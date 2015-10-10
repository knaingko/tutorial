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


function isOctal($octal){
    if(filter_var($octal, FILTER_VALIDATE_INT, array("flags"=>FILTER_FLAG_ALLOW_OCTAL))===TRUE)
        return true;
    else
        return false;
}
function isHexidecimal($Hex){
    if(filter_var($Hex, FILTER_VALIDATE_INT, array("flags"=>FILTER_FLAG_ALLOW_HEX))===FALSE)
        return false;
    else
        return true;
}
$octal = 0666;
var_dump(isOctal($octal));
$hex = "0xff";
var_dump(isHexidecimal($hex));

function isBoolean($boolean){
    return filter_var($boolean, FILTER_VALIDATE_BOOLEAN);
}
var_dump(isBoolean(1));

function isBooleanInArray($array){
    return(filter_var($array, FILTER_VALIDATE_BOOLEAN, FILTER_REQUIRE_ARRAY));
}
$array = array(0,1,2,3,4, array(0,1,2,3,4));
var_dump(isBooleanInArray($array));

function isFloat($var){
    return(filter_var($var, FILTER_VALIDATE_FLOAT))?true:false;
}
var_dump(isFloat('123.45678'));

function isFloatInArray($array){
    return (filter_var($array, FILTER_VALIDATE_FLOAT, FILTER_REQUIRE_ARRAY));
}
$array = array(1.2,"1.7","", "-12345.678", "1,234.2222", "abcd4.2efgh", array());
echo '<br/>';
var_dump(isFloatInArray($array));

function isEmailByRegexp($email){
    $pattern = '/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU';
    return (filter_var($email, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>$pattern))))?true:false;
}
$mail = 'knaingko@gmail.com';
var_dump(isEmailByRegexp($mail));

function isURL($url){
    return (filter_var($url, FILTER_VALIDATE_URL))?true:false;
}
var_dump(isURL('http://www.my.com/aaaa/asdfasd/asdfasdf/afsd'));
?>


</body>
</html>