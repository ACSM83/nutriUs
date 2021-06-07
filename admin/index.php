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
    <a href="../public/index.php"> < voltar à área pública</a>
</div>
<h4 class="text-uppercase text-primary font-weight-bold px-3">Receitas em BD
    <button class="p-2 ml-5 text-center border border-success">
        <a href="index.php#insert">
            Adicionar Receita
            <span class="fas fa-plus text-green fa-1x"></span>
        </a>
    </button>
</h4>
<table class="m-5" style="width: auto; height: auto;">
    <thead class="bg-primary text-white">
    <tr>
        <th class="text-center p-4">Nº Receita</th>
        <th class="text-center p-4">Título</th>
        <th class="text-center p-4">Link_imagem</th>
        <th class="text-center p-4">Descrição</th>
        <th class="text-center p-4">Preparação</th>
        <th class="text-center p-4">Ingredientes</th>
        <th class="text-center p-4">Data</th>
        <th class="text-center p-4">Editar</th>
        <th class="text-center p-4">Apagar</th>
    </tr>
    </thead>
    <?php
    // We need the function!
    require_once("connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_recipes, title, image, description_short, preparation, ingredients, date_recipe 
          FROM recipes
          ORDER BY id_recipes DESC";

    if (mysqli_stmt_prepare($stmt, $query)) {
    /* execute the prepared statement */
    if (mysqli_stmt_execute($stmt)) {
    /* bind result variables */
    mysqli_stmt_bind_result($stmt, $id_recipes, $title, $image, $preparation, $description_short, $ingredients, $date_recipe);

    /* fetch values */
    while (mysqli_stmt_fetch($stmt)) { ?>
        <tbody>
        <tr>
            <td class="px-2 text-center border border-success"><?= $id_recipes ?></td>
            <td class="px-2 border border-success" style="max-width: 150px"><?= $title ?></td>
            <td class="px-2 border border-success" style="max-width: 200px"><?= $image ?></td>
            <td class="px-2 border border-success" style="max-width: 300px"><?= $preparation ?></td>
            <td class="px-2 border border-success"><?= $description_short ?></td>
            <td class="px-2 border border-success"><?= $ingredients ?></td>
            <td class="px-2 border border-success"><?= $date_recipe ?></td>
            <td class="px-2 text-center border border-success"><a href="recipes_edit.php?id=<?= $id_recipes ?>">
                    <span class="fas fa-edit text-green fa-2x"></span></a></td>
            <td class="px-2 text-center border border-success"><a href="recipes_delete.php?id=<?= $id_recipes ?>">
                    <span class="fas fa-trash-alt text-green fa-2x"></span></a></td></tr>
        </tbody>
        <?php
    } ?>
</table>
<?php
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

<h4 class="text-uppercase text-primary font-weight-bold px-3" id="insert">Inserir Receitas</h4>
<?php
if (isset($_GET["msg"])) {
    $msg_show = true;
    switch ($_GET["msg"]) {
        case 0:
            $message = "ocorreu um erro ao inserir a receita";
            $class = "alert-warning";
            break;
        case 1:
            $message = "Receita adicionada com sucesso.";
            $class = "alert-success";
            break;
        default:
            $msg_show = false;
    }

    echo "<div class=\"alert $class alert-dismissible fade show m-3\" role=\"alert\">
" . $message . "
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>
</div>";
    if ($msg_show) {
        echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
    }
}
?>

<form class="bg-light p-3" method="post" action="recipes_insert_script.php">
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="title">Título Receita</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="nome">
        </div>
        <div class="form-group col-md-4">
            <label for="image">Imagem</label>
            <input type="text" class="form-control" name="image" id="image" placeholder="nome do ficheiro da imagem">
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
        <textarea class="form-control" name="description_short" id="description_short" rows="2"></textarea>
    </div>
    <div class="form-group">
        <label for="ingredients">Ingredientes</label>
        <textarea class="form-control" name="ingredients" id="ingredients" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="preparation">Preparação</label>
        <textarea class="form-control" name="preparation" id="preparation" rows="4"></textarea>
    </div>
    <div class="form-group">
        <label for="date_recipe">Data de Inserção</label>
        <input type="date" class="form-control" name="date_recipe" id="date_recipe">
    </div>
    <button type="submit" class="btn btn-primary">Inserir</button>
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
