<?php
require_once "../connections/connection.php";
session_start();

if(isset($_SESSION["id_recipe"]) && isset($_SESSION["id_usersToUse"]) ){

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "INSERT INTO myrecipes (recipes_id_recipes, users_id_users) VALUES (?, ?)";
    if(mysqli_stmt_prepare($stmt, $query)){
        mysqli_stmt_bind_param($stmt, 'ii', $recipes_id_recipes, $users_id_users);
        $recipes_id_recipes = intval($_SESSION["id_recipe"]);
        $users_id_users = $_SESSION["id_usersToUse"];

        if(mysqli_stmt_execute($stmt)){
            //em caso de sucesso
            mysqli_stmt_close($stmt);
            mysqli_close($link);
            header ("Location: ../myRecipes.php?msg=1&id_user=".$users_id_users);
        } else {
            mysqli_stmt_close($stmt);          //fecha statement
            mysqli_close($link);
            //em caso de erro
            header ("Location: ../myRecipes.php?msg=0&id_user=".$users_id_users);
        }
    } else{
        header ("Location: ../myRecipes.php?msg=0&id_user=".$users_id_users);
        mysqli_stmt_close($stmt);          //fecha statement
        mysqli_close($link);               //fecha BD
    }
}
//header ("Location: ../components/myRecipes.php?msg=2&id_user=".$users_id_users);