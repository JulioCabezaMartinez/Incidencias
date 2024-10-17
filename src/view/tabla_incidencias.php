<?php
    
    session_start();

    if (empty($_SESSION)){
        header("Location:../../../src/view/login.php");
        die();
    }

    require_once '../view/Templates/inicio.inc.php';

?>
<title>Incidencias</title>

</head>
<body>
    <!-- Modal de confirmación -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" >
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header" >
                    <h5 class="modal-title" id="exampleModalLongTitle">Insercción correcta</h5>
                </div>
                <div class="modal-body">
                    La incidencia se ha creado con éxito.
                </div>
                <div class="modal-footer">
                    <button id="cerrar" type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    
        //Barra de busqueda para DNI en tiempo real

        include_once '../view/Templates/barra_lateral.inc.php';

    ?>
    <div class="d-flex flex-column">

        <h1>Tabla de Incidencias</h1><br>
        <label for="buscador">Busqueda por DNI:</label>
        <input type="text" id="busqueda_DNI_incidencia" style="width: 10%;" maxlength="9" placeholder="12345678A">
        <table style="width: 85%;" class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th scope="col">N°Incidencia</th>
                    <th scope="col">Motivo</th>
                    <th scope="col">DNI-Cliente</th>
                    <th scope="col">Nombre-Cliente</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody id="all_incidencias">
                
                <?php
                    foreach($lista_incidencias as $incidencia){
                        $usuario=Usuario::recogerUsuarioId($incidencia->getIdCliente(), $connection);
                        $estado=match($incidencia->getEstado()){
                            1=>"Trabajando en ello",
                            2=>"Pausa",
                            3=>"En Seguimiento",
                            4=>"Finalizado",
                            5=>"Sin trabajador Asignado"
                        }
                ?>
                    <tr>
                        <?php
                        if($incidencia->getReabierto()){
                        ?>
                            <td><button id="main_row_<?php echo $incidencia->getNIncidencia() ?>" class="btn btn-outline-secondary main-row"><i class="fa-solid fa-arrow-down-wide-short"></i></button></td>
                        <?php
                        }else{
                        ?>
                        <td></td>
                        <?php
                        }
                        ?>
                            <td>01-<?php echo $incidencia->getNIncidencia()?></td>
                            <td><?php echo $incidencia->getMotivo() ?></td>
                            <td><?php echo $usuario["DNI"] ?></td>
                            <td><?php echo $usuario["nombre"]. " " .$usuario["apellidos"] ?></td>
                            <td><?php echo $estado ?></td>
                            <td>
                            <?php
                                if(is_null($incidencia->getIdEmpleado()) && $_SESSION["tipo"]!=2){
                                    ?>
                                    <form action="../../src/controller/actions_tabla.php?class=add_empleado" method="post">
                                        <input type="hidden" name="nIncidencia" value="<?php echo $incidencia->getNIncidencia()?>">
                                        <button type="submit" name="nIncidencia_submit" class="btn btn-small btn-success"><i class="fa-solid fa-user-plus"></i></button>Quedarse con la Incidencia
                                    </form>
                                    <?php
                                }
                                ?>
                                <?php
                                if($incidencia->getIdEmpleado()==$_SESSION["id"]){
                                    if($incidencia->getReabierto()){
                                ?>
                                        <button id="btn_reabrir-<?php echo $incidencia->getNIncidencia() ?>" class="btn btn-small btn-warning my-1 btn_reabrir"><i class="fa-solid fa-envelope-open-text me-2"></i>Reabrir Incidencia</button><br>
                                <?php
                                    }else{
                                ?>
                                        <a href="../../src/controller/actions_tabla.php?class=sol&back=all&nIncidencia=<?php echo $incidencia->getNIncidencia()?>" class="btn btn-small btn-primary my-1"><i class="fa-solid fa-briefcase me-2"></i>Trabajar en Incidencia</a><br>
                                <?php
                                    }
                                }
                                ?>
                                    <a href="../../src/controller/genera_PDF.php?nIncidencia=<?php echo $incidencia->getNIncidencia()?>" class="btn btn-small btn-primary my-1"><i class="fa-solid fa-file-arrow-down me-2"></i>Descargar Incidencia</a><br>

                                
                                <?php
                                if($_SESSION["tipo"]==1){
                                    ?>
                                        <a href="../../src/controller/actions_incidencia.php?action=mod&nIncidencia=<?php echo $incidencia->getNIncidencia()?>" class="btn btn-small btn-primary my-1"><i class="fa-solid fa-file-pen me-2"></i>Modificar Incidencia</a>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <tr class="subelement_<?php echo $incidencia->getNIncidencia() ?>" style="display:none;">
                            <th></th>
                            <th class="bg-dark text-light">N. Reapertura</th>
                            <th class="bg-dark text-light">Estado</th>
                            <th class="bg-dark text-light">Acciones</th>
                        </tr>
                            <?php
                                $lista_reaperturas=Reapertura::recogerReaperturas($incidencia->getNIncidencia(), $connection);
                                foreach($lista_reaperturas as $reapertura){
                                    $estado_reapertura=match($reapertura->getEstado()){
                                        1=>"Trabajando en ello",
                                        2=>"Pausa",
                                        3=>"En Seguimiento",
                                        4=>"Finalizado"
                                    }

                            ?>
                                
                                <tr class="subelement_<?php echo $incidencia->getNIncidencia() ?>" style="display:none;">
                                    <td></td>
                                    <td class="filas_reapertura" style="width: 150px">R-<?php echo $reapertura->getNreapertura() ?></td>
                                    <td class="filas_reapertura"><?php echo $estado_reapertura ?></td>
                                    <td class="filas_reapertura">
                                        <a href="../../src/controller/actions_tabla.php?class=solR&back=all&nIncidencia=<?php echo $incidencia->getNIncidencia()?>&nReapertura=<?php echo $reapertura->getNreapertura()?>" class="btn btn-small btn-primary my-1"><i class="fa-solid fa-briefcase"></i>Trabajar en Reapertura</a><br>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div><!-- Div que cierra la barra lateral para que se mantenga en su lugar -->
    
    <?php

        if(isset($_GET["add"])){
            if($_GET["add"]=="ok"){
                echo "<script type='text/javascript'>
                        $(window).on('load', function() {
                            $('#exampleModalCenter').modal('show');
                        });
                        $('#cerrar').on('click', function() {
                            $('#exampleModalCenter').modal('hide');
                        });
                    </script>";
            }
        }

    ?>
    
    <script>
        //Script de busqueda por DNI de AJAX
        $(document).ready(function(){
            $('#busqueda_DNI_incidencia').keyup(function(){
                var DNI=$(this).val();
                var lista_incidencias=$("#all_incidencias").html();
                if(DNI==""){
                    $("#all_incidencias").html(lista_incidencias);
                }else{
                    $.ajax({
                        url: "AJAX.php",
                        method: "POST",
                        data:{
                            mode: "busqueda_DNI_incidencias",
                            DNI: DNI
                        },
                        success:function(data){
                            
                            $("#all_incidencias").html(data);
                        }
                    })
                }
                
            });

            //Reaperturas

            //Mostrar Reaperturas
            $(".main-row").click(function(){
                let incidencia=$(this).attr('id').split('_')[2];
                // console.log(".subelement"+incidencia);
                $(".subelement_"+incidencia).toggle();  // Muestra u oculta el subelemento
            });

            //Crear Reaperturas
            $('.btn_reabrir').click(function(){
                let nIncidencia=$(this).attr('id').split('-')[1];
                $.ajax({
                    url: "AJAX.php",
                    method: "POST",
                    data:{
                        mode: "reabrir_incidencia",
                        nIncidencia: nIncidencia,
                    },
                    success:function(data){
                        location.reload();
                    }
                })
            })
        });

        
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

