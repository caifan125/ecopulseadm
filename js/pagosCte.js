$(function(){
    var clientes;
    var mensualidad;
    var credito;
    var plazos;
    
    $(document).ready(function(){
        
       listaClientes();
        
    });
    
    function listaClientes(){
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
    }
    
    $("#edoCte").submit(function(e){
        e.preventDefault();
        $("#altaPago input[type=text]").val("");
        ultimoPagoCliente();
        
    });
    
    function ultimoPagoCliente(){
        $.ajax({
            data:{
                action:"ultimoPago",
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
                var numPago=1;
                
                var pago=JSON.parse(dato);
                
                if(pago["status"]==="0"){
                    $("#tituloModal").text("Error");
                    $("#mensaje").text(pago["mensaje"]);
                    $("#numPago").val("");
                }
                else if(pago["status"]==="-1"){
                    /*mensualidad=clientes[parseInt($("#cliente option:selected").attr("id"))]["idcredito"];
                    credito=clientes[parseInt($("#cliente option:selected").attr("id"))]["idcredito"];
                    plazos=clientes[parseInt($("#cliente option:selected").attr("id"))]["plazo"];*/
                    
                    $("#tituloModal").text("Primer pago");
                    $("#mensaje").text(pago["mensaje"]);
                }
                else{
                    numPago=parseInt(pago["numPago"])+1;
                    
                    /*mensualidad=pago["mensualidad"];
                    credito=pago["idcredito"];
                    plazos=pago["plazo"];*/
                    $("#tituloModal").text("Carga terminada");
                    $("#mensaje").text("Proceso terminado con éxito");
                }
                mensualidad=clientes[parseInt($("#cliente option:selected").attr("id"))]["idcredito"];
                credito=clientes[parseInt($("#cliente option:selected").attr("id"))]["idcredito"];
                plazos=clientes[parseInt($("#cliente option:selected").attr("id"))]["plazo"];
                
                $("#numPago").val(numPago);
                
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
    
    $("#altaPago").submit(function(e){
        e.preventDefault();
        
        $.ajax({
            data:{
                action:"altaPago",
                mensualidad:mensualidad,
                numPago:$("#numPago").val(),
                descripcion:$("#descripcion").val(),
                mesFactura:$("#mesFactura").val(),
                pago:$("#pago").val(),
                status:$("#status").val(),
                fechaDep:$("#fechaDep").val(),
                factura:$("#factura").val(),
                credito:credito,
                plazos: plazos
            },
            method:"post",
            url:"./controlador/controlador.php",
            beforeSend:function(xhr, settings){
                $("#esperaModal").modal("show");
            },
            success:function(dato,estado,xhr){
                $("#esperaModal").modal("hide");
                console.log(dato);
                
                var resultado=JSON.parse(dato);
                
                if(Number(resultado["status"])===1){
                    //console.log("guardado");
                    
                    $("#altaPago input[type=text]").val("");
                    $("#status").val($("#status").children("option:first").val());
                    
                    if(parseInt($("#numPago").val())<parseInt(plazos)){
                        ultimoPagoCliente();
                    }
                    else{
                        listaClientes();
                    }
                    
                }
                else{
                    $("#tituloModal").text("Error");
                    $("#mensaje").text(resultado["mensaje"]);
                    $("#errorModal").modal("show");
                }
                
                
                
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