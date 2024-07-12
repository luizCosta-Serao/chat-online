<?php
  include('../../config.php');

  if (Painel::isLogin() === false) {
    die('Você não está logado!');
  }
  header('Content-Type: application/json');

  if (isset($_POST['acao']) && $_POST['acao'] === 'inserir_mensagens') {
    // Inserindo nova mensagem no chat
    $mensagem = $_POST['mensagem'];
    $nome = $_SESSION['user'];
    $id_user = $_SESSION['id_user'];
  
    $sql = MySql::connect()->prepare("INSERT INTO `chat` VALUES (null, ?, ?)");
    $sql->execute(array($id_user, $mensagem));
  
    echo '<div class="mensagem-chat">
      <span>'.$nome.':</span>
      <p>'.$mensagem.'</p>
    </div>';

    $_SESSION['lastIdChat'] = MySql::connect()->lastInsertId();
    
  } else if (isset($_POST['acao']) && $_POST['acao'] === 'pegar_mensagens') {
    // recuperando novas mensagens
    $lastId = $_SESSION['lastIdChat'];
    $sql = MySql::connect()->prepare("SELECT * FROM `chat` WHERE id > $lastId");
    $sql->execute();
    $mensagens = $sql->fetchAll();
    $mensagens = array_reverse($mensagens);
    foreach ($mensagens as $key => $value) {
      $nome = MySql::connect()->prepare("SELECT * FROM `usuarios_admin` WHERE id = ?");
      $nome->execute(array($value['user_id']));
      $nome = $nome->fetch()['user'];
      echo '<div class="mensagem-chat">
        <span>'.$nome.':</span>
        <p>'.$value['mensagem'].'</p>
      </div>';
      $_SESSION['lastIdChat'] = $value['id'];
    }
  }
?>