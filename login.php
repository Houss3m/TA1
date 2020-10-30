<html>
    <head>

        <title> BeSocial | Log in</title>

    </head>

    <style>
        #header{
            border-radius:5px;
            padding:5px;
            /*display: table;*/
            height:100px; 
            /*width:100%;*/
            background-color:rgb(59,89,152);
            color:#d9dfeb;
            font-size:40px;
        }

        #header_signup_button{
            width:270px;
            font-size:22px;
            color:white;
            background-color:#42b72a;
            border-radius:4px;
            }
        #login_form{
            border-radius:5px;
            background-color:white;
            width:30%;
        /*    height:350px;*/ 
            margin:auto; 
            margin-top:50px;
            text-align:center;
            padding-top:75px;
            padding-bottom:75px;
        }
        #account_id{
            width:250px;
            height:40px;
            border-radius:4px;
            border:solid 1px #aaa;
            padding:5px;
            font-size:15px;
            font-weight:bold;
        }
        #password{
            font-weight:bold;
            width:250px;
            height:40px;
            border-radius:4px;
            border:solid 1px #aaa;
            padding:5px;
            font-size:15px;
        }
        #login_button{
            font-weight:bold;
            width:250px;
            height:40px;
            color:#d9dfeb;
            background-color:rgb(59,89,152);
            font-family:tahoma;
            font-size:15px;
            border-radius:4px;
            border:solid 1px #aaa;
        }
    </style>
<?php

    $query="";
    $first_name = "";
    $last_name = "";
    $email = "";
    $password = "";
    $password2 = "";
    if(isset($_POST['LOGIN'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        }
    include("config.php");
?>

    <body style="font-family:tahoma; background-color:#e9ebee;">
        
        <div id="header" >
            <span id="header_BeSocial">BeSocial</span>
            <span >
                <a id="header_signup_button" href="signup.php">
                    Sign Up
                </a>
            </span>
        </div>

        <form id="login_form" method="POST">


            <div style="height:50px; font-size:23px;">
                <b>Log in to BeSocial</b>
            </div><br> 

            <input type="email" placeholder="email adress" id="account_id" name="email"> <br><br>
            <input type="password" placeholder="password" id="password" name="password"> <br><br>
            <input type="submit" id="login_button" name="LOGIN" value="LOG IN"> <br>
            <a href="signup.php">Don't have an account</a><br>
            <a href="google.com">forget password</a>
        </form>
        

    </body>

</html>