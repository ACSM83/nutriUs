<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php" style="font-size: 2rem; color: #82af3b">Nutri.Us</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <?php
                if (!isset($_SESSION)){
                    session_start();
                }
                if (isset($_SESSION['username'])){
                    if (isset($_SESSION['role']) && $_SESSION['role'] == 1){
                        ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../admin/" style="font-size: 1.15rem; color: #82af3b">Admin</a></li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" style="font-size: 1.15rem; color: #82af3b"><?= $_SESSION['username'] ?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="scripts/sc_logout.php">Logout</a></li>
                        </ul>
                        <?php
                    } else{?>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" style="font-size: 1.15rem; color: #82af3b"><?= $_SESSION['username'] ?>
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="perfil.php?id_user=<?php echo(isset($_SESSION["id_usersToUse"])? $_SESSION["id_usersToUse"]:'') ?>">Meu Perfil</a></li>
                                <li><a class="dropdown-item" href="myRecipes.php?id_user=<?php echo(isset($_SESSION["id_usersToUse"])? $_SESSION["id_usersToUse"]:'') ?>">Minhas Receitas</a></li>
                                <li><a class="dropdown-item" href="scripts/sc_logout.php">Logout</a></li>
                            </ul>
                        </li>
                <?php
                    }
                    ?>
                    <?php
                } else {
                    ?>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" style="font-size: 1.15rem; color: #82af3b" href="index.php#login">Login</a></li>
                    <?php
                } ?>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#portfolio" style="font-size: 1.15rem; color: #82af3b">Receitas</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#services" style="font-size: 1.15rem; color: #82af3b">Serviços</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#about" style="font-size: 1.15rem; color: #82af3b">Sobre Nós</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#contact" style="font-size: 1.15rem; color: #82af3b">Contactos</a></li>
            </ul>

        </div>
    </div>
</nav>