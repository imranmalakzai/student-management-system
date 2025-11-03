// =================== SweetAlert Helpers =================== //

// Success Alert
function showSuccess(message = "Operation successful!") {
  Swal.fire({
    icon: "success",
    title: message,
    showConfirmButton: false,
    timer: 1500,
  });
}

// Error Alert
function showError(message = "Something went wrong!") {
  Swal.fire({
    icon: "error",
    title: "Error",
    text: message,
  });
}

// Warning Confirmation (for delete or risky actions)
async function showConfirmDialog({
  title = "Are you sure?",
  text = "You won't be able to revert this!",
  confirmButtonText = "Yes, do it!",
  cancelButtonText = "Cancel",
  icon = "warning",
  confirmButtonColor = "#d33",
  cancelButtonColor = "#6c757d",
} = {}) {
  return await Swal.fire({
    title,
    text,
    icon,
    showCancelButton: true,
    confirmButtonColor,
    cancelButtonColor,
    confirmButtonText,
    cancelButtonText,
  });
}
