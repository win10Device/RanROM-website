<html>
<body>
    <div id="root"></div>
    <script>
        var host = 'ws<?php if ($_SERVER['HTTPS']) echo "s"; ?>://10.0.0.84:8081/get_time.php';
        var socket = new WebSocket(host);
        socket.onmessage = function(e) {
            document.getElementById('root').innerHTML = e.data;
        };
    </script>
</body>
</html>
