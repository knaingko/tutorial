<?php

function html_option($keyColumn, $displayColumn, $data, $displayValue = ''){
    $html_option = '';
    $html_option .= '<option label="--- Select One ----"> --- Select One --- </option>' . PHP_EOL;
    foreach ($data as $key => $value)
    {
        $html_option .= '<option value=' . $value[$keyColumn];
        if($value[$keyColumn] == $displayValue) $html_option .= ' selected ';
        $html_option .='>'. htmlspecialchars($value[$displayColumn]) .'</option>' . PHP_EOL;
    }
    return $html_option;
}

function html_month_option($SelectMonth=0){
    $option = '';
    for ($m=1; $m<=12; $m++) {
        $option .= '<option value="' . $m .'"';
        $option .= ($SelectMonth == $m)? "selected=\'selected\'" : "";
        $option .= '>' . date('F', mktime(0,0,0,$m)) . '</option>' . PHP_EOL;
    }
    return $option;
}
?>