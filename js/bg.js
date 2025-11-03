const themeToggle = document.getElementById("themeToggle");
const themeIcon = document.getElementById("themeIcon");

const savedThem = localStorage.getItem("them");
if (savedThem === "dark-mode") {
  document.body.classList.add("dark-mode");
  themeIcon.classList.replace("fa-sun", "fa-moon");
} else {
  document.body.classList.remove("dark-mode");
  themeIcon.classList.replace("fa-moon", "fa-sun");
}

themeToggle.addEventListener("click", () => {
  document.body.classList.toggle("dark-mode");
  // Save the current theme to localStorage
  if (document.body.classList.contains("dark-mode")) {
    localStorage.setItem("them", "dark-mode");
    themeIcon.classList.replace("fa-sun", "fa-moon");
  } else {
    localStorage.setItem("them", "light-mode");
    themeIcon.classList.replace("fa-moon", "fa-sun");
  }
});

//   // Change icon depending on the mode
//   if (document.body.classList.contains("dark-mode")) {
//     themeIcon.classList.replace("fa-moon", "fa-sun");
//   } else {
//     themeIcon.classList.replace("fa-sun", "fa-moon");
//   }
// });
