<?php
include "layout/header.php";
require "users/users.php";

if (!isset($_GET['id'])) {
    include "layout/notFound.php";
    exit;
}

$user = getUser($_GET['id']);

if (!$user) {
    include "layout/notFound.php";
    exit;
}
?>


<div class="container">
    <div class="card">
        <div class="card-header">
            <h3> View User : <?php echo $user['name'] ?> </h3>
        </div>
        <div class="card-body">
            <a href="update.php?id=<?php echo $user['id'] ?>" class="btn btn-sm btn-outline-secondary">Update</a>
            <form action="delete.php" method="POST" style="display:inline-block">
                <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
            <table class="table">

                <tbody>
                    <tr>
                        <th>Name : </th>
                        <td><?php echo $user['name'] ?></td>
                    </tr>

                    <tr>
                        <th>Username : </th>
                        <td><?php echo $user['username'] ?></td>
                    </tr>

                    <tr>
                        <th>Phone : </th>
                        <td><?php echo $user['phone'] ?></td>
                    </tr>

                    <tr>
                        <th>Email : </th>
                        <td><?php echo $user['email'] ?></td>
                    </tr>

                    <tr>
                        <th>Website : </th>
                        <td><a href="http://<?php echo $user['website'] ?>" target="_blank"><?php echo $user['website'] ?></a></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "layout/footer.php"; ?>