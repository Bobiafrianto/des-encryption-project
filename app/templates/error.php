{% extends 'base.php' %} {% block title %}Error - DES File Encryption{%
endblock %} {% block content %}
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="alert alert-danger">
      <h4 class="alert-heading">Terjadi Kesalahan</h4>
      {% if message %}
      <p>{{ message }}</p>
      {% endif %} {% for m in get_flashed_messages() %}
      <p>{{ m }}</p>
      {% endfor %}
      <hr />
      <a href="/" class="btn btn-secondary">Kembali ke Beranda</a>
    </div>
  </div>
</div>
{% endblock %}
