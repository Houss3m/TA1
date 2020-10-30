<?php
    error_reporting(-1);
    ini_set('display_errors', 'On');
    function upload_img(){
        $ret = false;
        $img_blob = '';
        $img_taille = 0;
        $img_type = '';
        $img_text="";
        $img_nom = '';
        $taille_max = 99000000;
                      
        if(isset($_POST['button_post'])){
            $ret = is_uploaded_file($_FILES['file']['tmp_name']);

            if (!$ret) {
                upload_text();
                //call upload text..
                return false;}
            else {
                // Le fichier a bien �t� re�u
                $img_taille = $_FILES['file']['size'];

                if ($img_taille > $taille_max) {
                    echo "Trop gros !";
                    return false;
                }

                $img_type = $_FILES['file']['type'];
                $img_nom = $_FILES['file']['name'];
                $img_text=$_POST['text'];
                $img_blob = file_get_contents ($_FILES['file']['tmp_name']);
                echo $img_nom." est bien trasf�r�";
        }

            /***************************************/
            include ("config.php");
            $req = "INSERT INTO images (" . "img_nom, img_taille, img_type, img_blob, img_text" .
            ") VALUES (" . "'" . $img_nom . "'," . "'" . $img_taille . "', " .
            "'" . $img_type . "', " .
            "'" . addslashes ($img_blob) . "'". ",'".$img_text ."'".");";
            
            if($cnx){
                $ret = $cnx->query($req);
                if($ret) 
                    echo "<h2>Insertion avec success</h2>";
                else{
                    echo "<h2>Echec</h2>";
                    print_r($cnx->errorInfo());
                    }
                return true;
            }
            else
                die ("<h3>Die, error on connexion on config.php</h3>");
        
        }
    }

    // ************************** UPLOAD TEXT METHOD ************************
    function upload_text(){
        $ret = false;
        $text = '';
        
        if(isset($_POST['button_post'])){
            $ret = is_uploaded_file($_FILES['file']['tmp_name']);

            if ($_POST['text']=='') {
                echo "please type something..";
                return false;}
            else {
                // Le statut a bien reçu
                $text = $_POST['text'];

                echo " post accepted";
        }

            /***************************************/
            include ("config.php");
            $req = "INSERT INTO texts (" . "text" . ") VALUES (" . "'" . $text . "'" .");";
            
            if($cnx){
                $ret = $cnx->query($req);
                if($ret) 
                    echo "<h2>Status bien posté</h2>";
                else{
                    echo "<h2>Echec</h2>";
                    print_r($cnx->errorInfo());
                    }
                return true;
            }
            else
                die ("<h3>Die, error on connexion on config.php</h3>");
        
        }
    }
  
    
?>

