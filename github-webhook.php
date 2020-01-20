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
        	// file_put_contents($debugFile, $url, FILE_APPEND);
            // zip file
            $master = "$url/archive/master.zip";
            $masterFile = __DIR__ . "/" . md5($master) . ".zip";
        	file_put_contents($masterFile, file_get_contents($master));   
        }
    }
    file_put_contents($logFile, $payload);

    echo $json;
}
