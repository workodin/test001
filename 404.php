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
    if ("php" == $extension)
    {
        include $targetFile;
    }
    else
    {
        readfile($targetFile);
    }
}
else
{
    echo "$targetFile";
}

