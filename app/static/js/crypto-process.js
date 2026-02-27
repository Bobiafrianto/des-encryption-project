document.addEventListener("DOMContentLoaded", function () {
  let loadingInterval = null;

  const MAX_SIZE = 100 * 1024 * 1024; // 100 MB

  function startLoading(texts) {
    let index = 0;
    const loadingText = document.getElementById("loadingText");
    if (!loadingText) return;

    loadingText.textContent = texts[index];
    loadingInterval = setInterval(() => {
      index = (index + 1) % texts.length;
      loadingText.textContent = texts[index];
    }, 1200);
  }

  function stopLoading() {
    if (loadingInterval) {
      clearInterval(loadingInterval);
      loadingInterval = null;
    }
  }

  async function handleCryptoForm(config) {
    const form = document.getElementById(config.formId);
    if (!form) return;

    const button = document.getElementById(config.buttonId);
    const loading = document.getElementById("loading");
    const downloadSection = document.getElementById("downloadSection");
    const downloadLink = document.getElementById("downloadLink");

    const fileInput = form.querySelector('input[type="file"]');
    const fileError = document.getElementById("fileError");

    form.addEventListener("submit", async function (e) {
      e.preventDefault();

      // ===== VALIDASI UKURAN FILE (GATE UTAMA) =====
      if (!fileInput || !fileInput.files.length) {
        return;
      }

      const file = fileInput.files[0];

      if (file.size > MAX_SIZE) {
        if (fileError) {
          fileInput.classList.add("is-invalid");
          fileError.textContent = "Ukuran file maksimal 100 MB.";
        }
        return; // ⬅️ STOP TOTAL, FETCH TIDAK JALAN
      }

      // ===== RESET UI =====
      if (fileError) {
        fileInput.classList.remove("is-invalid");
        fileError.textContent = "";
      }

      button.disabled = true;
      loading.classList.remove("d-none");
      downloadSection.classList.add("d-none");
      startLoading(config.loadingTexts);

      const formData = new FormData(form);

      try {
        const response = await fetch(config.endpoint, {
          method: "POST",
          body: formData,
        });

        const result = await response.json();

        stopLoading();
        loading.classList.add("d-none");
        button.disabled = false;

        if (!result.success) {
          showErrorModal(result.message);
          return;
        }

        downloadLink.href = `/download/${result.filename}`;
        downloadSection.classList.remove("d-none");

        downloadLink.onclick = () => {
          form.reset();
          downloadSection.classList.add("d-none");
        };
      } catch (err) {
        stopLoading();
        loading.classList.add("d-none");
        button.disabled = false;
        showErrorModal("Terjadi kesalahan sistem");
      }
    });
  }

  handleCryptoForm({
    formId: "encryptForm",
    buttonId: "encryptBtn",
    endpoint: "/encrypt",
    loadingTexts: [
      "Membaca file...",
      "Memproses enkripsi...",
      "Mengamankan data...",
      "Menyimpan hasil...",
    ],
  });

  handleCryptoForm({
    formId: "decryptForm",
    buttonId: "decryptBtn",
    endpoint: "/decrypt",
    loadingTexts: [
      "Membaca file terenkripsi...",
      "Memproses dekripsi...",
      "Mengembalikan data...",
      "Menyimpan hasil...",
    ],
  });
});

// MODAL ERROR
function showErrorModal(message) {
  const modalEl = document.getElementById("errorModal");
  const bodyEl = document.getElementById("errorModalBody");
  bodyEl.innerText = message;
  new bootstrap.Modal(modalEl).show();
}
