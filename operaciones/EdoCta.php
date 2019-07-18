<?php
require_once '../vendor/autoload.php';
require_once 'arreglos.php';

date_default_timezone_set('America/Mexico_City');

class EdoCta {
    
    function generarEstadoCta($cliente, $pagos, $liquidar){
        $cliente= strtoupper($cliente);
        
        $mensualidad= json_decode($pagos, TRUE);
        
        $nombres=new arreglos();
        
        $fecha=new DateTime();
        $mes=$nombres->getMeses($fecha->format("m"));
        $anio=$fecha->format("Y");
        
        /***cuerpo edocta***/
        
        $mpdf = new \Mpdf\Mpdf(['mode'=>'es-MX', 'format' => 'Letter', 'margin_left'=>10, 'margin_right'=>10]);

        $cuerpo="<div id='titulo'>
               <span>Estado de cuenta al mes de <span class='mes'>".$mes."</span> de <span class='anio'>".$anio."</span></span>
               <br>
               <span id='cliente'>".$cliente."</span>
           </div>

           <br>

           <div class='total'>
               <div class='inversion'>
                   <div id='etiquetaInversion' class='etiquetaInversion'>Total del proyecto</div>
                   <div id='totalInversion' class='totalInversion'>$".number_format($mensualidad[1],2,".",",")."</div>
               </div>
           </div>

           <br>

           <div id='tabla'>
               <table id='detalleCta'>
                   <thead>
                       <tr>
                           <th>Mes de factura</th>
                           <th>Mensualidad</th>
                           <th>Efectivamente pagado</th>
                           <th>Saldo</th>
                           <th>Factura</th>
                           <th>Fecha de pago</th>
                       </tr>
                   </thead>
                   <tbody>";
     
        for($i=0;$i<count($mensualidad[0]);$i++){
            //$det=array();
            //$saldo-=(float)$mensualidad[$i][1];
            $cuerpo.="<tr><td>".$mensualidad[0][$i][0]."</td><td>$".number_format($mensualidad[0][$i][1],2,".",",")."</td><td>$".number_format($mensualidad[0][$i][2],2,".",",")."</td><td>$"
                    .number_format($mensualidad[0][$i][3],2,".",",")."</td><td>".$mensualidad[0][$i][4]."</td><td>".date("d-m-Y",strtotime($mensualidad[0][$i][5]))."</td></tr>";
        }
        
        $cuerpo.="<tr><td></td><td></td><td></td><td>"
                    .number_format((float)$mensualidad[0][count($mensualidad[0])-1][3],2,".",",")."</td><td></td><td>Por pagar</td></tr>";
        
        $cuerpo.="</tbody>
                        </table>
                    </div>

                    <br>

                    <div class='total'>
                        <div id='pagoTotal' class='inversion'>
                            <div id='etiquetaLiquidar' class='etiquetaInversion'>Monto total del proyecto para liquidar el día de hoy:</div>
                            <div id='totalLiquidar' class='totalInversion'>$ ".number_format($liquidar,2,".",",")."</div>
                        </div>
                    </div>

                    <br>

                    <div id='descripcion'>
                        <span class='observacion'>*Queda pendiente de pago la mensualidad del mes de <span class='mes'>".$mes."</span> de <span class='anio'>".$anio."</span>.</span>
                        <br>
                        <span class='observacion'>Dudas y/o comentarios al 99 96 88 25 13 Ext. 147</span>
                    </div>";
 
        $mpdf->setAutoTopMargin = 'stretch';

        $mpdf->SetHTMLHeader("<div class='cabecera'>
                            <div class='imagen' style='float:left; width:18%;'>   
                               <img class='logos' src='../img/eplogo.png'/>                      
                            </div>
                            <div id='direccionEcopulse' style='float:right; width:30%; text-align:center;'>   
                                    <span>Calle 56 #551 depto. 4 x 79 y 81</span>
                                    <br>
                                    <span>Col. Núcleo Dzodzil C.P. 97300</span>
                                    <br>
                                    <span>Mérida, Yucatán, México</span>
                                    <br>
                                    <span>T. +52 999 688 2513</span>
                                    <br>
                                    <span>www.ecopulse.mx</span>
                                    <br>
                                    <span>contaco@ecopulse.mx</span>
                                 </div>
                         </div>");

        $mpdf->SetHTMLFooter("<div class='pie'>

                                <div style='float:right; width:15%;'>   
                                   <img class='logos' src='../img/ECOPULSE-300.png'/>                       
                                </div>
                                <div style='float:right; width:60%; text-align:center;'>   
                                    <span>{PAGENO}/{nbpg}</span>                      
                                 </div>

                             </div>");

        $stylesheet = file_get_contents('../css/estiloEdoCta.css');
        
        $nombreArchivo=str_replace(" ", "-", $cliente).date("YmdHms");
        
        $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

        $mpdf->WriteHTML($cuerpo);
        
        $mpdf->Output('../estadosCta/'.$nombreArchivo.'.pdf','F');
        
        return 'estadosCta/'.$nombreArchivo.'.pdf';
        
        /***cuerpo edocta***/
    }
    
}
