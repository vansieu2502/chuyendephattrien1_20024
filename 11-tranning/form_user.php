<?php
// Start the session
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();

function hashcode($id)
{
    return md5($id);
}
$user = NULL; //Add new user
$_id = NULL;

if (!empty($_GET['id'])) {
    $_id = $_GET['id'];
    $user = $userModel->findUserById($_id);//Update existing user

}


if (!empty($_POST['submit'])) {

    if (!empty($_id)) {
        $userModel->updateUser($_POST);
    } else {
        $userModel->insertUser($_POST);
    }
    header('location: list_users.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>User form</title>
    <?php include 'views/meta.php' ?>
</head>

<body>
    <?php include 'views/header.php' ?>
    <div class="container">

        <?php if ($user || !isset($_id)) { ?>
            <div class="alert alert-warning" role="alert">
                User form
            </div>
            <form method="POST" id="userUpdate">
                <input type="hidden" name="id" value="<?php echo $_id ?>">

                <div class="form-group">
                    <label for="name">User Name</label>
                    <input class="form-control" id="username" name="name" placeholder="Name"
                        value='<?php if (!empty($user[0]['name']))
                            echo $user[0]['name'] ?>'>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                    </div>

                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                </form>
        <?php } else { ?>
            <div class="alert alert-success" role="alert">
                User not found!
            </div>
        <?php } ?>
    </div>
</body>

</html>
<script>
    document.getElementById('userUpdate').addEventListener('submit', function (event) {

        var userName = document.getElementById('username').value;
        var namePattern = /^[A-Za-z0-9]{5,15}$/;

        if (userName.trim() === '') {
            alert('vui lòng nhập không thể để trống');
            event.preventDefault();
        } else if (!namePattern.test(userName)) {
            alert('Nhập User name chứa từ 5 đến 15 ký tự và chỉ bao gồm các ký tự A-Z, a-z, 0-9');
            event.preventDefault();
        }


        var password = document.getElementById('password').value;
        var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[~!@#$%^&*()])[A-Za-z\d~!@#$%^&*()]{5,10}$/;

        if (password.trim() === '') {
            alert('vui lòng nhập không thể để trống');
            event.preventDefault();
        } else if (!passwordPattern.test(password)) {
            alert('Password phải bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt, chiều dài từ 5 đến 10 ký tự');
            event.preventDefault();
        }
    });
</script>