<?php 
// panggil koneksi ke database
include_once("connection.php");

$result = mysqli_query($mysqli, 'SELECT * FROM users');
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
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <div class="container d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome ..</h1>
</div>

    <div class="container">
    <a class="btn btn-primary" href="add.php" role="button">Add user</a>
    </div>

<div class="container">
  <div class="row">
    <div class="col-md-8">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Alamat</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $i=0;
        while($user_data = mysqli_fetch_array($result)) {
            $i++
    ?>
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $user_data['name']?></td>
      <td><?php echo $user_data['address']?></td>
      <td>
      <a class="btn btn-info btn-sm" href="edit.php?id=<?php echo $user_data['id']; ?>" role="button">Edit</a>
      <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $user_data['id']; ?>" role="button" onclick="return confirm('Anda yakin ingin menghapus user ini?')">Delete</a>
      </td>
    </tr>
    <?php 
    }
    ?>
  </tbody>
</table>
    </div>
  </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>