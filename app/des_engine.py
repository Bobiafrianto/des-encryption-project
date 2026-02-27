from Crypto.Cipher import DES
from Crypto.Util.Padding import pad, unpad

BLOCK_SIZE = 8  # DES bekerja pada blok 8 byte
MAGIC = b"CRYPTFILE::"  # Penanda untuk verifikasi key


def encrypt_data(data: bytes, key: bytes) -> bytes:
    """
    Enkripsi data menggunakan DES (CBC Mode)
    """
    if len(key) != 8:
        raise ValueError("KEY_LENGTH_INVALID")

    cipher = DES.new(key, DES.MODE_CBC)

    # Tambahkan magic header agar bisa diverifikasi saat dekripsi
    payload = MAGIC + data

    encrypted = cipher.encrypt(pad(payload, BLOCK_SIZE))

    # IV disimpan di awal file
    return cipher.iv + encrypted


def decrypt_data(data: bytes, key: bytes) -> bytes:
    """
    Dekripsi data menggunakan DES (CBC Mode)
    Akan melempar error custom jika key salah atau file rusak
    """
    if len(key) != 8:
        raise ValueError("KEY_LENGTH_INVALID")

    if not data or len(data) < BLOCK_SIZE:
        raise ValueError("FILE_INVALID")

    iv = data[:BLOCK_SIZE]
    ciphertext = data[BLOCK_SIZE:]

    cipher = DES.new(key, DES.MODE_CBC, iv)

    try:
        decrypted = unpad(cipher.decrypt(ciphertext), BLOCK_SIZE)
    except ValueError:
        # Padding error → key salah / file rusak
        raise ValueError("KEY_INVALID")

    # Verifikasi magic header
    if not decrypted.startswith(MAGIC):
        raise ValueError("KEY_INVALID")

    # Kembalikan plaintext tanpa magic header
    return decrypted[len(MAGIC):]
