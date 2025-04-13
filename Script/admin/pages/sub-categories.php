<?php
require_once('../const/admin_dashboard.php');
?>
﻿<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title><?php echo WBName; ?> - Insurance Sub-Categories</title>
<meta name="description" content="Insurance Management System">
<meta name="author" content="Rahat">
<base href="../">
<link rel="shortcut icon" href="assets/media/favicons/favicon.ico">
<link rel="stylesheet" id="css-main" href="assets/css/dashmix.min-5.4.css">
<link rel="stylesheet" href="assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">
<link type="text/css" rel="stylesheet" href="assets/loader/waitMe.css">
<?php if (Theme !== "") { print '<link rel="stylesheet" id="css-theme" href="assets/css/themes/'.Theme.'">'; } ?>
</head>
<body>
<div id="page-container" class="sidebar-o <?php echo Header; ?> enable-page-overlay side-scroll <?php echo Sidebar; ?> <?php echo PageHeader; ?> <?php echo Sidebar_Min; ?> <?php echo Sidebar_Pos; ?> <?php echo Header; ?> <?php echo MainContent; ?>">
<?php require_once('main_nav.php'); ?>

<main id="main-container">

<div class="content">
<?php require_once('../const/check-reply.php'); ?>
<div class="block block-rounded">
<div class="block-header block-header-default">
<h3 class="block-title">
Insurance Sub-Categories
</h3>
<button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="modal" data-bs-target="#modal-default-fadein" data-bs-keyboard="false" data-bs-backdrop="static">
<i class="fa fa-plus"></i> New
</button>&nbsp;
<button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="modal" data-bs-target="#modal-default-fadein3" data-bs-keyboard="false" data-bs-backdrop="static">
<i class="fa fa-upload"></i> Import
</button>
</div>
<div class="block-content block-content-full">
<table class="table table-bordered table-vcenter js-dataTable-buttons">
<thead>
<tr>
<th>Sub-Category Name</th>
<th>Category</th>
<th style="width: 5%;">Status</th>
<th style="width: 5%;"></th>
</tr>
</thead>
<tbody>

<?php
try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_insuarance_sub_category LEFT JOIN tbl_insuarance_category ON tbl_insuarance_sub_category.category = tbl_insuarance_category.id ORDER BY tbl_insuarance_sub_category.name");
$stmt->execute();
$result = $stmt->fetchAll();

foreach($result as $row)
{
?>
<tr>
<td class="">
<?php echo $row[2]; ?>
</td>
<td class="">
<?php echo $row[5]; ?>
</td>
<td class="">
<?php
switch ($row[3]) {
case '1':
?><span class="badge bg-success">Active</span><?php
break;

default:
?><span class="badge bg-danger">Inactive</span><?php
}
?>
</td>
<td class="text-center">
<div class="btn-group">
<button onclick="set_cat('<?php echo $row[0]; ?>','<?php echo $row[1]; ?>','<?php echo $row[2]; ?>','<?php echo $row[3]; ?>');" type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="modal" data-bs-target="#modal-default-fadein2" data-bs-keyboard="false" data-bs-backdrop="static">
<i class="fa fa-pencil-alt"></i>
</button>
<a class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" onclick="return confirm('Are you sure you want to delete <?php echo $row[2]; ?> sub-category?');" href="admin/core/drop-sub-category?id=<?php echo $row[0]; ?>">
<i class="fa fa-trash-can"></i>
</a>
</div>
</td>
</tr>
<?php
}

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}
?>



</tbody>
</table>
</div>
</div>
</div>

<div class="modal fade" id="modal-default-fadein" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<form id="app_frm" action="admin/core/new_sub_category" method="POST" autocomplete="off">
<div class="modal-header">
<h5 class="modal-title">New Sub-Category</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body pb-1">

<div class="row mb-2">
<label class="col-sm-4 col-form-label">Category</label>
<div class="col-sm-8">
<select  name="category" required class="form-control form-control-alt">
<option selected disabled value="">Choose</option>
<?php
try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$stmt = $conn->prepare("SELECT * FROM tbl_insuarance_category ORDER BY name");
$stmt->execute();
$result = $stmt->fetchAll();

foreach($result as $row)
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
<?php
}
}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}
?>
</select>
</div>
</div>

<div class="row mb-2">
<label class="col-sm-4 col-form-label">Sub-Category Name</label>
<div class="col-sm-8">
<input class="form-control form-control-alt" name="name" required type="text" placeholder="Enter Sub-Category Name">
</div>
</div>

