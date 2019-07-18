<?php

    class arreglos {
        private $listado;
        private $meses;
        
        function getArreglos(){
            $this->listado=array("a","b","c","d","e","f","g","h","i","j","k","l",
                "m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B",
                "C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R",
                "S","T","U","V","W","X","Y","Z","<",">","!","$","%","&","/","(",
                ")","?","¨","|","@","#","\\","`","+","^","*","·","]","~","-",";",
                ":","_","=","'",","," ");
        
            return $this->listado;
        }
        
        function getMeses($numMes){
            $this->meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio",
                "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            
            return $this->meses[($numMes-1)];
        }
        
    }
