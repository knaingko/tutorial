<!DOCTYPE html>
<html>
<body>

<?php
/*** Filter simple Integer ***/
$int = '1234';
/*** validate the integer ***/
if(filter_var($int, FILTER_VALIDATE_INT))
    echo 'true';
else
    echo 'false';


echo '<br/>';

/*** Filter an Integer Within a Range ***/
$int = 110;
$option = array("options" => array("min_range"=>1, "max_range"=>100));
if (filter_var($int, FILTER_VALIDATE_INT, $option)) {
    echo("Variable value is within the legal range");
} else {
    echo("Variable value is not within the legal range");
}

echo '<br/>';

/*** Filter an Integer in Array Value ***/
$arr = array(10,"109","", "-1234", "some text", "asdf234asdfgs", array());
$filtered_array = filter_var_array($arr, FILTER_VALIDATE_INT);
foreach($filtered_array as $key=>$value)
{
    if($value) echo $key.' is Integer ['. $value. '] <br/>';
}



?>

</body>
</html>