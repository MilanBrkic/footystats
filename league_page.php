<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link rel="shortcut icon" href="favicon.ico"/>
    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link rel="stylesheet"  type="text/css" href="css/league_style.css">


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
                    <a class="nav-link" href="club_page.php">Clubs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="league_page.php" tabindex="-1" aria-disabled="true">Leagues</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="nation_page.php" >Nations</a>
                </li>
                </ul>
            </div>
        </div>
</nav>
<div class="container" id="bodyContainer">
    <div class="row" id='navbarrow'>
        <div class = "col-md-12 col-lg-12 col-xl-12">
           
        </div>
    </div>
    <div class="row" id="red">
        <div class="col-md-7 col-lg-7 col-xl-7">
            <div id="tabela_league" class="d-flex justify-content-end">
                <table>
                    <tr>
                        <th>League</th>
                        <th>Nation</th>
                        <th></th>
                        <th></th>
                        <th class='th_hidden'></th>
                    </tr>
                    
                    <?php
                        $crud = new Database("baza2");
                        try {
                            $crud->select("league");
                            
                        } catch (Exception $e) {
                            echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
                        }
                            while($row = mysqli_fetch_array($crud->getResult())){
                                echo "<tr>"; 
                                    echo "<td>", $row[1],"</td>";
                                    echo "<td>", $row[4],"</td>";
                                    echo "<td><button class='btn btn-info btn-sm' onclick=update(this)>Update</button></td>";
                                    echo "<td><button class='btn btn-danger btn-sm' onclick=del(this)>Del</button></td>";
                                    echo "<td class='td_hidden'>",$row[0],"</td"; 
                                echo "</tr>";
                            }
                            
                    ?>
                </table>
            </div>
            
            
        </div>
            
        <div class="col-md-5 col-lg-5 col-xl-5">
            <div class ='row'>
                <div id = 'league_insert_div'>
                    <h3>Add a new league:</h3>
                        <form method="post" id="league_insert"> 
                            <b>League: </b><span class="hidden_error" id="error_league_insert"></span> <br>
                            <input type="text" name="name_insert" id='name_league_insert' placeholder='Type in a new league'>
                            <input type="submit" name="nameinsert" value="Insert" >
                            <br><b>Select a nation first:</b>
                            <?php
                                try {
                                    $crud->select("nation","*", null, "name");
                                } catch (Exception $e) {
                                    echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
                                }
                            ?>
                            <br>
                            <select name="select_nations" id="id_select_nations">
                                <?php
                                    $nations_array = array();
                                    while($row = mysqli_fetch_array($crud->getResult())){
                                        array_push($nations_array, $row[1]);
                                        echo "<option>",$row[1],"</option>";
                                    }
                                ?>
                            </select>
                        </form>
                    
                </div>
            </div>
                    
                
                <div class ='row' >
                    <div id="league_update_div">
                        <h3>Update a league:</h3>
                            <form method="post" id="league_update"> 
                                <b>League: </b><span class="hidden_error" id="error_league_update">sads</span><br>
                                <input type="text" name="name_update" id='name_league_update' placeholder='Choose a league'>
                                <input type="hidden" name="id_update" id='id_league_update'>
                                <input type="submit" name="nameupdate" value="Update"  >
                                <br><b>Select a nation first:</b> <br>
                                
                                <select name="update_nations" id="id_update_nations">
                                <?php
                                    foreach($nations_array as &$nation){
                                        echo "<option>",$nation,"</option>";
                                    }
                                ?>
                            </select>
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
    <script src='js/league_script.js'></script>
</body>
</html>