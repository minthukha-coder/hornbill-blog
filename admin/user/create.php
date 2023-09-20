<?php
$nameErr = "";
$emailErr = "";
$passwordErr = "";
if (isset($_POST['userCreateBtn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    if ($name == '') {
        $nameErr = "The name field is required";
    } else if ($email == '') {
        $emailErr = "The email field is required";
    } else {
        $password = md5($password);
        $stmt = $db->prepare("INSERT INTO users(name,email,role,password)VALUES('$name','$email','$role','$password')");
        $result = $stmt->execute();
        if ($result) {
            echo "<script>sweetAlert('created a new user','users')</script>";
        }
    }
}
?>

<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">User Creation Form </h6>
                    <a href="index.php?page=users" class=" btn-primary btn-sm ">
                        <i class="fas fa-angle-double-left"></i> Back</a>

                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-2">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control">
                            <span class="text-danger"><?php echo $nameErr ?></span>

                        </div>
                        <div class="mb-2">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control">
                            <span class="text-danger"><?php echo $emailErr ?></span>

                        </div>
                        <div class="mb-2">
                            <label for="">Role</label>
                            <select name="role" id="" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>

                        </div>
                        <div class="mb-2">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control">
                            <span class="text-danger"><?php echo $passwordErr ?></span>
                        </div>

                        <button name="userCreateBtn" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>