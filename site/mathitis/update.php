<?php
include "../connect.php";

if ($_SERVER["REQUEST_METHOD"] === "PATCH") {
    $data = json_decode(file_get_contents("php://input"), true);

    $id = $data['id'];
    $full_name = $data['full_name'];
    $age = $data['age'];
    $class_year = $data['class_year'];
    $school = $data['school'];
    $absences = $data['absences'];

    if (!filter_var($id, FILTER_VALIDATE_INT) || empty($full_name) || !is_numeric($age) || !is_numeric($class_year) || empty($school) || !is_numeric($absences)) {
        die("Invalid input. Please check your data.");
    }

    $query = $conn->prepare("UPDATE MATHITIS SET full_name=?, age=?, class_year=?, school=?, absences=? WHERE id=?");
    $query->bind_param("siisii", $full_name, $age, $class_year, $school, $absences, $id);

    if ($query->execute()) {
        $query->close();
        header("Location: index.php");
        exit();
    } else {
        $query->close();
        echo "Error updating record: " . $conn->error;
    }
}
$id = $_GET['id'];

if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("Invalid ID.");
}

$query = $conn->prepare("SELECT * FROM MATHITIS WHERE id = ?");
$query->bind_param("i", $id);

if (!$query->execute()) {
    die("Error fetching record: " . $conn->error);
}

$result = $query->get_result();
$row = $result->fetch_assoc();
$query->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
<form method="post">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <label>Full Name: <input type="text" name="full_name" value="<?= htmlspecialchars($row['full_name']) ?>" required></label><br>
    <label>Age: <input type="number" name="age" value="<?= $row['age'] ?>" required></label><br>
    <label>Class Year: <input type="number" name="class_year" value="<?= $row['class_year'] ?>" required></label><br>
    <label>School: <input type="text" name="school" value="<?= htmlspecialchars($row['school']) ?>" required></label><br>
    <label>Absences: <input type="number" name="absences" value="<?= $row['absences'] ?>" required></label><br>
    <button type="submit">Update Student</button>
</form>
</body>
</html>