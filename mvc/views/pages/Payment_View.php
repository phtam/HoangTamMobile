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

<!-- Datatable -->
<script language="javascript">
		$(document).ready(function() {
    var table = $('#tablepay').DataTable( {
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
                <h2 class="breadcrumb-header">Manage Payments</h3>
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


<div class="container-fluid">
    <p>
        <a href="<?php echo $data["url"]; ?>Payments/display_Add_Payment"><img src="<?= $data["url"]; ?>public/icons/add.png"> Create New</a>
    </p>
    <table id="tablepay" class="table table-striped table-bordered" cellspacing="0" width="100%">
        
        <thead>
            <tr>
                <th>    <strong>Payment ID</strong>     </th>
                <th>    <strong>Payment Name</strong>   </th>
                <th>    <strong>Edit</strong>           </th>
                <th>    <strong>Delete</strong>         </th>
            </tr>
        </thead>

        <tbody>
        <?php                 
            $result = $data["list"];
            while( $row=mysqli_fetch_array( $result, MYSQLI_ASSOC )){
        ?>
            <tr>
                <td ><?php echo $row["pay_id"] ?></td>
                <td><?php echo $row["pay_name"] ?></td>

                <td align='center'>
                <a href="<?php echo $data["url"]; ?>Payments/display_Update_Payment/<?= $row['pay_id']; ?>">
                <img src="<?= $data["url"]; ?>public/icons/edit.png"></a>
                </td>
                
                <td align='center'>
                <a onclick="return deleteConfirm()" href="<?php echo $data["url"]; ?>Payments/delete_Payment/<?= $row['pay_id']; ?>">
                <img src="<?= $data["url"]; ?>public/icons/delete.png"></a>
                </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>  <br>
</div>

