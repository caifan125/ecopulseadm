// Call the dataTables jQuery plugin
$(function() {
    var creditos;
    var tabla;
    
    $(document).ready(function(){
        
       listaCreditos();
        
    });
    
    function listaCreditos(){
        $.ajax({
            data:{
                action:"leerCreditos"
            },
            method:"post",
            url:"./controlador/controlador.php",
            beforeSend:function(xhr, settings){
                $("#esperaModal").modal("show");
            },
            success:function(dato,estado,xhr){
                //console.log("clientes:"+dato);
                $("#esperaModal").modal("hide");
                
                creditos=JSON.parse(dato);
                
                if(!("status" in creditos)){
                    if(creditos.length>0){
                        $("#tituloModal").text("Carga terminada");
                        $("#mensaje").text("Carga finalizada con exito");

                        tabla=$('#dataTable').DataTable({
                            data: creditos
                        });
                    }
                    else{
                        $("#tituloModal").text("Error");
                        $("#mensaje").text("No hay datos disponibles");
                    }
                }
                else{
                    $("#tituloModal").text("Error");
                    $("#mensaje").text(creditos["mensaje"]);
                }
                $("#errorModal").modal("show");
                $('.accionCred').prop("disabled",true);
				
            },
            error:function(xhr,status,error){
                $("#esperaModal").modal("hide");
                $("#tituloModal").text("Error");
                $("#mensaje").text(error);
                $("#errorModal").modal("show");
            }
        });
    }
    
    $('#dataTable tbody').on( 'click', 'tr', function () {
        //console.log($(this).find("td:nth-child(10)").text());
        if(parseInt($(this).find("td:nth-child(10)").text())!==3){
        
            if ( $(this).hasClass('selected')) {
                $(this).removeClass('selected');
                $('.accionCred').prop("disabled",true);
            }
            else {
                tabla.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                $('.accionCred').prop("disabled",false);
            }
        }
        else{
            $("#tituloModal").text("Crédito liquidado");
            $("#mensaje").text("El crédito de "+$(this).find("td:nth-child(2)").text()+" ya está liquidado y no se puede modificar");
            $("#errorModal").modal("show");
        }
    } );
    
    $('#actualizarCred').click( function () {
        
        $("#nombre").val($(".selected td:nth-child(2)").text());
        $("#tipocontrato").val($(".selected td:nth-child(3)").text());
        $("#monto").val($(".selected td:nth-child(4)").text());
        $("#plazo").val($(".selected td:nth-child(5)").text());
        $("#mensualidad").val($(".selected td:nth-child(6)").text());
        $("#interes").val($(".selected td:nth-child(7)").text());
        $("#metodoPago").val($(".selected td:nth-child(8)").text());
        $("#observaciones").val($(".selected td:nth-child(9)").text());
        $("#ModalAcualizacion").modal("show");
        
    } );
    
    $("#modificar").submit(function(e){
        e.preventDefault();
        
        $("#ModalAcualizacion").modal("hide");
        
        $.ajax({
            data:{
                action:"actualizarCredito",
                credito:$(".selected td:nth-child(1)").text(),
                tipocontrato:$("#tipocontrato").val(),
                monto:$("#monto").val(),
                plazo:$("#plazo").val(),
                mensualidad:$("#mensualidad").val(),
                interes:$("#interes").val(),
                metodoPago:$("#metodoPago").val(),
                observaciones:$("#observaciones").val()
            },
            method:"post",
            url:"./controlador/controlador.php",
            beforeSend:function(xhr, settings){
                $("#esperaModal").modal("show");
            },
            success:function(dato,estado,xhr){
                //console.log("actualizacion:"+dato);
                $("#esperaModal").modal("hide");
                var actualizacion=JSON.parse(dato);
                
                $("#modificar input[type=text]").val("");
                $("#observaciones").val("");
                
                if(Number(actualizacion["status"])===1){
                    $("#dataTable").dataTable().fnDestroy();
                
                    listaCreditos();
                }
                else{
                    $("#tituloModal").text("Error");
                }
                $("#mensaje").text(actualizacion["mensaje"]);
                $("#errorModal").modal("show");
				
            },
            error:function(xhr,status,error){
                $("#esperaModal").modal("hide");
                $("#tituloModal").text("Error");
                $("#mensaje").text(error);
                $("#errorModal").modal("show");
            }
        });
    });
    
    $('#ModalAcualizacion').on('hidden.bs.modal', function (e) {
        $("#modificar input[type=text]").val("");
        $("#observaciones").val("");
    });
    
    $('#eliminarCred').click( function () {
        
        $("#infoBaja").text($(".selected td:nth-child(2)").text());
        $("#ModalBaja").modal("show");
        //console.log($(".selected td:first-child").text());
        
        
    } );
    
    $('#confirmarBaja').click( function () {
        $("#ModalBaja").modal("hide");
        //console.log($(".selected td:first-child").text());
        $.ajax({
            data:{
                action:"bajaCredito",
                idcredito:$(".selected td:first-child").text()
            },
            method:"post",
            url:"./controlador/controlador.php",
            beforeSend:function(xhr, settings){
                $("#esperaModal").modal("show");
            },
            success:function(dato,estado,xhr){
                //console.log("baja:"+dato);
                $("#esperaModal").modal("hide");
                
                var baja=JSON.parse(dato);
                
                if(Number(baja["status"])===1){
                    tabla.row('.selected').remove().draw( false );
                    $('.accionCred').prop("disabled",true);
                    
                    $("#tituloModal").text("Proceso finalizado");
                }
                else{
                    $("#tituloModal").text("Error");
                }
                $("#mensaje").text(baja["mensaje"]);
                $("#errorModal").modal("show");
				
            },
            error:function(xhr,status,error){
                $("#esperaModal").modal("hide");
                $("#tituloModal").text("Error");
                $("#mensaje").text(error);
                $("#errorModal").modal("show");
            }
        });
        
    } );
    
});
