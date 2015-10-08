<?php

function html_option($default, $keyColumn, $displayColumn, $data){
    $html_option = '';
    $html_option .= '<option label="--- Select One ----"> --- Select One --- </option>';
    foreach ($data as $key => $value)
    {
        $html_option .= '<option value=' . $value[$keyColumn];
        if($value[$keyColumn] == $default) $html_option .= ' selected ';
        $html_option .='>'. htmlspecialchars($value[$displayColumn]) .'</option>';
    }
    return $html_option;
}

?>