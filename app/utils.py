import os
import uuid
import time
from flask import current_app

# =============================
# ALLOWED FILE EXTENSIONS
# =============================
ALLOWED_EXTENSIONS = {
    'txt', 'pdf', 'docx', 'xlsx',
    'png', 'jpg', 'jpeg', 'webp',
    'csv', 'pptx',
    'mkv', 'mp4', 'mp3'
}

# =============================
# VALIDASI EKSTENSI FILE
# =============================
def allowed_file(filename: str) -> bool:
    if not filename or '.' not in filename:
        return False
    return filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS

# =============================
# GENERATE NAMA FILE AMAN
# =============================
def generate_filename(original_name: str) -> str:
    """
    Menghasilkan nama file unik berbasis UUID
    Ekstensi dipertahankan
    """
    if '.' not in original_name:
        return uuid.uuid4().hex

    ext = original_name.rsplit('.', 1)[1].lower()
    return f"{uuid.uuid4().hex}.{ext}"

# =============================
# AUTO DELETE FILE EXPIRED
# =============================
def cleanup_expired_files():
    """
    Menghapus file di UPLOAD_FOLDER
    yang usianya melebihi FILE_EXPIRE_TIME
    """
    upload_folder = current_app.config.get(
        'UPLOAD_FOLDER', 'app/static/uploads'
    )
    expire_time = current_app.config.get(
        'FILE_EXPIRE_TIME', 600
    )

    if not os.path.exists(upload_folder):
        return

    now = time.time()

    for filename in os.listdir(upload_folder):
        file_path = os.path.join(upload_folder, filename)

        if not os.path.isfile(file_path):
            continue

        file_age = now - os.path.getmtime(file_path)

        if file_age > expire_time:
            try:
                os.remove(file_path)
                current_app.logger.info(
                    "Deleted expired file: %s", filename
                )
            except Exception as e:
                current_app.logger.error(
                    "Failed to delete file %s: %s", filename, e
                )
