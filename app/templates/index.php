{% extends 'base.php' %} {% block title %}Cryptfile - Home{% endblock
%} {% block content %}
<div class="bg-light rounded-3 hero-box">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center px-2" href="/">
      <img
        src="{{ url_for('static', filename='img/logo/cryptfile.png') }}"
        alt="Cryptfile Logo"
        class="navbar-logo" />
    </a>
    <p class="hero-text mt-2 px-2">
      Sistem ini merupakan aplikasi berbasis web untuk melakukan enkripsi dan dekripsi
      file menggunakan algoritma Data Encryption Standard (DES). Pengguna dapat memilih file,
      memasukkan key sepanjang 8 karakter, kemudian mengunduh hasil proses enkripsi atau dekripsi.
    </p>
    <div class="px-2">
      <a class="btn btn-primary btn-hero" href="/encrypt">Encrypt File</a>
      <a class="btn btn-outline-secondary btn-hero" href="/decrypt">Decrypt File</a>
    </div>
  </div>
</div>

<!-- FITUR UTAMA -->
<div class="container my-5">
  <h2 class="section-title text-center">Fitur Utama</h2>
  <div class="row g-4">

    <!-- FITUR 1 -->
    <div class="col-md-6 d-flex">
      <div class="me-3 fs-2 text-primary">
        <i class="bi bi-shield-lock"></i>
      </div>
      <div>
        <h5 class="card-title">Lindungi File dengan Key</h5>
        <p class="card-text mb-0">
          Lindungi file Anda dengan memasukkan key sepanjang 8 karakter sesuai
          dengan spesifikasi algoritma DES untuk proses enkripsi dan dekripsi.
        </p>
      </div>
    </div>

    <!-- FITUR 2 -->
    <div class="col-md-6 d-flex">
      <div class="me-3 fs-2 text-primary">
        <i class="bi bi-lock-fill"></i>
      </div>
      <div>
        <h5 class="card-title">Enkripsi Simetris (DES)</h5>
        <p class="card-text mb-0">
          Sistem menggunakan algoritma Data Encryption Standard (DES) sebagai
          metode kriptografi simetris untuk tujuan pembelajaran mata kuliah
          Cryptography.
        </p>
      </div>
    </div>

    <!-- FITUR 3 -->
    <div class="col-md-6 d-flex">
      <div class="me-3 fs-2 text-primary">
        <i class="bi bi-clock-history"></i>
      </div>
      <div>
        <h5 class="card-title">Penghapusan Otomatis File</h5>
        <p class="card-text mb-0">
          Demi menjaga privasi pengguna, file yang diunggah akan dihapus secara
          otomatis dari server dalam waktu <strong>10 menit</strong>.
        </p>
      </div>
    </div>

    <!-- FITUR 4 -->
    <div class="col-md-6 d-flex">
      <div class="me-3 fs-2 text-primary">
        <i class="bi bi-file-earmark-text"></i>
      </div>
      <div>
        <h5 class="card-title">Tipe File</h5>
        <p class="card-text mb-0">
          Tipe file yang didukung meliputi:
          <strong>txt, pdf, docx, xlsx, csv, pptx, png, jpg, jpeg, webp,
            mp3, mkv, dan mp4</strong>.
        </p>
      </div>
    </div>


  </div>
</div>

<!-- PERHATIAN -->
<div class="col-md-12 text-center">
  <div class="card mb-3 border-danger bg-danger bg-opacity-10">
    <div class="card-body">
      <h5 class="card-title text-danger">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        Perhatian
      </h5>
      <p class="card-text">
        Aplikasi ini dirancang sebagai media demonstrasi dalam proses pembelajaran kriptografi.
        Seluruh fitur yang disediakan tidak ditujukan untuk menjamin keamanan data pada skala produksi,
        sehingga penggunaan terhadap data sensitif sangat tidak dianjurkan.
      </p>
    </div>
  </div>
</div>

<!-- TATA CARA PENGGUNAAN -->
<div class="card mt-4">
  <div class="card-body">
    <h4 class="card-title mb-3">
      Tata Cara Penggunaan
    </h4>

    <ol class="card-text fs-6">
      <li class="mb-2">
        Pilih menu <strong>Encrypt</strong> untuk melakukan enkripsi file atau
        <strong>Decrypt</strong> untuk melakukan dekripsi file.
      </li>
      <li class="mb-2">
        Unggah file yang ingin diproses sesuai dengan format yang didukung oleh sistem.
      </li>
      <li class="mb-2">
        Masukkan <strong>key sepanjang 8 karakter</strong> sebagai kunci enkripsi atau dekripsi.
      </li>
      <li class="mb-2">
        Klik tombol <strong>Encrypt</strong> atau <strong>Decrypt</strong> sesuai kebutuhan.
      </li>
      <li class="mb-2">
        Tunggu proses selesai, kemudian unduh file hasil enkripsi atau dekripsi yang tersedia.
      </li>
    </ol>
  </div>
</div>

{% endblock %}