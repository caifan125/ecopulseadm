$(function(){
    var referencias;
    var clientes;
    
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
    
    $("#referencia").change(function(){
        
        $.ajax({
            data:{
                action:"leerClientesRef",
                ref: $("#referencia").val()
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
    
    $("#cobros").submit(function(e){
        e.preventDefault();
        
        var tablaCon="<tr><td>"+clientes[$("#cliente option:selected").index()-1]["NombreCte"]+
            "</td><td>"+clientes[$("#cliente option:selected").index()-1]["RFCCte"]+"</td>"+
            "</td><td>"+clientes[$("#cliente option:selected").index()-1]["numTg"]+"</td>"+
            "</td><td>"+$("#pago").val()+"</td>"+
            /*"</td><td>"+$("#tipoGasto option:selected").text()+"</td>"+*/
            "</td><td>"+$("#divisa").val()+"</td>"+
            "</td><td>"+$("#movimiento").val()+"</td>"+
            "</td><td><button id='remover' type='button' class='btn btn-danger'>-</button></td></tr>";
            
        $("#detCargos>tbody").append(tablaCon);
        $("#crearReporte").prop("disabled", false);
    });
    
    $("#detCargos").on("click","#remover",function(){
        $(this).parents("tr").remove();
        
        if($("#detCargos>tbody").children("tr").length===0){
            $("#crearReporte").prop("disabled", true);
        }
        
    });
    
    $("#crearReporte").click(function(){
        var datos=new Array();
        //console.log($("#detCargos>tbody>tr").length);
        
        $("#detCargos>tbody>tr").each(function(i){
            var detalles=new Array();
            
            var celdas=$(this).children("td").length;
            $(this).children("td").each(function(j){
                if(j<(celdas-1)){
                    detalles[j]=$(this).text();
                }
            });

            datos.push(detalles);
        });
        
        $.ajax({
            data:{
                action:"crearArchivo",
                valores:JSON.stringify(datos),
                referencia:referencias[$("#referencia option:selected").index()-1]["referencia"],
                nombre:$("#referencia option:selected").text()
            },
            method:"post",
            url:"./controlador/controlador.php",
            beforeSend:function(xhr, settings){
                $("#esperaModal").modal("show");
            },
            success:function(dato,estado,xhr){
                //console.log(dato);
                
                $("#esperaModal").modal("hide");
                
                var respuesta=JSON.parse(dato);
                
                if(Number(respuesta["status"])===1){
                    $("#tituloModal").text("Creación archivo terminado");
                        
                    var filas=$("#detCargos>tbody").children("tr").length;
                    $("#detCargos>tbody>tr").each(function(i){
                        if(i<filas){
                            $(this).remove();
                        }
                    });

                    $("#referencia").val($("#referencia").children("option:first").val());
                    $("#cliente").val($("#cliente").children("option:first").val());
                    $("#pago").val("");
                    $("#divisa").val($("#divisa").children("option:first").val());
                    $("#movimiento").val($("#movimiento").children("option:first").val());

                    $("#crearReporte").prop("disabled", true);
                }
                else{
                    $("#tituloModal").text("Error");
                }
                $("#mensaje").text(respuesta["mensaje"]);
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