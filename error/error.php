<?php

function ErrorType(int $type, string $error = null) {
    $image = "https://kiyo.ranrom.xyz/img/4a9b0327-e5aa-b3dd-d4cd-5e1ff8430c2d.png";
    $image_fallback = "/assets/uploads/server/4a9b0327-e5aa-b3dd-d4cd-5e1ff8430c2d.webp";
    $html = file_get_contents("{$_SERVER['DOCUMENT_ROOT']}/error/error.html"); //Template
    switch ($type) {
        case 0:
            $file = str_replace("%HEADER001%", "Well...", $html);
            $file = str_replace("%HEADER002%", "this is awkward", $file);
            $file = str_replace("%PARA001%", "It appears something went wrong with our database, please try again later", $file);
            $file = str_replace("%EXTRA%", "<i><small><sub>Error: {$error}</sub></small></i>", $file);
            $file = str_replace("{BACKGROUND_IMG1}", $image /*ed9aab4a-1279-40ad-a672-ba54b045c008.webp*/, $file);
            $file = str_replace("{BACKGROUND_IMG2}", $image_fallback /*ed9aab4a-1279-40ad-a672-ba54b045c008.webp*/, $file);
            $file = str_replace("left: -30px;", "", $file);
            $file = str_replace("left: 0;", "left: -18px;", $file);
            $file = str_replace("</title>", "Sad Kiyo :(</title>", $file);
            //echo '<title>Unhappy</title>';
            die($file);
            break;
    }
}
