<?php
    include_once 'nation.php';
    include_once 'league.php';
    include_once 'club.php';
    include_once 'player.php';
class Database{
    private $hostname="localhost";
    private $username="root";
    private $password = "";
    private $dbname;
    private $dblink;
    private $result;

    /**
     * Class constructor.
     */
    public function __construct($dbname){
        $this->dbname =$dbname;
        $this->connect();

    }

    function connect(){
        $this->dblink = new mysqli($this->hostname,$this->username, $this->password, 
        $this->dbname);

        if($this->dblink->connect_errno){
             // echo "<script>console.log('Konekcija je neuspesna".$mysqli->connect_error."');</script>";
            // printf("Konekcija je neuspesna: %s\n", $mysqli->connect_error);
            exit();
        }

        $this->dblink->set_charset("utf8");
        // echo "<script>console.log('Konekcija je uspesna');</script>";
    }
    
    function select($table, $column="*",$where=null, $order=null){
        if($table == "league"){
            $q = "SELECT ".$column." FROM ".$table." as l INNER JOIN nation as n ON l.nation_id=n.id" ;
            if($where!=null)
                 $q .=" WHERE ".$where;
            if($order!=null)
                $q .=" ORDER BY ".$order;
        }
        else if($table=="club"){
            $q = "SELECT ".$column." FROM ".$table." as c INNER JOIN league as l ON c.league_id=l.id INNER JOIN nation as n ON l.nation_id=n.id";
            if($where!=null)
                 $q .=" WHERE ".$where;
            if($order!=null)
                $q .=" ORDER BY ".$order;
        }
        else if($table=="player"){
            $q="SELECT ".$column." FROM ".$table." as p INNER JOIN nation as n ON p.nation_id=n.id INNER JOIN club as c ON p.club_id=c.id";
            if($where!=null)
                $q .=" WHERE ".$where;
            if($order!=null)
                $q .=" ORDER BY ".$order;
        }
        else if($table =="nation"){
            $q = "SELECT ".$column." FROM ".$table;
            if($where!=null)
                $q .=" WHERE ".$where;
            if($order!=null)
                $q .=" ORDER BY ".$order;
    
        }
        else{
            throw new Exception("NIje pravilo uneta tabela");
        }
        
        if($this->executeQuery($q))
            return true;
        else return false;
        
       
    }

    function insert($table, $values){
        if($table=="nation"){
            $row = "name";
            $nation = new Nation($values); 
            
            $this->select($table, "*", "name='".$nation->getName()."'");
            if($this->result->num_rows>0){
                throw new Exception("Objekat je vec unet");
            }
            $q = "INSERT INTO ".$table." (".$row.") VALUES ('".$nation->getName()."')";
        }
        else if($table=='league'){
            $name_league = $values[0];
            $this->select("nation", "*", "name='".$values[1]."'");
            if($this->result->num_rows==1){
                $row = mysqli_fetch_array($this->getResult());
                $id_nation = $row[0];
                $name_nation = $row[1];
                $nation = new Nation($name_nation);
            }
            else{
                throw new Exception("Greska ne postoji taj objekat u listi nacija ili ih ima dva");
            }
            $row= "name, nation_id";
            $league = new League($name_league, $nation);

            $this->select($table, "*", "l.name='".$league->getName()."'");
            if($this->result->num_rows>0){
               
            }

            $q = "INSERT INTO ".$table." (".$row.") VALUES ('".$name_league."','".$id_nation."');";
        }
        else if($table=="club"){
            
            $name = $values[0];
            $stadium = $values[1];
            $name_league = $values[2];
            $this->select("league", "*", "l.name='".$name_league."'");
            if($this->result->num_rows==1){
                $row = mysqli_fetch_array($this->getResult());
                $id_league = $row[0];
                $name_nation = $row[4];
                $league = new League($name_league, new Nation($name_nation));
            }
            else{
                throw new Exception("Greska ne postoji taj objekat u listi nacija ili ih ima dva");
            }
        
            $row="name, stadium, league_id";
            $club = new Club($name, $stadium, $league);

            $this->select($table, "*", "c.name='".$club->getName()."'");
            if($this->result->num_rows>0){
                
            }

            $q = "INSERT INTO ".$table." (".$row.") VALUES ('".$name."','".$stadium."','".$id_league."');";
            
        }
        else if($table=="player"){
            $firstname = $values[0];
            $lastname = $values[1];
            $age = $values[2];
            $position = $values[3];
            $goals = $values[4];
            $nation_name = $values[5];
            $club_name = $values[6];
            $this->select("nation", "*", "name='".$nation_name."'");
            if($this->result->num_rows==1){
                $row = mysqli_fetch_array($this->result);
                $nation_id = $row[0];
                $nation = new Nation($nation_name);
            }
            else{
                throw new Exception("Greska ne postoji taj objekat u listi nacija ili ih ima dva");
            }
            $this->select("club", "*", "c.name='".$club_name."'");
            if($this->result->num_rows==1){
                $row = mysqli_fetch_array($this->result);
                $club_id = $row[0];
                $club = new Club($club_name,"nebitno", new League("nebitno", new Nation("nebitno")));
            }
            else{
                throw new Exception("Greska ne postoji taj objekat u listi nacija ili ih ima dva");
            }
            $row = "firstname, lastname, age, position, goals,nation_id, club_id";
            $player = new Player($firstname, $lastname, $age, $position, $goals, $nation, $club);
            $this->select($table, "*", "p.firstname='".$firstname."' AND p.lastname='".$lastname."'");
            if($this->result->num_rows>0){
                
            }

            $q = "INSERT INTO ".$table." (".$row.") VALUES ('".$firstname."','".$lastname."','".$age."','".$position."','".$goals."','".$nation_id."','".$club_id."');";
            
        }
        else{
            throw new Exception("Lose uneta tabela");
        }

        if($this->ExecuteQuery($q)) return true;
        else return false;
    }

