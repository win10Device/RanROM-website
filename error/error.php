<?php
if(isset($_GET)) {
    if($_GET['code'] == "404")
        ErrorType(404);
}
function ErrorType(int $type, string $error = null) {
    $image = "https://kiyo.ranrom.xyz/img/4a9b0327-e5aa-b3dd-d4cd-5e1ff8430c2d.png";
    $image_fallback = "/assets/uploads/server/4a9b0327-e5aa-b3dd-d4cd-5e1ff8430c2d.webp";
    $html = file_get_contents("{$_SERVER['DOCUMENT_ROOT']}/error/error.html"); //Template
    switch ($type) {
        case -2:
            http_response_code(500);
            $file = str_replace("%HEADER001%", "Well...", $html);
            $file = str_replace("%HEADER002%", "We can't send emails", $file);
            $file = str_replace("%PARA001%", "Due to one or more critical security issues on our end, to protect the security of our servers and user data, We've halted our email system, Sorry!", $file);
            $file = str_replace("%EXTRA%", "<i><small><sub></sub></small></i>", $file);
            $file = str_replace("{BACKGROUND_IMG1}", $image /*ed9aab4a-1279-40ad-a672-ba54b045c008.webp*/, $file);
            $file = str_replace("{BACKGROUND_IMG2}", $image_fallback /*ed9aab4a-1279-40ad-a672-ba54b045c008.webp*/, $file);
            $file = str_replace("left: -30px;", "", $file);
            $file = str_replace("left: 0;", "left: -18px;", $file);
            $file = str_replace("</title>", "Sad Kiyo :(</title>", $file);
            //echo '<title>Unhappy</title>';
            die($file);
            break;
        case -1:
            echo "THIS IS A TEST! THIS ISN'T REAL";
            http_response_code(503);
            $file = str_replace("%HEADER001%", "Sorry,", $html);
            $file = str_replace("%HEADER002%", "We are offline", $file);
            $file = str_replace("%PARA001%", "Due to one or more critical security issues on our end, to protect the security of our servers and user data, we've halted our network", $file);
            $file = str_replace("%EXTRA%", "<i><small><sub>Please try again later</sub></small></i>", $file);
            $file = str_replace("{BACKGROUND_IMG1}", $image /*ed9aab4a-1279-40ad-a672-ba54b045c008.webp*/, $file);
            $file = str_replace("{BACKGROUND_IMG2}", $image_fallback /*ed9aab4a-1279-40ad-a672-ba54b045c008.webp*/, $file);
            $file = str_replace("left: -30px;", "", $file);
            $file = str_replace("left: 0;", "left: -18px;", $file);
            $file = str_replace("</title>", "Sad Kiyo :(</title>", $file);
            //echo '<title>Unhappy</title>';
            die($file);
            break;
        case 0:
            //http_response_code(500);
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
        case 404:
            http_response_code(404);
            $file = str_replace("%HEADER001%", "404", $html);
            $file = str_replace("%HEADER002%", "Page Not Found", $file);
            $file = str_replace("%PARA001%", "Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily unavailable", $file);
            $file = str_replace("%EXTRA%", "<a href=\"/\">Back to homepage</a>", $file);
            $file = str_replace("{BACKGROUND_IMG1}", $image /*ed9aab4a-1279-40ad-a672-ba54b045c008.webp*/, $file);
            $file = str_replace("{BACKGROUND_IMG2}", $image_fallback /*ed9aab4a-1279-40ad-a672-ba54b045c008.webp*/, $file);
            $file = str_replace("left: -30px;", "", $file);
            $file = str_replace("left: 0;", "left: -18px;", $file);
            $file = str_replace("</title>", "404 - Not Found</title>", $file);
            die($file);
            break;
    }
}
