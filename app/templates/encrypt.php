{% extends 'base.php' %}
{% block title %}Cryptfile - Encrypt{% endblock %}

{% block content %}

<div class="text-center mb-4">
  <h4 class="card-title">Enkripsi File</h4>
  <p class="card-text">
    Unggah file dan masukkan key untuk mengenkripsi data menggunakan algoritma DES
  </p>
</div>

<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow-sm">
      <div class="card-header fw-bold">
        <i class="bi bi-lock-fill me-2"></i>Encrypt File (DES)
      </div>

      <div class="card-body">
        <form id="encryptForm" enctype="multipart/form-data" novalidate>

          <!-- File -->
          <div class="mb-3">
            <label class="form-label">
              <i class="bi bi-file-earmark-lock me-1"></i>File
            </label>

            <input
              class="form-control"
              type="file"
              name="file"
              id="fileInput"
              accept=".txt,.pdf,.docx,.xlsx,.png,.jpg,.jpeg,.webp,.csv,.pptx,.mkv,.mp4,.mp3"
              required>

            <div class="invalid-feedback" id="fileError"></div>
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

          <button id="encryptBtn" class="btn btn-primary w-100" type="submit">
            <i class="bi bi-lock me-1"></i>Encrypt File
          </button>

        </form>

        <div id="loading" class="text-center mt-3 d-none">
          <div class="spinner-border text-primary mb-2" role="status"></div>
          <p id="loadingText" class="mb-0 loading-text"></p>
        </div>

        <div id="downloadSection" class="text-center mt-3 d-none">
          <a id="downloadLink" class="btn btn-success w-100">
            <i class="bi bi-download me-1"></i>Download File
          </a>
        </div>

      </div>
    </div>
  </div>

  <div class="col-md-5 col-lg-4 mt-4 mt-md-0">
    <div class="card border-0 bg-light h-100">
      <div class="card-body">
        <h6 class="card-title mb-3">
          <i class="bi bi-info-circle me-2"></i>Informasi
        </h6>
        <ul class="card-text mb-0">
          <li>File diproses menggunakan algoritma DES</li>
          <li>File yang diupload tidak lebih dari 100 MB</li>
          <li>Key tidak disimpan oleh sistem</li>
          <li>Gunakan key yang sama saat dekripsi</li>
        </ul>
      </div>
    </div>
  </div>
</div>

{% endblock %}