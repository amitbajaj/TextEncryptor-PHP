<!DOCTYPE html>
<html><head>
        <link rel="stylesheet" type="text/css" href="styles/default.css"/>
        <link rel="icon" href="images/encdec.ico"/>
        <title>Password Protect</title>
        <style>
            body{
                background: #c8b7b7;
            }
            input[type=button], input[type=submit], input[type=reset] {
                background-color: #aaaaaa;
                border: none;
                color: white;
                padding: 16px 32px;
                text-decoration: none;
                margin: 4px 2px;
                cursor: hand;
                width: 20%;
            }
            h1{
                color: black;
                background-color: #c8b7b7; 
            }
table, th, td {
    border: 0px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: center;
}
        </style>
    </head>
    <body>
	<center>
        <h1>Password Protect</h1>
        <a href="privacypolicy.htm">Privacy Policy</a>
        <table width="100%">
            <tr>
                <th width="20%">
                    <a href='https://play.google.com/store/apps/details?id=online.buzzzz.security.textencryptor&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png' width='200px'/></a>
                    <br>
                    <!--
                    <a href="https://www.microsoft.com/store/apps/9ntqxcf1wzw4?ocid=badge"><img src="https://assets.windowsphone.com/85864462-9c82-451e-9355-a3d5f874397a/English_get-it-from-MS_InvariantCulture_Default.png" alt="Get it from Microsoft" width='170px'/></a>
                    <br><br>
                    <a href='#'><img src='images/Download_on_the_App_Store_Badge_US-UK_135x40.svg' width='180px'/></a>
                    <br><br>
                    -->
                    <a href="PasswordProtect-1.0.jar">Cross Platform</a>
                </th>
                <th width="80%">
                    <form name="main" action="index.php" method="post">
            <?php
                    $data = empty($_POST['data'])?"":$_POST['data'];
                    $pass = empty($_POST['pass'])?"":$_POST['pass'];
                    $pass2use = "";
                    if(!empty($_POST['mode'])){
                        $method = "AES-128-CBC";
                        $pass2use = strtolower(substr(hash("sha256",$pass,false),0,16));
                        $options = OPENSSL_RAW_DATA;
                        if($_POST['mode']=="Encrypt"){
                            $iv = random_bytes(16);
                            $res = openssl_encrypt($data,$method,$pass2use,$options, $iv);
                            $data = base64_encode($iv.$res);
                        }elseif($_POST['mode']==="Decrypt"){
                            $res = base64_decode($data);
                            $iv = substr($res,0,16);
                            $data2decrypt = substr($res,16);
                            $data = openssl_decrypt($data2decrypt,$method,$pass2use,$options, $iv);
                        }
                    }
            ?>
                            <textarea name="data" cols="100" rows="20" wrap="VIRTUAL"><?php echo $data?></textarea><br/><br/>
                            <input type="password" size="50" maxlength="16" name="pass" value="<?php echo $pass?>"/><br/><br/>
                            <input type="submit" name="mode" value="Encrypt" class="button"/>  <input type="submit" name="mode" value="Decrypt" class="button"/><br/>
                    </form>
                </th>
            </tr>
        </table>        
	</center>
    </body>
</html>