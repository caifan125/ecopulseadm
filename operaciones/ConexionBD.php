<?php
    class ConexionBD {
        
        private $dsn;
        private $dbh;
        private $dbname="ecopulse_admin";
        private $user="root";
        private $password="";
        
        function iniciarConexion() {
            try {
                $this->dsn = "mysql:host=localhost;dbname=$this->dbname";
                $this->dbh = new PDO($this->dsn, $this->user, $this->password);
                $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $resultado='{"status":"1","mensaje":"conexion"}';
            } catch (PDOException $e){
                $resultado='{"status":"0","mensaje":"'.$e->getMessage().'"}';
            }
            
            return $resultado;
        }
        
        function obtenerReferencias(){
            try{
                $stmt = $this->dbh->prepare("SELECT * FROM referencias where status=1");
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->execute();
                $referencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e){
                $referencias=array("status"=>"0","mensaje"=>$e->getMessage());
            }
            
            return $referencias;
        }
        
        function altaCliente($nombre, $rfc, $dir, $cd, $edo, $email, $tel, $tc, $referencia){
            try{
                $this->dbh->beginTransaction();
                $stmt = $this->dbh->prepare("INSERT INTO tarjetas_clientes (NombreCte, RFCCte, direccion, ciudad, estado, email, telefono, numTg,referenciaId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                // Bind
                //$stmt->bindParam(1, NULL);
                $stmt->bindParam(1, $nombre);
                $stmt->bindParam(2, $rfc);
                $stmt->bindParam(3, $dir);
                $stmt->bindParam(4, $cd);
                $stmt->bindParam(5, $edo);
                $stmt->bindParam(6, $email);
                $stmt->bindParam(7, $tel);
                $stmt->bindParam(8, $tc);
                $stmt->bindParam(9, $referencia);
                // Excecute
                $stmt->execute();
                
                $this->dbh->commit();
                
                $resultado='{"status":"1", "mensaje":"Registro exitoso"}';
            } catch (PDOException $e){
                $this->dbh->rollback();
                
                $resultado='{"status":"0", "mensaje":"'.$e->getMessage().'"}';
            }
            
            return $resultado;
        }
        
        function leerClientes(){//clientes que pagan de manera recurrente con TC
            
            try{
                $stmt = $this->dbh->prepare("SELECT c.idClienteTg, c.NombreCte,c.RFCCte, c.direccion, c.ciudad,c.estado, c.email, c.telefono, c.numTg,r.nombreReferencia FROM referencias r join tarjetas_clientes c on r.idreferencia=c.referenciaId where c.status=1");
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->execute();
                $clientes = $stmt->fetchAll(PDO::FETCH_NUM);
            } catch (PDOException $e){
                $clientes=array("status"=>"0","mensaje"=>$e->getMessage());
            }
            
            return $clientes;
        }
        
        function altaCredito($cte, $cont, $monto, $plazo, $mens, $interes, $metodo, $obs){
            try{
                $this->dbh->beginTransaction();
                $stmt = $this->dbh->prepare("INSERT INTO credito (tipoContrato, montoTotal, plazo, mensualidad, interes, metodoPago, observaciones, cteId) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                // Bind
                //$stmt->bindParam(1, NULL);
                $stmt->bindParam(1, $cont);//tipo contrato
                $stmt->bindParam(2, $monto);
                $stmt->bindParam(3, $plazo);
                $stmt->bindParam(4, $mens);
                $stmt->bindParam(5, $interes);
                $stmt->bindParam(6, $metodo);//metodo pago
                $stmt->bindParam(7, $obs);//observaciones
                $stmt->bindParam(8, $cte);
                // Excecute
                $stmt->execute();
                
                $this->dbh->commit();
                
                $resultado='{"status":"1", "mensaje":"Registro exitoso"}';
            } catch (PDOException $e){
                $this->dbh->rollback();
                
                $resultado='{"status":"0", "mensaje":"'.$e->getMessage().'"}';
            }
            
            return $resultado;
        }
        
        function leerClientesCredito(){//clientes que tiene algun tipo de crédito
            
            try{
                $stmt = $this->dbh->prepare("SELECT t.idClienteTg, t.NombreCte, c.idcredito, c.mensualidad, c.plazo FROM tarjetas_clientes t join credito c on"
                        . " t.idClienteTg=c.cteId where t.status=1 and c.status!=3");
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->execute();
                $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e){
                $clientes=array("status"=>"0","mensaje"=>$e->getMessage());
            }
            
            return $clientes;
        }
        
        function actualizarCliente($idcliente, $nombre, $rfc, $dir, $cd, $edo, $email, $tel, $tc){
            try{
                $this->dbh->beginTransaction();
                
                $stmt = $this->dbh->prepare("UPDATE tarjetas_clientes set NombreCte=?, RFCCte=?, direccion=?, ciudad=?, estado=?, email=?, telefono=?, numTg=?  where idClienteTg=?");
                // Especificamos el fetch mode antes de llamar a fetch()

                $stmt->bindParam(1, $nombre);
                $stmt->bindParam(2, $rfc);
                $stmt->bindParam(3, $dir);
                $stmt->bindParam(4, $cd);
                $stmt->bindParam(5, $edo);
                $stmt->bindParam(6, $email);
                $stmt->bindParam(7, $tel);
                $stmt->bindParam(8, $tc);
                $stmt->bindParam(9, $idcliente);

                $stmt->execute();
                
                $this->dbh->commit();
                
                $clientes='{"status":"1", "mensaje":"Registro actualizado"}';
            }catch (PDOException $e){
                $this->dbh->rollback();
                
                $clientes='{"status":"0", "mensaje":"'.$e->getMessage().'"}';
            }
            
            return $clientes;
        }
        
        function bajaCliente($idcliente){
            try{
                $this->dbh->beginTransaction();
                
                $stmt = $this->dbh->prepare("UPDATE tarjetas_clientes set status=0 where idClienteTg=?");
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->bindParam(1, $idcliente);

                $stmt->execute();
                $this->dbh->commit();
                
                $clientes='{"status":"1", "mensaje":"Registro eliminado"}';
            }catch (PDOException $e){
                $this->dbh->rollback();
                
                $clientes='{"status":"0", "mensaje":"'.$e->getMessage().'"}';
            }
            
            return $clientes;
        }
        
        function obtenerCtesRefrenciados($ref){
            try{
                $stmt = $this->dbh->prepare("SELECT idClienteTg, NombreCte,RFCCte,numTg FROM tarjetas_clientes where status=1 and referenciaId=".$ref);
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->execute();
                $referencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e){
                $referencias=array("status"=>"0","mensaje"=>$e->getMessage());
            }
            
            return $referencias;
        }
        
        function ultimoPago($cliente){
            try{
                $stmt = $this->dbh->prepare("SELECT c.tipoContrato,c.montoTotal,"
                        . "c.observaciones,m.numPago,m.descripPago,m.mesFactura,"
                        . "m.mensualidad as pago,m.efectivoPagado,m.status,m.fechaDeposito,m.factura from credito as c join mensualidad as m "
                        . "on c.idcredito=creditoId where c.cteId=".$cliente." order by m.numPago desc limit 1");
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->execute();
                $referencias = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e){
                $referencias=array("status"=>"0","mensaje"=>$e->getMessage());
            }
            
            return $referencias;
        }
        
        function altaPago($mensualidad,$numpago,$descrip,$mesfac,$pago,$status,$fechadep,$factura,$credito, $plazo){
            try{
                $stmtupdate=TRUE;
                
                $this->dbh->beginTransaction();
                
                $fechaDep=new DateTime($fechadep);
                $fecha=$fechaDep->format("Y-m-d");
                
                $stmt = $this->dbh->prepare("INSERT INTO mensualidad (numPago,descripPago,mesFactura,mensualidad,efectivoPagado,"
                        . "status,fechaDeposito,factura,creditoId) VALUES (?,?,?,?,?,?,?,?,?)");
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->bindParam(1, $numpago);
                $stmt->bindParam(2, $descrip);
                $stmt->bindParam(3, $mesfac);
                $stmt->bindParam(4, $mensualidad);
                $stmt->bindParam(5, $pago);
                $stmt->bindParam(6, $status);
                $stmt->bindParam(7, $fecha);
                $stmt->bindParam(8, $factura);
                $stmt->bindParam(9, $credito);

                $stmt->execute();
                
                if(((int)$numpago)==((int)$plazo)){
                    $stmtupdate = $this->dbh->prepare("UPDATE credito set status=3 where idcredito=".$credito);

                    //$stmtupdate->bindParam(1, "3");

                    $stmtupdate->execute();
                }
                
                if($stmt!=FALSE && $stmtupdate!=FALSE){
                    $this->dbh->commit();
                    $clientes='{"status":"1", "mensaje":"Registro exitoso"}';
                }
                else{
                    $clientes='{"status":"0", "mensaje":"Error en le proceso de registro"}';
                }
                
            }catch (PDOException $e){
                $this->dbh->rollback();
                
                $clientes='{"status":"0", "mensaje":"'.$e->getMessage().'"}';
            }
            
            return $clientes;
        }
        
        function creditoCliente($cliente){
            try{
                $stmt = $this->dbh->prepare("SELECT c.tipoContrato,c.montoTotal,c.plazo,"
                        . "c.mensualidad,c.observaciones,m.numPago,m.descripPago,m.mesFactura,"
                        . "m.mensualidad as pago,m.efectivoPagado,m.status,m.fechaDeposito,m.factura from credito as c join mensualidad as m "
                        . "on c.idcredito=creditoId where c.cteId=".$cliente." order by m.numPago");
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->execute();
                $referencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e){
                $referencias=array("status"=>"0","mensaje"=>$e->getMessage());
            }
            
            return $referencias;
        }
        
        function filtroPagosCte($cliente, $filtro){
            $comando="SELECT m.idpago,m.numPago,m.mensualidad,m.descripPago,m.mesFactura,"
                        . "m.efectivoPagado,m.status,m.fechaDeposito,m.factura from credito as c join mensualidad as m "
                        . "on c.idcredito=m.creditoId where c.cteId=".$cliente;
            
            if($filtro==1){
                $comando.=" and m.status=3 order by m.numPago";
            }
            else{
                $comando.=" and m.status!=3 order by m.numPago";
            }
            
            try{
                $stmt = $this->dbh->prepare($comando);
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->execute();
                $referencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e){
                $referencias=array("status"=>"0","mensaje"=>$e->getMessage());
            }
            
            return $referencias;
        }
        
        function actualizarPago($idpago, $pago, $factura, $estatus, $fecha){
            try{
                $this->dbh->beginTransaction();
                
                $fechaDep=new DateTime($fecha);
                $fechaPago=$fechaDep->format("Y-m-d");
                
                $stmt = $this->dbh->prepare("UPDATE mensualidad set efectivoPagado=?,status=?,fechaDeposito=?,factura=? "
                        . "where idpago=".$idpago);

                $stmt->bindParam(1, $pago);
                $stmt->bindParam(2, $estatus);
                $stmt->bindParam(3, $fechaPago);
                $stmt->bindParam(4, $factura);

                $stmt->execute();
                
                $this->dbh->commit();
                
                $clientes='{"status":"1", "mensaje":"Registro actualizado"}';
            }catch (PDOException $e){
                $this->dbh->rollback();
                
                $clientes='{"status":"0", "mensaje":"'.$e->getMessage().'"}';
            }
            
            return $clientes;
        }
        
        function leerCreditos(){//clientes que pagan de manera recurrente con TC
            
            try{
                $stmt = $this->dbh->prepare("SELECT c.idcredito, t.NombreCte,c.tipoContrato, c.montoTotal, c.plazo,c.mensualidad, c.interes,"
                        . " c.metodoPago, c.observaciones, c.status FROM tarjetas_clientes t join credito c on t.idClienteTg=c.cteId where c.status=1 or c.status=3");
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->execute();
                $clientes = $stmt->fetchAll(PDO::FETCH_NUM);
            } catch (PDOException $e){
                $clientes=array("status"=>"0","mensaje"=>$e->getMessage());
            }
            
            return $clientes;
        }
        
        function actualizarCredito($idcredito, $tipoCont, $monto, $plazo, $mensualidad, $interes, $metodoPago, $observaciones){
            try{
                $this->dbh->beginTransaction();
                
                $stmt = $this->dbh->prepare("UPDATE credito set tipoContrato=?, montoTotal=?, plazo=?, mensualidad=?, interes=?, metodoPago=?, observaciones=? where idcredito=?");
                // Especificamos el fetch mode antes de llamar a fetch()

                $stmt->bindParam(1, $tipoCont);
                $stmt->bindParam(2, $monto);
                $stmt->bindParam(3, $plazo);
                $stmt->bindParam(4, $mensualidad);
                $stmt->bindParam(5, $interes);
                $stmt->bindParam(6, $metodoPago);
                $stmt->bindParam(7, $observaciones);
                $stmt->bindParam(8, $idcredito);

                $stmt->execute();
                
                $this->dbh->commit();
                
                $clientes='{"status":"1", "mensaje":"Registro actualizado"}';
            }catch (PDOException $e){
                $this->dbh->rollback();
                
                $clientes='{"status":"0", "mensaje":"'.$e->getMessage().'"}';
            }
            
            return $clientes;
        }
        
        function bajaCredito($idcredito){
            try{
                $this->dbh->beginTransaction();
                
                $stmt = $this->dbh->prepare("UPDATE credito set status=0 where idcredito=?");
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->bindParam(1, $idcredito);

                $stmt->execute();
                $this->dbh->commit();
                
                $clientes='{"status":"1", "mensaje":"Registro eliminado"}';
            }catch (PDOException $e){
                $this->dbh->rollback();
                
                $clientes='{"status":"0", "mensaje":"'.$e->getMessage().'"}';
            }
            
            return $clientes;
        }
        
    }
