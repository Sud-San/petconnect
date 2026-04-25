<?php
include("./db/db.php");

// If AJAX request
if(isset($_POST['ajax']) && $_POST['ajax'] == 1){
    $search = mysqli_real_escape_string($conn, $_POST['query']);

    $sql = "SELECT * FROM users 
            WHERE name LIKE '%$search%' 
            OR email LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "
            <tr>
                <td>".$row['user_id']."</td>
                <td>".$row['name']."</td>
                <td>".$row['email']."</td>
            </tr>
            ";
        }
    } else {
        echo "<tr><td colspan='3'>No Records Found</td></tr>";
    }
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Live Search</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
input{
    padding:10px;
    width:300px;
    margin-bottom:10px;
}
table, td, th{
    border:1px solid #333;
    border-collapse:collapse;
    padding:8px;
}
</style>

</head>
<body>

<h3>Search Students</h3>

    <input type="text" id="search" placeholder="Search by name or course">

<table>
<thead>
<tr>
   <th>ID</th>
   <th>Name</th>
   <th>Course</th>
</tr>
</thead>
<tbody id="tableData">
<!-- Data loaded from PHP -->
</tbody>
</table>

<script>
$(document).ready(function(){

    // Load initial data
    loadData("");

    function loadData(query){
        $.ajax({
            url:"",
            method:"POST",
            data:{ajax:1, query:query},
            success:function(data){
                $("#tableData").html(data);
            }
        });
    }

    $("#search").keyup(function(){
        var text = $(this).val();
        loadData(text);
    });
});
</script>

</body>
</html>
