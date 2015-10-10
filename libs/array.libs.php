<?php
function getDataByKeyValue($array, $key, $value)
{
    foreach ($array as $data){
        if ($data[$key] == $value) {
            return $data;
        }
    }
}

