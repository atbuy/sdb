<?php

include "../connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    $full_name = $data['full_name'];
    $age = $data['age'];
    $class_year = $data['class_year'];
    $school = $data['school'];
    $absences = $data['absences'];

    // Input validation
    if (empty($full_name) || !is_numeric($age) || !is_numeric($class_year) || empty($school) || !is_numeric($absences)) {
        die("Invalid input. Please check your data.");
    }

    $query = $conn->prepare("INSERT INTO MATHITIS (full_name, age, class_year, school, absences) VALUES (?, ?, ?, ?, ?)");
    $query->bind_param("siisi", $full_name, $age, $class_year, $school, $absences);

    if ($query->execute()) {
        $query->close();
        header("Location: index.php");
        exit();
    } else {
        $query->close();
        echo "Error inserting record: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
</head>
<body>
<form method="post">
    <label>Full Name: <input type="text" name="full_name" required></label><br>
    <label>Age: <input type="number" name="age" required></label><br>
    <label>Class Year: <input type="number" name="class_year" required></label><br>
    <label>School: <input type="text" name="school" required></label><br>
    <label>Absences: <input type="number" name="absences" required></label><br>
    <button type="submit">Add Student</button>
</form>
</body>
</html>

