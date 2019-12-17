<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link rel="shortcut icon" href="favicon.ico"/>
    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link rel="stylesheet"  type="text/css" href="css/player_style.css">


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
                    <a class="nav-link active" href="player_page.php" tabindex="-1" aria-disabled="true">Players<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="club_page.php" >Clubs</a>
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
            <div id="tabela_player" class="d-flex justify-content-center">
                <table>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Age</th>
                        <th>Position</th>
                        <th>Goals</th>
                        <th>Nation</th>
                        <th>Club</th>
                        <th></th>
                        <th></th>
                        <th class='th_hidden'></th>
                    </tr>
                    
                    <?php
                        $crud = new Database("baza2");
                        try {
                            // $values = array("21","Arthur", "Melo", "23", "midfielder", 4, "Brazil", "FC Barcelona");
                            
                            // $crud->update('player', $values);
                            $crud->select("player", "*", null, "position");
                        } catch (Exception $e) {
                            echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
                        }
                            while($row = mysqli_fetch_array($crud->getResult())){
                                echo "<tr>"; 
                                    echo "<td>", $row[1],"</td>";
                                    echo "<td>", $row[2],"</td>";
                                    echo "<td>", $row[3],"</td>";
                                    echo "<td>", $row[4],"</td>";
                                    echo "<td>", $row[5],"</td>";
                                    echo "<td>", $row[9],"</td>";
                                    echo "<td>", $row[11],"</td>";
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
                <div id = 'player_insert_div'>
                <?php
                                try {
                                    
                                    $crud->select("club");
                                } catch (Exception $e) {
                                    echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
                                }
                                $clubs_array = array();
                                while($row = mysqli_fetch_array($crud->getResult())){
                                     array_push($clubs_array, $row[1]);
                                }

                                try {
                                    $crud->select("nation");
                                } catch (Exception $e) {
                                    echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
                                }
                                $nations_array = array();
                                while($row = mysqli_fetch_array($crud->getResult())){
                                     array_push($nations_array, $row[1]);
                                }
                            ?>
                    <h3>Add a new player:</h3>
                        <form method="post" id="player_insert"> 
                            <div class="container firstlastname">
                                <div class="row">
                                    <div class="col-md-5 col-lg-5 col-xl-5">
                                        <b>Firstname:</b> 
                                    </div>
                                    <div class="col-md-7 col-lg-7 col-xl-7">
                                        <b>Lastname:</b> 
                                    </div>
                                </div>
                            </div>
                            
                            <input type="text" name="firstname_insert" id='firstname_player_insert' placeholder='Type in the firstname'>
                            
                            <input type="text" name="lastname_insert" id='lastname_player_insert' placeholder='Type in the lastname'>
                            
                            <div class="container firstlastname">
                                <div class="row">
                                    <div class="col-md-5 col-lg-5 col-xl-5">
                                        <b>Age:</b> 
                                    </div>
                                    <div class="col-md-7 col-lg-7 col-xl-7">
                                        <b>Goals:</b> 
                                    </div>
                                </div>
                            </div>
                            <input type="text" name="age_insert" id='age_player_insert' placeholder='Type in the age'>
                            
                            <input type="text" name="goals_insert" id='goals_player_insert' placeholder='Goals scored'>

                            <div class="container firstlastname">
                                <div class="row">
                                    <div class="col-md-5 col-lg-5 col-xl-5">
                                        <b>Select a position:</b> 
                                    </div>
                                    <div class="col-md-7 col-lg-7 col-xl-7">
                                        <b>Select a club:</b> 
                                    </div>
                                </div>
                            </div>

                            <div class="container firstlastname">
                                <div class="row">
                                    <div class="col-md-5 col-lg-5 col-xl-5">
                                        <select name="select_position" id="id_select_position">
                                            <option value="attacker">attacker</option>
                                            <option value="midfielder">midfielder</option>
                                            <option value="defender">defender</option>
                                            <option value="goalkeeper">goalkeeper</option>
                                        </select>   
                                    </div>
                                    <div class="col-md-7 col-lg-7 col-xl-7">
                                        <select name="select_clubs" id="id_select_clubs">
                                            <?php
                                                foreach($clubs_array as &$club){
                                                    echo "<option>",$club,"</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="container firstlastname">
                                <div class="row">
                                    <div class="col-md-5 col-lg-5 col-xl-5">
                                    <b>Select a nation:</b> <br>
                            <select name="select_nations" id="id_select_nations">
                                <?php
                                    foreach($nations_array as &$nation){
                                        echo "<option>",$nation,"</option>";
                                    }
                                ?>
                            </select>
                                    </div>
                                    <div class="col-md-7 col-lg-7 col-xl-7">
                                    <br>
                                    <input type="submit" name="playerinsert" value="Insert" id="clubBtnId" >
                                    </div>
                                </div>
                            </div>
                        </form>
                    
                    </div>
                </div>
            <div>
                    
                
                <div class ='row' >
                    <div id="player_update_div">
                        <h3>Update a player:</h3>
                            <form method="post" id="player_update"> 
                                <div class="container firstlastname">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <b>Firstname:</b> 
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6 clubs">
                                            <b>Lastname:</b> 
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id_update" id='id_player_update'>
                                <input type="text" name="firstname_update" id='firstname_player_update' placeholder='Type in the firstname'>
                                
                                <input type="text" name="lastname_update" id='lastname_player_update' placeholder='Type in the lastname'>
                                
                                <div class="container firstlastname">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <b>Age:</b> 
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6 clubs">
                                            <b>Goals:</b> 
                                        </div>
                                    </div>
                                </div>
                                <input type="text" name="age_update" id='age_player_update' placeholder='Type in the age'>
                                
                                <input type="text" name="goals_update" id='goals_player_update' placeholder='Goals scored'>

                                <div class="container firstlastname">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <b>Select a position:</b>
                                            
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6 clubs">
                                            <b>Select a club:</b>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="container firstlastname">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                        <select name="update_position" id="id_update_position">
                                                <option value="attacker">attacker</option>
                                                <option value="midfielder">midfielder</option>
                                                <option value="defender">defender</option>
                                                <option value="goalkeeper">goalkeeper</option>
                                            </select>   
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6 clubs">
                                        <select name="update_clubs" id="id_update_clubs">
                                                <?php
                                                    foreach($clubs_array as &$club){
                                                        echo "<option>",$club,"</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="container firstlastname">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <b>Select a nation:</b> <br>
                                    <select name="update_nations" id="id_update_nations">
                                        <?php
                                            foreach($nations_array as &$nation){
                                                echo "<option>",$nation,"</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6 clubs">
                                        <br>
                                        <input type="submit" name="clubupdate" value="Update" id="clubBtnIdUp" >
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
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
    <script src='js/player_scripts.js'></script>
</body>
</html>