<?php
include "layout/header.php";
require "users/users.php";

if (!isset($_GET['id'])) {
    include "layout/notFound.php";
    exit;
}

$id = $_GET['id'];

$user = getUser($id);

if (!$user) {
    include "layout/notFound.php";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = [
        'name' => "",
        'username' => "",
        'email' => "",
        'phone' => "",
        'website' => "",
    ];
        
    $user = array_merge($user, $_POST);
    $isValid = validateUser($user, $errors);

    if ($isValid) {
        updateUser($_POST, $id);
        header('location:index.php');
    }
}

$title = "Update User ${user['name']}" ;

?>


<?php include "_form.php"; ?>


<?php include "layout/footer.php"; ?>