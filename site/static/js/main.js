const getBasePath = () => {
  let basePath = "/";
  if (location.hostname !== "localhost") {
    basePath = "/db2/student_2419/";
  }

  return basePath;
};

const goto = (path) => {
  // Takes you to the appropriate page, depending on the **base url**
  const basePath = getBasePath();
  window.location.replace(`${basePath}${path}`);
};
