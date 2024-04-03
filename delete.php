<?php
session_start();
include('db.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "SELECT * FROM student WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        // Delete the record
        $delete_query = "DELETE FROM student WHERE id = $id";
        if(mysqli_query($conn, $delete_query)) {
            echo "Record deleted successfully";
            $_SESSION['success_delete'] = "Record deleted successfully!";
            header('Location: display.php'); // Redirect to display page after deletion
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
            exit();
        }
    } else {
        echo "Student record not found.";
        exit();
    }
} else {
    echo "Student ID not provided.";
    exit();
}
?>