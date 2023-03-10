<?php

if (isset($_SESSION['auth'])) {

    header("Location: home");
    exit();
}
else {

    header("Location: https://{$_SERVER['HTTP_HOST']}/welcome");
    exit();
}
