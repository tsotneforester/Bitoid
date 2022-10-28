<?php
function FileUpload()
{

  if ($_FILES["uploadfile"]["size"] < 500000) {
    $location = "vault";
    if (!is_dir($location)) {
      global $image_name;
      mkdir($location);
      $image_name = $_FILES['uploadfile']['name'];
      $image_tmp_name = $_FILES['uploadfile']['tmp_name'];
      move_uploaded_file($image_tmp_name, "$location/$image_name");
    } else {
      global $image_name;
      $image_name = $_FILES['uploadfile']['name'];
      $image_tmp_name = $_FILES['uploadfile']['tmp_name'];
      move_uploaded_file($image_tmp_name, "$location/$image_name");
    }
  }
};


$display_status = "block";
$pattern = "/^[A-Za-z]{2,}$/";
$fullName = "";
$image_name = "";
$comment = "";
if (isset($_POST["submit"])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  if (!preg_match($pattern, $lname) || !preg_match($pattern, $fname) || $_FILES["uploadfile"]["size"] > 500000) {
    $comment =  "არასწორი ფორმატი, გამოიყენე A-Z და ფაილი 500kb-ზე ნაკლები ზომის";
    FileUpload();
  } else {
    $display_status = "none";
    FileUpload();
    $comment = $fname . " " . $lname;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="shortcut icon" type="image/x-icon" href="img/ico.ico" />
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>Profile</title>
</head>

<body>

  <div class="box" style="display: <?= $display_status ?>;">

    <form action="" method="post" enctype="multipart/form-data">
      <div class="line1">
        <div class="icon"><i class='bx bx-user-check'></i></div>
        <div class="input"><input id="lname" type="text" name="fname" placeholder="სახელი" required /></div>
      </div>

      <div class="line2">
        <div class="icon"><i class='bx bx-user-plus'></i></div>
        <div class="input"><input id="lname" type="text" name="lname" placeholder="გვარი" required /></div>
      </div>

      <div class="line3">

        <input type="file" name="uploadfile" value="" required />
      </div>

      <div id="line4">
        <input id="submit" type="submit" name="submit" value="SEND" class="btn btn-success" />

      </div>
    </form>
  </div>



  <?php

  if (isset($_POST["submit"])) { ?>

    <div class="result">
      <p><?= $comment ?></span></p>
      <img src='vault/<?= $image_name ?>' alt="error">
    </div>

  <?php
  }
  ?>
</body>

</html>