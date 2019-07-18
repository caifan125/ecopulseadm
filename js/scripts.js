$(function(){
    var referencias;
    
    $(document).ready(function(){
        
       $.ajax({
            data:{
                action:"referencias"
            },
            method:"post",
            url:"./controlador/controlador.php",
            beforeSend:function(xhr, settings){
                $("#esperaModal").modal("show");
            },
            success:function(dato,estado,xhr){
                $("#esperaModal").modal("hide");
                
                referencias=JSON.parse(dato);
                
                if(!("status" in referencias)){
                    if(referencias.length>0){
                        $("#tituloModal").text("Carga terminada");
                        $("#mensaje").text("Carga finalizada con exito");
                        
                        for(var i=0;i<referencias.length;i++){
                            $("#referencia").append($("<option id='"+i+"'></option>").attr("value",referencias[i]["idreferencia"]).text(referencias[i]["nombreReferencia"]));
                        }
                    }
                    else{
                        $("#tituloModal").text("Error");
                        $("#mensaje").text("No hay datos disponibles");
                    }
                }
                else{
                    $("#tituloModal").text("Error");
                    $("#mensaje").text(referencias["mensaje"]);
                }
                
                $("#errorModal").modal("show");
                
				
            },
            error:function(xhr,status,error){
                $("#esperaModal").modal("hide");
                $("#titulo").text("Error");
                $("#mensaje").text(error);
                $("#errorModal").modal("show");
            }
        });
        
    });
    
    $("#alta").submit(function(e){
        e.preventDefault();
        
        $.ajax({
            data:{
                action:"altaCte",
                rfc:$("#rfc").val(),
                nombre:$("#nombre").val(),
                direccion:$("#direccion").val(),
                ciudad:$("#ciudad").val(),
                estado:$("#estado").val(),
                email:$("#email").val(),
                telefono:$("#telefono").val(),
                tarjeta:$("#tarjeta").val(),
                referencia:$("#referencia").val()
            },
            method:"post",
            url:"./controlador/controlador.php",
            beforeSend:function(xhr, settings){
                $("#esperaModal").modal("show");
            },
            success:function(dato,estado,xhr){
                //console.log(dato);
                $("#esperaModal").modal("hide");
                
                var status=JSON.parse(dato);
                
                if(Number(status["status"])===1){
                    $("#alta input[type=text]").val("");
                    $("#alta input[type=email]").val("");
                    //$("#rfc").val("");
                    //$("#nombre").val("");
                    $("#estado").val($("#estado").children("option:first").val()); 
                    //$("#tarjeta").val("");
                    $("#referencia").val($("#referencia").children("option:first").val()); 
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