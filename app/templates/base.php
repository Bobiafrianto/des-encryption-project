<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{% block title %}Cryptfile{% endblock %}</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ url_for('static', filename='css/style.css') }}" />
  <link rel="icon" type="image/x-icon" href="{{ url_for('static', filename='img/icon/cryptfile.ico') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Changa+One:ital@0;1&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Quantico:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

</head>

<body class="d-flex flex-column min-vh-100">

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-none navbar-compact">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="/">
        <img
          src="{{ url_for('static', filename='img/logo/cryptfile.png') }}"
          alt="Cryptfile Logo"
          class="navbar-logo" />
      </a>

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse mobile-nav" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link {% if request.path == '/' %}active{% endif %}" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {% if request.path == '/encrypt' %}active{% endif %}" href="/encrypt">Encrypt</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {% if request.path == '/decrypt' %}active{% endif %}" href="/decrypt">Decrypt</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- CONTENT -->
  <main class="container flex-fill">

    {% if request.path != '/error' %}
    {% with messages = get_flashed_messages() %}
    {% if messages %}
    <div class="alert alert-warning">
      {% for m in messages %}
      <div>{{ m }}</div>
      {% endfor %}
    </div>
    {% endif %}
    {% endwith %}
    {% endif %}

    {% block content %}{% endblock %}

  </main>


  <!-- ERROR MODAL -->
  <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>Terjadi Kesalahan
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="errorModalBody">
          <!-- pesan error diisi lewat JS -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Tutup
          </button>
        </div>
      </div>
    </div>
  </div>


  <!-- FOOTER -->
  <footer class="bg-dark text-light pt-4 mt-auto">
    <div class="text-center pb-3">
      <small class="footer-text">
        © 2025 Cryptfile • All rights reserved
      </small>
    </div>
  </footer>


  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ url_for('static', filename='js/encrypt-validation.js') }}"></script>
  <script src="{{ url_for('static', filename='js/crypto-process.js') }}"></script>

</body>


</html>