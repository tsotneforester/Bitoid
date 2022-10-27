<?php

include_once '../root/function.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta property="og:type" content="website">
  <meta property="og:url" content="GPX Bitcamp">
  <meta property="og:title" content="GPX Bitcamp">
  <meta property="og:description" content="Junior_PHP">
  <meta property="og:image" content="https://gpx.ge/root/img/main.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" type="image/x-icon" href="img/ico.ico" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../css/style.css" />
  <title>Result</title>
</head>

<body>
  <div class="resultbox">
    <a href="../index.php" id="back"><i class='bx bxs-left-arrow-circle'></i></a>

    <div class="result">
      <?php

      if (isset($_POST["submit"])) {
        //----------------------------------------------------------------
        $userName = $_POST["user"];
        $sumbitType = $_POST["github"];
        $userInfo = json_decode(parseJson("https://api.github.com/users/$userName"), true);
        $repoCheck = array_key_exists("public_repos", $userInfo);



        //----------------------------------------------------------------

        if ($repoCheck === true) {
          //--------------------check whether user exists--------------------
          $repoCount = $userInfo["public_repos"];
          $pageNumber = ceil($userInfo["public_repos"] / 20) + 1;
          //----------------------------------------------------------------
          if ($repoCount > 0) {
      ?>

            <ul class="pagination">
              <li class='page-item active'><a class='page-link' href='process.php?page=1&user=<?= $userName ?>&type=<?= $sumbitType ?>&number=<?= $pageNumber ?>'>1</a></li>
              <?php

              for ($i = 2; $i < $pageNumber; $i++) {

              ?>
                <li class='page-item'><a class='page-link' href='process.php?page=<?= $i  ?>&user=<?= $userName  ?>&type=<?= $sumbitType  ?>&number=<?= $pageNumber  ?>'><?= $i  ?></a></li>
              <?php
              } ?>

            </ul>


            <table>
              <tr id="header">
                <th style="border-top-left-radius: 12px;">N</th>
                <th>REPO</th>
                <th style="border-top-right-radius: 12px;">DESC</th>
              </tr>';


              <?php



              $result = parseJson("https://api.github.com/users/$userName/repos?per_page=20&page=1");
              $api = json_decode($result, true);
              $x = 1;
              foreach ($api as $key => $value) {
              ?>
                <tr>
                  <td><?= $x++  ?></td>
                  <td><a href='<?= $value['html_url'] ?>' target='_blank'><?= $value['name'] ?></a></td>
                  <td><?= $value['description'] ?></td>
                </tr>
        <?php



              }
            } else {
              header('Location: https://www.w3resource.com/'); //no repos for active uzer
            }
          } else {
            header('Location: ../index.php');
          } //$sumbitType == "repo" && $repoCheck === true

        } //isset($_POST["submit"])
        ?>
            </table>
    </div>
  </div>
</body>

</html>