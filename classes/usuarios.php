<?php

class Usuario {

    private $pdo;
    public  $msgErro = "";

    public function  conectar($nome, $host, $usuario, $senha){
        global $pdo;
        global $msgErro;

        try {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        }catch (PDOException $e){
            $msgErro = $e -> getMessage();
        }
    }

    public function cadastrar($nome, $telefone, $email, $senha)
    {
        global $pdo;
        //Verificar se existe email cadastrado
        $sql = $pdo->prepare("SELECT id_usuarios FROM usuarios WHERE email = :e");

        $sql->bindValue(":e",$email);
        if($sql->rowCount() > 0)
        {
            return false; //ja esta cadastrada
        }
        else
        { //caso não, Cadastrar
            $sql = $pdo->prepare("INSERT INTO usuarios(nome,telefone,email,senha) VALUES (:n, :t, :e,:s)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":t",$telefone);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            return true;
        }
    }

    public function  logar($email, $senha)
    {
        global $pdo;
        //verificar se o email e a senha estao cadastrados, se sim
        $sql = $pdo->prepare("SELECT id_usuarios FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e" ,$email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();
        if ($sql->rowCount() > 0)
        {
            //entrar no sistema (sessao)
            $dado = $sql -> fetch();
            session_start();
            $_SESSION['id_usuarios'] = $dado['id_usuarios'];
            return true; // logado com sucesso
        }
        else
        {
            return false; // não foi possivel logar
        }


    }
}





?>