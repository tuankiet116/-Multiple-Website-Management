<? include("config_security.php"); ?>
<?
$record_id 		= getValue("record_id", "arr", "POST", array());
$field_id		= "mod_id";
$fs_table		= "modules";

$errorMsg = "";
//Call Class generate_form();
$myform = new generate_form();

$myform->add("mod_name","mod_name",0,0,"",0,"",0,"Bạn chưa nhập tiêu đề bài viết");
$myform->add("mod_path","mod_path",0,0,"",0,"",0,"");
$myform->add("mod_listname","mod_listname",0,0,"",0,"",0,"");
$myform->add("mod_listfile","mod_listfile",0,0,"",0,"",0,"");
$myform->add("mod_order","mod_order",1,0,0,0,"",0,"Bạn chưa nhập ngày đăng tin");
//Add table
$myform->addTable($fs_table);

$iQuick = getValue("iQuick","str","POST","");
if ($iQuick == "update"){
	$errorMsg	='';
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex 	= new db_execute($myform->generate_insert_SQL());
		unset($db_ex);
	}
	redirect($_SERVER['REQUEST_URI']);
}
//add form for javacheck
$myform->addFormname("add_new");
//add more javacode
$myform->evaluate();
$myform->checkjavascript();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Add New</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="<?=$fs_stype_css?>" rel="stylesheet" type="text/css">
<link href="<?=$fs_template_css?>" rel="stylesheet" type="text/css">
<link href="../../resource/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="../../resource/css/style.css" rel="stylesheet" type="text/css">

<style type="text/css">
	input.form{
		height: auto;
	}
</style>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<?=template_top("Cấu hình module")?>
	<? /*---------Body------------*/ ?>
		<form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
			<input type="hidden" name="iQuick" value="update">
			<table class="table table_border_none" cellpadding="3" cellspacing="0">
				<tr>
					<td colspan="2" class=""><h4>Thêm mới module</h4></td>
				</tr>
				<tr>
					<td class="textBold" width="120">Tên module</td>
					<td><input type="text" class="form-control" name="mod_name" id="mod_name" value="<?=$mod_name?>"></td>
				</tr>
				<tr>
					<td class="textBold">Thư mục</td>
					<td><input type="text" class="form-control" name="mod_path" id="mod_path" value="<?=$mod_path?>"></td>
				</tr>
				<tr>
					<td class="textBold">Thứ tự</td>
					<td><input type="text" class="form-control" name="mod_order" id="mod_order" value="<?=$mod_order?>"></td>
				</tr>
				<tr>
					<td class="textBold">Tiêu đề</td>
					<td><input type="text" class="form-control" name="mod_listname" id="mod_listname" value="<?=$mod_listname?>" style="width: 400px;"></td>
				</tr>
				<tr>
					<td class="textBold">URL file</td>
					<td><input type="text" class="form-control" name="mod_listfile" id="mod_listfile" value="<?=$mod_listfile?>" style="width: 400px;"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" value="Thêm mới module" class="btn btn-info btn-sm" /></td>
				</tr>
			</table>
		</form>
		<form action="quickeditmodule.php" method="post">
		<input type="hidden" name="iQuick" value="update">
		<table cellpadding="3" cellspacing="0" align="left" width="100%" class="table table_border_none">
			<?
			$db_module = new db_query("SELECT * FROM modules ORDER BY mod_order ASC");
			$i 	= 0;
			while($mod 	= mysqli_fetch_assoc($db_module->result)){
				if(file_exists("../../modules/" . $mod["mod_path"] . "/inc_security.php")){
					require_once("../../modules/" . $mod["mod_path"] . "/inc_security.php");
					$i++;
					?>
					<tbody>
						<tr>
							<td width="10" class="bold"><?=$i?></td>
							<td>
								<b><?=$mod["mod_name"]?></b> <input type="submit" value="Save" class="btn btn-xs btn-info"/>
								<input type="button" class="btn btn-xs btn-danger" value="Delete" onClick="if (confirm('Bạn muốn xóa?')) { window.location.href='deletemodule.php?record_id=<?=$mod["mod_id"];?>&returnurl=<?=base64_encode(getURL())?>'}">
							</td>
						</tr>
					</tbody>
					<tbody id="list_<?=$mod["mod_id"]?>">
						<tr>
							<td>&nbsp;</td>
							<td colspan="3">
								<input type="hidden" name="record_id[]" value="<?=$mod["mod_id"]?>">
								<table cellpadding="3" cellspacing="0" class="table table_border_none">
									<tr>
										<td class="textBold" width="120">Module id</td>
										<td><?=$mod["mod_id"]?></td>
									</tr>
									<tr>
										<td class="textBold">Tên module</td>
										<td><input type="text" class="form-control" name="mod_name<?=$mod["mod_id"]?>" id="mod_name<?=$mod["mod_id"]?>" value="<?=$mod["mod_name"]?>"></td>
									</tr>
									<tr>
										<td class="textBold">Thư mục</td>
										<td><input type="text" class="form-control" name="mod_path<?=$mod["mod_id"]?>" id="mod_path<?=$mod["mod_id"]?>" value="<?=$mod["mod_path"]?>"></td>
									</tr>
									<tr>
										<td class="textBold">Thứ tự</td>
										<td><input type="text" class="form-control" name="mod_order<?=$mod["mod_id"]?>" id="mod_order<?=$mod["mod_id"]?>" value="<?=$mod["mod_order"]?>"></td>
									</tr>
									<tr>
										<td class="textBold">Tiêu đề</td>
										<td><input type="text" class="form-control" name="mod_listname<?=$mod["mod_id"]?>" id="mod_listname<?=$mod["mod_id"]?>" value="<?=$mod["mod_listname"]?>" style="width: 400px;"></td>
									</tr>
									<tr>
										<td class="textBold">URL file</td>
										<td><input type="text" class="form-control" name="mod_listfile<?=$mod["mod_id"]?>" id="mod_listfile<?=$mod["mod_id"]?>" value="<?=$mod["mod_listfile"]?>" style="width: 400px;"></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
					<?
				unset($module_id);
				}
			}
			?>
		</table>
		</form>
	<? /*---------Body------------*/ ?>
<?=template_bottom() ?>
</body>
</html>