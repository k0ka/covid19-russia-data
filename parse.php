<?php

require_once 'library.php';

$date = new DateTime('2020-04-16');
for ($i = 0; $i < 30; $i++){
    echo $date->format('Y-m-d') . "\n";
    ParseWebArchive($date);
    $date->modify("-1 DAY");
}