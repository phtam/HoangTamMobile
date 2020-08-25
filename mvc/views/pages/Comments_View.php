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
    var table = $('#tablecomment').DataTable( {
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
                    <h2 class="breadcrumb-header">Manage Comment</h3>
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
    <table id="tablecomment" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>    <strong>ID</strong>         </th>
                <th>    <strong>Name</strong>       </th>
                <th>    <strong>Email</strong>      </th>
                <th>    <strong>Content</strong>    </th>
                <th>    <strong>Date</strong>       </th>
                <th>    <strong>Product</strong>    </th>
                <th>    <strong>Delete</strong>     </th>
            </tr>
        </thead>

        <tbody>
            <?php                  
                $result = $data["list"];
                while( $row=mysqli_fetch_array( $result, MYSQLI_ASSOC )){
            ?>
                <tr>
                    <td>    <?php echo $row["cmt_id"] ?>         </td>
                    <td>    <?php echo $row["cmt_name"] ?>      </td>
                    <td>    <?php echo $row["cmt_email"] ?>      </td>
                    <td>    <?php echo $row["cmt_content"] ?>    </td>
                    <td>    <?php echo $row["cmt_date"] ?>   </td>
                    <td>    <?php echo $row["pro_name"] ?>        </td>
                    <td align='center' class='cotNutChucNang'>
                    <a onclick="return deleteConfirm()" href="<?php echo $data["url"]; ?>Comments/delete_Comment/<?php echo $row['cmt_id']; ?>">
                    <img src="<?= $data["url"]; ?>public/icons/delete.png"></a>
                    </td>
                </tr>
            <?php  } ?>
        </tbody>
    </table><br>  
</div>

