<?php
            include_once "../classes/database.php";
            $crud = new Database("baza2");

            if(isset($_POST['club_insert']) && isset($_POST['stadium_insert']) && isset($_POST['league_insert'])){
                 $values = array($_POST['club_insert'], $_POST['stadium_insert'], $_POST['league_insert']);
                
                try {
                    $crud->insert('club',$values);
                } catch (Exception $e) {
                    echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
                }
            }
            
            if(isset($_POST['id_delete'])){
                $values = $_POST['id_delete'];
                
                try {
                   if(!($crud->delete('club',$values))){
                       echo "console.log('Ne odigrava se delete')";
                   }
               } catch (Exception $e) {
                   echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
                   
               }
               
           }
           if(isset($_POST['id_update']) && isset($_POST['name_update']) && isset($_POST['stadium_update']) && isset($_POST['league_update'])){
               $values = array($_POST['id_update'],$_POST['name_update'],$_POST['stadium_update'], $_POST['league_update']); 
               
               try {
                  $crud->update('club',$values);
               } catch (Exception $e) {
                    echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
               }
           }

    ?>


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
            