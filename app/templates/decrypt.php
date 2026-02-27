{% extends 'base.php' %}
{% block title %}Cryptfile - Decrypt{% endblock %}

{% block content %}

<!-- Judul Halaman -->
<div class="text-center mb-4">
  <h4 class="card-title">Dekripsi File</h4>
  <p class="card-text">
    Unggah file terenkripsi (.enc) dan masukkan key untuk melakukan dekripsi
  </p>
</div>

<div class="row justify-content-center">
  <!-- FORM -->
  <div class="col-md-6 col-lg-5">
    <div class="card shadow-sm">
      <div class="card-header fw-bold">
        <i class="bi bi-unlock-fill me-2"></i>Decrypt File (DES)
      </div>

      <div class="card-body">
        <form id="decryptForm" enctype="multipart/form-data">

          <!-- File -->
          <div class="mb-3">
            <label class="form-label">
              <i class="bi bi-file-earmark-lock me-1"></i>File (.enc)
            </label>
            <input
              class="form-control"
              type="file"
              name="file"
              accept=".enc"
              required>
          </div>

          <!-- Key -->
          <div class="mb-3">
            <label class="form-label">
              <i class="bi bi-key-fill me-1"></i>Key (8 karakter)
            </label>
            <input
              class="form-control"
              type="password"
              name="key"
              placeholder="Masukkan 8 karakter key"
              maxlength="8"
              minlength="8"
              required
              autocomplete="off">
          </div>

          <!-- Tombol -->
          <button id="decryptBtn" class="btn btn-primary w-100" type="submit">
            <i class="bi bi-unlock me-1"></i>Decrypt File
          </button>

        </form>

        <!-- LOADING -->
        <div id="loading" class="text-center mt-3 d-none">
          <div class="spinner-border text-primary mb-2" role="status"></div>
          <p id="loadingText" class="mb-0 loading-text"></p>
        </div>

        <!-- DOWNLOAD -->
        <div id="downloadSection" class="text-center mt-3 d-none">
          <a id="downloadLink" class="btn btn-success w-100">
            <i class="bi bi-download me-1"></i>Download File
          </a>
        </div>

      </div>
    </div>
  </div>

  <!-- INFO -->
  <div class="col-md-5 col-lg-4 mt-4 mt-md-0">
    <div class="card border-0 bg-light h-100">
      <div class="card-body">
        <h6 class="card-title mb-3">
          <i class="bi bi-info-circle me-2"></i>Informasi
        </h6>
        <ul class="card-text mb-0">
          <li>File akan didekripsi menggunakan algoritma DES</li>
          <li>Key harus sama dengan saat enkripsi</li>
          <li>File hasil dapat langsung diunduh</li>
        </ul>
      </div>
    </div>
  </div>
</div>

{% endblock %}