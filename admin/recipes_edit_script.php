<?php
session_start();
if (isset($_POST["title"]) && ($_POST["title"] != "") &&
    isset($_POST["image"]) && ($_POST["image"] != "") &&
    isset($_POST["description_short"]) && ($_POST["description_short"] != "")&&
    isset($_POST["preparation"]) && ($_POST["preparation"] != "") &&
    isset($_POST["id_categorias"]) && ($_POST["id_categorias"] != "")&&
    isset($_POST["ingredients"]) && ($_POST["ingredients"] != "") &&
    isset($_SESSION["id_recipes"])) {

    $title = $_POST["title"];
    $image = $_POST["image"];;
    $description_short = $_POST["description_short"];
    $preparation = $_POST["preparation"];
    $id_categorias = intval($_POST["id_categorias"]);
    $ingredients = $_POST["ingredients"];
    $id = intval($_SESSION["id_recipes"]);

    // We need the function!
    require_once ("connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE recipes
              SET title = ?, image = ?, description_short = ?, preparation = ?, categorias_id_categorias = ?, ingredients = ?
              WHERE id_recipes = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        /* Bind paramenters */
        mysqli_stmt_bind_param(
            $stmt,
            "ssssisi",
            $title,
            $image,
            $description_short,
            $preparation,
            $id_categorias,
            $ingredients,
            $id);

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
header("Location: index.php");
?>