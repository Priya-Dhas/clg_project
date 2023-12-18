<?PHP
	$conn=mysqli_connect("localhost","root","","lbmns");
	if(isset($_POST["insert"])){
		$accno=$_POST["accno"];
		$title=$_POST["title"];
		$author=$_POST["author"];
		$publisher=$_POST["publisher"];
		$isbnno=$_POST["isbnno"];
		$dop=$_POST["dop"];
		$billno=$_POST["billno"];
		$price=$_POST["price"];
		$q="insert into bookdataentry values('$accno','$title','$author','$publisher','$isbnno','$dop','$billno','$price')";
		$r=mysqli_query($conn,$q);
	}
	if(isset($_GET["delete"])){
		$accno=$_GET["delete"];
		$q="delete from bookdataentry where accno='$accno'";
		$r=mysqli_query($conn,$q);
	}
	$accno=$title=$author=$publisher=$isbnno=$dop=$billno=$price="";
	if(isset ($_GET["edit"])){
		$accno=$_GET["edit"];
		$title=$_GET["title"];
		$author=$_GET["author"];
		$publisher=$_GET["publisher"];
		$isbnno=$_GET["isbnno"];
		$dop=$_GET["dop"];
		$billno=$_GET["billno"];
		$price=$_GET['price'];
	}
	if(isset($_POST["update"])){
		$accno=$_POST["accno"];
		$title=$_POST["title"];
		$author=$_POST["author"];
		$publisher=$_POST["publisher"];
		$isbnno=$_POST["isbnno"];
		$dop=$_POST["dop"];
		$billno=$_POST["billno"];
		$price=$_POST["price"];
		$q="update bookdataentry set accno='$accno',title='$title',author='$author',publisher='$isbnno',dop='$dop',billno='$billno',price='$price' where accno='$accno'";
		$r=mysqli_query($conn,$q);
		$accno=$title=$author=$publisher=$isbnno=$dop=$billno=$price="";
		unset($_GET["edit"]);
	}
?>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
	<form method=POST action="">
		<center><h2>BOOK DATA ENTRY</h2></center>
		<table>
			<tr><td>Accession no<td><input type=text name=accno     value=<?=$accno?>>
			<tr><td>Title <td>		<input type=text name=title     value=<?=$title?>>
			<tr><td>Author<td> 		<input type=text name=author    value=<?=$author?>>
			<tr><td>Publisher<td> 	<input type=text name=publisher value=<?=$publisher?>>
			<tr><td>ISBN no <td>	<input type=text name=isbnno    value=<?=$isbnno?>>
			<tr><td>DOP <td>		<input type=date name=dop		value=<?=$dop?>>
			<tr><td>Bill no<td>		<input type=text name=billno	value=<?=$billno?>>	
			<tr><td>Price<td>		<input type=text name=price	value=<?=$price?>>				
			<tr><td colspan=2 align=center>
				
			<?php
				if(isset($_GET["edit"]))
					echo "<input type=submit name=update value=UPDATE>";
				else
					echo "<input type=submit name=insert value=ADDRECORD>";
			?>
			<input type=reset>
		</table>
	</form>
	</div><hr><br>

<?php
		$q="select * from bookdataentry";
		$result=mysqli_query($conn,$q);
		$sno=1;
		$result=mysqli_query($conn,$q);
		$sno=1;
		echo "	<table class='table striped row-hover cell-border'><tr><th>S.No<th>Acc.No<th>Title<th>Author<th>Publisher<th>ISBN.No<th>DOP<th>Bill no<th>Price<th colspan=2>Operation";
		while($r=mysqli_fetch_assoc($result)){
			$accno=$r["accno"];
			$title=$r["title"];
			$author=$r["author"];
			$publisher=$r["publisher"];
			$isbnno=$r["isbnno"];
			$dop=$r["dop"];
			$billno=$r["billno"];
			$price=$r["price"];
			echo "<tr><td>$sno<td>$accno<td>$title<td>$author<td>$publisher<td>$isbnno<td>$dop<td>$billno<td>$price <br>
						<td><a href=bookdataentry.php?delete=$accno>Delete</a>
						<td><a href=bookdataentry.php?edit=$accno&title=$title&author=$author&publisher=$publisher&isbnno=$isbnno&dop=$dop&billno=$billno&price=$price>Edit</a>
				";
			$sno++;
		}
		echo "</table>";
	?>
</body>
</html>