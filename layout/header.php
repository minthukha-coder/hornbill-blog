<?php
session_start();

require_once('config/db.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0 user-scalable=no">
    <title>blogging system</title>
    <!-- bootstrap cdn  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- custom css  -->
    <link rel="stylesheet" href="assets/css/app.css">
    <!-- aos  -->
    <link rel="stylesheet" href="assets/aos/aos.css">

    <!-- sweet alert cdn-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function sweetAlert(message, page) {
            Swal.fire({
                title: 'Congrats',
                text: 'You have successfully ' + message,
                icon: 'success',
                confirmButtonText: 'Ok'
            }).then(function() {
                location.href = page;
            })
        }
    </script>


</head>

<body>