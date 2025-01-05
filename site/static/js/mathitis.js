const insertMathitis = (elemID) => {
  const row = document.getElementById(elemID);
  const inputs = row.getElementsByTagName("input");

  let data = {};
  for (let elem of inputs) {
    data[elem.dataset.insertKey] = elem.value;
  }

  const payload = JSON.stringify(data);

  const request = new XMLHttpRequest();
  request.onreadystatechange = () => {
    if (request.readyState !== XMLHttpRequest.DONE) return;

    if (request.status === 200) {
      toastSuccess("New row inserted successfully.");
      setTimeout(() => {
        window.location.reload();
      }, 2000);
      return;
    }

    if (request.status === 400) {
      toastError("Some values you gave are incorrect.");
      return;
    }

    toastError("Something went wrong.");
  };

  const base = getBasePath();
  const endpoint = `${base}mathitis/insert.php`;

  request.open("POST", endpoint, true);
  request.setRequestHeader("Content-Type", "application/json");
  request.send(payload);
};

const editMathitis = (elem) => {
  const rowID = parseInt(elem.dataset.rowid);
  const inputs = document.querySelectorAll(`[data-mathitis-input="${rowID}"]`);

  let data = { id: rowID };
  inputs.forEach((input) => {
    const key = input.dataset.mathitisInputKey;
    data[key] = input.value;
  });

  const payload = JSON.stringify(data);

  const request = new XMLHttpRequest();
  request.onreadystatechange = () => {
    if (request.readyState !== XMLHttpRequest.DONE) return;

    if (request.status === 200) {
      toastSuccess("Data updated successfully.");

      inputs.forEach((input) => {
        const key = input.dataset.mathitisInputKey;
        const elem = document.querySelector(
          `[data-mathitis-value-key="${key}"]`,
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

  const base = getBasePath();
  const endpoint = `${base}mathitis/update.php`;

  request.open("PATCH", endpoint, true);
  request.setRequestHeader("Content-Type", "application/json");
  request.send(payload);
};

const deleteMathitis = (elem) => {
  const rowID = parseInt(elem.dataset.rowid);
  const data = { id: rowID };
  const payload = JSON.stringify(data);

  const request = new XMLHttpRequest();
  request.onreadystatechange = () => {
    if (request.readyState !== XMLHttpRequest.DONE) return;

    if (request.status === 200) {
      toastSuccess("Row deleted successfully.");
      const row = document.querySelector(`tr[data-mathitis-row="${rowID}"]`);
      row.remove();
      return;
    }

    if (request.status === 400) {
      toastError("Invalid data sent to server.");
      return;
    }

    toastError("Something went wrong.");
  };

  const base = getBasePath();
  const endpoint = `${base}mathitis/delete.php`;

  request.open("DELETE", endpoint, true);
  request.setRequestHeader("Content-Type", "application/json");
  request.send(payload);
};

// Tooltips for MATHITIS
tippy("#mathitisIDInfo", {
  content: "The row's ID will be<br>generated automatically",
  placement: "bottom",
  animation: "fade",
  delay: [250, 0],
  allowHTML: true,
});

tippy("#insertMathitisButtonInfo", {
  content: "Insert row",
  placement: "bottom",
  animation: "fade",
  delay: [250, 0],
  allowHTML: false,
});
