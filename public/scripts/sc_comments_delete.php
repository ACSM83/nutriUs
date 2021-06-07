<?php
session_start();

if(isset($_GET["id"]) && isset($_SESSION["id_recipe"])){
    $id = $_GET["id"];
    $id_recipe = intval($_SESSION['id_recipe']);

    require_once ("../connections/connection.php");
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "DELETE FROM comments
              WHERE id_comments = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        /* Bind paramenters */
        mysqli_stmt_bind_param($stmt, "i", $id);
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
header("Location: ../detalhes_receita.php?id=".$id_recipe);