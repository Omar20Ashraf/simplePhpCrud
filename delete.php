<?php
require "users/users.php";

if (!isset($_POST['id'])) {
    include "layout/notFound.php";
    exit;
}

$id = $_POST['id'];

$user = getUser($id);

if (!$user) {
    include "layout/notFound.php";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    deleteUser($id);
    header('location:index.php');


}


?>


