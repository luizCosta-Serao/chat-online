<h1 class="title">Chat Online</h1>

<section class="box-chat-online">
  <?php
    for ($i=0; $i < 10; $i++) { 
  ?>
  <div class="mensagem-chat">
    <span>Luiz Antonio:</span>
    <p>Olá pessoal, tudo bom?</p>
  </div>
  <?php } ?>

</section>
<form class="enviar-mensagem" action="" method="post">
  <h2>Envie uma mensagem</h2>
  <textarea name="" id=""></textarea>
  <input type="submit" name="acao" value="Enviar">
</form>