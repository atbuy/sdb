<?php
include "../connect.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        die("Invalid ID.");
    }

    $query = $conn->prepare("DELETE FROM MATHITIS WHERE id = ?");
    $query->bind_param("i", $id);

    if ($query->execute()) {
        $query->close();
        header("Location: index.php");
        exit();
    } else {
        $query->close();
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>