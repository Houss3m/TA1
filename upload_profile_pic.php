<html>
<head>
<title>Change profile pic | BeSocial</title>
</head>

<style>

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
</style>

<body>

        <!-- TOP BAR -->
        <div id="header_profile">
            <div id="nav_bar" >
            <div class="buttons">
                
                <span id="header_BeSocial_id" >BeSocial</span> 
                
                    <a href="login.php">Disconnect</a>
                    <a href="profile.php">Profile</a>
                </div>

            </div>
        </div>
        <br>


<h3>Upload profile image (size < 1 MO)</h3>
<form enctype="multipart/form-data" method="post">
<input type="hidden" name="max_allowed_packet" value="1000000" />
<input type="file" name="file" size=500 />
<input type="submit" name="change"value="Envoyer" />
<br><br><br><br><br><br>
<!--<a style="font-size:25px;font-family:Tahoma; padding:25px;" href="profile.php"> GO BACK TO MY PROFILE</a>
-->
<?php
    error_reporting(-1);
    ini_set('display_errors', 'On');
    function upload_img(){
        $ret = false;
        $img_blob = '';
        $img_nom = '';
        $taille_max = 1000000;
        $img_taille=0;
        if(isset($_POST['change'])){
            $ret = is_uploaded_file($_FILES['file']['tmp_name']);

            if (!$ret) {
                echo "probleme de transfert";
                //call upload text..
                return false;}
            else {
                // Le fichier a bien �t� re�u
                $img_taille = $_FILES['file']['size'];

                if ($img_taille > $taille_max) {
                    echo "Trop gros !";
                    return false;
                }

                $img_nom = $_FILES['file']['name'];
                $img_blob = file_get_contents ($_FILES['file']['tmp_name']);
                echo $img_nom." est bien trasfere";
        }

            /***************************************/
            include ("config.php");
/*          $req0="SELECT * FROM profile_pic";

            $result = $cnx->query($req0);


            $col = $result->fetch();
            if($col[1]==""){

                $req = "INSERT INTO profile_pic (" . "img_nom, img_blob " . ")  VALUES (" . "'" . 
                $img_nom . "', " . "'" . addslashes ($img_blob) . "'" . ");";
            } else{
                $req1="UPDATE profile_pic SET img_nom ="
                 ."'". $img_nom . "'" . ", img_blob ="."'". addslashes ($img_blob) ."'".";";
                }

*/


// $req1="UPDATE profile_pic SET img_nom ="
// ."'". $img_nom . "'" . ", img_blob ="."'". addslashes ($img_blob) ."'".";";
           
            if($cnx){

                //$ret = $cnx->query($req1);
                
                $req0="SELECT * FROM profile_pic";

                $result = $cnx->query($req0);
    
    
                $col = $result->fetch();
                if($col==""){
    
                    $req = "INSERT INTO profile_pic (" . "img_nom, img_blob " . ")  VALUES (" . "'" . 
                    $img_nom . "', " . "'" . addslashes ($img_blob) . "'" . ");";
                    $ret = $cnx->query($req);

                } else{
                    $req1="UPDATE profile_pic SET img_nom ="
                     ."'". $img_nom . "'" . ", img_blob ="."'". addslashes ($img_blob) ."'".";";
                     $ret = $cnx->query($req1);
                    }
                
                if($ret) 
                    echo "<h2>Insertion avec success</h2>";
                else{
                    echo "<h2>Echec</h2>";
                    echo '<pre>';
                    print_r($cnx->errorInfo());
                    echo '<pre>';    
                }
                return true;
            }
            else
                die ("<h3>Die, error on connexion on config.php</h3>");
        
        }
    }
    upload_img();
?>

</form>
</body>
</html>