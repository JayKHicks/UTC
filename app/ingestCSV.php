<?php
/**
 * Created by PhpStorm.
 * User: JHICKS
 * Date: 4/16/2015
 * Time: 1:47 PM
 */

function csv_to_array($filename='', $delimiter=',')
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}

$csvFile = 'C:\Users\jhicks\Desktop\UCT_URL2.csv';

$csvFileArray = csv_to_array($csvFile);

$baseURLArray = array();
$campaignArray = array();
$mediumArray = array();
$sourceArray = array();

foreach ($csvFileArray as $urlArray) {
    if ($urlArray['creator'] == 'NP') continue;
    $baseURL = trim($urlArray['baseUrl']);
    $campaign = trim($urlArray['campaign']);
    $medium = trim($urlArray['medium']);
    $source = trim($urlArray['source']);

    if (!empty($baseURL)) {
        if (! strstr($baseURL, 'http')) {
            $baseURL = 'http://'.$baseURL;
        }
        $baseURLHost = parse_url($baseURL, PHP_URL_HOST);
        $baseURLPath = parse_url($baseURL, PHP_URL_PATH);

        $regs = array();
        if (preg_match('/((?<subdomain>[a-z0-9][a-z0-9\-]{1,63})\.)?(?<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $baseURLHost, $regs)) {
            //print_r ($regs);
        }

        if (isset($regs['subdomain'])) {
            @$baseURLArray[$regs['domain']][$regs['subdomain']][$baseURLPath]++;
        } else {
            if (empty($baseURLHost)) {$baseURLHost = 'EEE'.$baseURL;}
            @$baseURLArray[$baseURLHost][$baseURLPath]++;
        }
    }
    if (!empty($campaign)) {
        @$campaignArray[$campaign]++;
    }
    if (!empty($medium)) {
        @$mediumArray[$medium]++;
    }
    if (!empty($source)) {
        @$sourceArray[$source]++;
    }
}

echo "base URL Host: (".count($baseURLArray).")\n";
ksort($baseURLArray);
print_r($baseURLArray);
/*
echo "campaigns: (".count($campaignArray).")\n";
ksort($campaignArray);
print_r($campaignArray);

echo "mediums: (".count($mediumArray).")\n";
ksort($mediumArray);
print_r($mediumArray);

echo "channels: (".count($sourceArray).")\n";
ksort($sourceArray);
print_r($sourceArray);
*/
