<script language="javascript">
            function deleteConfirm(){
                if(confirm("Bạn có chắc chắn muốn xóa!")){
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
                <h2 class="breadcrumb-header">Manage Customer</h3>
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
        <a href="<?php echo $data["url"]; ?>Customers/display_Add_Customer"><img src="<?= $data["url"]; ?>public/icons/add.png"> Create New</a>
    </p>
    <table id="tablesalomon" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>    <strong>Username</strong>       </th>
                <th>    <strong>Name</strong>           </th>
                <th>    <strong>Gender</strong>         </th>
                <th>    <strong>Address</strong>        </th>
                <th>    <strong>Phone number</strong>   </th>
                <th>    <strong>Email</strong>          </th>
                <th>    <strong>Birthdate</strong>      </th>
                <th>    <strong>Identity card</strong>  </th>
                <th>    <strong>Status</strong>         </th>
                <th>    <strong>Role</strong>           </th>
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
                <td>    <?php echo $row["cus_username"] ?>                                                    </td>
                <td>    <?php echo $row["cus_name"] ?>                                                        </td>
                <td>    <?php if($row["cus_gender"]==0){echo "Male";}else{echo "Female";} ?>                  </td>
                <td>    <?php echo $row["cus_address"] ?>                                                     </td>
                <td>    <?php echo $row["cus_phone_number"] ?>                                                </td>
                <td>    <?php echo $row["cus_email"] ?>                                                       </td>
                <td>    <?php echo $row["cus_birthdate"] ?>                                                   </td>
                <td>    <?php echo $row["cus_identity_card"] ?>                                               </td>
                <td>    <?php if($row["cus_status"]==1) { echo "Not activated"; } else {echo "Activated";} ?> </td>
                <td>    <?php if($row["cus_admin"]==1) { echo "User"; } else {echo "Admin";} ?>               </td>

                <td align='center' class='cotNutChucNang'>
                    <a href="<?php echo $data["url"]; ?>Customers/display_Update_Customer/<?php echo $row['cus_username']; ?>">
                    <img src="<?= $data["url"]; ?>public/icons/edit.png"></a>
                </td>
                
                <td align='center' class='cotNutChucNang'>
                <a onclick="return deleteConfirm()" href="<?php echo $data["url"]; ?>Customers/delete_Customer/<?php echo $row['cus_username']; ?>">
                <img src="<?= $data["url"]; ?>public/icons/delete.png"></a>
                </td>
            </tr>
        <?php  }  ?>
        </tbody>
    </table>  <br>
</div>

