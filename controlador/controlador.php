<?php
    require '../operaciones/ConexionBD.php';
    require '../operaciones/GeneracionArchivo.php';
    require '../operaciones/EdoCta.php';
    
    date_default_timezone_set ("America/Mexico_City"); 
    
    if(isset($_POST)){
        
        if(isset($_POST['action']) && $_POST['action']=='referencias'){
            $conn=new ConexionBD();
            
            $respuesta=json_decode($conn->iniciarConexion(), TRUE);
            
            if(intval($respuesta["status"])==0){
                echo json_encode($respuesta);
            }
            else{
                $referencias=$conn->obtenerReferencias();
            
                echo json_encode($referencias);
            }
            
        }
        
        if(isset($_POST['action']) && $_POST['action']=='altaCte'){
            $conn=new ConexionBD();
            
            $respuesta=json_decode($conn->iniciarConexion(), TRUE);
            
            if(intval($respuesta["status"])==0){
                echo json_encode($respuesta);
            }
            else{
                $alta=$conn->altaCliente(strtoupper($_POST["nombre"]), strtoupper($_POST["rfc"]), strtoupper($_POST["direccion"]), strtoupper($_POST["ciudad"]), strtoupper($_POST["estado"]), $_POST["email"], $_POST["telefono"],$_POST["tarjeta"], $_POST["referencia"]);
            
                echo $alta;
            }
            
        }
        
        if(isset($_POST['action']) && $_POST['action']=='leerClientes'){
            $conn=new ConexionBD();
            
            $respuesta=json_decode($conn->iniciarConexion(), TRUE);
            
            if(intval($respuesta["status"])==0){
                echo json_encode($respuesta);
            }
            else{
                $clientes=$conn->leerClientes();

                echo json_encode($clientes);
            }
        }
        
        if(isset($_POST['action']) && $_POST['action']=='clientesCredito'){
            $conn=new ConexionBD();
            
            $respuesta=json_decode($conn->iniciarConexion(), TRUE);
            
            if(intval($respuesta["status"])==0){
                echo json_encode($respuesta);
            }
            else{
                $clientes=$conn->leerClientesCredito();

                echo json_encode($clientes);
            }
        }
        
        if(isset($_POST['action']) && $_POST['action']=='actualizarCliente'){
            $conn=new ConexionBD();
            
            $respuesta=json_decode($conn->iniciarConexion(), TRUE);
            
            if(intval($respuesta["status"])==0){
                echo json_encode($respuesta);
            }
            else{
                $clientes=$conn->actualizarCliente($_POST["id"],strtoupper($_POST["nombre"]),strtoupper($_POST["rfc"]), strtoupper($_POST["direccion"]), strtoupper($_POST["ciudad"]), strtoupper($_POST["estado"]), $_POST["email"], $_POST["telefono"],$_POST["tarjeta"]);
            
                echo $clientes;
            }
            
        }
        
        if(isset($_POST['action']) && $_POST['action']=='bajaCliente'){
            $conn=new ConexionBD();
            
            $respuesta=json_decode($conn->iniciarConexion(), TRUE);
            
            if(intval($respuesta["status"])==0){
                echo json_encode($respuesta);
            }
            else{
                $clientes=$conn->bajaCliente($_POST["id"]);
            
                echo $clientes;
            }
            
        }
        
        if(isset($_POST['action']) && $_POST['action']=='leerClientesRef'){
            $conn=new ConexionBD();
            $conn->iniciarConexion();
            
            $clientes=$conn->obtenerCtesRefrenciados($_POST["ref"]);
            
            echo json_encode($clientes);
        }
        
        if(isset($_POST['action']) && $_POST['action']=='crearArchivo'){
            $archivo=new GeneracionArchivo();
            
            $resultado=$archivo->crearArchivo($_POST['valores'],$_POST['referencia'],$_POST['nombre']);
            
            echo $resultado;
        }
        
        if(isset($_POST) && $_POST["action"]=="ultimoPago"){
            $conn=new ConexionBD();
            
            $respuesta=json_decode($conn->iniciarConexion(), TRUE);
            
            if(intval($respuesta["status"])==0){
                echo json_encode($respuesta);
            }
            else{
                $pagos=$conn->ultimoPago($_POST["cliente"]);
                
                if($pagos==FALSE){
                   $pagos["status"]="-1";//status=3 para indicar que es su primer pago
                   $pagos["mensaje"]="No hay datos disponibles, es el primer pago";
                }
                
                echo json_encode($pagos);
            }
            
        }
        
        if(isset($_POST) && $_POST["action"]=="altaPago"){
        
            $conn=new ConexionBD();
            
            $respuesta=json_decode($conn->iniciarConexion(), TRUE);
            
            if(intval($respuesta["status"])==0){
                echo json_encode($respuesta);
            }
            else{
                $altaPago=$conn->altaPago($_POST["mensualidad"],$_POST["numPago"],$_POST["descripcion"],$_POST["mesFactura"],
                        $_POST["pago"],$_POST["status"],$_POST["fechaDep"],$_POST["factura"],$_POST["credito"], $_POST["plazos"]);
                
                
                echo $altaPago;
            }
        }
        
        if(isset($_POST['action']) && $_POST['action']=='altaCredito'){
            $conn=new ConexionBD();
            
            $respuesta=json_decode($conn->iniciarConexion(), TRUE);
            
            if(intval($respuesta["status"])==0){
                echo json_encode($respuesta);
            }
            else{
                $alta=$conn->altaCredito($_POST["cliente"],$_POST["tipocontrato"],$_POST["monto"],$_POST["plazo"],
                        $_POST["mensualidad"],$_POST["interes"],$_POST["metodoPago"],$_POST["observaciones"]);
            
                echo $alta;
            }
            
        }
        
        if(isset($_POST) && $_POST["action"]=="pagosCte"){
            $datosEdoCta=array();
            $conn=new ConexionBD();
            
            $respuesta=json_decode($conn->iniciarConexion(), TRUE);
            
            if(intval($respuesta["status"])==0){
                echo json_encode($respuesta);
            }
            else{
                $pagos=$conn->creditoCliente($_POST["cliente"]);
                
                if(count($pagos)>0){
                    $saldo=(float) $pagos[0]["montoTotal"];

                    $mensualidad=(float) $pagos[0]["mensualidad"];

                    for($i=0;$i<count($pagos);$i++){
                        $det=array();
                        $saldo-=(float)$pagos[$i]["pago"];

                        array_push($det, $pagos[$i]["mesFactura"],$pagos[$i]["pago"],$pagos[$i]["efectivoPagado"],
                                $saldo,$pagos[$i]["factura"],$pagos[$i]["fechaDeposito"]);

                        array_push($datosEdoCta, $det);
                    }
                    
                    $datos=array($datosEdoCta, $pagos[0]["montoTotal"]);
                }
                else{
                    $datos=array("status"=>"0","mensaje"=>"No hay datos disponibles");
                }
                echo json_encode($datos);
            }
            
        }
        
        if(isset($_POST) && $_POST["action"]=="edoCta"){
        
            $edoCta=new EdoCta();

            $reporte=$edoCta->generarEstadoCta($_POST["cliente"], $_POST["mensualidades"], $_POST["aliquidar"]);

            echo $reporte;
        }
        
        if(isset($_POST) && $_POST["action"]=="filtroPagos"){
            $datos=array();
            $conn=new ConexionBD();
            
            $respuesta=json_decode($conn->iniciarConexion(), TRUE);
            
            if(intval($respuesta["status"])==0){
                echo json_encode($respuesta);
            }
            else{
                $pagos=$conn->filtroPagosCte($_POST["cliente"], $_POST["tipoFiltro"]);
                
                if(count($pagos)>0){

                    for($i=0;$i<count($pagos);$i++){
                        $det=array();

                        array_push($det, $pagos[$i]["idpago"],$pagos[$i]["mesFactura"],$pagos[$i]["mensualidad"],$pagos[$i]["efectivoPagado"],
                                $pagos[$i]["status"],$pagos[$i]["factura"],$pagos[$i]["fechaDeposito"]);

                        array_push($datos, $det);
                    }
                }
                else{
                    $datos=array("status"=>"0","mensaje"=>"No hay datos disponibles");
                }
                echo json_encode($datos);
            }
            
        }
        
        if(isset($_POST['action']) && $_POST['action']=='actualizarPagos'){
            $conn=new ConexionBD();
            
            $respuesta=json_decode($conn->iniciarConexion(), TRUE);
            
            if(intval($respuesta["status"])==0){
                echo json_encode($respuesta);
            }
            else{
                $pago=$conn->actualizarPago($_POST["idpago"],$_POST["pago"],$_POST["factura"],$_POST["status"],$_POST["fecha"]);
            
                echo $pago;
            }
            
        }
        
        if(isset($_POST['action']) && $_POST['action']=='leerCreditos'){//detalle de credito del cliente
            $conn=new ConexionBD();
            
            $respuesta=json_decode($conn->iniciarConexion(), TRUE);
            
            if(intval($respuesta["status"])==0){
                echo json_encode($respuesta);
            }
            else{
                $creditos=$conn->leerCreditos();

                echo json_encode($creditos);
            }
        }
        
        if(isset($_POST['action']) && $_POST['action']=='actualizarCredito'){
            $conn=new ConexionBD();
            
            $respuesta=json_decode($conn->iniciarConexion(), TRUE);
            
            if(intval($respuesta["status"])==0){
                echo json_encode($respuesta);
            }
            else{
                $credito=$conn->actualizarCredito($_POST["credito"],$_POST["tipocontrato"],$_POST["monto"], $_POST["plazo"], $_POST["mensualidad"], $_POST["interes"], $_POST["metodoPago"], $_POST["observaciones"]);
            
                echo $credito;
            }
            
        }
        
        if(isset($_POST['action']) && $_POST['action']=='bajaCredito'){
            $conn=new ConexionBD();
            
            $respuesta=json_decode($conn->iniciarConexion(), TRUE);
            
            if(intval($respuesta["status"])==0){
                echo json_encode($respuesta);
            }
            else{
                $clientes=$conn->bajaCredito($_POST["idcredito"]);
            
                echo $clientes;
            }
            
        }
        
    }