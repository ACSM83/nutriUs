<?php
require_once "connections/connection.php";
?>
<section id="portfolio">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <?php
            if (isset($_GET["id"])) {
            $id_categorias = $_GET["id"];
            $query = "SELECT id_recipes, title, image, description_short 
                      FROM recipes
                      INNER JOIN categorias
                      ON recipes.categorias_id_categorias = categorias.id_categorias
                      WHERE id_categorias = ?";
            $link = new_db_connection(); // Create a new DB connection
            $result = mysqli_prepare($link, $query); //Preparamos a nossa base de dados com a query
            mysqli_stmt_bind_param($result, 'i', $id_categorias); //Quando eu fizer a minha query à BD, o ponto?(linha 7) vai ser substituído pelo $id_sessions da nossa BD, tendo que ser forçosamente um inteiro.
            mysqli_stmt_execute($result); // Execute the prepared statement
            mysqli_stmt_bind_result($result, $id_recipes, $title, $image, $description_short); // Bind results
            while (mysqli_stmt_fetch($result)) {// Fetch values

            ?>
                        <div class="card col-lg-4 col-sm-6">
                            <img class="card-img-top" src="img/portfolio/thumbnails/<?= $image ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title text-green"><?= $title ?>
                                    <span class="fas fa-heart text-green fa-1x mx-3"></span>
                                    <span class="fas fa-share-alt text-green fa-1x mx-3"></span>
                                </h5>
                                <p class="card-text"><?= $description_short ?></p>
                                <a class="btn btn-primary btn-xl js-scroll-trigger"
                                   href="detalhes_receita.php?id=<?= $id_recipes ?>">Ver mais</a>
                            </div>
                        </div>
                <?php
            }
                mysqli_stmt_close($result);
                mysqli_close($link);
            }
            ?>
        </div>
    </div>
</section>