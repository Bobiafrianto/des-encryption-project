import os
from flask import (
    Blueprint,
    render_template,
    request,
    jsonify,
    current_app,
    send_from_directory
)

from .des_engine import encrypt_data, decrypt_data
from .utils import allowed_file, generate_filename
from app.utils import cleanup_expired_files

main = Blueprint('main', __name__)


@main.route('/')
def index():
    return render_template('index.php')

@main.route('/encrypt', methods=['GET', 'POST'])
def encrypt():
    cleanup_expired_files()
    # GET → tampilkan halaman
    if request.method == 'GET':
        return render_template('encrypt.php')

    # POST → proses enkripsi (AJAX)
    file = request.files.get('file')
    key = request.form.get('key')

    # VALIDASI
    if not file or not key:
        return jsonify({
            "success": False,
            "message": "File dan key wajib diisi"
        }), 400

    if len(key) != 8:
        return jsonify({
            "success": False,
            "message": "Key DES harus 8 karakter"
        }), 400

    if not allowed_file(file.filename):
        return jsonify({
            "success": False,
            "message": "Tipe file tidak didukung"
        }), 400

    try:
        data = file.read()
        encrypted = encrypt_data(data, key.encode())
    except Exception as e:
        current_app.logger.exception("Gagal enkripsi")
        return jsonify({
            "success": False,
            "message": f"Gagal melakukan enkripsi: {e}"
        }), 500

    # SIMPAN FILE
    upload_folder = current_app.config.get(
        'UPLOAD_FOLDER',
        'app/static/uploads'
    )
    os.makedirs(upload_folder, exist_ok=True)

    output_filename = generate_filename(file.filename) + '.enc'
    output_path = os.path.join(upload_folder, output_filename)

    try:
        with open(output_path, 'wb') as f:
            f.write(encrypted)
    except Exception as e:
        current_app.logger.exception("Gagal menyimpan file")
        return jsonify({
            "success": False,
            "message": "Gagal menyimpan file terenkripsi"
        }), 500

    # 🔑 RETURN JSON (BUKAN FILE)
    return jsonify({
        "success": True,
        "filename": output_filename
    })


# ==============================
# ROUTE: DOWNLOAD
# ==============================
@main.route('/download/<filename>')
def download(filename):

    upload_folder = current_app.config.get(
        'UPLOAD_FOLDER', 'app/static/uploads'
    )
    file_path = os.path.join(upload_folder, filename)

    if not os.path.exists(file_path):
        return "File sudah kedaluwarsa atau tidak tersedia", 404

    return send_from_directory(
        upload_folder,
        filename,
        as_attachment=True
    )

@main.route('/decrypt', methods=['GET', 'POST'])
def decrypt():
    cleanup_expired_files()

    # =========================
    # GET → tampilkan halaman
    # =========================
    if request.method == 'GET':
        return render_template('decrypt.php')

    # =========================
    # POST → proses dekripsi (AJAX)
    # =========================
    file = request.files.get('file')
    key = request.form.get('key')

    # VALIDASI INPUT DASAR
    if not file or not key:
        return jsonify({
            "success": False,
            "message": "File dan key wajib diisi"
        }), 400

    if len(key) != 8:
        return jsonify({
            "success": False,
            "message": "Key DES harus 8 karakter"
        }), 400

    try:
        data = file.read()
        decrypted = decrypt_data(data, key.encode())

    # =========================
    # ERROR LOGIKA (EXPECTED)
    # =========================
    except ValueError as e:
        error_code = str(e)

        if error_code == "KEY_INVALID":
            message = "Key yang dimasukkan tidak valid"
        elif error_code == "FILE_INVALID":
            message = "File tidak valid atau rusak"
        elif error_code == "KEY_LENGTH_INVALID":
            message = "Key DES harus 8 karakter"
        else:
            message = "Gagal melakukan dekripsi"

        return jsonify({
            "success": False,
            "message": message
        }), 400

    # =========================
    # ERROR SISTEM (UNEXPECTED)
    # =========================
    except Exception:
        current_app.logger.exception("Gagal dekripsi (error sistem)")
        return jsonify({
            "success": False,
            "message": "Terjadi kesalahan sistem saat dekripsi"
        }), 500

    # =========================
    # SIMPAN FILE HASIL
    # =========================
    upload_folder = current_app.config.get(
        'UPLOAD_FOLDER',
        'app/static/uploads'
    )
    os.makedirs(upload_folder, exist_ok=True)

    original_name = file.filename.replace('.enc', '')
    output_filename = 'decrypted_' + original_name
    output_path = os.path.join(upload_folder, output_filename)

    try:
        with open(output_path, 'wb') as f:
            f.write(decrypted)
    except Exception:
        current_app.logger.exception("Gagal menyimpan file hasil dekripsi")
        return jsonify({
            "success": False,
            "message": "Gagal menyimpan file hasil dekripsi"
        }), 500

    # =========================
    # SUCCESS
    # =========================
    return jsonify({
        "success": True,
        "filename": output_filename
    })
