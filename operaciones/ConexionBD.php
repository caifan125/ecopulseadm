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
        
        function altaCliente($nombre, $rfc, $tc, $referencia){
            try{
                $this->dbh->beginTransaction();
                $stmt = $this->dbh->prepare("INSERT INTO tarjetas_clientes (NombreCte,RFCCte,numTg,referenciaId) VALUES (?, ?, ?, ?)");
                // Bind
                //$stmt->bindParam(1, NULL);
                $stmt->bindParam(1, $nombre);
                $stmt->bindParam(2, $rfc);
                $stmt->bindParam(3, $tc);
                $stmt->bindParam(4, $referencia);
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
        
        function leerClientes(){
            
            try{
                $stmt = $this->dbh->prepare("SELECT c.idClienteTg, c.NombreCte,c.RFCCte,c.numTg,r.nombreReferencia FROM referencias r join tarjetas_clientes c on r.idreferencia=c.referenciaId where c.status=1");
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->execute();
                $clientes = $stmt->fetchAll(PDO::FETCH_NUM);
            } catch (PDOException $e){
                $clientes=array("status"=>"0","mensaje"=>$e->getMessage());
            }
            
            return $clientes;
        }
        
        function actualizarCliente($idcliente, $nombre, $rfc, $tc){
            try{
                $this->dbh->beginTransaction();
                
                $stmt = $this->dbh->prepare("UPDATE tarjetas_clientes set NombreCte=?, RFCCte=?, numTg=?  where idClienteTg=?");
                // Especificamos el fetch mode antes de llamar a fetch()

                $stmt->bindParam(1, $nombre);
                $stmt->bindParam(2, $rfc);
                $stmt->bindParam(3, $tc);
                $stmt->bindParam(4, $idcliente);

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
        
    }
