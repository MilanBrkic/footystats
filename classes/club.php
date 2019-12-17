<?php
    include_once "league.php";
    class Club{
        private $name;
        private $stadium;
        private $league;

        /**
         * Class constructor.
         */
        public function __construct($name, $stadium, $league)
        {
            if($name=="") throw new Exception ("Club - Name can not be empty");
            else $this->name = $name;

            $this->stadium = $stadium;
            
            //provera za ligu
            if($league instanceof League)
                $this->league = $league;
            else
                throw new Exception ("Club - Object is not an instance of League");
        }

        function setName($name){
            if($name=="") return false;
            
            $this->name = $name;
            return true;
        }

        function getName(){
            return $this->name;
        }


        function setStadium($stadium){
            $this->stadium = $stadium;
        }

        function getStadium(){
            return $this->stadium;
        }


        function setLeague($league){
            if($league instanceof League){
                $this->league = $league;    
                return true;
            }
            else
                return false;
        }

        function getLeague(){
            return $this->league;
        }
        
    }


?>