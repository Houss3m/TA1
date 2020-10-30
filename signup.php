<html>
    <head>

        <title> BeSocial | Sign up</title>

    </head>

    <style>
        #header{
           padding:5px;
            /*display: table;*/
            height:100px; 
            border-radius:5px;
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
            padding-top:60px;
            padding-bottom:55px;
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
        #name_id{
            font-weight:bold;
            width:250px;
            height:40px;
            border-radius:4px;
            border:solid 1px #aaa;
            padding:5px;
            font-size:15px;
        }
        #second_name_id{
            font-weight:bold;
            width:250px;
            height:40px;
            border-radius:4px;
            border:solid 1px #aaa;
            padding:5px;
            font-size:15px;
        }
        #signup_button{
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

    <body style="font-family:tahoma; background-color:#e9ebee;">
        
        <div id="header" >
            <span id="header_BeSocial">BeSocial</span>
            <span id="header_signup_button">
                <a id="header_signup_button" href="login.php">
                    Log in
                </a>
            </span>
        </div>



<?php

    $query="";
    $first_name = "";
    $last_name = "";
    $email = "";
    $password = "";
    $password2 = "";
    $cpt=0;
    if(isset($_POST['SIGN_UP'])){
        $first_name = $_POST['name_id'];
        $last_name = $_POST['second_name_id'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['re-password'];
        $cpt=$cpt+1;
        }

    include("config.php");




    $query = "INSERT INTO users (" . "first_name, last_name, email, password " .
    ") VALUES (" . "'" . $first_name . "'," . "'" . $last_name . "', 
    " . "'" . $email . "', " . "'" . $password . "');";
    
        if($cnx){
            
            $ret = $cnx->query($query);}

?>



        <form id="login_form" method="POST" action="login.php">
            
            <input type="text" placeholder="First name" id="name_id" name="name_id"> <br><br>
            <input type="text" placeholder="Last name" id="second_name_id" name="second_name_id"> <br><br>
            <input type="email" placeholder="email adress" id="account_id" name="email"> <br><br>
            <input type="password" placeholder="password" id="password" name="password"> <br><br>
            <input type="password" placeholder="repeat password" id="password" name="re-password"> <br><br>

            <input type="submit" name="SIGN_UP" id="signup_button" value="SIGN UP"> <br>
            <a href="login.php">You have an account</a><br>
            
        </form>


    </body>

</html>