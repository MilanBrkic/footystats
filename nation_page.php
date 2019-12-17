<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link rel="shortcut icon" href="favicon.ico"/>
    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link rel="stylesheet"  type="text/css" href="css/nation_style.css">


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
                    <a class="nav-link" href="league_page.php">Leagues</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="nation_page.php" tabindex="-1" aria-disabled="true">Nations</a>
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
        <div class="col-md-6 col-lg-6 col-xl-6">
            <div id="tabela_nation" class="d-flex justify-content-end">
                <table>
                    <tr>
                        <th id="sort_nation" onclick=sort()>Nation ▼</th>
                        <th></th>
                        <th></th>
                        <th class='th_hidden'></th>
                    </tr>
                    
                    <?php
                        $crud = new Database("baza2");
                        try {
                            $crud->select("nation","*", null, "name");
                            
                        } catch (Exception $e) {
                            echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
                        }
                            while($row = mysqli_fetch_array($crud->getResult())){
                                echo "<tr>"; 
                                    echo "<td>", $row[1],"</td>";
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
                <div id = 'nation_insert_div'>
                    <h3>Add a new nation:</h3>
                        <form method="post" id="nation_insert"> 
                            <b>Nation: </b> <span class="hidden_error" id="error_nation_insert"></span> <br>
                            <input type="text" name="name_insert" id='name_nation_insert' placeholder='Type in a new nation'>
                            <input type="submit" name="nameinsert" value="Insert" >
                        </form>
                    
                </div>
            </div>
                    
                
                <div class ='row' >
                    <div id="nation_update_div">
                        <h3>Update a nation:</h3>
                            <form method="post" id="nation_update"> 
                                <b>Nation: </b><span class="hidden_error" id="error_nation_update">sads</span> <br>
                                <input type="text" name="name_update" id='name_nation_update' placeholder='Choose a nation'>
                                <input type="hidden" name="id_update" id='id_nation_update'>
                                <input type="submit" name="nameupdate" value="Update"  >
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
            ©MilanBrkic
        </footer>
       </div>
    </div>
</div>
    <script src='js/nation_script.js'></script>
    
</body>
</html>