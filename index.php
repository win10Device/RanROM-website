<?php

if (isset($_SESSION['auth'])) {

    header("Location: home");
    exit();
}
else {

    header("Location: welcome");
    exit();
}
