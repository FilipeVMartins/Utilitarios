
//script para definir cor de fundo e mensagem da div #msg2, de acordo com o seu valor.
var msg2 = document.getElementById("msg2").textContent;

if (msg2=='0'){
    var msgretorno = "Tabela não existia, foi criada agora, pode começar a salvar as mensagens.";
    document.getElementById("msg2").textContent = msgretorno;
    document.getElementById("msg2").style.backgroundColor = '#ff6633';

    
} else { 
    var msgretorno = "Tabela tabela já existente.";
    document.getElementById("msg2").textContent = msgretorno;
    document.getElementById("msg2").style.backgroundColor = '#99ff99';
}






var msg1 = document.getElementById("msg1").textContent;

if (msg1=='0'){
    var msgretorno = "Conexão falhou.";
    document.getElementById("msg1").textContent = msgretorno;
    document.getElementById("msg1").style.backgroundColor = '#ff6633';

    
} else {
    var msgretorno = "Conexão realizada com sucesso.";
    document.getElementById("msg1").textContent = msgretorno;
    document.getElementById("msg1").style.backgroundColor = '#99ff99';
}
