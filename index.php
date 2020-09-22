
<?php
    require_once 'classes/usuarios.php';
    $u = new Usuario();
?>

<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Projeto LogIn </title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div id="corpo-form">
        <h1>Entrar</h1>
        <form method="POST">
            <input type="email"  placeholder="Usuário" name="email">
            <input type="password" placeholder="Senha" name="senha">
            <input type="submit" value="Acessar"><br>
            <a href="cadastrar.php">Ainda não é inscrito?<strong> Cadastre-se!</strong></a>
        </form>
    </div>
    <?php
    if (isset($_POST['email']))
    {
    $email =addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    //verificar se esta preenchido
    if(!empty($email) && !empty($senha))
        {
            $u->conectar("project_login","localhost", "root", "");
                if($u->msgErro == ""){
                if($u ->logar($email, $senha)){
                    header("location: areaPrivada.php");
                }else{
                    ?><div class="msg-erro"> Email e/ou senha estão incorretos. </div><?php
                }
            }else{
                    echo "Erro:".$u->msgErro;
                }
        }else{
        ?><div class="msg-erro"> Preencha todos os campos </div><?php
        }
    }


    ?>
</body>
</html>