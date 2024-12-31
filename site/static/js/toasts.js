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

const resetToast = () => {
  Toastify({
    text: "This will reset the entire database<br>Click the button below to <b>reset the database.</b><br><button class='reset-button' onclick='resetDatabase()'>Reset</button>",
    duration: 10000,
    escapeMarkup: false,
    gravity: "top",
    position: "right",
    stopOnFocus: true,
    style: {
      background: "#303030"
    }
  }).showToast();
}
