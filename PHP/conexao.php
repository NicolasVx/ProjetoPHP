<?php
    $servername = "127.0.0.1:3306";
    $username = "root";
    $password = "aluno";
    $dbname = "sistema_login";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("Erro na conexão: " . $e->getMessage());
    }
?>

<?php
require_once 'conexao.php';

function inserirUsuario($nome, $login, $senha) {
    global $conexao;

    $senhaAcesso = password_hash($senha, PASSWORD_DEFAULT);

    $inserir = $conexao->prepare("INSERT INTO usuarios (nome, login, senha) VALUES (?, ?, ?)");
    $inserir->bind_param("sss", $nome, $login, $senhaAcesso);

    if ($inserir->execute()) {
        echo "Novo usuário inserido com sucesso!";
    } else {
        echo "Erro: " . $inserir->error;
    }
    $inserir->close();
}

function listarUsuarios() {
    global $conexao;

    $sql = "SELECT id, nome, login FROM usuarios";
    $busca = $conexao->query($sql);

   
}

/*
function deletarUsuarios($nome, $login, $senha){
    global $conexao;

    // processar.php
    $senhaAcesso = password_hash($senha, PASSWORD_DEFAULT);

    $deletar = $conexao->prepare("TRUNCATE TABLE usuarios;");
    $deletar->bind_param("sss", $nome, $login, $senhaAcesso);

    if ($deletar->execute()) {
        echo "Usuários deletados";
    } else {
        echo "Erro: " . $deletar->error;
    }
    $deletar->close();

    // Verifica se o botão foi clicado
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['botao'])) {
        minhaFuncao();
    }
    
}
?>*/
