<!DOCTYPE html>
<?php
    require_once './libs/csv-crud.php';
    require_once './libs/header.php';
    require_once './libs/breadcrumb.php';
    require_once './libs/select-option.php';
    $Id = $Name = $Action = ''; $data = array();
    $countryData = GetAllData('./data/country.csv');


    if(!empty($_GET))
    {
        $Id = $_GET['id'];
        $data = GetDataByKey('./data/country.csv','CountryID',$Id);
        $Name = $data['CountryName'];
    }
    if(!empty($_POST))
    {
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        $Id =  $_POST['country_id'];
        $Name = $_POST['country_name'];
        $data = array('CountryID'=>$Id, 'CountryName'=>$Name);

        if(UpdateDataByKey('./data/country.csv','CountryID',$Id,$data)){
            redirect('country-list.php');
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
            array("label"=>"Country Information","url"=>"country-list.php","active"=>"false"),
            array("label"=>"Country Edit","url"=>"country-edit.php","active"=>"true")
        )
    ));
    ?>
</section>

<section id="country-edit" class="container" style="height:793px;">
    <div  class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Country Edit Form</h3>
        </div>
        <div class="panel-body" align="center">
            <form class="center" role="form" id="CountryForm" name="CountryForm">
                <div class="form-group">
                    <div class="input-group col-sm-3 form-inline">
                        <label for="country_id" class="input-group-addon">ID</label>
                        <select id="country_id" name="country_id" class="form-control"><?php echo(html_option($Id,"CountryID","CountryID",$countryData));?></select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group col-sm-3">
                        <label for="country_name" class="input-group-addon">Name</label>
                        <input type="text" id="country_name" name="country_name" placeholder="Country Name" class="form-control" value="<?php echo($Name);?>">
                    </div>
                </div>
            </form>
        </div>
        <div class="panel-footer" align="center">
            <button type="button" class="btn btn-primary action-btn" onclick="SaveData();">Save</button>
            <button type="button" class="btn btn-primary action-btn" onclick="window.open('country-list.php','_self');">Cancel</button>
        </div>
    </div>
</section><!--/#registration-->

<pre></pre>

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
    var objCountry = <?php echo json_encode($countryData); ?>;

    $('#country_id').on('change', function() {
        var selectValue = $(this).find(":selected").val();
        //alert(selectValue);
        var countryName = $.map(objCountry,function(value){
            return value.CountryID == selectValue? value.CountryName : '';
        })
        for (var i = 0; i < objCountry.length; i++) {
            if(countryName[i] != '')
            {
                $('#country_name').val(countryName[i]);
            }
        }
    });

    function SaveData()
    {
        with(document.CountryForm)
        {
            action = 'country-edit-select.php';
            method = 'post';
            submit();
        }
    }
//-->
</script>
<!-- Placed at the end of the document so the pages load faster -->

</body>
</html>



