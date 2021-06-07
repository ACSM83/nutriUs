<!DOCTYPE html>
<html>
<head>
    <?php include_once "helpers/help_meta.php"; ?>
    <title>Nutri.Us - Admin</title>
    <?php include_once "helpers/help_css.php"; ?>
</head>
<body>
<h2 class="text-uppercase bg-primary text-white p-3">Área de Administrador</h2>
<div class="p-3">
    <a href="index.php"> < voltar</a>
</div>

<h4 class="text-uppercase text-primary font-weight-bold px-3">Editar Receitas</h4>
<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    // We need the function!
    require_once ("connections/connection.php");
    // Create a new DB connection
    $link_sel = new_db_connection();
    /* create a prepared statement */
    $stmt_sel = mysqli_stmt_init($link_sel);

    $query_sel = "SELECT id_recipes, title, image, preparation, description_short, ingredients 
                  FROM recipes
                  WHERE id_recipes = ?";
    if (mysqli_stmt_prepare($stmt_sel, $query_sel)) {
        mysqli_stmt_bind_param($stmt_sel, "i", $id);
        /* execute the prepared statement */
        if (mysqli_stmt_execute($stmt_sel)) {
            /* bind result variables */
            mysqli_stmt_bind_result($stmt_sel, $id_recipes, $title, $image, $preparation, $description_short, $ingredients);

            /* fetch values */
            if (!mysqli_stmt_fetch($stmt_sel)) {
                // Isto significa que não há resultado da query
                header("Location: index.php");
            }
            session_start();
            $_SESSION["id_recipes"] = $id;
        }  else {
            // Acção de erro
            echo "Error:" . mysqli_stmt_error($stmt_sel);
        }
        /* close statement */
        mysqli_stmt_close($stmt_sel);
    } else {
        echo("Error description: " . mysqli_error($link_sel));
    }
    /* close connection */
    mysqli_close($link_sel);
} else {
    header("Location: index.php");
}?>


<form class="bg-light p-3" method="post" action="recipes_edit_script.php">
    <div class="form-row">
        <input type="hidden" name="id_recipes" value="<?= $id ?>">
        <div class="form-group col-md-4">
            <label for="title">Título Receita</label>
            <input type="text" class="form-control" value="<?= $title ?>" name="title" id="title" placeholder="p.e. Cogumelos com Broa">
        </div>
        <div class="form-group col-md-4">
            <label for="image">Imagem</label>
            <input type="text" class="form-control" value="<?= $image ?>" name="image" id="image" placeholder="p.e. cogumeloscombroa.jpg">
        </div>
        <div class="form-group col-md-4">
            <label for="id_categorias">Categoria</label>
            <select name="id_categorias" id="categoria" class="form-control">

                <?php
                // We need the function!
                require_once("connections/connection.php");

                // Create a new DB connection
                $link = new_db_connection();

                /* create a prepared statement */
                $stmt = mysqli_stmt_init($link);

                $query = "SELECT id_categorias, nome_categoria 
                      FROM categorias 
                      ORDER BY nome_categoria";
                if (mysqli_stmt_prepare($stmt, $query)) {
                    /* execute the prepared statement */
                    if (mysqli_stmt_execute($stmt)) {
                        /* bind result variables */
                        mysqli_stmt_bind_result($stmt, $id_categorias, $nome_categoria);
                        /* fetch values */
                        while (mysqli_stmt_fetch($stmt)) { ?>
                            <option value="<?= $id_categorias ?>"><?= $nome_categoria ?></option>
                            <?php
                        }
                    } else {
                        // Acção de erro
                        echo "Error:" . mysqli_stmt_error($stmt);
                    }
                    /* close statement */
                    mysqli_stmt_close($stmt);
                } else {
                    echo("Error description: " . mysqli_error($link));
                }
                /* close connection */
                mysqli_close($link);
                ?>
            </select>

        </div>
    </div>

    <div class="form-group">
        <label for="description_short">Breve Descrição</label>
        <textarea class="form-control" value="<?= $description_short ?>" name="description_short" id="description_short" rows="2"><?= $description_short ?></textarea>
    </div>
    <div class="form-group">
        <label for="ingredients">Ingredientes</label>
        <textarea class="form-control" value="<?= $ingredients ?>" name="ingredients" rows="3"><?= $ingredients ?></textarea>
    </div>
    <div class="form-group">
        <label for="preparation">Preparação</label>
        <textarea class="form-control" value="<?= $preparation ?>" name="preparation" id="preparation" rows="4"><?= $preparation ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Alterar</button>
</form>
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/scrollreveal/scrollreveal.min.js"></script>
<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<!-- Custom scripts for this template -->
<script src="js/creative.min.js"></script>
</body>
</html>
