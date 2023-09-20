<?php
require_once('../config/db.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hornbill Blog - Admin Panel</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/admin/css/sb-admin-2.min.css" rel="stylesheet">

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
                location.href = 'index.php?page=' + page;
            })
        }
    </script>

</head>

<body id="page-top">