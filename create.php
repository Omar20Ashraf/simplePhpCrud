<?php
    include "layout/header.php";
    require "users/users.php";
    $title = 'Create New User';

    $user = [
        'id' => '',
        'name' => '',
        'username' => '',
        'email' => '',
        'phone' => '',
        'website' => '',
    ];

    $errors = [
        'name' => "",
        'username' => "",
        'email' => "",
        'phone' => "",
        'website' => "",
    ];

    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = array_merge($user,$_POST);

    $isValid = validateUser($user, $errors);  

    if($isValid){
        create($_POST);
        header('location:index.php');
    }
}
?>

<?php include "_form.php"; ?>


<?php include "layout/footer.php"; ?>