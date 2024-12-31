const resetDatabase = () => {
  // Send a DELETE request to the /reset.php endpoint,
  // so that the database can be restored to its intial state.

  const request = new XMLHttpRequest();

  request.onreadystatechange = () => {
    if (request.readyState !== XMLHttpRequest.DONE) return;

    const response = JSON.parse(request.response);

    if (request.status === 200) {
      toastSuccess(response["message"]);
      return;
    }

    toastError(response["message"]);
  };

  // Set options and send request to reset.php
  request.open("DELETE", "/reset.php", true);
  request.send();
};
