<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
	<title></title>
<body>	
	<div class="container">
		<h1 style="text-align:center;">Check-in App</h1>
	<form style="text-align:right">
        <input type="text" name='myInput' id='myInput' placeholder="Search for guests">
    </form>
    <br/>
    <center>
        <table class="table" border="2">
            <thead class="thead-dark">
            <tr>
                <th scope="col" onclick="sortTable('name')">Name</th>
                <th scope="col"  onclick="sortTable('surname')">Surname</th>
                <th scope="col">Check-in button</th>
            </tr>
            </thead>
        <tbody id="checkin">
        </tbody>
        </table>
	</center>
    <nav class="pagination"></nav>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        tableResults();
        pagination();
    });
    $('#myInput').keyup(function(){
        var search = $(this).val();
        if(search==''){
            tableResults();
            pagination();
        }
        else {
            $('#checkin').html('');
            tableResults(search);
            pagination(search);
        }
    });
    function tableResults(search, id){    
        $.ajax({
            url: "home.php",
            method: 'POST',
            data: {results: $('.results').val(), search: search, sort: id },
            success: function(data){
                $('#checkin').html(data);
            }
        });
    };
    function pagination(search){
        $.ajax({
            url: 'pagination.php',
            method: 'POST',
            data: {pagination: $('.page').val(), search: search},
            success: function(data){
                $('.pagination').html(data);
            }
        });
    }
    $('.pagination').on('click', '.page', function Pages(){
            var page= $(this).val();
        $.ajax({
            url: "home.php",
            method: 'GET',
            data: {'data': $('.data').val(), page: page},
            success: function(data){
                $('#checkin').html(data);
            } 
        });
    }); 
    $('body').on('change','.checkIn',function(){
        var check=$(this).is(':checked')?1:0;
        var id=$(this).attr('id');
        $.ajax({
            url: 'checked.php',
            method: 'POST',
            data: {'check': check, 'id': id },
            dataType: 'text',
        });
    });
    function sortTable(id){
        if(id=='name'){
          tableResults('',id);
        }
        else 
        if(id=='surname'){
          tableResults('',id);
        }
    }
</script>
</html>