<?php

if (isset($_SESSION['auth'])) {

    header("Location: home");
    exit();
}
else {
    if(empty($_GET['redirect'])) {
        header("Location: /welcome");
        exit();
    } else {
        exit("<h4>Redirected from play.ranrom.xyz</h4><br>Nothing here yet. <a href=\"/\">Contuine</a>");
    }
}
