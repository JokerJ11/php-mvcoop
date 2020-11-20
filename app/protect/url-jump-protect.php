<!-- url jumping protect -->
<?php
if(isset($_SESSION["email-session"])) {
    //  echo "User login is :" . $_SESSION["email-session"];
    // exit;
}
else {
  echo "There is no permission to view this page";
  exit;
}
?>
<!-- url jumping protect -->