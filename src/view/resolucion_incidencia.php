<?php

    session_start();

    require_once '../model/BuscadorDB.php';
    require_once '../model/usuario.php';
    require_once '../model/incidencias.php';

    if (empty($_SESSION)){
        header("Location:../../../src/view/login.php");
        die();
    }

    $lista_DNIs=Usuario::recogerDNIsUsuarios($connection);

    require_once "../view/Templates/inicio.inc.php";

?>
    <title>Resolución Incidencia</title>
</head>
<body>

    <!-- Modal de Estado -->
    <div class="modal fade" id="modal_motivo_estado" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog d-flex justify-content-center">
            <div class="modal-content w-75">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Motivo de estado</h5>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <!-- Motivo de Estado input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="name3">Motivo de Estado</label>
                            <input id="motivo_estado" type="text" id="name3" class="form-control" />
                        </div>
                        <button id="btn_cerrar_modal" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="btn_guardar_estado_modal" type="button" class="btn btn-primary w-50" data-dismiss="modal">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de Estado-->

    <!-- Modal de confirmación -->
    <div class="modal fade" id="modal_estado_confirmacion" tabindex="-1" >
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header" >
                    <h5 class="modal-title" id="exampleModalLongTitle">Incidencia Guardada</h5>
                </div>
                <div class="modal-body">
                    Incidencia guardada con éxito.
                </div>
                <div class="modal-footer">
                    <button id="cerrar" type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de confirmación -->
    
    <?php
        include_once '../view/Templates/barra_lateral.inc.php';
    ?>
        <div>
            <h1>Resolución de Incidencias</h1>
            <div>
                <div>

                </div>
                <div class="my-4">
                    <h3>Tiempo trabajado: </h3>
                    <p><span id="horas">00</span>:<span id="minutos">00</span>:<span id="segundos">00</span></p><!-- Contador -->
                </div>    
            </div>

                <?php
                    if($_GET["back"]=="asig"){ //Con esta variable podemos ver de donde viene el usuario para al darle atras pueda volver.
                ?>
                    <a href="../../../src/controller/actions_tabla.php?class=empleados" class="btn btn-secondary">← Atras</a>
                <?php
                    }elseif($_GET["back"]=="all"){
                ?>
                    <a href="../../../src/controller/actions_tabla.php?class=all" class="btn btn-secondary">← Atras</a>
                <?php
                    } 
                ?>
            
            
                    
            <div class="col py-3 mx-4">
                <div class="mb-3">
                    <label for="motivo" class="form-label w-50">Motivo de la Incidencia</label>
                    <input type="text" name="motivo" class="form-control w-50" id="motivoIncidencia" value="<?php echo $incidencia->getMotivo() ?>"> <!-- Cambiar value por incidencia-->
                </div>

                <form>
                    <div class="mb-3 w-50">
                        <label for="motivo" class="form-label">Resolución de la Incidencia</label>
                        <textarea id="resolucion_instancia" class="form-control w-75" rows="6"></textarea>
                    </div>
                    <br>
                    <div class="mb-3 w-50">
                        <label for="estado"><strong>Estado de la Incidencia:</strong></label><br><br>
                        <?php
                            if($incidencia->getEstado()==1){
                        ?>
                            <input type="radio" name="estado" value="1" checked required>Trabajando en la Incidencia
                        <?php
                            }else{
                        ?>
                            <input type="radio" name="estado" value="1" checked required>Trabajando en la Incidencia
                        <?php
                        }
                        ?>
                        <br>
                        <?php
                            if($incidencia->getEstado()==2){
                        ?>
                            <input type="radio" name="estado" value="2" checked>Pendiente
                        <?php
                            }else{
                        ?>
                            <input type="radio" name="estado" value="2">Pendiente
                        <?php
                        }
                        ?>
                        <br>
                        <?php
                            if($incidencia->getEstado()==3){
                        ?>
                           <input type="radio" name="estado" value="3" checked>En Seguimiento
                        <?php
                            }else{
                        ?>
                            <input type="radio" name="estado" value="3">En Seguimiento
                        <?php
                        }
                        ?>
                        <br>
                        <?php
                            if($incidencia->getEstado()==4){
                        ?>
                           <input type="radio" name="estado" value="4" checked>Finalizado
                        <?php
                            }else{
                        ?>
                            <input type="radio" name="estado" value="4">Finalizado
                        <?php
                        }
                        ?>

                    </div>
                    <div class="mb-3 w-50">
                        <label for="motivo" class="form-label">Observaciones: </label>
                        <textarea id="observaciones_incidencia" class="form-control w-75" rows="3"></textarea>
                    </div>
                    <input type="hidden" id="hidden_nIncidencia" value="<?php echo $incidencia->getNIncidencia() ?>">
                    <input type="hidden" id="hidden_hApertura" value="<?php echo $incidencia->getHoraApertura() ?>">
                    <input id="btn_guardar_resolucion" type="button" value="Guardar" class="btn btn-outline-success">
                </form>
            </div>
        </div>
