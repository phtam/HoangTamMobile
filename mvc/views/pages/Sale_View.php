<script language="javascript">
	function deleteConfirm(){
		if(confirm("Do you want to delete?")){
			return true;
		}
		else{
			return false;
		}
	}
</script>

<script language="javascript">
		$(document).ready(function() {
    var table = $('#tablesale').DataTable( {
        responsive: true,
            "lengthMenu": [[10, 2, 5, 15, 20, 25, 30, -1], [10, 2, 5, 15, 20, 25, 30, "All"]]
    } );
    new $.fn.dataTable.FixedHeader( table );
} );		
</script>


<div id="breadcrumb" class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="breadcrumb-header">Manage Sale</h3>
			</div>
		</div>
	</div>
</div>

<h3 style="color:green">
	<?php if(isset($data["notice"])){
			echo $data["notice"];
		}
	?>
</h3>

<h3 style="color:red">
	<?php if(isset($data["error"])){
			echo $data["error"];
		}
	?>
</h3>


<div class="container-fluid">
    <p>
        <a href="<?php echo $data["url"]; ?>Sale/display_Add_Sale"><img src="<?= $data["url"]; ?>public/icons/add.png"> Create New</a>
    </p>
	<table id="tablesale" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
			<tr>
					<th>	<strong>Sale ID</strong>		</th>
					<th>	<strong>Sale Name</strong>		</th>
					<th>	<strong>Content</strong>		</th>
					<th>	<strong>Start Date</strong>		</th>
					<th>	<strong>End Date</strong>		</th>
					<th>	<strong>Image</strong>			</th>
					<th>	<strong>Edit</strong>			</th>
					<th>	<strong>Delete</strong>			</th>
			</tr>
        </thead>

		<tbody>
        <?php                 
			$result = $data["list"];
			while( $row=mysqli_fetch_array( $result, MYSQLI_ASSOC )){
        ?>
			<tr>
				<td>	<?php echo $row["sal_id"] ?>				</td>
				<td>	<?php echo $row["sal_name"] ?>				</td>
				<td>	<?php echo $row["sal_content"] ?>			</td>
				<td>	<?php echo $row["sal_start_date"] ?>		</td>
				<td>	<?php echo $row["sal_end_date"] ?>			</td>
				<td>	<img src="<?php echo $data["url"]; ?>public/images_sale/<?php echo $row["sal_poster"]; ?>" style="max-width: 80px"/></td>

				
				<td align='center' >
				<a href="<?php echo $data["url"]; ?>Sale/display_Update_Sale/<?php echo $row['sal_id']; ?>">
				<img src="<?= $data["url"]; ?>public/icons/edit.png"></a>
				</td>
				
				<td align='center' >
				<a onclick="return deleteConfirm()" href="<?php echo $data["url"]; ?>Sale/Delete_Sale/<?php echo $row['sal_id']; ?>">
				<img src="<?= $data["url"]; ?>public/icons/delete.png"></a>
				</td>
        	</tr>
        <?php } ?>
        </tbody>
</table> <br> 
</div>

