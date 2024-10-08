<?php
    
    session_start();

    ini_set('display_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    if (empty($_SESSION)){
        header("Location:../../../src/view/login.php");
        die();
    }

    require_once '../view/Templates/inicio.inc.php';
    
?>
<title>Resolución</title>
</head>
<body>
    <?php
        include_once '../view/Templates/barra_lateral.inc.php';
    ?>

    <div class="col py-3">
            <h1>Cambiar contraseña</h1>
            <div class="card-body w-25" >
                            <form action="../../../src/controller/actions_usuario.php" class="form" role="form" autocomplete="off" method="post">
                                <div class="form-group">
                                    <label for="inputPasswordOld">Contraseña Actual:</label>
                                    <input type="password" name="old_pass" class="form-control" id="old_pass" required="">
                                </div>
                                <div class="form-group">
                                    <label for="inputPasswordNew">Nueva Contraseña:</label>
                                    <input type="password" name="new_pass" class="form-control" id="new_pass" required="">
                                    <!-- <span class="form-text small text-muted">
                                            The password must be 8-20 characters, and must <em>not</em> contain spaces.
                                        </span> -->
                                </div>
                                <div class="form-group">
                                    <label for="inputPasswordNewVerify">Confirmar Contraseña:</label>
                                    <input type="password" name="confirm" class="form-control" id="confirm" required="">
                                    <!-- <span class="form-text small text-muted">
                                            To confirm, type the new password again.
                                        </span> -->
                                </div>
                                <div class="form-group my-3">
                                    <button type="submit" name="guardar_pass" class="btn btn-primary btn-lg float-right">Cambiar Contraseña</button>
                                </div>
                            </form>
                        </div>
    </div>
</div> <!-- Div que cierra la barra lateral para que se mantenga en su lugar -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>