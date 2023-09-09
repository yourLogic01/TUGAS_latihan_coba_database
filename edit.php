<?php 
    include_once("connection.php");
    // Initialize variables
    $id = "";
    $name = "";
    $address = "";

    // Check if 'id' is set in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = mysqli_query($mysqli, "SELECT * FROM users WHERE id='$id'");

        while($user_data = mysqli_fetch_array($query)) {
            $name = $user_data['name'];
            $address = $user_data['address'];
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HTML | CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <div class="container-fluid d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Users</h1>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-8">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <form action="edit.php" method="post">
            <div class="mb-3">
              <label for="name" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="name" name="name" required value="<?= $name ?>">
            </div>
            <div class="mb-3">
              <label for="address" class="form-label">Alamat</label>
              <textarea class="form-control" id="address" name="address" rows="3" required><?= $address ?></textarea>
            </div>
            <input type="hidden" name="id" value="<?php echo $_GET['id']?>" >
            <input type="submit" name="update" class="btn btn-primary" value="Update">
          </form>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>
<?php

    // Update users
    if (isset($_POST['update'])) {
      $id = $_POST['id'];
      $name = $_POST['name'];
      $address = $_POST['address'];

      // query untuk update data
      $query = mysqli_query($mysqli, "UPDATE users SET name='$name', address='$address' WHERE id='$id' ");

      // Check if the update was successful
      if ($query) {
          header("Location: index.php"); // Redirect to index.php
          exit(); // Exit the script after the redirect
      } else {
          echo "Update failed. Please try again.";
      }
    }

?>
