const languageBtn = document.getElementById("language");

// Function to load Pashto translation
async function loadPashto() {
  try {
    const res = await fetch("languages/pashto.json");
    const data = await res.json();

    document.querySelectorAll("[data-translate]").forEach((el) => {
      const key = el.getAttribute("data-translate");
      if (data[key]) el.innerText = data[key];
    });
  } catch (error) {
    console.error("Error loading Pashto:", error);
  }
}

// Get saved language (default English)
const savedLang = localStorage.getItem("savedLanguage") || "english";

// Initialize page language
(async function initLanguage() {
  if (savedLang === "pashto") {
    await loadPashto();
    languageBtn.innerText = "PS";
  } else {
    languageBtn.innerText = "EN";
  }

  // ✅ Show content only after initialization
  document.body.classList.add("loaded");
})();

// Toggle button click
languageBtn.addEventListener("click", async () => {
  if (languageBtn.innerText === "EN") {
    localStorage.setItem("savedLanguage", "pashto");
    languageBtn.innerText = "PS";
    await loadPashto();
  } else {
    localStorage.removeItem("savedLanguage");
    languageBtn.innerText = "EN";
    window.location.reload(); // Reload to restore default English
  }
});
