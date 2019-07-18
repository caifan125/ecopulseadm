$(function(){
    var clientes;
    
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
    
    $("#altaCredito").submit(function(e){
        e.preventDefault();
        
        $.ajax({
            data:{
                action:"altaCredito",
                cliente:$("#cliente").val(),
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
                $("#esperaModal").modal("hide");
                console.log(dato);
                
                var status=JSON.parse(dato);
                
                if(Number(status["status"])===1){
                    $("#altaCredito input[type=text]").val("");
                    $("#observaciones").val("");
                    $("#cliente").val($("#cliente").children("option:first").val());
                    $("#tituloModal").text("Proceso terminado");
                }
                else{
                    $("#tituloModal").text("Error");
                }
                $("#mensaje").text(status["mensaje"]);
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