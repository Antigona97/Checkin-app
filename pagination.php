<!DOCTYPE html>
<html>
<head></head>
<body>
<?php
include "connection.php";

if(isset($_POST['search'])){$search=$_POST['search'];}else $search=''; //returns results of search textbox
if(isset($_GET['page'])){$page=$_GET['page'];}else {$page=1;} //get number of page that it is clicked

$results_per_page=2;
$limit=($page-1)*$results_per_page;

$qry=("Select count(*) from guests where name LIKE '%".$search."%' or surname like '%".$search."%' limit $limit, $results_per_page");
$results=mysqli_query($conn, $qry);

$total_rows=mysqli_fetch_array($results)[0]; //returns number of rows of the table guests
$total_pages=ceil($total_rows/$results_per_page);//returns number of pages
//displays page number
if($total_rows>=$results_per_page){

  for($page=1; $page<=$total_pages; $page ++){ 
    
    echo '<input type="button" value='.$page.' class="page"/>';

  }
};
?>
</body>
</html>
