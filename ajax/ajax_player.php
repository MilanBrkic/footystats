<?php
            include_once "../classes/database.php";
            $crud = new Database("baza2");

            if(isset($_POST['firstname_insert']) && isset($_POST['lastname_insert']) && isset($_POST['age_insert'])  && isset($_POST['position_insert']) && isset($_POST['goals_insert']) && isset($_POST['nation_insert']) && isset($_POST['club_insert'])){
                 $values = array($_POST['firstname_insert'], $_POST['lastname_insert'], $_POST['age_insert'], $_POST['position_insert'], $_POST['goals_insert'], $_POST['nation_insert'], $_POST['club_insert']);
                
                try {
                    $crud->insert('player',$values);
                } catch (Exception $e) {
                    echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
                }
            }
            
            if(isset($_POST['id_delete'])){
                $values = $_POST['id_delete'];
                
                try {
                   if(!($crud->delete('player',$values))){
                       echo "console.log('Ne odigrava se delete')";
                   }
               } catch (Exception $e) {
                   echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
                   
               }
               
           }
           if(isset($_POST['id_update']) && isset($_POST['firstname_update']) && isset($_POST['lastname_update']) && isset($_POST['age_update'])  && isset($_POST['position_update']) && isset($_POST['goals_update']) && isset($_POST['nation_update']) && isset($_POST['club_update'])){
               $values = array($_POST['id_update'],$_POST['firstname_update'],$_POST['lastname_update'],$_POST['age_update'], $_POST['position_update'], $_POST['goals_update'], $_POST['nation_update'], $_POST['club_update']); 
            
               try {
                  $crud->update('player',$values);
               } catch (Exception $e) {
                    echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
               }
           }

    ?>

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