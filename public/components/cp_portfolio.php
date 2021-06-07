<!-- Portfolio-->
<?php
require_once "connections/connection.php";
?>
<section id="portfolio">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
                <?php
                $link = new_db_connection(); // Create a new DB connection
                $stmt = mysqli_stmt_init($link); // create a prepared statement
                $query = "SELECT id_categorias, nome_categoria, image_categoria FROM categorias"; // Define the query
                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                    mysqli_stmt_execute($stmt); // Execute the prepared statement
                    mysqli_stmt_bind_result($stmt, $id_categorias, $nome_categoria, $image_categoria); // Bind results
                    while (mysqli_stmt_fetch($stmt)) { // Fetch values?>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="lista_receitas.php?id=<?= $id_categorias ?>">
                            <img class="img-fluid" src="img/portfolio/thumbnails/<?= $image_categoria ?>" alt="" />
                            <div class="portfolio-box-caption">
                                <div class="project-name"><?= $nome_categoria ?></div>
                            </div>
                        </a>
                    </div>
                <?php
                    }
                    mysqli_stmt_close($stmt); // Close statement
                }
                mysqli_close($link); // Close connection
                ?>
        </div>
    </div>
</section>