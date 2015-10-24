<?php
$string = "<script>Hello</script>";
echo filter_var($string, FILTER_SANITIZE_STRING);

echo '<br/>';

$string = "<script>\"'foo'\"</script>";
echo filter_var($string, FILTER_SANITIZE_STRING);

echo '<br/>';

$string = "<script>\"'foo'\"</script>";
echo filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

echo '<br/>';

$string = "<li><script>!@#$%^&*foo</script><br><p /><li />";
echo filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);

echo '<br/>';

$string = "<li><script>!@#$%^&*foo</script><br><p /><li />";
echo filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

echo '<br/>';

$string = "<li><script>!@#$%^&*foo</script><br><p /><li />";
echo filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);

echo '<br/>';

$string = "<li><script>!@#$%^&*foo</script><br><p /><li />";
echo filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_HIGH);

echo '<br/>';

$string = "http://phpro.org/file.php?foo=1&bar=2";
echo $string ;
echo '<br />';
echo filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);

echo '<br/>';

$string = "?><!@#$%^&*()}{~bobthebuilder";
echo $string;
echo '<br />';
echo filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS);

echo '<br/>';

$string = "test'test2'test3'' test\'\"test5";
echo $string;
echo '<br />';
echo filter_var($string, FILTER_SANITIZE_MAGIC_QUOTES)

?>
