<?php
    include_once "club.php";
    include_once "nation.php";
     class Player{
        private $firstname;
        private $lastname;
        private $age;
        private $position;
        private $goals;
        private $nation;
        private $club;


        /**
         * Class constructor.
         */
        public function __construct($firstname, $lastname, $age, $position, $goals,
        $nation, $club) 
        {
            $this->firstname= $firstname;
            $this->lastname= $lastname;
            if($age>15){
                $this->age= $age;
            }
            else throw new Exception('Player - Age must be greater than 15');
                
            if($goals>=0)
                $this->goals= $goals;
            else throw new Exception ("Player - Goals cannot be negative");
            
            //provera za pozicija
            if($position=="attacker" || $position=="goalkeeper" || 
            $position=="defender" || $position=="midfielder")
                $this->position= $position;
            else
                throw new Exception ("Player - Invalid position");

            //provera za nation
            if($nation instanceof Nation)
                $this->nation= $nation;
            else
                throw new Exception ("Player - Object is not an instance of Nation"); 

            //provera za club
            if($club instanceof Club)
                $this->club= $club;         
            else
                throw new Exception ("Player - Object is not an instance of Club"); ;

        }


        function setFirstname($firstname){
            $this->firstname= $firstname;
        }

        function getFirstname(){
            return $this->firstname;
        }


        function setLastname($lastname){

            $this->lastname= $lastname;
        }

        function getLastname(){
            return $this->lastname;
        }



        function setAge($age){
            if(age<16) return false;
            $this->age= $age;
            return true;
        }

        function getAge(){
            return $this->age;
        }



        function setPostion($position){
                if($position=="attacker" || $position=="goalkeeper" || 
            $position=="defender" || $position=="midfielder"){
                $this->position= $position;
                return true;
            }
            else
                return false;
        }

        function getPostion(){
            return $this->positon;
        }

        function setGoals($goals){
            if($goals<0) return false;
            
            $this->goals= $goals;
            return true;
            

        }

        function getGoals(){
            return $this->goals;
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

        
        function setClub($club){
            if($club instanceof Club){
                $this->club= $club;   
                return true;
            }      
            else
                return false;
        }

        function getClub(){
            return $this->club;
        }

        function toString(){
            return "<br>Name: ".$this->firstname."  ".$this->lastname." 
            Age: ".$this->age."  Postion: ".$this->position." Nation: ".$this->nation->getName()." Club: ".$this->club->getName();
            
        }
    }
?>