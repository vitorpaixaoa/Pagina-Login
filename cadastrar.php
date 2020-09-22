<?php
    require_once 'classes/usuarios.php';
    $u = new Usuario;
?>

<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Projeto LogIn </title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<div id="corpo-form-cad">
    <h1>Cadastras</h1>
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome completo" maxlength="30">
        <input type="text" name="telefone" placeholder="Telefone" maxlength="30">
        <input type="email" name="email" placeholder="Usuário" maxlength="40">
        <input type="password" name="senha" placeholder="Senha" maxlength="15">
        <input type="password" name="confSenha" placeholder="Confirmar senha" maxlength="15">
        <input type="submit" value="Cadastrar"><br>
    </form>
</div>
<?php
//verificar se clicou no botão
if (isset($_POST['nome']))
    {
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $email =addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $confirmarSenha = addslashes($_POST['confSenha']);
            //verificar se esta preenchido
        if(!empty($nome) && !empty($email) && !empty($senha) && !empty($telefone) && !empty($confirmarSenha)){
           $u->conectar("project_login","localhost", "root", "");
           if($u->msgErro == "")// ta tudo ok
           {
               if($senha == $confirmarSenha){
                   if ($u->cadastrar($nome,$telefone,$email,$senha)){
                       ?>
                        <div id="msg-sucesso">
                            "Cadastrado com sucesso! acesse para entrar!";
                        </div>
                        <?php
                   }else{
                       ?>
                       <div class="msg-erro"> Email já cadastrado </div>
                   <?php }
               } else { ?>
                   <div class="msg-erro"> As senhas não conferem </div>
                   <?php
               }

           }else {
               echo "Erro: ".$u->msgErro;
           }
        } else { ?>
            <div class="msg-erro"> Preencha todos os campos </div>
            <?php
        }
    }


?>
</body>
</html>
