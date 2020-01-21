<?php
/**
 *  Template Name: Github WebHook
 */

$now = date("Ymd-His");
$logFile = __DIR__ . "/git-$now.log";
$debugFile = __DIR__ . "/git-debug.log";

$payload = $_REQUEST["payload"] ?? [];
if (!empty($payload))
{
    //$json = json_encode($payload);
    $payload = stripcslashes($payload);
    $tabPayload = json_decode($payload, true);
    if (is_array($tabPayload))
    {
    	$url = $tabPayload["repository"]["url"] ?? "";
        if ($url)
        {
            $path = parse_url($url, PHP_URL_PATH);
            extract(pathinfo($path));
            // crée les variables $dirname, $filename, etc...
            // enlève le / au début de $dirname
            $dirname     = trim($dirname, "/");
        	// file_put_contents($debugFile, $url, FILE_APPEND);
            // zip file
            // https://codeload.github.com/workodin/test001/zip/master
            // $master     = "$url/archive/master.zip";
            // vraie url pour la dernière version du code ?
            $master     = "https://codeload.github.com/$dirname/$filename/zip/master";
            
            $master5    = md5("$dirname/$filename");
            $masterFile = __DIR__ . "/$master5-$now.zip";
            
            $masterUrl = "$master?t=".time();   // évite le cache du serveur ?
            //$masterUrl = "$master";   // évite le cache du serveur ?
            
            // pb de cache de github qui ne donne pas la dernière version du master :-/
            file_put_contents($masterFile, file_get_contents($masterUrl));

            $zip = new ZipArchive;
            if ($zip->open($masterFile) === TRUE) {
                $extractDir = dirname(__DIR__) . "/$dirname";
                if (!is_dir($extractDir)) {
                    mkdir($extractDir);
                }
                $zip->extractTo($extractDir);
                $zip->close();

                if (is_dir("$extractDir/$filename"))
                {
                    rename("$extractDir/$filename","$extractDir/$filename-$now");
                }
                rename("$extractDir/$filename-master", "$extractDir/$filename");
            } 
            else {
            }
        }
    }
    //file_put_contents($logFile, $payload);
    //file_put_contents($logFile, $masterUrl);

    echo $json;
}
