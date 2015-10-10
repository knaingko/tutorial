<!DOCTYPE html>
<?php
    require_once './libs/csv-crud.php';
    require_once './libs/header.php';
    require_once './libs/breadcrumb.php';
    require_once './libs/html-option.php';
    $locationID = $locationName = $month = $countryID = $cityID = $errorMsg= ''; $countryData = $cityData = $_savedata = array();
    $countryData = GetAllData('./data/country.csv');
    $cityData = GetAllData('./data/city.csv');

if(!empty($_GET))
    {
        $locationID = $_GET['id'];
        $data = GetDataByKey('./data/location.csv','LocationID',$locationID);
        $locationName = $data['LocationName'];
        $month = $data['Month'];
        $countryID = $data['CountryID'];
        $cityID = $data['CityID'];
    }
    if(!empty($_POST))
    {
        //print_r($_POST);
        $locationID =  $_POST['location_id'];
        $locationName = $_POST['location_name'];
        $month = $_POST['month'];
        $countryID = $_POST['country_id'];
        $cityID = $_POST['city_id'];
        $_savedata = array(
            'LocationID'=>$locationID,
            'LocationName'=>$locationName,
            'Month'=>$month,
            'CountryID' =>$countryID,
            'CityID'=>$cityID
        );

        if(UpdateDataByKey('./data/location.csv','LocationID',$locationID,$_savedata)){
            redirect('location-list.php');
        }
    }
?>
<html lang="en">
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
    echo(display_breadcrumb(
        array(
            array("label"=>"Back Office","url"=>"#","active"=>"false"),
            array("label"=>"Location Information","url"=>"location-list.php","active"=>"false"),
            array("label"=>"Location Edit","url"=>"location-edit.php","active"=>"true")
        )
    ));
    ?>
</section>

<section id="country-edit" class="container" style="height:793px;">
    <div  class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Location Edit Form</h3>
        </div>
        <div class="panel-body" align="center">
            <form class="center" role="form" id="LocationForm" name="LocationForm">
                <div class="form-group">
                    <div class="input-group col-sm-3 form-inline">
                        <label for="location_id" class="input-group-addon">ID</label>
                        <input type="text" id="location_id" name="location_id" placeholder="Location ID" class="form-control col-lg-1" value="<?php echo($locationID);?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group col-sm-3">
                        <label for="location_name" class="input-group-addon">Name</label>
                        <input type="text" id="location_name" name="location_name" placeholder="Location Name" class="form-control" value="<?php echo($locationName);?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group col-sm-3">
                        <label for="month" class="input-group-addon">Month</label>
                        <select id="month" name="month" class="form-control">
                            <?php echo(html_month_option($month));?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group col-sm-3">
                        <label for="country_id" class="input-group-addon">Country</label>
                        <select id="country_id" name="country_id" class="form-control">
                            <?php echo(html_option("CountryID","CountryName",$countryData,$countryID));?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group col-sm-3">
                        <label for="city_id" class="input-group-addon">City</label>
                        <select id="city_id" name="city_id" class="form-control">
                            <?php echo(html_option("CityID","CityName",$cityData,$cityID));?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel-footer" align="center">
            <button type="button" class="btn btn-primary action-btn" onclick="SaveData();">Save</button>
            <button type="button" class="btn btn-primary action-btn" onclick="window.open('location-list.php','_self');">Cancel</button>
        </div>
    </div>
</section><!--/#registration-->

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
<script language="JavaScript" type="text/javascript">
    <!--
    function SaveData()
    {
        with(document.LocationForm)
        {
            action = 'location-edit.php';
            method = 'post';
            submit();
        }
    }
    //-->
</script>
<!-- Placed at the end of the document so the pages load faster -->

</body>
</html>



