<?php
require_once "../connections/connection.php";

if(isset($_POST["username"]) && isset($_POST["password"]) &&
    ($_POST["username"] != "" && $_POST["password"]!= "")) {

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT password_hash, ref_id_roles, id_users 
              FROM users 
              WHERE username 
              LIKE ?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $password_hash, $ref_id_roles, $id_users);
            if (mysqli_stmt_fetch($stmt)) {
                if (password_verify($password, $password_hash)) {
                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    $_SESSION['username'] = $username;
                    $_SESSION['id'] = $id_users;
                    $_SESSION['id_usersToUse'] = $id_users;
                    $_SESSION['role'] = $ref_id_roles;
                    header('Location: ../index.php?msg=3');
                    // feedback de sucesso
                } else {
                    // feedback de erro porque a password está errada
                    header('Location: ../index.php?msg=2#login');
                }
            } else {
                // feedback de erro porque o username está errado
                header('Location: ../index.php?msg=2#login');
            }
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        } else {
            echo "ERRO: " . mysqli_stmt_error($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        }
    } else {
        echo "ERRO: ".mysqli_stmt_error($stmt);
        mysqli_close($link);
    }
}