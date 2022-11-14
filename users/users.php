<?php


function getUsers()
{
    # code...
    return json_decode(file_get_contents(__DIR__.'/users.json'),true);
}

function getUser($id)
{
    # code...
    $users = getUsers();

    foreach($users as $user):
        if($user['id'] == $id)
            return $user;
    endforeach;
    
    return Null;
}

function create($data)
{
    # code...
    $users = getUsers();

    $data['id'] =  rand(1000000, 2000000);

    $data['extension'] = uploadImage($data['id']);

    $users[] = $data;

    putJson($users);

    return $data;
}


function updateUser($data,$id)
{
    # code...
    $users = getUsers();

    
    foreach ($users as $key =>$user) :
        if ($user['id'] == $id){

            $data['extension'] = uploadImage($id,$user['extension']);
            $users[$key] = array_merge($user, $data);

            break;
        }
    endforeach;

    putJson($users);
}

function deleteUser($id)
{
    # code...
    $users = getUsers();


    foreach ($users as $key => $user) :
        if ($user['id'] == $id) {
            array_splice($users,$key,1);
            break;
        }
    endforeach;

    putJson($users);
}

function uploadImage($id,$oldExtension=null)
{   
    $extension = $oldExtension;

    if (!empty($_FILES['picture']['tmp_name'])) {

        $dir = __DIR__ . "/images";

        if (!is_dir($dir))
            mkdir($dir);

        $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);

        move_uploaded_file($_FILES['picture']['tmp_name'], $dir . '/' . $id . '.' . $extension);
    }  
    return $extension;
}


function putJson($users)
{
    # code...
    file_put_contents(__DIR__ . '/users.json', json_encode($users, JSON_PRETTY_PRINT));
}

function validateUser($user, &$errors)
{
    $isValid = true;
    // Start of validation
    if (!$user['name']) {
        $isValid = false;
        $errors['name'] = 'Name is mandatory';
    }
    if (!$user['username'] || strlen($user['username']) < 6 || strlen($user['username']) > 16) {
        $isValid = false;
        $errors['username'] = 'Username is required and it must be more than 6 and less then 16 character';
    }
    if ($user['email'] && !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        $errors['email'] = 'This must be a valid email address';
    }

    if (!filter_var($user['phone'], FILTER_VALIDATE_INT)) {
        $isValid = false;
        $errors['phone'] = 'This must be a valid phone number';
    }
    // End Of validation

    return $isValid;
}