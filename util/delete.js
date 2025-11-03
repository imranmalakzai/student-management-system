export function confirmAction(message = "Are you sure?") {
  return new Promise((resolve) => {
    const confirmed = window.confirm(message);
    resolve(confirmed);
  });
}

export function showMessage(message) {
  alert(message);
}
