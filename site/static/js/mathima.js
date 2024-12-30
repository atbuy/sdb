const insertMathima = (elem) => {
  console.log(elem);
};

const editMathima = (elem) => {
  const rowID = parseInt(elem.dataset.rowid);
  const inputs = document.querySelectorAll(`[data-mathima-input="${rowID}"]`);

  let data = { id: rowID };

  inputs.forEach((input) => {
    const key = input.dataset.mathimaInputKey;
    data[key] = input.value;
  });

  const payload = JSON.stringify(data);

  // Start new AJAX request
  const request = new XMLHttpRequest();

  // Handle cases to update row depending on response status
  request.onreadystatechange = () => {
    if (request.readyState !== XMLHttpRequest.DONE) return;

    if (request.status === 200) {
      toastSuccess("Data updated successfully.");

      // Since the request was successful, we need to update
      // the row data in the `span`s, so that the user does not
      // need to refresh the page after each save
      inputs.forEach((input) => {
        const key = input.dataset.mathimaInputKey;
        const elem = document.querySelector(
          `[data-mathima-value-key="${key}"]`,
        );

        if (!elem) return;

        elem.innerHTML = data[key];
      });

      return;
    }

    if (request.status === 400) {
      toastError("Invalid data sent to server.");
      return;
    }

    toastError("Something went wrong.");
  };

  // Set options and send request to update.php
  request.open("PATCH", "/mathima/update.php", true);
  request.setRequestHeader("Content-Type", "application/json");
  request.send(payload);
};

const deleteMathima = (elem) => {
  const rowID = parseInt(elem.dataset.rowid);
  const data = { id: rowID };
  const payload = JSON.stringify(data);

  // Start new AJAX request
  const request = new XMLHttpRequest();

  // Handle cases to update row depending on response status
  request.onreadystatechange = () => {
    if (request.readyState !== XMLHttpRequest.DONE) return;

    if (request.status === 200) {
      toastSuccess("Row deleted successfully.");

      // Response was successful so we need to delete the row clicked
      const row = document.querySelector(`tr[data-mathima-row="${rowID}"]`);
      row.remove();

      return;
    }

    if (request.status === 400) {
      toastError("Invalid data sent to server.");
      return;
    }

    toastError("Something went wrong.");
  };

  // Set options and send request to update.php
  request.open("DELETE", "/mathima/delete.php", true);
  request.setRequestHeader("Content-Type", "application/json");
  request.send(payload);
};
