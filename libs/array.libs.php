<?php
require_once '/csv-crud.php';
function merge($array1, $array2)
{

    if(sizeof($array1)>sizeof($array2))
    {
        echo $size = sizeof($array1);
    }else{
        $a = $array1;
        $array1 = $array2;
        $array2 = $a;

        echo $size = sizeof($array1);
    }

    $keys2 = array_keys($array2);

    for($i = 0;$i<$size;$i++)
    {
        $array1[$keys2[$i]] = $array1[$keys2[$i]] + $array2[$keys2[$i]];
    }

    $array1 = array_filter($array1);
    return $array1;
}



$country = GetAllData('../data/country.csv');

echo '<pre>';
print_r($country);
echo '</pre>';

$location = GetAllData('../data/location.csv');
echo '<pre>';
print_r($location);
echo '</pre>';


//$result = $location + $country  ;
//$result = array_merge($location,$country);
$result = merge($country,$location);
echo '<pre>';
print_r($result);
echo '</pre>';



$result = array_map($country,$location);
echo '<pre>';
print_r($result);
echo '</pre>';

?>