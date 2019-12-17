<?php
    include_once "nation.php";
    class League{
        private $name;
        private $nation;
    
        /**
         * Class constructor.
         */
        public function __construct($name, $nation)
        {
            if($name=="") throw new Exception("League - Name cannot be empty");
            else $this->name = $name;
                
            //da li je atribut objekta Nation
            if($nation instanceof Nation)
                $this->nation= $nation;
            else
                throw new Exception("League - Object is not instance of Nation");
            
        }

        function setName($name){
            if($name=="") return false;
            
            $this->name = $name;
            return true;
        }

        function getName(){
            return $this->name;
        }
        
        function setNation($nation){
            if($nation instanceof Nation){
                $this->nation= $nation;
                return true;
            }
            else
                return false;
        }

        function getNation(){
            return $this->nation;
        }

    }

?>