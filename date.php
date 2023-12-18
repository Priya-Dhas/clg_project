<?php
    $conn=mysqli_connect('localhost','root','','lbmns');
    if(isset($_GET['searchtext'])){
        $searchtext=$_GET['searchtext'];
        $q="select * from transaction where doi like '%$searchtext%'";
        $result=mysqli_query($conn,$q);
        echo "<table class='table striped row-hover cell-border'><tr><th>accno<th>rollno<th>doi<th>dor";
        while($r=mysqli_fetch_assoc($result)){
            $accno=$r['accno'];
            $rollno=$r['rollno'];
            $doi=$r['doi'];
            $dor=$r['dor'];
            echo "
                    <tr><td>$accno
                        <td>$rollno
                        <td>$doi
                        <td>$dor
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
    <body>
        <input data-role='input' data-prepend="date" type=text id=searchtext data-search-button="true">
        <div id=result> </div>
        <script src="https://cdn.korzh.com/metroui/v4.5.1/js/metro.min.js"></script>
    </body>
</html>
<script>
    $(document).ready(function(){
        $("#searchtext").keyup(function(){
            searchtext=$("#searchtext").val();
            if(searchtext.length>=7)
                $.get("date.php?searchtext="+searchtext,function(data,status){
                        $("#result").html(data);
                });
            else
                $("#result").html("Enter minimum 1 characters");
        });
    });
</script>