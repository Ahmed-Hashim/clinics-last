<?php
	$PAGE_TITLE = 'My site CP';
	$PG_title = 'My site CP';
	$PG_desc = 'desc';
	$PG_keywords = 'keywords';
	$PG_author = 'author';
	$pager = 1;
	$sub_page = 1;
	$has_sub = true;
	$has_slider = false;
session_start();

if (!isset($_SESSION['username']) && $_SESSION['username'] != 'sb_admin') {

	header('location:../index.php');
}
$no_session = true;
$main_pointer = '../../';
	require_once('../../bootstrap/app_config.php');
	
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<?php
	include('app/includes.php');
?>
</head>
<style>
	.alert-style{
		padding: 20px;
	    background: green;
	    color: #fff;
	    text-align: right;
	}
</style>
<body id="bodyer">
<?php
	include('app/header.php');
	//PAGE DATA START
	//-----------------------------
?>
	<h1 class="main-page-title">Clinics</h1>
	<section class="page-btns-holder">
		<a href="page_hospitals_new.php"><button class="page-btn" type="button">New</button></a>
	</section>
	<section class="page-content">
		<?php
		if (isset($_SESSION['message'])) {
			echo $_SESSION['message'];
		} else {
			echo $_SESSION['message'];
		}
		unset($_SESSION['message']);
		?>
		<table>
			<thead>
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>User</th>
					<th>Clinic ID</th>
					<th>Options</th>
				</tr>
			</thead>
			<tbody>
<?php
$qq = "SELECT * FROM `clinics`";
$qqEE = mysqli_query($KONN, $qq);
if(mysqli_num_rows($qqEE) > 0){
	$counter = 1;
	while($row = mysqli_fetch_assoc($qqEE)){
		
?>
				<tr id="fam_<?=$row['clinic_id']; ?>">
					<td><?=$counter++; ?></td>
					<td><?=$row['clinic_name']; ?></td>
					<td>clin_<?=$row['clinic_id']; ?></td>
					<td><?=$row['clinic_id']; ?></td>
					<td>
						<a href="page_hospitals_edit.php?pf_id=<?=$row['clinic_id']; ?>"><i class="fa fa-edit" area-hidden="true"></i></a>
						<?php 
							if ($row['is_deleted'] == 0) {
								echo '<a href="page_hospitals_delete.php?pf_id='.$row['clinic_id'].'"><i class="fa fa-trash" area-hidden="true"></i></a>';
							}else{
								echo '<a href="page_hospitals_un_delete.php?pf_id='.$row["clinic_id"].'"><i class="fa fa-external-link" area-hidden="true"></i></a>';
							}
						?>
						
					</td>
				</tr>
<?php
	}
} else {
?>
				<tr>
					<td colspan="5">No DATA FOUND</td>
				</tr>
<?php
}
?>
			</tbody>
		</table>
		
<script>
function del_ths(IDD){
	var aa = confirm('Are You Sure ?, This will remove selected family and all of its catageories and models');
	if(aa == true){
		
		aa = confirm('ACTION CANNOT BE UNDONE, Continue ?');
		if(aa == true){
			$.ajax({
				url      :"api/settings/remove_items.php",
				data     :{ 'clinic_id': IDD },
				dataType :"html",
				type     :'POST',
				success  :function(data){
						dt_arr = data.split('|');
						dt_res = parseInt(dt_arr[0]);
						if(dt_res == 1){
							alert(dt_arr[1]);
							$('#fam_' + IDD).remove();
						} else {
							alert(dt_arr[1]);
						}
					},
				error    :function(){
					alert('Data Error No: 5467653');
					},
				});
		}
	}
	
}
</script>
		
		
	</section>
<?php
	//-----------------------------
	//PAGE DATA END
	include('app/footer.php');
?>
</body>
</html>