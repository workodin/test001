<?php

$url = $_SERVER["REQUEST_URI"];

$path = parse_url($url, PHP_URL_PATH);
if ("/" == mb_substr($path, -1)) {
    $path = $path . "index.php";
}

extract(pathinfo($path));

$dirname = trim($dirname, "/");
$master5    = md5("$dirname");


$targetFile = __DIR__ . "/$dirname/$filename.$extension";
if (is_file($targetFile))
{
    // SECURITY
    $gitCapability = "read";

    if (($gitCapability != "") && current_user_can($gitCapability) ) 
    {
        status_header(200);
        
        $extension = strtolower($extension);
        switch($extension)
        {
            case "css":
                header("Content-Type: text/css");
                break;
            case "js":
                    header("Content-Type: application/javascript");
                break;
            case "php":
                    header("Content-Type: text/html");
                break;
            default:
                $mimeType = mime_content_type($targetFile);
                header("Content-Type: $mimeType");
        }

        if ("php" == $extension)
        {
            // protection contre modif fichiers
            ini_set("open_basedir", "/tmp:" .__DIR__ . "/$dirname");
            include $targetFile;
        }
        else
        {
            readfile($targetFile);
        }
    }
    else
    {
        auth_redirect();
        echo "$targetFile";
    }

}