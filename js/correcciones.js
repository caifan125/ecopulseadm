$(function(){
    var clientes;
    var mensualidades;
    var tabla;
    var credito;
    
    $(document).ready(function(){
        
       $.ajax({
            data:{
                action:"clientesCredito"
            },
            method:"post",
            url:"./controlador/controlador.php",
            beforeSend:function(xhr, settings){
                $("#esperaModal").modal("show");
            },
            success:function(dato,estado,xhr){
                $("#esperaModal").modal("hide");
                
                clientes=JSON.parse(dato);
                
                if(!("status" in clientes)){
                    $(".refClientes").remove();
                    
                    if(clientes.length>0){
                        $("#tituloModal").text("Carga terminada");
                        $("#mensaje").text("Carga finalizada con exito");
                        
                        for(var i=0;i<clientes.length;i++){
                            $("#cliente").append($("<option class='refClientes' id='"+i+"'></option>").attr("value",clientes[i]["idClienteTg"]).text(clientes[i]["NombreCte"]));
                        }
                    }
                    else{
                        $("#tituloModal").text("Error");
                        $("#mensaje").text("No hay datos disponibles");
                    }
                }
                else{
                    $("#tituloModal").text("Error");
                    $("#mensaje").text(clientes["mensaje"]);
                }
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
    
    $("#edoCte").submit(function(e){
        e.preventDefault();
        
        listadoPagos();
    });
    
    function listadoPagos(){
        $.ajax({
            data:{
                action:"filtroPagos",
                cliente:$("#cliente").val(),
                tipoFiltro: $(".filtroCta:checked").val()
            },
            method:"post",
            url:"./controlador/controlador.php",
            beforeSend:function(xhr, settings){
                $("#esperaModal").modal("show");
            },
            success:function(dato,estado,xhr){
                $("#esperaModal").modal("hide");
                console.log(dato);
                
                if(tabla!==undefined)
                {                    
                    
                    tabla.clear().draw();
                }
                
                mensualidades=JSON.parse(dato);
                
                if(!("status" in mensualidades)){
                    $("#tituloModal").text("Carga terminada");
                    $("#mensaje").text("Carga finalizada con exito");
                    $("#actualizarDato").prop("disabled", true);
                    
                    tabla=$('#detPagos').DataTable();
                    tabla.rows.add(mensualidades).draw();
                    $("#enviarCta").prop("disabled", false);
                    $("#aliquidar").prop("disabled", false);
                }
                else{
                    
                    $("#tituloModal").text("Error");
                    $("#mensaje").text(mensualidades["mensaje"]);
                    $("#enviarCta").prop("disabled", true);
                    $("#aliquidar").prop("disabled", true);
                }
                $("#aliquidar").val("");
                $("#errorModal").modal("show");
                
            },
            error:function(xhr,status,error){
                $("#esperaModal").modal("hide");
                $("#tituloModal").text("Error");
                $("#mensaje").text(error);
                $("#errorModal").modal("show");
            }
        });
    }
    
    $('#detPagos tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
            $('.accionCtes').prop("disabled",true);
        }
        else {
            tabla.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            $('.accionCtes').prop("disabled",false);
        }
    } );
    
    $('#actualizarDato').click( function () {
        
        $("#pago").val($(".selected td:nth-child(4)").text());
        $("#factura").val($(".selected td:nth-child(6)").text());
        $("#status").val($(".selected td:nth-child(5)").text());
        $("#fechaPago").val($(".selected td:nth-child(7)").text());
        
        if(parseInt($(".selected td:nth-child(5)").text())===3){
            $("#tituloActualizar").text("Correción de pago ya registrado");
        }
        else{
            $("#tituloActualizar").text("Modificación de pago pendiente");
        }
        
        $("#ModalAcualizacion").modal("show");
    } );
    
    $("#aplicarCambio").click(function(){
        
        $("#ModalAcualizacion").modal("hide");
        
        $.ajax({
            data:{
                action:"actualizarPagos",
                idpago:$(".selected td:nth-child(1)").text(),
                pago:$("#pago").val(),
                factura:$("#factura").val(),
                status:$("#status").val(),
                fecha:$("#fechaPago").val()
            },
            method:"post",
            url:"./controlador/controlador.php",
            beforeSend:function(xhr, settings){
                $("#esperaModal").modal("show");
            },
            success:function(dato,estado,xhr){
                console.log("actualizacion:"+dato);
                $("#esperaModal").modal("hide");
                var actualizacion=JSON.parse(dato);
                
                if(Number(actualizacion["status"])===1){
                    $("#modificar input[type=text]").val("");
                    $("#status").val($("#status").children("option:first").val());
        
                    listadoPagos();
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
    
});