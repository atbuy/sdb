const toastSuccess = (message) => {
  Toastify({
    text: message,
    duration: 2000,
    close: true,
    gravity: "top",
    position: "right",
    stopOnFocus: true,
    style: {
      background: "linear-gradient(to right, #37db73, #2fd42f)",
    },
  }).showToast();
};

const toastError = (message) => {
  Toastify({
    text: message,
    duration: 2000,
    close: true,
    gravity: "top",
    position: "right",
    stopOnFocus: true,
    style: {
      background: "linear-gradient(to right, #eb8934, #eb4034)",
    },
  }).showToast();
};
