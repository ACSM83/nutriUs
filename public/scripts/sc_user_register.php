<?php
require_once "../connections/connection.php";

if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) &&
    ($_POST["username"] != "" && $_POST["email"]!= "" && $_POST["password"]!= "")){

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "INSERT INTO users (email, username, password_hash,ref_id_roles) VALUES (?, ?, ?, 2)";
    if(mysqli_stmt_prepare($stmt, $query)){
        mysqli_stmt_bind_param($stmt, 'sss', $email, $username, $password_hash);
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if(mysqli_stmt_execute($stmt)){
            //em caso de sucesso
            mysqli_stmt_close($stmt);
            mysqli_close($link);
            header ("Location: ../index.php?msg=1#login");
        } else {
            //em caso de erro
            header ("Location: ../index.php?msg=0#login");
        }
    } else{
        //houve erro
        echo "ERRO: ".mysqli_error($link); //mostra erro
        mysqli_stmt_close($stmt);          //fecha statement
        mysqli_close($link);               //fecha BD
    }
} else{
    echo "Os campos do formulário não foram devidamente definidos\n";
}