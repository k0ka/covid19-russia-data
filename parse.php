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

