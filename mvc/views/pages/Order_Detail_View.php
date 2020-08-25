<script language="javascript">
function CheckOut() {
    if (confirm("Do you want to confirm payment for the order?")) {
        return true;
    } else {
        return false;
    }
}
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
    echo $data["notice"];} ?>
</h3>


<div class="section">
    <div class="container">
        <div class="row">

            <div class="col-md-7">
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Customer Information</h3>
                    </div>
                    <?php while($row = mysqli_fetch_array($data["customer"])){ ?>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="" class="col-md-3 label-control">Username: </label>
                            <div class="col-md-9">
                                <input class="input" type="text" value="<?= $row["cus_username"]; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 label-control">Name: </label>
                            <div class="col-md-9">
                                <input class="input" type="text" value="<?= $row["cus_name"]; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 label-control">Email: </label>
                            <div class="col-md-9">
                                <input class="input" type="text" value="<?= $row["cus_email"]; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 label-control">Address: </label>
                            <div class="col-md-9">
                                <input class="input" type="text" value="<?= $row["cus_address"]; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 label-control">Phone number: </label>
                            <div class="col-md-9">
                                <input class="input" type="text" value="<?= $row["cus_phone_number"]; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 label-control">Birthdate: </label>
                            <div class="col-md-9">
                                <input class="input" type="text" value="<?= $row["cus_birthdate"]; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 label-control">Identity card: </label>
                            <div class="col-md-9">
                                <input class="input" type="text" value="<?= $row["cus_identity_card"]; ?>" readonly>
                            </div>
                        </div>

                    </form>
                    <?php } ?>
                </div>
                <div class="col-sm-3"></div>
                <a href="<?= $data["url"]; ?>Order" class="primary-btn order-submit col-sm-9">Back</a>
            </div>


            <div class="col-md-5 order-details">
                <div class="section-title text-center">
                    <h3 class="title">YOUR ORDER</h3>
                </div>
                <div class="order-summary">
                    <div class="order-col">
                        <div><strong>PRODUCT</strong></div>
                        <div><strong>TOTAL</strong></div>
                    </div>
                    <div class="order-products">
                        <?php $total = 0; ?>
                        <?php while($row = mysqli_fetch_array($data["list"])){ ?>
                        <div class="order-col">
                            <div><?= $row["pro_ord_quantity"]; ?>x <?= $row["pro_name"]; ?></div>
                            <div><?= $row["pro_ord_total"]; ?> VND</div>
                            <?php $total += $row["pro_ord_total"];  ?>
                        </div>
                        <?php } ?>

                    </div>
                    <div class="order-col">
                        <div>Payments</div>
                        <?php while($row = mysqli_fetch_array($data["payment"])){ ?>
                        <div><strong><?= $row["pay_name"] ?></strong></div>
                        <?php } ?>
                    </div>
                    <div class="order-col">
                        <div><strong>TOTAL</strong></div>
                        <div><strong class="order-total"><?= $total; ?> VND</strong></div>
                    </div>

                    <div class="order-col">
                        <div><strong>Status</strong></div>
                        <?php while($row = mysqli_fetch_array($data["checkout"])){ ?>
                        <div>
                            <?php  if($row["ord_status"]==0){echo "Unpaid";}else{echo "Paid";} ?>
                        </div>

                    </div>
                </div>
                <?php if($row["ord_date_shipped"]== '0000-00-00 00:00:00'){ ?>
                <a href="<?php echo $data["url"]; ?>Order/Ship/<?= $row["ord_id"]; ?>"
                    class="primary-btn order-submit">Delivery</a>
                <?php } } ?>
            </div>
        </div>
    </div>
</div>
