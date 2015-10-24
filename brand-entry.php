<!DOCTYPE html>
<?php
    require_once './libs/csv-crud.php';
    require_once './libs/breadcrumb.php';
    require_once './libs/header.php';
    $Id = $Name = ''; $data = array();

    if(!empty($_POST))
    {
        $Id =  $_POST['brand_id'];
        $Name = $_POST['brand_name'];

        $checkData = GetDataByKey('./data/brand.csv','BrandID',$Id);
        if($checkData['BrandID']==$Id)
        {
            echo 'Duplicate';
        }else{
            $_savedata = array('BrandID'=>$Id, 'BrandName'=>$Name);
            InsertData('./data/brand.csv', $_savedata );
            redirect('brand-list.php');
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
            array("label"=>"Khin Myat Noe","url"=>"kmn.php","active"=>"false"),
            array("label"=>"Brand Information","url"=>"brand-list.php","active"=>"false"),
            array("label"=>"Brand Entry","url"=>"brand-entry.php","active"=>"true")
        )
    ));
    ?>
</section>


<section id="country-entry" class="container" style="height:793px;">
    <div  class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Country Entry Form</h3>
        </div>
        <div class="panel-body" align="center">
            <form id="BrandForm" name="BrandForm" role="form" class="form-horizontal">
                <div class="form-group">
                    <div class="input-group col-sm-3 form-inline">
                        <label for="country_id" class="input-group-addon">ID</label>
                        <input type="text" id="brand_id" name="brand_id" placeholder="Brand ID" class="form-control" value="<?php echo($Id); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group col-sm-3">
                        <label for="country_name" class="input-group-addon">Name</label>
                        <input type="text" id="brand_name" name="brand_name" placeholder="Brand Name" class="form-control" value="<?php echo($Name); ?>">
                    </div>
                </div>
                <br/>
            </form>
        </div>
        <div class="panel-footer" align="center">
            <button type="button" class="btn btn-primary action-btn" onclick="SaveData();">Save</button>&nbsp;
            <button type="button" class="btn btn-primary action-btn" onclick="window.open('brand-list.php','_self');">Cancel</button>
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
        with(document.BrandForm)
        {
            action = 'brand-entry.php';
            method = 'post';
            submit();
        }
    }
    //-->
</script>

<!-- Placed at the end of the document so the pages load faster -->

</body>
</html>



