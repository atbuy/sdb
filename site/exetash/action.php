<?php

include '../connect.php';

try {
    // Check if the form data is received via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['delete'])) {
            // Get the ID of the row to delete
            $id = $_POST['id'];

            // Delete query
            $delete_query = "DELETE FROM EXETASH WHERE id = ?";
            $stmt = mysqli_prepare($conn, $delete_query);

            if ($stmt) {
                // Bind the parameter and execute the delete statement
                mysqli_stmt_bind_param($stmt, 'i', $id);
                if (mysqli_stmt_execute($stmt)) {
                    // Redirect back to the index page after deletion
                    header("Location: index.php");
                    exit();
                } else {
                    throw new Exception("Failed to delete record: " . mysqli_error($conn));
                }
            } else {
                throw new Exception("Error preparing delete statement: " . mysqli_error($conn));
            }
        } elseif (isset($_POST['save'])) {
            // Updating a row when the save button is pressed
            $id = $_POST['id'];
            $student = $_POST['student'];
            $lesson = $_POST['lesson'];
            $grade = $_POST['grade'];

            // Update query
            $update_query = "UPDATE EXETASH SET student = ?, lesson = ?, grade = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $update_query);

            if ($stmt) {
                // Bind the parameters and execute the update statement
                mysqli_stmt_bind_param($stmt, 'sssi', $student, $lesson, $grade, $id);
                if (mysqli_stmt_execute($stmt)) {
                    // Redirect back to the index page after saving
                    header("Location: index.php");
                    exit();
                } else {
                    throw new Exception("Failed to update record: " . mysqli_error($conn));
                }
            } else {
                throw new Exception("Error preparing update statement: " . mysqli_error($conn));
            }
        } else {
            // Inserting a new row when the insert button is pressed
            $student = $_POST['student'];
            $lesson = $_POST['lesson'];
            $grade = $_POST['grade'];

            // Validate input
            if (!empty($student) && !empty($lesson) && !empty($grade)) {
                // Insert query
                $insert_query = "INSERT INTO EXETASH (student, lesson, grade) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conn, $insert_query);

                if ($stmt) {
                    // Bind the parameters and execute the insert statement
                    mysqli_stmt_bind_param($stmt, 'sss', $student, $lesson, $grade);
                    if (mysqli_stmt_execute($stmt)) {
                        // Redirect back to the main page after insertion
                        header("Location: index.php");
                        exit();
                    } else {
                        throw new Exception("Failed to insert record: " . mysqli_error($conn));
                    }
                } else {
                    throw new Exception("Error preparing insert statement: " . mysqli_error($conn));
                }
            } else {
                throw new Exception("All fields are required!");
            }
        }
    } else {
        // Redirect if accessed directly
        header("Location: index.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    // Handle database-specific exceptions
    $error_message = "Database error: " . $e->getMessage();
    header("Location: index.php?error=" . urlencode($error_message));
    exit();
} catch (Exception $e) {
    // Handle general exceptions
    $error_message = $e->getMessage();
    header("Location: index.php?error=" . urlencode($error_message));
    exit();
}
?>