<?php
include('db.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "SELECT * FROM student WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $image = $row['image'];
    } else {
        echo "Student record not found.";
        exit();
    }
} else {
    echo "Student ID not provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h4 class="text-secondary">Edit Student </h4>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>" class="form-control"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mobile</label>
                <input type="mobile" name="mobile" value="<?php echo $mobile; ?>" class="form-control"
                    id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="exampleInputPassword1">
                <img src="uploads/<?php echo $image; ?>" alt="Imageupdate" width=50 height=50 />
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>


    <?php
    session_start();
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $file_name = $_FILES['image']['name']; 

        if (!empty($file_name)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/'. $file_name)) {
                // Update data in the database
                $update_sql = "UPDATE student SET name='$name', email='$email', mobile='$mobile',  image='$file_name' WHERE id=$id";
                if(mysqli_query($conn, $update_sql)){
                    $_SESSION['success_update'] ="Record updated successfully";
                    header('Location:display.php');
                } else {
                    echo "Error: " . $update_sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            // Update data in the database without changing the image
            $update_sql = "UPDATE student SET name='$name', email='$email', mobile='$mobile' WHERE id=$id";
            if(mysqli_query($conn, $update_sql)){
                    $_SESSION['success_update'] ="Record updated successfully";
                header('Location:display.php');
            } else {
                echo "Error: " . $update_sql . "<br>" . mysqli_error($conn);
            }
        }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>