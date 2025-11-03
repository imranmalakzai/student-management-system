document
  .getElementById("logoutBtn")
  .addEventListener("click", async function (event) {
    event.preventDefault();

    const confirmLogout = await Swal.fire({
      title: "Are you sure?",
      text: "You will be logged out of your admin account.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#7D53F3",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Logout",
    });

    if (confirmLogout.isConfirmed) {
      try {
        const res = await fetch("Admin/logout.php");
        const data = await res.json();

        if (data.status === "success") {
          Swal.fire({
            icon: "success",
            title: "Logged out",
            text: "Redirecting to login page...",
            showConfirmButton: false,
            timer: 1000,
          });
          setTimeout(() => {
            window.location.href = "Admin/login.php";
          }, 1000);
        }
      } catch (error) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Unable to logout. Try again later.",
        });
      }
    }
  });
