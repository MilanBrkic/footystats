<?php
            include_once "../classes/database.php";
            $crud = new Database("baza2");

            if(isset($_POST['league_insert']) && isset($_POST['nation_insert'])){
                 $values = array($_POST['league_insert'], $_POST['nation_insert']);
                 try {
                    $crud->insert('league',$values);
                } catch (Exception $e) {
                    echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
                    
                }
            }
            
            if(isset($_POST['id_delete'])){
                $values = $_POST['id_delete'];
                
                try {
                   if(!($crud->delete('league',$values))){
                       echo "console.log('Ne odigrava se delete')";
                   }
               } catch (Exception $e) {
                   echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
                   
               }
           }
           if(isset($_POST['id_update']) && isset($_POST['name_update']) && isset($_POST['nation_name_update'])){
               $values = array($_POST['id_update'],$_POST['name_update'], $_POST['nation_name_update']); 
               try {
                  $crud->update('league',$values);
               } catch (Exception $e) {
                    echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
               }
           }

    ?>

<!-- <div id="tabela_league" class="d-flex justify-content-center"> -->
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
 <!-- </div> -->