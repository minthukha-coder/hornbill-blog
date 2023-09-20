<?php

// SELECT

$userId = $_SESSION['user']->id;
$stmt = $db->prepare("SELECT * FROM users WHERE id=$userId");
$stmt->execute();

$user = $stmt->fetchObject();

?>

<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">User Profile</h6>
                </div>
                <div class="card-body">
                    <div class="my-3"><strong>Name</strong>: <?php echo $user->name ?> </div>
                    <div class="my-3"><strong>Email</strong>: <?php echo $user->email ?> </div>
                    <div class="my-3"><strong>Role</strong>: <?php echo $user->role ?> </div>

                </div>
            </div>
        </div>
    </div>
</div>