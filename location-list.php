<!DOCTYPE html>
<?php
require_once './libs/csv-crud.php';
require_once './libs/breadcrumb.php';
require_once './libs/array.libs.php';
$Id = $Action = ''; $locationData = $countryData = $cityData = $data = array();

if(!empty($_POST)){
    if($_POST['hidDelete'] == 'single'){
        $Id = $_POST['hidCode'];
        DeleteDataByKey('./data/location.csv','LoactionID',$Id);
    }
    if($_POST['hidDelete'] == 'multi') {
        $data = $_POST['delCheck'];
        foreach($data as $value)
        {
            DeleteDataByKey('./data/location.csv','LocationID',$value);
        }
    }
}

$locationData = GetAllData('./data/location.csv');
$countryData =  GetAllData('./data/country.csv');
$cityData =  GetAllData('./data/city.csv');


//echo '<pre>';
//print_r($locationData);
//print_r($countryData);

//echo '</pre>';
//
//$lcountry = array();
//$lcity = array();
//$data = array();

if(!empty($locationData)){
    foreach ($locationData as $key => $locArray) {
        $lcountry = getDataByKeyValue($countryData, 'CountryID', $locArray['CountryID']);
//        echo '<pre>';
//        print_r($lcountry);
//        echo '</pre>';
        $lcity = getDataByKeyValue($cityData, 'CityID', $locArray['CityID']);
        if (isset($lcountry) || isset($lcity)) {
            $data[] = array_merge($locArray,$lcountry,$lcity);
        }
    }
}
//echo '<pre>';
//print_r($data);
//echo '</pre>';
?>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- The below 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Kyaw Naing">

    <!-- Theme Matter -->
    <title>Tutorial</title>

    <!-- Vendor Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <link href="css/dropdown-submenu.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <link href="css/footer.css" rel="stylesheet">
</head><!--/head-->
<body>
    <?php require_once 'menu.php' ?>
    <section id="breadcrumb" class="container">

    <?php
    echo (display_breadcrumb(
        array(
            array("label"=>"Back Office","url"=>"#","active"=>"false"),
            array("label"=>"Location Information","url"=>"location-list.php","active"=>"true")
        ))
    );
    ?>
    </section>

    <div class="container" style="height:793px;">
        <form id="LocationList" name="LocationList">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Location Information</h3>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-sm-1" align="right">#</th>
                            <th class="col-sm-1"><label>ID</label></th>
                            <th class="col-sm-2"><label>Name</label></th>
                            <th class="col-sm-1"><label>Month</label></th>
                            <th class="col-sm-2"><label>Country</label></th>
                            <th class="col-sm-2"><label>City</label></th>
                            <th class="col-sm-1" colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; foreach ($data as $value) { ?>
                        <tr>
                            <td align="left"><label><input type="checkbox" id="delCheck[]" name="delCheck[]" value="<?php echo $value["LocationID"] ?>"/>&nbsp;<?php echo($i);?></label></td>
                            <td align="left"><?php echo($value['LocationID']); ?></td>
                            <td align="left"><?php echo($value['LocationName']); ?></td>
                            <td align="left"><?php echo(date('F', mktime(0, 0, 0, $value["Month"], 10))); ?></td>
                            <td align="left"><?php echo($value['CountryName']); ?></td>
                            <td align="left"><?php echo($value['CityName']); ?></td>
                            <td align="right">
                                <button type="button" class="btn table-btn" onclick="show_edit('<?php echo( $value["LocationID"] ) ?>')">Edit</button>
                            </td>
                            <td align="right">
                                <button type="button" class="btn table-btn" onclick="delete_data('<?php echo( $value["LocationID"] ) ?>')">Delete</button>
                            </td>
                        </tr>
                    <?php $i += 1; } ?>
                    </tbody>
                </table>
                <div class="panel-footer">
                    <label class="btn btn-primary col-sm-1"><input id="SelectAll" type="checkbox" />&nbsp;All</label>
                    <button type="button" class="btn btn-primary col-sm-1" onclick="show_entry();">New</button>
                    <button type="button" class="btn btn-primary col-sm-1" onclick="delete_all();">Delete</button>
                </div>
            </div>
            <input type="hidden" id="hidDelete" name="hidDelete">
            <input type="hidden" id="hidCode" name="hidCode">
        </form>
    </div>


    <?php require_once 'footer.php' ?>
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- Bootstrap core JavaScript ================================================== -->
    <script src="./js/jquery-2.1.4.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/theme.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="./js/html5shiv.min.js"></script>
    <script src="./js/respond.min.js"></script>
    <![endif]-->
    <!-- Private Function JavaScript ================================================== -->

    <script lang="javascript" type="text/javascript">
        <!--
        function delete_all()
        {
            with(document.LocationList)
            {
                if(confirm("Are you sure to delete?"))
                {
                    hidCode.value = '';
                    hidDelete.value = 'multi';
                    action = 'location-list.php';
                    method="post";
                    submit();
                }
            }
        }

        function delete_data(IdCode)
        {
            with(document.LocationList)
            {
                hidCode.value = IdCode;
                hidDelete.value = 'single';
                action = 'location-list.php';
                method="post";
                submit();
            }
        }

        function show_edit(id)
        {
            window.open('location-edit.php?id='+ id,'_self');
        }

        function show_entry()
        {
            window.open('location-entry.php','_self');
        }

        //Select All Checkbox
        $('#SelectAll').click(function(event) {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        });
    //-->
    </script>
    <!-- Placed at the end of the document so the pages load faster -->

</body>
</html>



