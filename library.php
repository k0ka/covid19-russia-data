<?php

require_once 'simple_html_dom.php';
require_once 'regions.php';

/**
 * Parses today data from site
 *
 * @throws Exception
 */
function ParseToday()
{
    // https://стопкоронавирус.рф/
    $url = 'https://xn--80aesfpebagmfblc0a.xn--p1ai/';
    $date = new DateTime('now');
    ParseStopCoronavirusUrl($url, $date);
}

/**
 * Parses date from webarchive
 *
 * @param DateTime $date
 * @throws Exception
 */
function ParseWebArchive($date){
    $url = 'https://web.archive.org/web/20200416044534/https://xn--80aesfpebagmfblc0a.xn--p1ai/';
    $tomorrow = clone $date;
    $tomorrow->modify("+1 DAY");

    $webArchiveTimeUrl = 'https://web.archive.org/__wb/calendarcaptures/2?url=https%3A%2F%2Fxn--80aesfpebagmfblc0a.xn--p1ai%2F&date=' . $tomorrow->format('Ymd');
    $result = UploadUrl($webArchiveTimeUrl);

    $items = json_decode($result, true);
    $time = $items['items'][0][0];
    if(!$time){
        echo "Can't find time for date " . $tomorrow->format('Ymd');
        exit(1);
    }

    $webArchiveUrl = 'https://web.archive.org/web/' . $tomorrow->format('Ymd') . sprintf('%06d', $time) . '/https://xn--80aesfpebagmfblc0a.xn--p1ai/';

    ParseStopCoronavirusUrl($webArchiveUrl, $date);
}

/**
 * Parses url from site or webarchive and saves to file
 *
 * @param $url
 * @param DateTime $date
 * @throws Exception
 */
function ParseStopCoronavirusUrl($url, $date)
{
    $regions = new Regions();

    $html = UploadUrl($url);
    $dom = str_get_html($html);

    $element = $dom->find('.d-map__list', 0);
    if($element == null){
        echo "No d-map__list found\n";
        exit(1);
    }

    $result = "Region Id,Sick,Healed,Die,Region Name\n";
    $sumSick = 0;
    $sumHealed = 0;
    $sumDie = 0;
    foreach ($element->find('table tr') as $regionData){
        /** @var simple_html_dom_node $regionData */
        $regionName = trim($regionData->find('th', 0)->plaintext);
        $sick = intval($regionData->find('td', 0)->plaintext);
        $healed = intval($regionData->find('td', 1)->plaintext);
        $die = intval($regionData->find('td', 2)->plaintext);

        $sumSick += $sick;
        $sumHealed += $healed;
        $sumDie += $die;

        $regionId = $regions->GetRegionId($regionName);
        $result .= "$regionId,$sick,$healed,$die,$regionName\n";
    }

    $result .= "99,$sumSick,$sumHealed,$sumDie,Всего\n";
    file_put_contents("data/{$date->format('Y-m-d')}.csv", $result);
}


/**
 * Uploads url with info
 *
 * @param $url
 * @return string
 * @throws Exception
 */
function UploadUrl($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);
    $info = curl_getinfo($ch);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headers = substr($server_output, 0, $header_size);
    $response = substr($server_output, $header_size);

    curl_close($ch);

    if($info['http_code'] == 200 || $info['http_code'] == 201) {
        return $response;
    }

    echo "Error, HTTP Status Code : " . $info['http_code'] . "\n";
    echo "Headers are ".$headers;
    echo "Response are ".$response;
    throw new Exception("Error");
}