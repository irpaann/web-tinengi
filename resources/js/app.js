import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


document.addEventListener("DOMContentLoaded", () => {
    const themeToggleBtn = document.getElementById("theme-toggle");

    // Fungsi update teks tombol
    function updateButtonText() {
        if (document.documentElement.classList.contains("dark")) {
            themeToggleBtn.textContent = "Light";
        } else {
            themeToggleBtn.textContent = "Dark";
        }
    }

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener("click", () => {
            document.documentElement.classList.toggle("dark");

            if (document.documentElement.classList.contains("dark")) {
                localStorage.setItem("theme", "dark");
            } else {
                localStorage.setItem("theme", "light");
            }

            updateButtonText();
        });

        // Saat reload, cek preferensi
        if (localStorage.getItem("theme") === "dark") {
            document.documentElement.classList.add("dark");
        }

        updateButtonText(); // set teks pertama kali
    }
});