<div class="row mb-2">
<label class="col-sm-4 col-form-label">Status</label>
<div class="col-sm-8">
<select  name="status" required class="form-control form-control-alt">
<option selected disabled value="">Choose</option>
<option value="1">Active</option>
<option value="0">Inactive</option>
</select>
</div>
</div>
</div>
<input type="hidden" name="submit" value="1">
<div class="modal-footer">
<button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">Close</button>
<button id="sub_btn" type="submit" class="btn  btn-primary">Save changes</button>
</div>
</form>
</div>
</div>
</div>

<div class="modal fade" id="modal-default-fadein2" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein2" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<form id="app_frm2" action="admin/core/update_sub_category" method="POST" autocomplete="off">
<div class="modal-header">
<h5 class="modal-title">Edit Sub-Category</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body pb-1">

<div class="row mb-2">
<label class="col-sm-4 col-form-label">Category</label>
<div class="col-sm-8">
<select id="category" name="category" required class="form-control form-control-alt">
<option selected disabled value="">Choose</option>
<?php
try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$stmt = $conn->prepare("SELECT * FROM tbl_insuarance_category ORDER BY name");
$stmt->execute();
$result = $stmt->fetchAll();

foreach($result as $row)
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
<?php
}
}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}
?>
</select>
</div>
</div>

<div class="row mb-2">
<label class="col-sm-4 col-form-label">Sub-Category Name</label>
<div class="col-sm-8">
<input id="name" class="form-control form-control-alt" name="name" required type="text" placeholder="Enter Sub-Category Name">
</div>
</div>

<div class="row mb-2">
<label class="col-sm-4 col-form-label">Status</label>
<div class="col-sm-8">
<select id="status" name="status" required class="form-control form-control-alt">
<option selected disabled value="">Choose</option>
<option value="1">Active</option>
<option value="0">Inactive</option>
</select>
</div>
</div>
</div>
<input id="id" type="hidden" name="id" value="">
<input type="hidden" name="submit" value="1">
<div class="modal-footer">
<button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">Close</button>
<button id="sub_btn2" type="submit" class="btn  btn-primary">Save changes</button>
</div>
</form>
</div>
</div>
</div>


<div class="modal fade" id="modal-default-fadein3" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein3" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<form id="app_frm3" enctype="multipart/form-data" action="admin/core/import_sub_categories" method="POST" autocomplete="off">
<div class="modal-header">
<h5 class="modal-title">Import Sub-Categories</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body pb-1">
<div class="row">
<div class="col-lg-12 mb-2">
<div class="alert alert-info">
Download excel template from <a download href="templates/import_sub_categories.xlsx" class="alert-link">here</a>, fill sub-category information then upload it through the form below.
</div>
</div>
</div>

<div class="row mb-2">
<label class="col-sm-12 col-form-label">Category</label>
<div class="col-sm-12">
<select id="category" name="category" required class="form-control form-control-alt">
<option selected disabled value="">Choose</option>
<?php
try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$stmt = $conn->prepare("SELECT * FROM tbl_insuarance_category ORDER BY name");
$stmt->execute();
$result = $stmt->fetchAll();

foreach($result as $row)
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
<?php
}
}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}
?>
</select>
</div>
</div>

<div class="row mb-2">
<label class="col-sm-12 col-form-label">Excel File</label>
<div class="col-sm-12">
<input required accept=".xlsx" type="file" name="file" class="form-control" accept="application/msexcel">
</div>
</div>

</div>
<input type="hidden" name="submit" value="1">
<div class="modal-footer">
<button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">Close</button>
<button id="sub_btn3" type="submit" class="btn  btn-primary">Upload</button>
</div>
</form>
</div>
</div>
</div>

</main>

</div>
<script src="assets/js/lib/jquery.min.js"></script>
<script src="assets/js/dashmix.app.min-5.4.js"></script>
<script src="assets/loader/waitMe.js"></script>
<script src="assets/js/forms.js"></script>
<script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="assets/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
<script src="assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
<script src="assets/js/plugins/datatables-buttons-jszip/jszip.min.js"></script>
<script src="assets/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js"></script>
<script src="assets/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js"></script>
<script src="assets/js/plugins/datatables-buttons/buttons.print.min.js"></script>
<script src="assets/js/plugins/datatables-buttons/buttons.html5.min.js"></script>
<script src="assets/js/pages/be_tables_datatables.min.js"></script>
<script>
function set_cat(id, category, name, status) {
document.getElementById('id').value = id;
document.getElementById('category').value = category;
document.getElementById('name').value = name;
document.getElementById('status').value = status;
}
</script>
</body>
</html>
