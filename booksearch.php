<?php
    $conn=mysqli_connect('localhost','root','','lbmns');
    if(isset($_GET['searchtext'])){
        $searchtext=$_GET['searchtext'];
        $q="select * from books where authname like '%$searchtext%' or title like '%$searchtext%' or pubname like '%$searchtext%'";
        $result=mysqli_query($conn,$q);
        echo "<table class='table striped row-hover cell-border'><tr><th>Acc No<th>Author<th>Title<th>Publisher";
        while($r=mysqli_fetch_assoc($result)){
            $accno=$r['accno'];
            $authname=$r['authname'];
            $title=$r['title'];
            $pubname=$r['pubname'];
            echo "
                    <tr><td>$accno
                        <td>$authname
                        <td>$title
                        <td>$pubname
            ";
        }
        echo "</table>";
        exit();
    }
?>
<html>
    <head>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <script src="jquery.js"></script>
        <link rel="stylesheet" href="https://cdn.korzh.com/metroui/v4.5.1/css/metro-all.min.css">
	</head>
    <style>
        body{
			background-attachment:fixed;
			background-image:linear-gradient(30deg,#AAC8A7,#C9DBB2,#E3F2C1,#F6FFDE);
		}
	</style>
    <body>
        <center><h2>Search by the given key word</h2></center>
        <input data-role='input' data-prepend="Title / Author / Publisher name" type=text id=searchtext data-search-button="true">
        <div id=result> </div>
        <script src="https://cdn.korzh.com/metroui/v4.5.1/js/metro.min.js"></script>
    </body>
</html>
<script>
    $(document).ready(function(){
        $("#searchtext").keyup(function(){
            searchtext=$("#searchtext").val();
            if(searchtext.length>=5)
                $.get("booksearch.php?searchtext="+searchtext,function(data,status){
                        $("#result").html(data);
                });
            else
                $("#result").html("Enter minimum 5 characters");
        });
    });
</script>