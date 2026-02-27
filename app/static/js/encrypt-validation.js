document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("encryptForm");
  if (!form) return;

  const fileInput = document.getElementById("fileInput");
  const fileError = document.getElementById("fileError");

  const allowedExt = [
    "txt",
    "pdf",
    "docx",
    "xlsx",
    "png",
    "jpg",
    "jpeg",
    "webp",
    "csv",
    "pptx",
    "mkv",
    "mp4",
    "mp3",
  ];

  const MAX_SIZE = 100 * 1024 * 1024; // 100 MB

  form.addEventListener("submit", function (e) {
    // reset
    fileInput.classList.remove("is-invalid");
    fileError.textContent = "";

    if (!fileInput.files || fileInput.files.length === 0) {
      e.preventDefault();
      fileInput.classList.add("is-invalid");
      fileError.textContent = "Silakan pilih file terlebih dahulu.";
      return;
    }

    const file = fileInput.files[0];
    const ext = file.name.split(".").pop().toLowerCase();

    if (!allowedExt.includes(ext)) {
      e.preventDefault();
      fileInput.classList.add("is-invalid");
      fileError.textContent =
        "Tipe file tidak didukung. Gunakan: " + allowedExt.join(", ");
      return;
    }

    if (file.size > MAX_SIZE) {
      e.preventDefault(); // ⬅️ INI KUNCI UTAMA
      fileInput.classList.add("is-invalid");
      fileError.textContent = "Ukuran file maksimal 100 MB.";
      return;
    }

    // ✅ kalau lolos semua → submit LANJUT
  });
});