<html>
    <head>
        <title>BeSocial | Profile</title>
    </head>

    <style type="text/css">
        #header_profile{
            background-color:rgb(59,89,152); 
            height:50px;
        }
        #header_BeSocial_id{
            font-family:tahoma; 
            font-size:30px;
            font-weight:bold;
            background-color:rgb(59,89,140);
            color:#d9dfeb;
        }
        #nav_bar{
            width:90%; 
            height:50px; 
            margin:auto;
            padding-left:15px
        }
        #search_field{
            width:500px;
            border-radius:8px;
            padding: 6px;
            border: none;
            font-size: 17px;
            margin-left:75px;
        }


        /* Style the links inside the navigation bar */
        .buttons a {
            
        font-family:tahoma;
        float: right;
        display: block;
        color: #d9dfeb;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
        }

        /* Change the color of links on hover */
        .buttons a:hover {
        background-color: #ddd;
        color: black;
        }

        /* Style the "active" element to highlight the current page */
        .buttons a.active {
        font-weight:bold;
        background-color: #2196F3;
        color: #d9dfeb;
        }
        #profile_pic{
            margin-top:-250px;
            width:200px;
            height:200px;
            border-radius:50%;
            border:solid 2px white;
            background-color: white;
        }
        #change_buttons{
            text-align:center;
            background-color:rgb(59,89,152); 
            margin:auto; 
            margin-top:-20px;
        }
        #friends_box{
            flex:1; 
            height:400px;
            background-color:white; 
            min-height:400px;
            padding-left:5px; 
            margin-top:15px;
            margin-right:8px; 
            padding-top:15px;
        }
        #post_box{
            flex:3;
            min-height:400px; 
            
            margin-top:15px;
        }
        textarea{
            background-color:white;

            width:100%;
            height:65px;
            border:none;
            font-size:15px;
            font-family:tahoma;
        }
        #button_post{
            float: right;
        }
        #post_bar{
            margin-top:15px;
        }
        #post_profile_image{
            border-radius:50%;
            width:50px;
            height:50px;
            /*float:left;*/
            margin-right:15px;
            
        }
        #post{
            display:flex;
            padding-top:5px;
            padding-left:5px;
            padding-right:35px;
            padding-bottom: 20px;
            margin-bottom:15px;
            border: solid thin black;
            border-radius:10px;
            background-color:white;
        }
        #post_profile_name{
            font-family:tahoma;
            font-weight:bold;
            font-size:20px;
            
        }
    </style>

    <body style="font-family:tahoma; background-color:#e9ebee;">
        <!-- TOP BAR -->
        <div id="header_profile">
            <div id="nav_bar" >
            <div class="buttons">
                
                <span id="header_BeSocial_id" >BeSocial</span> 
                <input  type="text" id="search_field" placeholder="Type to search..">
                
                    <a href="login.php">Disconnect</a>
                    <a class="active" href="profile.php">Profile</a>
                    <a  href="signup.php">Home</a>
                </div>

            </div>
        </div>
        <br>
        <!-- COVER AREA -->
        <div style="width:90%; margin:auto; min-height:100%;">
        
            <div style="text-align:center;">
                <img src="cover-image.jpg" style="width:100%; height:500px;"></img> 
                <?php
                include('config.php');
                $req0="SELECT * FROM profile_pic";

                $result = $cnx->query($req0);
    
    
                $col = $result->fetch();

                if($col==""){
                    echo "<img src="."profile-image.jpg"." id="."profile_pic"."></img> <br> ";
                }else 
                //echo "<img src='data:image/jpeg;base64,";
                echo '<img class="sh-img" id="profile_pic" src="data:image/jpeg;base64,' . base64_encode($col[2]) . '"/>';
                ?>
                 
                <h3 style="font-family:tahoma; font-size:24px; margin-top:-35px; 
                color:white;background-color:black">Houssam Lachemat</h3>

                
                
            </div>
            <!-- Change profile pic buttons -->
            <div id="change_buttons">
                    <a href="upload_profile_pic.php" style="color:#d9dfeb;text-decoration:none;">Change profile image</a>
                       <b style="color:white;">-</b>
                    <a href="profile.php" style="color:#d9dfeb;text-decoration:none;">Change cover</a>
            </div>
            <!--  Friend list and share box  -->
            <div style="display:flex;">
                <!--  Friends  -->
                <div id="friends_box">
                
                    <a href="login.php" 
                      style="font-size:22px; font-weight:bold;font-family:tahoma; text-decoration:none">
                        Friends
                    </a>

                </div>
                <!--  Posts  -->
                <div id="post_box">
                    <!-- Writing Posts  -->
                    <form method="post" enctype="multipart/form-data" action="profile.php" 
                        style="border:solid thin grey;padding:10px;background-color:white;">
                        
                        <textarea rows="5" name="text" placeholder="What's on your mind?"></textarea>
                        <input type="hidden" name="size" file="99000000">
                        <input id="button_choose_image" type="file" name="file" size=50 value="open file" > 

                        <input id="button_post" type="submit" name="button_post" value="POST" >  <br> <br>
                        <?php 
                            upload_img();
                        ?>
                    </form>

                    <!--  Posts  View-->

                    <div id="post_bar">
                    
                    <!-- Single post -->
                        
                        
                        
                        <!--- text post --->
                        <?php
                                    error_reporting(-1);
                                    ini_set('display_errors', 'On');
                                    include ("config.php");

        $req = "SELECT * FROM (
            
            (SELECT images.img_id, NULL AS text_id, NULL AS text, 
            images.img_nom, images.img_blob, images.img_date, images.img_type ,images.img_taille
            ,images.img_text FROM images)

            UNION ALL

            (SELECT NULL AS img_id, texts.text_id, texts.text, NULL AS img_nom, NULL AS img_blob,
            texts.text_date, NULL AS img_type, NULL AS img_taille, NULL AS img_text FROM texts)
        
        ) results
        
        ORDER BY img_date DESC";

                                    $result = $cnx->query($req);
                                    if(!$result)
                                    {
                                    echo "echec de requete";
                                    print_r($cnx->errorInfo());
                                    }
                                    while ( $col = $result->fetch() )
                                    {

                                       echo '<div id="post">';
                                       echo '<div>';
                                       $req1="SELECT * FROM profile_pic";

                                       $result1 = $cnx->query($req1);
                           
                           
                                       $col2 = $result1->fetch();
                       
                                       echo '<img class="sh-img" id="post_profile_image" src="data:image/jpeg;base64,' . base64_encode($col2[2]) . '"/>';

                                       echo '</div>';            
                                        echo  '<div id="post_text">';
                                        echo '<span id="post_profile_name">Houssam Lachemat</span> <br/>';


                                        //echo "<h5>  $col[0]" ."<br> </h5>";
                                        if($col[4]!=''){
                                        echo "$col[5] "."</br>";
                                        echo "<h5>  $col[8]" ."</h5><br/>";
                                        echo '<img style="width:100%;" class="sh-img" src="data:image/jpeg;base64,' . 
                                        base64_encode($col[4]) . '"/>';
                                        }else {
                                            echo "$col[5] "."</br>";
                                            echo "<h5>  $col[2]" ."</h5><br/>";
                                        }
                                        echo '</div>';
                                        echo '</div>';            
                                    }
                                    ?>

                        
                        

                    </div>


                </div>
            </div>
        </div>

    </body>

</html>