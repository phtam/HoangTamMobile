<div id="breadcrumb" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="breadcrumb-header">Detail Your Order</h3>
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

<div class="section">
    <div class="container">
        <div class="row">

            <div class="col-md-7">
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Personal Information</h3>
                    </div>
                    <?php $cus = json_decode($data["customer"]); ?>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="" class="col-md-3 label-control">Username: </label>
                            <div class="col-md-9">
                                <input class="input" type="text" value="<?= $cus->username; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 label-control">Name: </label>
                            <div class="col-md-9">
                                <input class="input" type="text" value="<?= $cus->name; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 label-control">Email: </label>
                            <div class="col-md-9">
                                <input class="input" type="text" value="<?= $cus->email; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 label-control">Address: </label>
                            <div class="col-md-9">
                                <input class="input" type="text" value="<?= $cus->address; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 label-control">Phone Numer: </label>
                            <div class="col-md-9">
                                <input class="input" type="text" value="<?= $cus->phone_number; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 label-control">Birthdate: </label>
                            <div class="col-md-9">
                                <input class="input" type="text" value="<?= $cus->birthdate; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 label-control">Identity Card: </label>
                            <div class="col-md-9">
                                <input class="input" type="text" value="<?= $cus->identity_card; ?>" readonly>
                            </div>
                        </div>

                    </form>

                </div>

                <div class="col-sm-3"></div>
                <a href="<?= $data["url"]; ?>Home/display_The_Bills_Of_Customer" class="primary-btn order-submit col-sm-9">Back</a>
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
                            <div><?= $row["pro_ord_total"]; ?> đ</div>
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

                <?php } ?>
            </div>
        </div>
    </div>
</div>
