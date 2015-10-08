<?php
/**
 * Display Breadcrumb with html <ol> element for bootstrap
 * Usage:
 *  display_breadcrumb(
 *      array(
 *          array("label"=>"Name","url"=>"url","active"=>"true (or) false"),
 *      )
 *  );
 *
 *
 * @param $breadcrumb
 * @return string
 */
function display_breadcrumb($breadcrumb){
    $olHtml = "";
    $olHtml = $olHtml . "<ol class='breadcrumb'>" ." \n";
    foreach($breadcrumb as $row)
    {
        if($row['active'] == 'true'){
            $active = "class='active'";
        }else{
            $active = "";
        }
        $olHtml = $olHtml . "<li><a href='". $row['url'] ."'". $active .">". $row['label'] ."</a></li>\n";
    }
    $olHtml = $olHtml . "</ol>" . "\n";
    return $olHtml;
}
?>


