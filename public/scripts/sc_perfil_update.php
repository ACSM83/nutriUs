<?php
session_start();
if (isset($_POST["username"]) && ($_POST["username"] != "") && (isset($_SESSION["id_usersToUse"]))) {
    $username = $_POST["username"];
    $id = $_SESSION["id_usersToUse"];

    // We need the function!
    require_once ("../connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE users
              SET username = ?
              WHERE id_users = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        /* Bind paramenters */
        mysqli_stmt_bind_param($stmt, "si", $username, $id);
        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt);
        }
        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        echo("Error description: " . mysqli_error($link));
    }
    /* close connection */
    mysqli_close($link);
}
header("Location: ../perfil.php?id_user=$id");