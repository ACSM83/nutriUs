<?php
if (isset($_POST["categoria"]) && ($_POST["categoria"] != "") && isset($_POST["image"]) && ($_POST["image"] != "")
&& isset($_POST["image"]) && ($_POST["image"] != "") && isset($_POST["description_short"]) && ($_POST["description_short"] != "")
&& isset($_POST["preparation"]) && ($_POST["preparation"] != "") && isset($_POST["id_categorias"]) && ($_POST["id_categorias"] != "")
&& isset($_POST["ingredients"]) && ($_POST["ingredients"] != "")
&& isset($_POST["date_recipe"]) && ($_POST["date_recipe"] != "")) {
    $title = $_POST["title"];
    $image = $_POST["image"];
    $description_short = $_POST["description_short"];
    $preparation = $_POST["preparation"];
    $id_categorias = intval($_POST["id_categorias"]);
    $ingredients = $_POST["ingredients"];
$date_recipe=$_POST["date_recipe"];

    // We need the function!
    require_once ("connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO categorias (categoria) VALUES (?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        /* Bind paramenters */
        mysqli_stmt_bind_param($stmt, "ssssiss", $title, $image, $description_short, $preparation, $id_categorias, $ingredients,$date_recipe);
        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {

            echo "Error:" . mysqli_stmt_error($stmt);
            header("Location: index.php?msg=0");
        }

        header("Location: index.php?msg=1");
        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        echo("Error description: " . mysqli_error($link));
        header("Location: index.php?msg=0");
    }
    /* close connection */
    mysqli_close($link);
}
