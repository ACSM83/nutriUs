<?php
session_start();//vai buscar o nome do autor
require_once "../connections/connection.php";


if (isset($_POST) && ($_POST["texto"] != "") && isset($_SESSION["username"]) && isset($_SESSION["id"]) && isset($_SESSION["id_recipe"])) {

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "INSERT INTO comments (recipes_id_recipes, users_id_users, comments_user) VALUES (?, ?, ?)";


    if(mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'iis', $id_recipe, $user, $texto);

        $user = intval($_SESSION["id"]); //;intval($_SESSION["username"]);
        $texto = $_POST["texto"];
        $id_recipe = intval($_SESSION['id_recipe']);

        if(mysqli_stmt_execute($stmt)){
            //em caso de sucesso
            mysqli_stmt_close($stmt);
            mysqli_close($link);
            header("Location: ../detalhes_receita.php?id=".$id_recipe);
        } else {
           header("Location: ../detalhes_receita.php?id=".$id_recipe);
        }
    }

}

