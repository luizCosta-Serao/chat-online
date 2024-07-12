<h1 class="title">Chat Online</h1>
<section class="box-chat-online">
  <?php
    // Recuperando mensagens ao entrar no chat
    $mensagens = MySql::connect()->prepare("SELECT * FROM `chat` ORDER BY id DESC LIMIT 10");
    $mensagens->execute();
    $mensagens = $mensagens->fetchAll();
    $mensagens = array_reverse($mensagens);
    foreach ($mensagens as $key => $value) {
      $lastId = $value['id'];

      $nome = MySql::connect()->prepare("SELECT * FROM `usuarios_admin` WHERE id = ?");
      $nome->execute(array($value['user_id']));
      $nome = $nome->fetch()['user']
  ?>
    <div class="mensagem-chat">
      <span><?php echo $nome ?></span>
      <p><?php echo $value['mensagem'] ?></p>
    </div>
  <?php
    } 
  ?>

</section>
<form class="enviar-mensagem" method="post">
  <h2>Envie uma mensagem</h2>
  <textarea name="mensagem" id="mensagem"></textarea>
  <input type="submit" name="acao" value="Enviar">
</form>