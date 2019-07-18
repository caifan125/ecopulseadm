$(function(){
    var clientes;
    var mensualidades;
    var tabla;
    
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
        
        $.ajax({
            data:{
                action:"pagosCte",
                cliente:$("#cliente").val()
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
                    console.log("hay datos en tabla");
                    tabla.clear().draw();
                }
                
                mensualidades=JSON.parse(dato);
                
                if(!("status" in mensualidades)){
                    $("#tituloModal").text("Carga terminada");
                    $("#mensaje").text("Carga finalizada con exito");
                    
                    tabla=$('#detPagos').DataTable();
                    tabla.rows.add(mensualidades[0]).draw();
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
    });
    
    $("#generarEdoCta").submit(function(e){
        e.preventDefault();
        
        $.ajax({
            data:{
                action:"edoCta",
                mensualidades:JSON.stringify(mensualidades),
                cliente:$("#cliente option:selected").text(),
                aliquidar:$("#aliquidar").val()
            },
            method:"post",
            url:"./controlador/controlador.php",
            beforeSend:function(xhr, settings){
                $("#esperaModal").modal("show");
            },
            success:function(dato,estado,xhr){
                $("#esperaModal").modal("hide");
                console.log(dato);
                window.open(dato);
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