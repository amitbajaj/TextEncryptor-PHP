<!DOCTYPE html>
<html><head>
        <link rel="stylesheet" type="text/css" href="styles/default.css"/>
        <link rel="icon" href="images/encdec.ico"/>
        <title>Encrypt/Decrypt</title>
        <style>
            body{
                background: #feae16;
                background-image:url('images/background.jpg');
            }
            input[type=button], input[type=submit], input[type=reset] {
                background-color: #aaaaaa;
                border: none;
                color: white;
                padding: 16px 32px;
                text-decoration: none;
                margin: 4px 2px;
                cursor: pointer;
                width: 20%;
            }
            h1{
                color: black;
                background-color: white; 
            }
        </style>
    </head>
    <body>
	<center>
        <h1>Text Encryptor</h1>
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
                <input type="text" size="50" maxlength="16" name="pass" value="<?php echo $pass?>"/><br/><br/>
		<input type="submit" name="mode" value="Encrypt" class="button"/>  <input type="submit" name="mode" value="Decrypt" class="button"/><br/>
                
	</form>
	</center>
    </body>
</html>