<section id="login">
    <div class="container py-5">
        <h2 class="text-center pb-2"></h2>
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <?php
                if (isset($_GET["msg"])) {
                    $msg_show = true;
                    switch ($_GET["msg"]) {
                        case 0:
                            $message = "ocorreu um erro no registo";
                            $class="alert-warning";
                            break;
                        case 1:
                            $message = "registo efectuado com sucesso";
                            $class="alert-success";
                            break;
                        case 2:
                            $message = "ocorreu um erro no login";
                            $class="alert-warning";
                            break;
                        case 3:
                            $message = "login efectuado com sucesso";
                            $class="alert-success";
                            break;
                        default:
                            $msg_show = false;
                    }

                    echo "<div class=\"alert $class alert-dismissible fade show\" role=\"alert\">
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

            </div>
            <div class="col-lg-6 col-12 pb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Login</h2>
                        <form id="login-form" class="py-2" role="form" action="scripts/sc_user_login.php" method="post">
                            <div class="form-group">
                                <label for="inputEmailForm" class="sr-only form-control-label">Username</label>
                                <div class="mx-auto col-sm-10">
                                    <input type="text" class="form-control" id="inputEmailForm" name="username"
                                           placeholder="username"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPasswordForm" class="sr-only form-control-label">Password</label>
                                <div class="mx-auto col-sm-10">
                                    <input type="password" class="form-control" id="inputPasswordForm" name="password"
                                           placeholder="password" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mx-auto col-sm-10">
                                    <div class="checkbox form-control form-control-sm text-center small">
                                        <label class="">
                                            <input type="checkbox" class=""> remember me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mx-auto col-sm-10 pb-3 pt-2">
                                    <button type="submit" class="btn btn-outline-secondary btn-lg btn-block">Sign-in
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mx-auto col-sm-10">
                                    <div class="text-center">
                                        <a href="components/cp_user_password_recover.php" tabindex="5"
                                           class="forgot-password">Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12 pb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Sign-up</h2>
                        <form method="post" role="form" id="register-form" action="scripts/sc_user_register.php">
                            <div class="form-group">
                                <label for="input2EmailForm" class="sr-only form-control-label">username</label>
                                <div class="mx-auto col-sm-10">
                                    <input type="text" class="form-control" id="input2UserForm" name="username"
                                           placeholder="username"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input2EmailForm" class="sr-only form-control-label">email</label>
                                <div class="mx-auto col-sm-10">
                                    <input type="email" class="form-control" id="input2EmailForm" name="email"
                                           placeholder="email"
                                           required="required" onchange="email_validate(this.value);">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input2PasswordForm" class="sr-only form-control-label">password</label>
                                <div class="mx-auto col-sm-10">
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="password" required="required"
                                           onkeyup="checkPass(); return false;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input2Password2Form" class="sr-only form-control-label">verify</label>
                                <div class="mx-auto col-sm-10">
                                    <input type="password" class="form-control" id="password_confirm"
                                           placeholder="verify password" required="required"
                                           onkeyup="checkPass(); return false;">
                                    <span id="confirmMessage" class="confirmMessage"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mx-auto col-sm-10 pb-3 pt-2">
                                    <button type="submit" class="btn btn-outline-secondary btn-lg btn-block">Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</section>
