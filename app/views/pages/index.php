<?php require APPROOT . '/views/components/header.php';?>

<h1><?php echo $data['title']; ?></h1>

<!-- url jumping protect -->
<?php
if(isset($_SESSION["email-session"])) {
    //  echo "User login is :" . $_SESSION["email-session"];
    // exit;
}
else {
  echo "no permission";
  exit;
}
?>
<!-- url jumping protect -->
<?php require APPROOT . '/views/components/footer.php';?>