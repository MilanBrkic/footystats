<?php
            include_once "../classes/database.php";
            $crud = new Database("baza2");

            if(isset($_POST['name_insert'])){
                 $values = trim($_POST['name_insert']);
                 try {
                    $crud->insert('nation',$values);
                } catch (Exception $e) {
                    
                    
                    // echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
                    
                }
                
            }
            
            if(isset($_POST['id_delete'])){
                $values = $_POST['id_delete'];
                
                try {
                   if(!($crud->delete('nation',$values))){
                       echo "console.log('Ne odigrava se delete')";
                   }
               } catch (Exception $e) {
                //    echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
                   
               }
           }
           if(isset($_POST['id_update']) && isset($_POST['name_update'])){
               $values = array($_POST['id_update'],trim($_POST['name_update'])); 
               try {
                  $crud->update('nation',$values);
               } catch (Exception $e) {
                    // echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
               }
           }

    ?>

<!-- <div id="tabela_nation" class="d-flex justify-content-end"> -->
<table>
     <tr>
<?php
        try {
            $sort = $_POST['sort'];
                if(strpos($sort, '▲')){
                $crud->select("nation","*", null, "name desc");
                echo "<th id='sort_nation' onclick=sort()>Nation ▲</th>";
            }
            else{
                $crud->select("nation","*", null, "name");
                echo "<th id='sort_nation' onclick=sort()>Nation ▼</th>";
            }
        } catch (Exception $e) {
            echo "<br> <b>EXCEPTION CAUGHT:</b> ",$e->getMessage();
        }
?>
        <th></th>   
        <th></th>   
        <th class='th_hidden'></th>
    </tr>
<?php    
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
<!-- </div> -->