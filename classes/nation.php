<?php
     class Nation{
        private $name;
    
        /**
         * Class constructor.
         */
        public function __construct($name)
        {
            if($name=="") throw new Exception ("Nation - Name can not be empty"); 
            else $this->name = $name;
        }

        function setName($name){
            if($name=="") return false;
            
            $this->name = $name;
            return true;
        }

        function getName(){
            return $this->name;
        }
    
    }
?>