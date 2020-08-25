<div id="breadcrumb" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="breadcrumb-header">YOUR ORDER</h3>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <table id="tableorder" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><strong>Criteria</strong></th>
                <th><strong>Date Created</strong></th>
                <th><strong>Date Shipped</strong></th>
                <th><strong>Address Shipped</strong></th>
                <th><strong>Status</strong></th>
                <th><strong>Payments</strong></th>
                <th><strong>Username</strong></th>
                <th><strong>Name</strong></th>
                <th><strong>Detail</strong></th>
            </tr>
        </thead>

        <tbody>
            <?php
                            
            $result = $data["list"];
            while( $row=mysqli_fetch_array( $result, MYSQLI_ASSOC )){  ?>
            <tr>
                <td><?= $row["ord_id"] ?></td>
                <td><?= $row["ord_date_create"] ?></td>
                <td><?php if($row["ord_date_shipped"] == '0000-00-00 00:00:00') {echo "Products are being shipped ...";}else{echo $row["ord_date_shipped"];} ?></td>
                <td><?= $row["ord_address_shipped"] ?></td>
                <td><?php if($row["ord_status"] == 0) {echo "Unpaid";}else{echo "Paid";} ?>
                </td>
                <td><?= $row["pay_name"] ?></td>
                <td><?= $row["cus_username"] ?></td>
                <td><?= $row["cus_name"] ?></td>


                <td align='center'>
                    <a href="<?= $data["url"]; ?>Home/display_Detail_The_Bill/<?= $row["ord_id"]; ?>">
                        <img src="<?= $data["url"]; ?>public/icons/view.png"></a>
                </td>

            </tr>
            <?php  }  ?>
        </tbody>
    </table><br>
</div>