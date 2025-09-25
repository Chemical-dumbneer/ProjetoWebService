<form action="login.php" method="post">
    <label>Usuario:</label>
    <input type="text" name="usuario"><br/>
    <label>Senha:</label>
    <input type="password" name="senha"><br />
    <button>Entrar</button>
</form>

<?php
    require "usuarios.php";
    session_start();
    
    if(isset($_SESSION["logado"]) && $_SESSION["logado"] == true){
        header("Location: ../MENU/home.php");
    }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST["usuario"] ?? null;
    $senha =$_POST["senha"] ?? null;



    try{
        if(isset($contas[$usuario]) && $contas[$usuario] === $senha){
            $_SESSION['logado'] = true;
            $_SESSION['usuario'] = $usuario;
    
            header("Location: ../MENU/home.php");
            exit;
        }else{
            throw new Exception("Usuário ou senha ínvalido!");
        }}catch(Exception $e){
            echo "<p style='color:red;'>" . $e->getMessage() . "</p>";
        }
    }
    
?>