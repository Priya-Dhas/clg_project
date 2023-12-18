<?php
    session_start();
    if(isset($_SESSION["username"]) && $_SESSION['password']){
        header("location:frame.html");
        exit();
    }
    if(!isset($_POST['submit']))
    {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $conn=mysqli_connect('localhost','root','','lbmns');
        $sql="SELECT * from login WHERE username='$username' AND password='$password'";
        $result=mysqli_query($conn,$sql);
        $resultcheck=mysqli_num_rows($result);
        if($resultcheck>0){
            $_SESSION['username']=$username;
            $_SESSION['password']=$password;
            $_SESSION['status']="login successfully";
            header('location:frame.html');
        }
        else
        {
            echo"Username or Password incorrect";
        }
    }
?> 