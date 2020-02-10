<?php 
include "connection.php";

if(isset($_POST['search'])){$search=$_POST['search'];}else $search=''; //returns results of search textbox
if(isset($_GET['page'])){$page=$_GET['page'];}else {$page=1;} //gets number of page that it is clicked
if(isset($_POST['sort'])){$sort=$_POST['sort'];}else $sort='id'; //posts name of column selected

$output='';
$results_per_page=2;
$limit=($page-1)*$results_per_page; //start for select on next page

$query=("Select * from guests where name LIKE '%".$search."%' or surname like '%".$search."%' order by $sort limit $limit, $results_per_page");
$res= mysqli_query($conn, $query);

if(mysqli_num_rows($res) > 0){ //controls if query has results

    while($row=mysqli_fetch_array($res)){ //returns rows of table
        //controls if checkin column is checked
        if($row["checkin"]==1){
            $checkin = 'checked ' ; 
            $color = 'style="background-color: red;"'; //changes the background color of row when it is checked
        }
        else {
            $checkin = '';
            $color = ''; 
        }        
        $output .='<tr class="results" '.$color.'>
           <td scope="row" class="name">' . $row["name"] . '</td>
           <td scope="row">' . $row["surname"] . '</td>
           <td scope="row" style="text-align:center;">
             <input type="checkbox" class="checkIn" name="check" id="'.$row["id"].'" '.$checkin.'/>
            </td>
        </tr>';
    } 
    echo $output; //displays table
} 
?>