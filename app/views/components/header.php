
<?php
//session hijacking
session_start();
header('X-XSS-Protection: 0'); ?>
<?php 
function getToken() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $ip = null;
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_x_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return md5($ip . ":" .$user_agent);
    }
    
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = getToken();
    } else {
        if($_SESSION['token'] != getToken()) {
            die("session token is not valid");
            // redirect('login');
        }
    }
//session hijacking
    ?>

<?php 
	if(session_id() == ''){
        //session has not started
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/style.css">
    <!-- datatable cdn -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
</head>
<body>