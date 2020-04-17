<?php

require_once 'library.php';
require_once 'simple_html_dom.php';
require_once 'regions.php';

$regions = new Regions();

// https://стопкоронавирус.рф/
$url = 'https://xn--80aesfpebagmfblc0a.xn--p1ai/';

$html = UploadUrl($url);
$dom = str_get_html($html);

$element = $dom->find('.d-map__list', 0);
if($element == null){
    echo "No d-map__list found\n";
    exit(1);
}

$result = "Region Id,Sick,Healed,Die,Region Name";
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
file_put_contents('data/' . date('Y-m-d') . '.csv', $result);