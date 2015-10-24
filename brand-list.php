<!DOCTYPE html>
<?php
require_once './libs/csv-crud.php';
require_once './libs/breadcrumb.php';
$Id = $Name = $Action = ''; $data = array();

if(!empty($_POST)){
    if($_POST['hidDelete'] == 'single'){
        $Id = $_POST['hidCode'];
        DeleteDataByKey('./data/brand.csv','BrandID',$Id);
    }
    if($_POST['hidDelete'] == 'multi') {
        $data = $_POST['delCheck'];
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        die;
        foreach($data as $value)
        {
            DeleteDataByKey('./data/brand.csv','BrandID',$value);
        }
    }
}

$data = GetAllData('./data/brand.csv')
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
            array("label"=>"Khin Myat Noe","url"=>"kmn.php","active"=>"false"),
            array("label"=>"Brand Information","url"=>"brand-list.php","active"=>"true")
        ))
    );
    ?>
    </section>

    <div class="container" style="height:793px;">
        <form id="BrandList" name="BrandList">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Country Information</h3>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-sm-1" align="right">#</th>
                            <th class="col-sm-1"><label>ID</label></th>
                            <th class="col-sm-9"><label>Name</label></th>
                            <th class="col-sm-1" colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; foreach ($data as $value) { ?>
                        <tr>
                            <td align="left"><label><input type="checkbox" id="delCheck[]" name="delCheck[]" value="<?php echo $value["BrandID"] ?>"/>&nbsp;<?php echo($i);?></label></td>
                            <td align="left"><?php echo($value['BrandID']); ?></td>
                            <td align="left"><?php echo($value['BrandName']); ?></td>
                            <td align="right">
                                <button type="button" class="btn table-btn" onclick="show_edit('<?php echo( $value["BrandID"] ) ?>')">Edit</button>
                            </td>
                            <td align="right">
                                <button type="button" class="btn table-btn" onclick="delete_data('<?php echo( $value["BrandID"] ) ?>')">Delete</button>
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
            with(document.BrandList)
            {
                if(confirm("Are you sure to delete?"))
                {
                    hidCode.value = '';
                    hidDelete.value = 'multi';
                    action = 'brand-list.php';
                    method="post";
                    submit();
                }
            }
        }

        function delete_data(IdCode)
        {
            with(document.CountryList)
            {
                hidCode.value = IdCode;
                hidDelete.value = 'single';
                action = 'brand-list.php';
                method="post";
                submit();
            }
        }

        function show_edit(id)
        {
            window.open('brand-edit.php?id='+ id,'_self');
        }

        function show_entry()
        {
            window.open('brand-entry.php','_self');
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



