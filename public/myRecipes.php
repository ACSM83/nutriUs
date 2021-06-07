<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once "helpers/help_meta.php"; ?>

    <title>Nutri.Us - MiniProjeto LABMM4</title>

    <?php include_once "helpers/help_css.php"; ?>

</head>

<body id="page-top">

<!-- Navigation -->
<?php require_once "components/cp_menu.php"; ?>

<!-- Entradas -->
<?php require_once "components/cp_myRecipes.php"; ?>

<!-- Footer -->
<?php require_once "components/cp_footer.php"; ?>


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
