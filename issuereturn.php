<?php 
    $conn=mysqli_connect('localhost','root','','lbmns');
    if(isset($_GET['check'])){
        $check=$_GET['check'];
        $q="select * from transaction where accno='$check' and dor is null";
        $result=mysqli_query($conn,$q);
        $rollno="issue";
        if(mysqli_num_rows($result)==1){
            $r=mysqli_fetch_assoc($result);
            $rollno=$r['rollno'];
        }
        echo $rollno;
        exit();
    }
    if(isset($_GET['accno'])){
        $accno=$_GET['accno'];
        $q="select * from books where accno='$accno'";
        $booktitle=mysqli_fetch_assoc(mysqli_query($conn,$q))['title'];
        echo $booktitle;
        exit();
    }
    if(isset($_GET['rollno'])){
        $rollno=$_GET['rollno'];
        $q="select * from students where rollno='$rollno'";
        $studentname=mysqli_fetch_assoc(mysqli_query($conn,$q))['name'];
        echo $studentname;
        exit();
    }
    if(isset($_POST['issue'])){
        $rollno=$_POST['rollno'];
        $accno=$_POST['accno'];
        $q="insert into transaction(accno,rollno,doi) values ($accno,'$rollno',CURRENT_DATE)";
        $result=mysqli_query($conn,$q);
    }
    if(isset($_POST['return'])){
        $rollno=$_POST['rollno'];
        $accno=$_POST['accno'];
        $q="update transaction set dor=CURRENT_DATE where accno=$accno";
        $result=mysqli_query($conn,$q);
    }
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="jquery.js"></script>
        <link rel="stylesheet" href="https://cdn.korzh.com/metroui/v4.5.1/css/metro-all.min.css">
    </head>
    <style>
		.h2{
			text-align:center;
		}
		th {
  			background-color: grey;
  			color: white;
		}
		th,
		td {
  			width: 150px;
  			padding:5px;
			font-family:inherit;
		}
		body{
			background-attachment:fixed;
			background-image:linear-gradient(30deg,#27E1C1,#C9EEFF,#C7DEFF,#27E1C1);
		}
	</style>
    <body>
        <div align="center">
        <form method=post action="">
        <center><h2>BOOK ISSUE/RETURN<h2></center>
            <table width=80%>
                <tr><td width=25%>Book Acc No<td><input type=number name=accno id=accno style='border:none'>
                <tr><td>Book Details<td id=bookdetails>
                <tr><td>Student Roll No<td><input type=text name=rollno id=rollno style='border:none'>
                <tr><td>Student Name<td id=studentname>
            </TABLE>
            <center><input type=submit name=issue id=issue value=Issue>
                    <input type=submit name=return id=return value=Return></center>
    </form>
    <TABLE class='table striped row-hover cell-border'>
        <tr><th>S.No.<th>Book Accno<th>Title of the Book<th>Rollno<th>Student Name<th>Transaction Type
        <?php
            $q="select * from transaction where doi=CURRENT_DATE or dor=CURRENT_DATE order by tno desc";
            $result=mysqli_query($conn,$q);
            $sno=1;
            while($r=mysqli_fetch_assoc($result)){
                $accno=$r['accno'];
                $rollno=$r['rollno'];
                $booktitle=mysqli_fetch_assoc(mysqli_query($conn,"select title from books where accno=$accno"))['title'];
                $studentname=mysqli_fetch_assoc(mysqli_query($conn,"select name from students where rollno='$rollno'"))['name'];
                $transaction="Return";
                if($r['dor']==null) $transaction="Issue";
                echo "<tr>  <td>$sno
                            <td>$accno
                            <td>$booktitle
                            <td>$rollno
                            <td>$studentname
                            <td>$transaction
                ";
                $sno++;
            }
        ?>
    </table>
    </body>
</html>
<script>
    $(document).ready(function(){
        $("#accno").keyup(function(){
            accno=$("#accno").val();
            $.get("issuereturn.php?accno="+accno,function(data,status){
                    $("#bookdetails").html(data);
            });
        });
        $("#rollno").keyup(function(){
            rollno=$("#rollno").val();
            $.get("issuereturn.php?rollno="+rollno,function(data,status){
                    $("#studentname").html(data);
            });
        });
        $("#accno").blur(function(){
            accno=$("#accno").val();
            $.get("issuereturn.php?check="+accno,function(data,status){
                $("#rollno").val(data);
                $("#return").removeAttr('disabled','disabled');
                $("#issue").attr('disabled','disabled');
                if(data=="issue"){
                    $("#rollno").val("");
                    $("#studentname").html("");
                    $("#issue").removeAttr('disabled');
                    $("#return").attr('disabled','disabled');
                }
            });
        });
    });
</script>

