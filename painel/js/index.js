$(function() {

  $('.box-chat-online').scrollTop($('.box-chat-online')[0].scrollHeight);

  $('#mensagem').keyup(function(e) {
    let code = e.keyCode || e.which;
    // code == 13 -> enter keycode
    if (code == 13) {
      e.preventDefault();
      chat();
    }
  })

  $('.enviar-mensagem').submit(function(e) {
    e.preventDefault();
    chat();
  })

  // função responsável por inserir as mensagens
  function chat() {
    let mensagem = $('#mensagem').val();
    $('#mensagem').val('');
    $.ajax({
      url: 'http://localhost/chat-online/painel/ajax/chat-online.php',
      method: 'post',
      data: {
        'mensagem': mensagem,
        'acao': 'inserir_mensagens'
      },
      dataType: 'html'
    }).done(function(data) {
      $('.box-chat-online').append(data);
      $('.box-chat-online').scrollTop($('.box-chat-online')[0].scrollHeight);
    })
  }

  // função responsável por recuperar as mensagens
  function recuperarMensagens() {
    $.ajax({
      url: 'http://localhost/chat-online/painel/ajax/chat-online.php',
      method: 'post',
      data: {
        'acao': 'pegar_mensagens'
      },
      dataType: 'html'
    }).done(function(data) {
      $('.box-chat-online').append(data);
      $('.box-chat-online').scrollTop($('.box-chat-online')[0].scrollHeight);
    })
  }

  // recupera novas mensagens a cada 3 segundos
  setInterval(function() {
    recuperarMensagens();
  }, 3000)
})