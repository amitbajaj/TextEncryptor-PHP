<!DOCTYPE html>
<html><head><link rel="stylesheet" type="text/css" href="styles/default.css"/><title>Encrypt/Decrypt</title></head><body>
	<center>
	<form name="main" action="index.php" method="post">
<?php
        $data = empty($_POST['data'])?"":$_POST['data'];
	$pass = empty($_POST['pass'])?"":$_POST['pass'];
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
		<textarea name="data" cols="50" rows="10" wrap="VIRTUAL"><?php echo $data?></textarea><br/><br/>
                <input type="text" size="50" maxlength="16" name="pass" value="<?php echo $pass?>"/><br/><br/>
		<input type="submit" name="mode" value="Encrypt" class="button"/>  <input type="submit" name="mode" value="Decrypt" class="button"/><br/>
                
	</form>
	</center>
</body></html>