    function delete($table,$where){
        if($table=="nation" || $table=="league" || $table=="club" || $table=="player"){
            $q = "DELETE FROM ".$table." WHERE id='".$where."'";
        }
        else{
            throw new Exception("Lose uneta tabela");
        }

        if($this->ExecuteQuery($q)) return true;
        else return false;

    }

    function update($table, $values){
        if($table=='nation'){
            
            $nation = new Nation($values[1]); 

            $this->select($table, "*", "name='".$nation->getName()."'");
            if($this->result->num_rows>0){
                // echo "<script>console.log('Objekat je vec unet')<script>";
                throw new Exception("Objekat je vec unet");
            }

            $q = "UPDATE ".$table." SET name='".$nation->getName()."' WHERE id=".$values[0];
            
        }
        else if($table=='league'){
            $id = $values[0];
            $name = $values[1];
            $nation_name = $values[2];
            $this->select("nation", "*", "name='".$nation_name."'");
            if($this->result->num_rows==1){
                $row = mysqli_fetch_array($this->getResult());
                $nation_id = $row[0];
                $nation = new Nation($nation_name);
            }
            else{
                throw new Exception("Greska ne postoji taj objekat u listi nacija ili ih ima dva");
            }
            $row= "name, nation_id";
            $league = new League($name, $nation);
            
            $this->select($table, "*", "l.name='".$league->getName()."' AND l.nation_id='".$nation_id."'");
            if($this->result->num_rows>0){
                // echo "<script>console.log('Objekat je vec unet')<script>";
            }

            $q="UPDATE ".$table." SET name='".$name."', nation_id='".$nation_id."' WHERE id=".$id;
            
        }
        else if($table=="club"){
            $id=$values[0];
            $name = $values[1];
            $stadium = $values[2];
            $name_league = $values[3];

            $this->select("league", "*", "l.name='".$name_league."'");
            if($this->result->num_rows==1){
                $row = mysqli_fetch_array($this->getResult());
                $id_league = $row[0];
                $name_nation = $row[4];
                $league = new League($name_league, new Nation($name_nation));
            }
            else{
                throw new Exception("Greska ne postoji taj objekat u listi nacija ili ih ima dva");
            }
        
            
            $club = new Club($name, $stadium, $league);

            $this->select($table, "*", "c.name='".$club->getName()."' AND c.stadium='".$stadium."' AND c.league_id='".$id_league."'");
            if($this->result->num_rows>0){
                // echo "<script>console.log('Objekat je vec unet')<script>";
            }

            $q="UPDATE ".$table." SET name='".$name."', stadium='".$stadium."', league_id='".$id_league."' WHERE id=".$id;
            
        }
        else if($table='player'){
            $id = $values[0];
            $firstname = $values[1];
            $lastname = $values[2];
            $age = $values[3];
            $position = $values[4];
            $goals = $values[5];
            $nation_name = $values[6];
            $club_name = $values[7];
            $this->select("nation", "*", "name='".$nation_name."'");
            if($this->result->num_rows==1){
                $row = mysqli_fetch_array($this->result);
                $nation_id = $row[0];
                $nation = new Nation($nation_name);
            }
            else{
                throw new Exception("Greska ne postoji taj objekat u listi nacija ili ih ima dva");
            }
            $this->select("club", "*", "c.name='".$club_name."'");
            if($this->result->num_rows==1){
                $row = mysqli_fetch_array($this->result);
                $club_id = $row[0];
                $club = new Club($club_name,"nebitno", new League("nebitno", new Nation("nebitno")));
            }
            else{
                throw new Exception("Greska ne postoji taj objekat u listi nacija ili ih ima dva");
            }
            $row = "firstname, lastname, age, position, goals,nation_id, club_id";
            $player = new Player($firstname, $lastname, $age, $position, $goals, $nation, $club);
            $this->select($table, "*", "p.firstname='".$firstname."' AND p.lastname='".$lastname."' AND p.age='".$age."' AND p.position='".$position."' AND p.goals='".$goals."' AND p.nation_id='".$nation_id."' AND p.club_id='".$club_id."'");
            if($this->result->num_rows>0){
                // echo "<script>console.log('Objekat je vec unet')<script>";
            }
            $q= "UPDATE ".$table." SET firstname='".$firstname."', lastname='".$lastname."', age='".$age."', position='".$position."', goals='".$goals."', nation_id='".$nation_id."', club_id='".$club_id."' WHERE id=".$id;
            

        }
        else{
            throw new Exception("Lose uneta tabela");
        }

        if($this->ExecuteQuery($q)) return true;
        else return false;
    }


    function executeQuery($query){
        if($this->result = $this->dblink->query($query)){
            // echo "<script>console.log('izvrsen:".$query."');</script>";
            // echo "Izvrsen",$query;
            return true;
        }
        else{
            echo "NEizvrsen", $query;
            return false;
        }

    }

    function getResult(){
        return $this->result;
    }
    
    
}

?>