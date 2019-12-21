<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link rel="shortcut icon" href="favicon.ico"/>
    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link rel="stylesheet"  type="text/css" href="css/club_style.css">


    <title>Footystats</title>
</head>
<body>
<?php
    include_once "classes/database.php";
    include_once "classes/nation.php";
    include_once "classes/league.php";
    include_once "classes/club.php";
    include_once "classes/player.php";
    
    
?>
 <nav class="navbar navbar-expand-lg navbar-light bg-custom" id='navbarMain'>
        <div class="container" id="navContainer">
        <img src="favicon.ico" alt="ball" id="ball">
            <a class="navbar-brand" href="player_page.php">FOOTYSTATS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Players<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="club_page.php" tabindex="-1" aria-disabled="true">Clubs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="league_page.php" >Leagues</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="nation_page.php" >Nations</a>
                </li>
                </ul>
            </div>
        </div>
</nav>
<div class="container" id="bodyContainer">
    
    <div class="row" id="red">
        <div class="col-md-8 col-lg-8 col-xl-8">
            <div id="tabela_club" class="d-flex justify-content-center">
                <table>
                    <tr>
                        <th>Club</th>
                        <th>Stadium</th>
                        <th>League</th>
                        <th>Nation</th>
                        <th></th>
                        <th></th>
                        <th class='th_hidden'></th>
                    </tr>
                    
                    <?php
                        $crud = new Database("baza2");
                        try {
                            $crud->select("club");
                        } catch (Exception $e) {
                            echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
                        }
                            while($row = mysqli_fetch_array($crud->getResult())){
                                echo "<tr>"; 
                                    echo "<td>", $row[1],"</td>";
                                    echo "<td>", $row[2],"</td>";
                                    echo "<td>", $row[5],"</td>";
                                    echo "<td>", $row[8],"</td>";
                                    echo "<td><button class='btn btn-info btn-sm' onclick=update(this)>Update</button></td>";
                                    echo "<td><button class='btn btn-danger btn-sm' onclick=del(this)>Del</button></td>";
                                    echo "<td class='td_hidden'>",$row[0],"</td"; 
                                echo "</tr>";
                            }
                            
                    ?>
                </table>
            </div>
            
            
        </div>
            
        <div class="col-md-4 col-lg-4 col-xl-4">
            <div class ='row'>
                <div id = 'club_insert_div'>
                    <h3>Add a new club:</h3>
                        <form method="post" id="club_insert"> 
                            <b>Club: </b><span class="hidden_error" id="error_club_insert"></span> <br>
                            <input type="text" name="name_insert" id='name_club_insert' placeholder='Type in a new club'>
                            <br>
                            <b>Stadium:</b> <br>
                            <input type="text" name="stadium_insert" id='stadium_club_insert' placeholder='Type in stadium name'>
                            
                            <br>
                            <?php
                                try {
                                    $crud->select("league");
                                } catch (Exception $e) {
                                    echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
                                }
                            ?>
                            <br><b>Select a league first:</b> <br>
                            <select name="select_leagues" id="id_select_leagues">
                                <?php
                                    $leagues_array = array();
                                    while($row = mysqli_fetch_array($crud->getResult())){
                                        array_push($leagues_array, $row[1]);
                                        echo "<option>",$row[1],"</option>";
                                    }
                                ?>
                            </select>
                            <input type="submit" name="nameinsert" value="Insert" >
                        </form>
                    
                </div>
            </div>
                    
                
                <div class ='row' >
                    <div id="club_update_div">
                        <h3>Update a club:</h3>
                            <form method="post" id="club_update"> 
                                <b>Club:</b><span class="hidden_error" id="error_club_update">sads</span><br>
                                <input type="text" name="name_update" id='name_club_update' placeholder='Type in a new club'>
                                <input type="hidden" name="id_update" id='id_club_update'>
                                <br>
                                <b>Stadium:</b> <br>
                                <input type="text" name="stadium_update" id='stadium_club_update' placeholder='Type in stadium name'>
                                
                                <br><b>Select a league first:</b> <br>
                                
                                <select name="update_leagues" id="id_update_leagues">
                                <?php
                                    foreach($leagues_array as &$league){
                                        echo "<option>",$league,"</option>";
                                        
                                    }
                                ?>
                            </select>
                            <input type="submit" name="stadiumupdate" value="Update">
                            </form>
                    </div>
                </div>    
            

        </div>
    </div>
</div>

<div class="container" id="containerFooter">
    <div class="row">
       <div class="d-flex justify-content-center"">
       <footer>
            ©MilanBrkić
        </footer>
       </div>
    </div>
</div>
    <script src='js/club_script.js'></script>
</body>
</html>