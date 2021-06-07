<?php
require_once "connections/connection.php";
if(isset($_SESSION['comments'])){
    $comments = $_SESSION['comments'];
}
?>
 <section class="bg-light">
     <div class="container">
         <div class="row">
            <?php
            if (isset($_GET["id"])) {
            $id_recipes = $_GET["id"];

            $_SESSION["id_recipe"] = $id_recipes;
            $query = "SELECT id_recipes, title, image, description_short, preparation, ingredients 
                      FROM recipes
                      WHERE id_recipes = ?";
            $link = new_db_connection(); // Create a new DB connection
            $result = mysqli_prepare($link, $query); //Preparamos a nossa base de dados com a query
            mysqli_stmt_bind_param($result, 'i', $id_recipes); //Quando eu fizer a minha query à BD, o ponto?(linha 7) vai ser substituído pelo $id_sessions da nossa BD, tendo que ser forçosamente um inteiro.
            mysqli_stmt_execute($result); // Execute the prepared statement
            mysqli_stmt_bind_result($result, $id_recipes, $title, $image, $description_short, $preparation, $ingredients); // Bind results
            if (mysqli_stmt_fetch($result)) {// Fetch values
            mysqli_stmt_close($result);
            ?>
             <div class="col-sm-12">
                 <img class="img-fluid w-100" src="img/portfolio/thumbnails/<?= $image ?>">
             </div>

             <div class="col-sm-12 mt-2">
                 <div class="card">
                     <div class="card-body">
                         <h3 class="card-title pt-2"><?= $title ?></h3>
                         <p class="card-text text-justify"><?= $description_short ?></p>
                         <p class="px-3 font-weight-bold text-center text-brown">9 Ingredientes <span class="font-weight-bold text-brown"> | </span>330Kcal/Dose<span class="font-weight-bold text-brown"> | </span> 15Min.</p>
                     </div>
                 </div>
             </div>
             <div class="col-sm-12 my-2">
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title">Ingredientes</h5>
                         <p><?= $ingredients ?></p>
                     </div>
                 </div>
             </div>
             <div class="col-sm-12 mb-2">
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title">Preparação</h5>
                         <p><?= $preparation ?></p>
                     </div>
                 </div>
             </div>
             <div class="col-sm-12 mb-2 text-center">
                 <?php
                 if (isset($_SESSION["username"]) && $_SESSION['role'] == 2){ ?>
                     <a href="scripts/sc_add_my_recipes.php" class="btn btn-primary btn-xl js-scroll-trigger">Adicionar minhas Receitas</a>
                 <?php
                  }?>
             </div>
             <!-- COMMENTS VIEW-->
             <div class="col-lg-12" id="comment">
                 <h2 class="page-header">Comentários</h2>
             </div>
             <div class="col-lg-12 col-sm-12 text-center">
                 <?php
                 $link_comments = new_db_connection(); // Create a new DB connection
                 $stmt = mysqli_stmt_init($link_comments); // create a prepared statement
                 $query_comments = "SELECT comments.id_comments, comments.comments_user, comments.comment_date, users.username 
                                    FROM comments 
                                    INNER JOIN users 
                                    ON users.id_users = comments.users_id_users 
                                    WHERE recipes_id_recipes = ?";
                            // Define the query
                 if (mysqli_stmt_prepare($stmt, $query_comments)) { // Prepare the statement
                     mysqli_stmt_bind_param($stmt, 'i', $id_recipes);
                     mysqli_stmt_execute($stmt); // Execute the prepared statement

                     mysqli_stmt_bind_result($stmt,  $id_comments,$comments_user, $comment_date, $username);
                     while (mysqli_stmt_fetch($stmt)) { // Fetch values?>
                         <h4><?= $comments_user ?>
                         <small> (<?= $comment_date ?> autor: <?= $username ?>)</small>
                         <?php
                         if (isset($_SESSION['username']) && $_SESSION['username'] == $username) { ?>
                             <small><a href='scripts/sc_comments_delete.php?id=<?= $id_comments ?>'>x</a></small>
                         <?php }
                     }?>
                     </h4>
                     <?= mysqli_stmt_close($stmt); // Close statement?>
                     <?php
                 }
                 mysqli_close($link_comments); // Close connection
                 ?>
             </div>

             <!-- COMMENTS FORMULÁRIO-->
              <div class="col-sm-12 mb-2">
              <?php
              if (isset($_SESSION["username"])){ ?>
                  <form class="form-horizontal" method="POST" action="scripts/sc_comments_add.php">
                      <h3>Adicione o seu comentário</h3>
                      <br>
                      <div class="form-group">
                          <label for="inputPassword" class="col-sm-2 control-label">Comentário</label>
                          <div class="col-sm-10">
                              <textarea name="texto" class="form-control"></textarea>
                          </div>
                      </div>
                      <div class="form-group col-lg-12 col-sm-12 text-right"><div>
                                <button type="submit" class="btn btn-primary btn-xl js-scroll-trigger">Submeter</button>
                            </div>
                        </div>
                    </form>
                <?php
              } else {
                    echo "<p>Precisa de efetuar o login para inserir comentários!</p>";
                }
            }
                mysqli_close($link);
            }
            ?>
              </div>
         </div>
 </section>
