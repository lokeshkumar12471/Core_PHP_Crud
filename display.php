<?php
session_start();
include('db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <h4 class="text-secondary">Student Details</h4>

        <?php if(isset($_SESSION['success_create'])): ?>
        <div id="createSuccessAlert" class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['success_create']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success_create']); ?>
        <?php elseif(isset($_SESSION['success_update'])): ?>
        <div id="updateSuccessAlert" class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['success_update']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success_update']); ?>
        <?php elseif(isset($_SESSION['success_delete'])): ?>
        <div id="deleteSuccessAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['success_delete']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success_delete']); ?>
        <?php endif; ?>

        <a href="create.php"><button class="btn btn-primary float-end">Add</button></a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result  = mysqli_query($conn, "SELECT * FROM student");
                
                $sno= 1;
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $sno. "</th>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['mobile'] . "</td>";
                    echo "<td><img src='uploads/" . $row['image'] . "' style='width: 50px; height: 50px;' alt=''></td>";
                    echo "<td><a href='edit.php?id=" . $row['id'] . "'><button class='btn btn-warning btn-sm mx-1'>Edit</button></a>";
                    echo "<a href='delete.php?id=" . $row['id'] . "'><button onclick='return confirmDelete()' class='btn btn-danger btn-sm mx-1'>Delete</button></a></td>";
                    echo "</tr>";
                    $sno++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this record?");
    }
    </script>

    <script>
    setTimeout(function() {
        <?php if(isset($_SESSION['success_create'])): ?>
        document.getElementById('createSuccessAlert').style.display = 'none';
        <?php elseif(isset($_SESSION['success_update'])): ?>
        document.getElementById('updateSuccessAlert').style.display = 'none';
        <?php elseif(isset($_SESSION['success_delete'])): ?>
        document.getElementById('deleteSuccessAlert').style.display = 'none';
        <?php endif; ?>
    }, 2000);
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>