</div> <!-- Div que cierra la barra lateral para que se mantenga en su lugar -->

<script>
    function conseguirFecha(){
        let fecha = new Date();
        let año = fecha.getFullYear();
        let mes = (fecha.getMonth() + 1).toString().padStart(2, '0'); // Para asegurar que los meses y días tengan 2 dígitos
        let día = fecha.getDate().toString().padStart(2, '0');
        let horas = fecha.getHours().toString().padStart(2, '0');
        let minutos = fecha.getMinutes().toString().padStart(2, '0');
        let segundos = fecha.getSeconds().toString().padStart(2, '0');

        return `${año}-${mes}-${día}T${horas}:${minutos}:${segundos}`;
    }

    function calcularTiempo(tiempoPrincipio, tiempoFinal){
        let diferenciaMilisegundos = tiempoFinal - tiempoPrincipio;
        let diferenciaHoras = diferenciaMilisegundos / (1000 * 60);

        return diferenciaHoras;
    }

    //Cuando se pulse el boton de guardar. (Si se ha seleccionado "Trabajando en ello" se guardarán los datos usando AJAX, en caso contrario se abrirá un modal para indicar el motivo del estado)
    $(document).ready(function(){
        $("#btn_guardar_resolucion").click(function(){
            let estado=$('input[type="radio"]:checked').val();
            let resolucion=$("#resolucion_instancia").val();
            let observaciones=$("#observaciones_incidencia").val();
            let nIncidencia=$("#hidden_nIncidencia").val();
            let horaApertura=$("#hidden_hApertura").val();
            let horaCierre= conseguirFecha();
            let totalTiempo= calcularTiempo(new Date(horaApertura).getTime(), new Date(horaCierre).getTime());


            if(estado!=1 || estado!=4){
                $("#modal_motivo_estado").modal("show");
            }else{
                $.ajax({
                    url: "AJAX.php",
                    method: "POST",
                    data:{
                        mode: "resolucion_Trabajando",
                        estado: estado,
                        resolucion: resolucion,
                        observaciones:observaciones,
                        nIncidencia: nIncidencia,
                        horaApertura: horaApertura,
                        horaCierre: horaCierre,
                        totalTiempo: totalTiempo
                    },
                    success:function(data){
                        $("#modal_motivo_estado").modal('hide');
                        $("#modal_estado_confirmacion").modal('show');
                    }
                })
            }
        });

        $("#btn_guardar_estado_modal").click(function(){
            let estado=$('input[type="radio"]:checked').val();
            let resolucion=$("#resolucion_instancia").val();
            let observaciones=$("#observaciones_incidencia").val();
            let nIncidencia=$("#hidden_nIncidencia").val();
            let motivo=$("#motivo_estado").val();
            console.log(motivo);
            let horaApertura=$("#hidden_hApertura").val();
            let horaCierre= conseguirFecha();
            let totalTiempo=calcularTiempo(new Date(horaApertura).getTime(), new Date(horaCierre).getTime());
            $.ajax({
                    url: "AJAX.php",
                    method: "POST",
                    data:{
                        mode: "resolucion_Trabajando",
                        estado: estado,
                        motivo: motivo,
                        resolucion: resolucion,
                        observaciones: observaciones,
                        nIncidencia: nIncidencia,
                        horaApertura: horaApertura,
                        horaCierre: horaCierre,
                        totalTiempo: totalTiempo
                        
                    },
                    success:function(data){
                        console.log(data);
                        $("#modal_motivo_estado").modal('hide');
                        $("#modal_estado_confirmacion").modal('show');

                    }
                })
        });

        $("#btn_cerrar_modal").click(function(){
            $("#modal_motivo_estado").modal('hide');
        })

        $("#cerrar").click(function(){
            $("#modal_estado_confirmacion").modal('hide');
        })

        //Ccontador
        let segundos=0;
        let minutos=0;
        let horas=0;

        setInterval(function(){
            segundos++;
            if(segundos==60){
                segundos=0;
                minutos++;
            }
            if(minutos==60){
                minutos=0;
                horas++;
            }

            console.log(segundos);

            $("#horas").text(horas.toString().padStart(2, '0'));
            $("#minutos").text(minutos.toString().padStart(2, '0'));
            $("#segundos").text(segundos.toString().padStart(2, '0'));
        }, 1000);

    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>