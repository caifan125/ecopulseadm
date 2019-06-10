<?php
    date_default_timezone_set('America/Mexico_City');
    
    class GeneracionArchivo {
        
        function crearArchivo($pagos, $ref, $nombre){
            $suma=0.00;
            $datosCobro=json_decode($pagos,true);
            
            try{
                $seg=fopen('../seguimiento/seguimiento.txt','r');
                
                if ( !$seg ) {
                    throw new Exception('Error apertura de archivo de seguimiento');
                }
                
                $dato=  fread($seg, filesize('../seguimiento/seguimiento.txt'));
                
                if ( !$dato ) {
                    throw new Exception('Error de lectura de seguimiento');
                }
                
                fclose($seg);
                $datoSeg=  explode('.', $dato);

                if($datoSeg[0]==('1e'.date('ymd'))){
                    $fechaArch=$datoSeg[0];
                    $ext=$datoSeg[1]+1;
                }
                else{
                    $fechaArch=('1e'.date('ymd'));
                    $ext=1;
                }

                $fp = fopen('../recurrentes/'.$fechaArch.'.'.str_pad((string)$ext, 3, '0', STR_PAD_LEFT),'a');
                
                if ( !$fp ) {
                    throw new Exception('Error apertura/creación de archivo a cargar');
                }

                $encabezado='HWEBFT2.00ENT'.$ref.strtoupper($nombre).'  BANCOMER';
                $fecha=date('mdY');
                
                $escritura=fwrite($fp, $encabezado.$fecha.'                  .'.PHP_EOL);
                
                if ( !$escritura ) {
                    unlink('../recurrentes/'.$fechaArch.'.'.str_pad((string)$ext, 3, '0', STR_PAD_LEFT));
                    throw new Exception('Error de generación de archivo');
                }

                for($i=0;$i<count($datosCobro);$i++){
                    $suma+= floatval($datosCobro[$i][3]);
                    $imp=str_pad((string)($datosCobro[$i][3]*100), 12, '0', STR_PAD_LEFT);
                    $ref=strtoupper(str_pad($datosCobro[$i][1], 19, '0', STR_PAD_LEFT));

                    $cuenta=str_pad($datosCobro[$i][2], 16, chr(32), STR_PAD_RIGHT);

                    $cadenaDato='D'.$datosCobro[$i][5].$cuenta.$imp.$datosCobro[$i][4].$ref.'000         .';
                    $escritura=fwrite($fp, $cadenaDato.PHP_EOL);
                    
                    if ( !$escritura ) {
                        unlink('../recurrentes/'.$fechaArch.'.'.str_pad((string)$ext, 3, '0', STR_PAD_LEFT));
                        throw new Exception('Error de generación de archivo');
                    }
                }

                $numReg=str_pad((string)(count($datosCobro)), 6, '0', STR_PAD_LEFT);
                $totalTransac=str_pad((string)((round($suma,2))*100), 15, '0', STR_PAD_LEFT);

                $cadenaCierre='T'.$numReg.$totalTransac.'000000000000000000000000000000000000000000.';

                $escritura=fwrite($fp, $cadenaCierre.PHP_EOL);
                
                if ( !$escritura ) {
                    unlink('../recurrentes/'.$fechaArch.'.'.str_pad((string)$ext, 3, '0', STR_PAD_LEFT));
                    throw new Exception('Error de generación de archivo');
                }

                fclose($fp);

                $modSeg=fopen('../seguimiento/seguimiento.txt','w');
                
                if ( !$modSeg ) {
                    unlink('../recurrentes/'.$fechaArch.'.'.str_pad((string)$ext, 3, '0', STR_PAD_LEFT));
                    throw new Exception('Error apertura de archivo de seguimiento. No se generó el archivo');
                }
                
                $escritura=fwrite($modSeg, $fechaArch.'.'.(str_pad((string)$ext, 3, '0', STR_PAD_LEFT)));
                
                if ( !$escritura ) {
                    unlink('../recurrentes/'.$fechaArch.'.'.str_pad((string)$ext, 3, '0', STR_PAD_LEFT));
                    throw new Exception('Error de actualización de seguimiento. No se generó el archivo');
                }
                
                fclose($modSeg);
                
                $respuesta= '{"status":"1", "mensaje":"'.$fechaArch.'.'.str_pad((string)$ext, 3, '0', STR_PAD_LEFT).'"}';
            }catch(Exception $e){
                $respuesta= '{"status":"0", "mensaje":'.$e->getMessage().'}';
            }
            
            return $respuesta;
        }
        
    }
