<?php
$erronome = "";
$erroemail = "";
$erropass = "";
$errorpass = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){ // verificação do método
        if(empty($_POST['nome'])){
            $erronome = "please, input your name!";
        }else{
            $nome = clearpost($_POST['nome']);///tratamento
            if(!preg_match("/^[a-zA-Z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ' ]+$/", $nome)){
            $erronome = "only letters!!";
            }
        }
        ##VALIDAÇÃO DO EMAIL
        if(empty($_POST['email'])){
            $erroemail = "please, input your E-mail! ";
        }else{
            $email = clearpost($_POST['email']);///tratamento
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $erroemail = "invalid email!";
            }
        }
        ###verificação de senha
        if(empty($_POST['senha'])){
            $erropass = "please, input your password!";
        }else{
            $pass = clearpost($_POST['senha']);///tratamento
            if(strlen($pass)< 6){
                $erropass = "Too short, more than 6 chracters";
            }
        }
         ###verificação de repete-senha
         if(empty($_POST['r_senha'])){
            $errorpass = "please, input your password again!";
        }else{
            $rpass = clearpost($_POST['r_senha']);///tratamento
            if($rpass != $pass){
                $errorpass = "invalid passwords";
            }
        }
    }
    if(($erronome == '')&&($erroemail == "")&&($erropass == "")&&($errorpass == "")){
        header('Location: redirect.php'); ##redirecionamento
    }
    

    function clearpost($valor){
        $valor = trim($valor);   
        $valor = stripslashes($valor);
        $valor = htmlspecialchars($valor);
        return $valor;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link href="form.css" rel="stylesheet">
</head>
<body>
    <main>
    <h1><span>HEY, Whats'up dude?</span><br>Put your information here</h1>

     <form method="POST">

        <!-- NAME -->
        <label> Name </label>
        <input type="text" <?php if(!empty($erronome)){ echo "class = 'invalido'";}?> <?php if($_POST['nome']){echo "value ='" .$_POST['nome']."'";}?> class="invalido" name="nome" placeholder="Digite seu nome">
        <br><span class="Characters invalids"><?php echo $erronome; ?></span>

        <!-- EMAIL -->
        <label> E-mail </label>
        <input type="email" <?php if(!empty($erroemail)){ echo "class = 'invalido'";}?> <?php if($_POST['email']){echo "value ='" .$_POST['email']."'";}?> class="invalido" name="email" placeholder="email@provedor.com">
        <br><span class="Invalid email"><?php echo $erroemail; ?></span>

        <!-- PASS -->
        <label> Pass </label>
        <input type="password" <?php if(!empty($erropass)){ echo "class = 'invalido'";}?> <?php if($_POST['senha']){echo "value ='" .$_POST['senha']."'";}?> class="invalido" name="senha" placeholder="Digite uma senha">
        <br><span class="Too short pass"><?php echo $erropass; ?></span>

        <!-- REPEAT PASS -->
        <label> Repeat Pass </label>
        <input type="password" <?php if(!empty($errorpass)){ echo "class = 'invalido'";}?> <?php if($_POST['r_senha']){echo "value ='" .$_POST['r_senha']."'";}?> class="invalido" name="r_senha" placeholder="Repita a senha">
        <br><span class="invalid passwords"><?php echo $errorpass; ?></span>

        <button type="submit"> SEND </button>

      </form>
    </main>
</body>
</html>
