<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark barra_lateral">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a style="cursor: default;" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Menu</span><span><img src="../../../assets/IMG/file.png" style="width: 50%; margin-left: 50%;" alt=""></span>
                </a>
                <ul class="nav flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="main.php" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Incidencias</span> </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li>
                                <a href="creacion_Incidencia.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Crear Incidencia</span></a>
                            </li>
                            <li class="w-100">
                                <a href="../../../src/controller/actions_tabla.php?class=mi" class="nav-link px-0"> <span class="d-none d-sm-inline">Mis Incidencias</span></a>
                            </li>
                            <li>
                                <a href="../../../src/controller/actions_tabla.php?class=all" class="nav-link px-0"> <span class="d-none d-sm-inline">Todas las Incidencias</span></a>
                            </li>
                        </ul>
                        <?php
                        if($_SESSION['tipo']==1){//El estado 1 equivale a ser Admin. ($usurioActivo->estado==1) Este es el if real, lo otro es para pruebas.
                        ?>
                            <li class="nav-item">
                                <a href="../../../src/controller/actions_tabla.php?class=em" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Peticiones de empleados</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Panel Principal</span>
                                </a>
                            </li>
                        
                        <?php
                        }
                        ?>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../../assets/IMG/images.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1"><?php echo $_SESSION["nombre"] ?></span> <!-- Aqui tendría que coger la info de la sesion iniciada = -->
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        
                        <li><a class="dropdown-item" href="../../../src/controller/actions_usuario.php?action=cerrar">Cerrar Sesion</a></li>
                    </ul>
                </div>
            </div>
        </div>