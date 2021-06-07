<?php
require_once "connections/connection.php";
?>
<section>
    <div class="container">
        <?php
        if (isset($_GET["id_user"])) {
            $id_user = $_GET["id_user"];

            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);
            $query = "SELECT id_users, username, email, image_user 
                      FROM users
                      WHERE id_users = ?";
            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 'i', intval($id_user));
                /* execute the prepared statement */
                if (mysqli_stmt_execute($stmt)) {
                /* bind result variables */
                mysqli_stmt_bind_result($stmt, $id_users, $username, $email, $image_user);
                /* fetch values */
                if (mysqli_stmt_fetch($stmt)) { ?>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="text-center">
                            <img src="img/portfolio/thumbnails/<?= $image_user ?>" class="avatar img-circle img-thumbnail"
                                 alt="avatar">
                        </div>
                        </hr><br>
                    </div>

                    <div class="col-sm-9">
                        <ul class="bg-primary text-white">
                            <h4 class="py-2">Perfil</h4>
                        </ul>

                        <div class="tab-content">
                            <h4>Username</h4>
                            <p><?= $username ?>
                                <button id="btnEdit" class="btn btn-primary mx-5" onclick="showEditName()">Editar</button>
                            </p>

                            <div id="myDIV" style="display: none;">
                                <form method="post" action="scripts/sc_perfil_update.php">
                                    <input type="text" name="username" value="<?= $username ?>">
                                    <!-- Passar o id por campo escondido, mas não é muito seguro
                                    <input type="hidden" name="id_users" value="<?= $id ?>">
                                    -->
                                    <input class="btn btn-primary mx-5" type="submit" value="Editar nome">
                                </form>
                            </div>

                            <script>
                                function showEditName() {
                                    var x = document.getElementById("myDIV");
                                    var btnEdit = document.getElementById("btnEdit");
                                    if (x.style.display === "none") {
                                        x.style.display = "block";
                                        btnEdit.style.display = "none";
                                    } else {
                                        x.style.display = "none";
                                        btnEdit.style.display = "block";
                                    }
                                }
                            </script>
                            <h4>Email</h4>
                            <p><?= $email ?></p>
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
                    </div>
                    <?php
                    }
                            ?>
    </div>
</section>