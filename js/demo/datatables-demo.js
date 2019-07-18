// Call the dataTables jQuery plugin
$(function() {
    var clientes;
    var tabla;
    
    $(document).ready(function(){
        
       listaClientes();
        
    });
    
    function listaClientes(){
        $.ajax({
            data:{
                action:"leerClientes"
            },
            method:"post",
            url:"./controlador/controlador.php",
            beforeSend:function(xhr, settings){
                $("#esperaModal").modal("show");
            },
            success:function(dato,estado,xhr){
                //console.log("clientes:"+dato);
                $("#esperaModal").modal("hide");
                
                clientes=JSON.parse(dato);
                
                if(!("status" in clientes)){
                    if(clientes.length>0){
                        $("#tituloModal").text("Carga terminada");
                        $("#mensaje").text("Carga finalizada con exito");

                        tabla=$('#dataTable').DataTable({
                            data: clientes
                        });
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
                $('.accionCtes').prop("disabled",true);
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
    
    $('#dataTable tbody').on( 'click', 'tr', function () {
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
        
        $("#rfc").val($(".selected td:nth-child(3)").text());
        $("#nombre").val($(".selected td:nth-child(2)").text());
        $("#direccion").val($(".selected td:nth-child(4)").text());
        $("#ciudad").val($(".selected td:nth-child(5)").text());
        $("#estado").val($(".selected td:nth-child(6)").text());
        $("#email").val($(".selected td:nth-child(7)").text());
        $("#telefono").val($(".selected td:nth-child(8)").text());
        $("#tarjeta").val($(".selected td:nth-child(9)").text());
        $("#ModalAcualizacion").modal("show");
        
    } );
    
    $("#modificar").submit(function(e){
        e.preventDefault();
        
        $("#ModalAcualizacion").modal("hide");
        
        $.ajax({
            data:{
                action:"actualizarCliente",
                id:$(".selected td:first-child").text(),
                rfc:$("#rfc").val(),
                nombre:$("#nombre").val(),
                direccion:$("#direccion").val(),
                ciudad:$("#ciudad").val(),
                estado:$("#estado").val(),
                email:$("#email").val(),
                telefono:$("#telefono").val(),
                tarjeta:$("#tarjeta").val()
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
                $("#modificar input[type=email]").val("");
                $("#estado").val($("#estado").children("option:first").val());
                
                if(Number(actualizacion["status"])===1){
                    $("#dataTable").dataTable().fnDestroy();
                
                    listaClientes();
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
        $("#rfc").val("");
        $("#nombre").val("");
        $("#tarjeta").val("");
    });
    
    $('#eliminarDato').click( function () {
        
        $("#infoBaja").text($(".selected td:nth-child(2)").text());
        $("#ModalBaja").modal("show");
        //console.log($(".selected td:first-child").text());
        
        
    } );
    
    $('#confirmarBaja').click( function () {
        $("#ModalBaja").modal("hide");
        //console.log($(".selected td:first-child").text());
        $.ajax({
            data:{
                action:"bajaCliente",
                id:$(".selected td:first-child").text()
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
                    $('.accionCtes').prop("disabled",true);
                    
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
