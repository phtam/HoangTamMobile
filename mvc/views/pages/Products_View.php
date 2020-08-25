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
    var table = $('#tablesalomon').DataTable( {
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
                <h2 class="breadcrumb-header">Manage Products</h3>
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
        <a href="<?php echo $data["url"]; ?>Products/display_Add_Product"><img src="<?= $data["url"]; ?>public/icons/add.png"> Create New</a>
    </p>

    <table id="tablesalomon" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>    <strong>Product ID</strong>         </th>
                <th>    <strong>Name</strong>               </th>
                <th>    <strong>Price</strong>              </th>
                <th>    <strong>Old Price</strong>          </th>
                <th>    <strong>Short Describe</strong>     </th>
                <th>    <strong>Describe</strong>           </th>
                <th>    <strong>Quantity</strong>           </th>
                <th>    <strong>Brand</strong>              </th>
                <th>    <strong>Sale</strong>               </th>
                <th>    <strong>Image</strong>              </th>
                <th>    <strong>Edit</strong>               </th>
                <th>    <strong>Delete</strong>             </th>
            </tr>
        </thead>

        <tbody>
        <?php                 
            $result = $data["list"];
            while( $row=mysqli_fetch_array( $result, MYSQLI_ASSOC )){
        ?>
            <tr>
                <td ><?php echo $row["pro_id"] ?></td>
                <td><?php echo $row["pro_name"] ?></td>
                <td><?php echo $row["pro_price"] ?></td>
                <td><?php echo $row["pro_old_price"] ?></td>
                <td><?php echo $row["pro_short_desc"] ?></td>
                <td><?php echo $row["pro_date"] ?></td>
                <td><?php echo $row["pro_quantity"] ?></td>
                <td><?php echo $row["brd_name"] ?></td>
                <td><?php echo $row["sal_name"] ?></td>

                
                <td align='center' class='cotNutChucNang'>
                <a href="<?php echo $data["url"]; ?>Products/display_Upload_Image/<?php echo $row['pro_id']; ?>">
                <img src="<?= $data["url"]; ?>public/icons/add_image.png"></a>
                </td>

                <td align='center' class='cotNutChucNang'>
                <a href="<?php echo $data["url"]; ?>Products/display_Update_Product/<?php echo $row['pro_id']; ?>">
                <img src="<?= $data["url"]; ?>public/icons/edit.png"></a>
                </td>
                
                <td align='center' class='cotNutChucNang'>
                <a onclick="return deleteConfirm()" href="<?php echo $data["url"]; ?>Products/delete_Product/<?php echo $row['pro_id']; ?>">
                <img src="<?= $data["url"]; ?>public/icons/delete.png"></a>
                </td>
        </tr>
        <?php }  ?>
        </tbody>

    </table>  <br>
</div>

