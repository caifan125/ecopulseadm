<?php
    require '../operaciones/ConexionBD.php';
    require '../operaciones/GeneracionArchivo.php';
    
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
                $alta=$conn->altaCliente(strtoupper($_POST["nombre"]), strtoupper($_POST["rfc"]), $_POST["tarjeta"], $_POST["referencia"]);
            
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
        
        if(isset($_POST['action']) && $_POST['action']=='actualizarCliente'){
            $conn=new ConexionBD();
            
            $respuesta=json_decode($conn->iniciarConexion(), TRUE);
            
            if(intval($respuesta["status"])==0){
                echo json_encode($respuesta);
            }
            else{
                $clientes=$conn->actualizarCliente($_POST["id"],strtoupper($_POST["nombre"]),strtoupper($_POST["rfc"]),$_POST["tarjeta"]);
            
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
    }