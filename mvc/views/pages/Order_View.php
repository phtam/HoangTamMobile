<script language="javascript">
            function Confirm(){
                if(confirm("Do you want to confirm payment for the order?")){
                    return true;
                }
                else{
                    return false;
                }
            }
</script>

<script language="javascript">
		$(document).ready(function() {
    var table = $('#tableorder').DataTable( {
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
                <h2 class="breadcrumb-header">Manage Order</h3>
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

    <table id="tableorder" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>    <strong>Order ID</strong>           </th>
                <th>    <strong>Date Created</strong>       </th>
                <th>    <strong>Date Shipped</strong>       </th>
                <th>    <strong>Address Shipped</strong>    </th>
                <th>    <strong>Status</strong>             </th>
                <th>    <strong>Payments</strong>           </th>
                <th>    <strong>Username</strong>           </th>
                <th>    <strong>Name</strong>               </th>
                <th>    <strong>Delivery</strong>           </th>
                <th>    <strong>Pay</strong>                </th>
            </tr>
        </thead>

        <tbody>
            <?php                  
                $result = $data["list"];
                while( $row=mysqli_fetch_array( $result, MYSQLI_ASSOC )){
            ?>
            <tr>
                <td><?= $row["ord_id"] ?></td>
                <td><?= $row["ord_date_create"] ?></td>
                <td>
                    <?php if($row["ord_date_shipped"] == '0000-00-00 00:00:00') {echo "Not delivered";}else{echo $row["ord_date_shipped"];} ?>
                </td>
                <td><?= $row["ord_address_shipped"] ?></td>
                <td><?php if($row["ord_status"] == 0) {echo "Not paid";}else{echo "Paid";} ?></td>
                <td><?= $row["pay_name"] ?></td>
                <td><?= $row["cus_username"] ?></td>
                <td><?= $row["cus_name"] ?></td>

                
                <td align='center'>
                    <a href="<?= $data["url"]; ?>Order/display_Detail/<?= $row["ord_id"]; ?>">
                    <img src="<?= $data["url"]; ?>public/icons/ship.png"></a>
                </td>

                <td align='center'>
                    <?php if($row["ord_status"] == 0){ ?>
                    <a onclick="return Confirm()" href="<?= $data["url"]; ?>Order/Pay/<?= $row['ord_id']; ?>">
                    <img src="<?= $data["url"]; ?>public/icons/pay.png"></a>
                </td>
                <?php } else{ echo "Paid"; } ?>
        
            </tr>
            <?php  }  ?>
        </tbody>
    </table>  <br>
</div>

