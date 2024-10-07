<?php
    
    session_start();

    if (empty($_SESSION)){
        header("Location:login.php");
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Asignación correcta</h5>
                </div>
                <div class="modal-body">
                    Empleado asociado con éxito.
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

        <h1>Tabla de Incidencias Asignadas</h1><br>
        <label for="buscador">Busqueda por DNI:</label>
        <input type="text" id="busqueda_DNI_incidencia" style="width: 10%;" maxlength="9" placeholder="12345678A">
        <table style="width: 85%;" class="table table-striped">
            <thead>
                <tr>
                <th scope="col">N°Incidencia</th>
                <th scope="col">Motivo</th>
                <th scope="col">DNI-Cliente</th>
                <th scope="col">Nombre-Cliente</th>
                <th scope="col">Estado</th>
                <th scope="col"></th>
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
                            <td>01-<?php echo $incidencia->getNIncidencia()?></td>
                            <td><?php echo $incidencia->getMotivo() ?></td>
                            <td><?php echo $usuario["DNI"] ?></td>
                            <td><?php echo $usuario["nombre"]. " " .$usuario["apellidos"] ?></td>
                            <td><?php echo $estado ?></td>
                            <td>
                            <?php
                                if(!is_null($incidencia->getIdEmpleado()) && $_SESSION["tipo"]==1){
                                ?>
                                <form action="../../src/controller/actions_tabla.php?class=del_Empleado" method="post">
                                    <input type="hidden" name="nIncidencia" value="<?php echo $incidencia->getNIncidencia()?>">
                                    <input type="submit" name="nIncidencia_submit"><i class="fa-solid fa-user-minus"></i>
                                </form>
                                    
                                <?php
                                }
                                ?>
                                 <a href="../../src/controller/genera_PDF.php?nIncidencia=<?php echo $incidencia->getNIncidencia()?>" class="btn btn-small btn-primary my-1"><i class="fa-solid fa-briefcase"></i></a>
                                <a href="../../src/controller/genera_PDF.php?nIncidencia=<?php echo $incidencia->getNIncidencia()?>" class="btn btn-small btn-primary my-1 btn_descarga"><i class="fa-solid fa-file-arrow-down"></i></a>
                            </td>
                        </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div><!-- Div que cierra la barra lateral para que se mantenga en su lugar -->
    
    <?php

        if($_GET["class"]=="add_empleado"){
            echo "<script type='text/javascript'>
                    $(window).on('load', function() {
                        $('#exampleModalCenter').modal('show');
                    });
                    $('#cerrar').on('click', function() {
                        $('#exampleModalCenter').modal('hide');
                    });
                </script>";
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
        });
        
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

