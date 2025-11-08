//============== Login Page ==============//
const form = document.getElementById("loginForm");

form.addEventListener("submit", async function (event) {
  event.preventDefault();

  try {
    const username = form.querySelector('input[name="username"]').value;
    const password = form.querySelector('input[name="password"]').value;

    const formData = new FormData();
    formData.append("username", username);
    formData.append("password", password);

    const res = await fetch("login.api.php", {
      method: "POST",
      body: formData,
    });

    const data = await res.json(); // ✅ parse JSON properly

    if (data.status === "success") {
      showSuccess("Login successful! Redirecting...");
      setTimeout(() => {
        window.location.href = "../index.php";
      }, 1000);
    } else {
      showError(data.message || "Login failed. Please try again.");
    }
  } catch (error) {
    console.error(error);
    showError("An error occurred. Please try again.");
  }
});

//======================= Eye Icons for showing and hiding the password =========================//
const password = document.querySelector("[type = 'password']");
const eye = document.querySelector(".eye");

password.addEventListener("input", function () {
  try {
    if (this.value.trim()) {
      eye.removeAttribute("hidden");
      eye.addEventListener("click", () => {
        if (password.type === "password") {
          password.type = "text";
          eye.classList.remove("fa-eye");
          eye.classList.add("fa-eye-slash");
        } else {
          password.type = "password";
          eye.classList.remove("fa-eye-slash");
          eye.classList.add("fa-eye");
        }
      });
    }
  } catch (error) {
    console.log(error);
  }
});
