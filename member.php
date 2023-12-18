<?php
    $conn=mysqli_connect('localhost','root','','lbmns');
    if(isset($_GET['searchtext'])){
        $searchtext=$_GET['searchtext'];
        $q="select distinct tr.*,bk.title from books bk,transaction tr where tr.rollno like '%$searchtext%' and tr.accno=bk.accno";
        $result=mysqli_query($conn,$q);
        echo "<table class='table striped row-hover cell-border'><tr><th>title<th>accno<th>DOI<th>DOR";
        while($r=mysqli_fetch_assoc($result)){
            $title=$r['title'];
            $accno=$r['accno'];
            $doi=$r['doi'];
            $dor=$r['dor'];
            echo "
                    <tr><td>$title
                        <td>$accno
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
    <style>
        body{
            background-attachment:fixed;
            background-image:linear-gradient(30deg,#AAC8A7,#C9DBB2,#E3F2C1,#F6FFDE);
        }
    </style>
    <body>
        <center><H2>MEMBER DETAILS</H2></center>
        <input data-role='input' data-prepend="rollno" type=text id=searchtext data-search-button="true">
        <div id=result> </div>
        <script src="https://cdn.korzh.com/metroui/v4.5.1/js/metro.min.js"></script>
    </body>
</html>
<script>
    $(document).ready(function(){
        $("#searchtext").keyup(function(){
            searchtext=$("#searchtext").val();
            if(searchtext.length>=3)
                $.get("member.php?searchtext="+searchtext,function(data,status){
                        $("#result").html(data);
                });
            else
                $("#result").html("Enter minimum 3 characters");
        });
    });
</script>