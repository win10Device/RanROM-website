<?php //die("<h2>Thanks to drew, i have taken down the chat service for now</h2>"); ?>
<!DOCTYPE html>
<html>
<meta>
  <link rel="stylesheet" href="/assets/vendor/bootstrap/5.0.2/css/bootstrap.min.css">
  <style>
    .footer {
      position: fixed;
      bottom: 0;
    }
    .div1 {
      //height: 200px;
      width: 50%;
    }
  </style>
</meta>
<body>
<div style="padding: 1%;">
<h3 style="font-family:verdana">A quickly put together chat system</h3>
<i style="font-family:verdana">Warning: Chat may not be filtered, and since this is still in development, auth is not done, meaning any message could have been sent by anyone!</i><br>
<i style="font-family:verdana; color:red;">By using this chat service, you agree that nothing <u>AT ALL</u> that occurs can be held accountable to anyone who hosts, maintains, moderates <?php echo $_SERVER['HTTP_HOST'] ?>, Include those who own and/or pay for the web domain, <b>WE ARE NOT RESPONSABLE FOR ANY ACTION!</b></i>
<br><br>
<p id="chatsystem" style="padding-bottom: 5%;"></p>
<form id="a" onsubmit="return false">
  <div class="input-group mb-3 div1 footer">
    <input type="text" class="form-control" placeholder="Message..." id="messagetext" aria-label="Message" aria-describedby="button-addon2" maxlength="500">
    <button class="btn btn-outline-secondary" type="submit" id="button-addon2" onclick="SendButton()">Send</button>
  </div>
</form>
</div>
<script>
var conn = new WebSocket('wss://chat.ranrom.xyz:443'); //new WebSocket('ws://10.0.0.84:8880');
conn.onopen = function(e) {
    console.log("Connection established!");
    document.getElementById("chatsystem").innerHTML = "Connection established!<br> - You can't view past messages!<br>";
};

conn.onmessage = function(e) {
    console.log(e.data);
    document.getElementById("chatsystem").innerHTML += e.data + "<br>";
};
AA();
function AA() {
  setTimeout(function() {
    if (conn.readState != WebSocket.CLOSED) {
        conn.send("KeepAlive_Ahdie73");
        console.log("Sent packet to keep connection alive if any");
        AA();
    }
  }, 25000);
}
function SendButton() {
    var x = document.getElementById("messagetext").value;
    document.getElementById("messagetext").value = "";
    if (conn.readyState != WebSocket.OEPN) {
        switch (conn.readyState) {
            case WebSocket.CONNECTING:
              document.getElementById("chatsystem").innerHTML += '<i style="color:red;">Failed to send message - Still connecting!</i><br>';
              break;
            case WebSocket.CLOSED:
              document.getElementById("chatsystem").innerHTML += '<i style="color:red;">Failed to send message - You are not connected to the websocket!</i><br>';
              break;
            default:
              if(x.includes("<img")) {
                  x = x.replace("<img", "<img width=128");
              }
              //document.getElementById("chatsystem").innerHTML += '<i style="color:red;">Message will not send because conn.send was removed, if you want to send meessages, do it via console <code>conn.send("message")</i>' + "<br>";
              document.getElementById("chatsystem").innerHTML += "<i>NOTICE: Sending message: </i>" + x + "<br>";
              conn.send(x);
              break;
        }
    }
    if (conn.readyState === WebSocket.OEPN) {
        //document.getElementById("chatsystem").innerHTML += "<i>NOTICE: Sending message: </i>" + x + "<br>";
        //conn.send(x);
    }
}
</script>
