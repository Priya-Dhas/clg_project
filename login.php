<html>
    <style>
        body{
            margin:0;
            padding:0;
            background:url("images.jpg");
            background-repeat:no-repeat;
            background-size:cover;
            width:200px;
            font-family:sans-serif;
        }
        .loginbox{
            position:absolute;
            top:50%;
            left:50%;
            transform: translate(-50%, -50%);
            width:350px;
            height:390px;
            padding:80px 40px;
            box-sizing:border-box;
            background:rgba(0,0,0,0.5);
        }
        h2{
            margin:0;
            padding: 0 0 20px;
            color:#1E90FF;
            text-align:center;
        }
        .loginbox p{
            padding:0;
            margin:0;
            font-weight:bold;
            color:#fff;
        }
        .loginbox input{
            width:100%;
            margin-bottom:20px;
        }
        .loginbox input[type="text"], .loginbox input[type="password"]{
            border:none;
            border-bottom: 1px solid #fff;
            background:transparent;
            outline:none;
            height:40px;
            color:#fff;
            font-size: 16px;
        }
        .loginbox input[type="submit"]{
            border:none;
            outline:none;
            height:40px;
            color:#fff;
            font-size:16px;
            background:rgb(255,38,126);
            cursor:pointer;
            border-radius:20px;
        }
        .loginbox input[type="submit"]:hover{
            background: #efed40;
            color: #262626;
        }
        ::placeholder{
            color:rgba(255,255,255,0.5);
        }
        .user{
            width:100px;
            height:100px;
            overflow:hidden;
            position:absolute;
            top:calc(-100px/2);
            left:calc(-50% -50px);
            border-radius:50%;
        }


        </style>
<body>
    <div class="loginbox">

    <img src="./assets/user.png" class="user">
    <h2>Login here</h2>
    <form method="POST" action="logincheck.php">
        <p>Username</p>
        <input type="text" name="username" placeholder="enter username">
        <p>Password</p>
        <input type="password" name="password" placeholder="enter password">
        <input type="submit" value="sign in">
</body>
</html>









