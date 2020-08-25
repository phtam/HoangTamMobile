<div id="breadcrumb" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Cart</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="#">Home</a></li>
                    <li class="active">Cart</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- SECTION -->
<div class="section">
    <!-- container -->
    
    <div class="container">
    <h3 style="color: red"><?php if(isset($data["error"])) echo $data["error"]; ?></h3>
    <h3 style="color: green"><?php if(isset($data["notice"])) echo $data["notice"]; ?></h3>
    <br>
        <!-- row -->
        <div class="row">
        
            <!-- Order Details -->
            <div class="col-md-12 order-details">
                <?php if(isset($_SESSION["cart"]) && $_SESSION["cart"] != null ){ ?>

                <div class="section-title text-center">
                    <h3 class="title">YOUR ORDER</h3>
                </div>

                    <table  class="table table-striped">
                    <thead>
                        <tr>
                            <th><strong>PRODUCT</strong></th>
                            <th><strong>PRODUCT NAME</strong></th>
                            <th><strong>PRICE</strong></th>
                            <th><strong>QUANTITY</strong></th>
                            <th><strong>TOTAL</strong></th>
                            <th><strong>DELETE</strong></th>
                        </tr>
                    </thead>

                    <tbody>
                    
                        
                            <?php  
                                foreach ($_SESSION["cart"] as $key => $value) { ?>
                                    <tr>
                                        <td><img src="<?= $data["url"]; ?>public/images/<?= $value["image"]; ?>" alt="" style="max-width: 60px"></td>
                                        <td><?= $value["name"]; ?></td>
                                        <td><script>document.write(formatNumber(<?= $value["price"]; ?>));</script> VND</td>
                                        <td><?= $value["qty"]; ?></td>
                                        <td><script>document.write(formatNumber(<?= $value["price"]*$value["qty"];  ?>));</script> VND</td>
                                        <td><a href="<?= $data["url"]; ?>Home/delete_product_in_cart/<?= $key ?>"><img src="<?= $data["url"]; ?>public/icons/bin.png" onclick="count_products();"/></a></td>
                                    </tr>
                            <?php  } ?>
                        

                    </tbody>	
                    </table>   

                    <hr> 

                    <div class="col-md-8"></div>   
                    <div class="col-md-2">
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="order-col">
                            <?php  ?>
                            <div><strong class="order-total"><script>document.write(formatNumber(<?php if(isset($_SESSION["total"])){ echo $_SESSION["total"]; } ?>));</script> VND</strong></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="order-col">
                            <div><strong>PAYMENTS</strong></div>
                        </div>
                    </div>

                    <div class="col-ms-6"></div>
                    <form method="POST" action="<?= $data["url"]; ?>Home/Order">
                    <div class="col-md-12 payment-method">
                        
                        <?php while($row =mysqli_fetch_array($data["payment"])){ ?>
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment_<?= $row["pay_id"]; ?>" value="<?= $row["pay_id"]; ?>">
                            <label for="payment_<?= $row["pay_id"]; ?>">
                                <span></span>
                                <?= $row["pay_name"]; ?>
                            </label>
                        </div>        
                        <?php } ?>
                        
                        
                    </div>

                    <div class="col-md-4">
                        <input type="submit" name="btnOrder" class="primary-btn order-submit" value="PLACE ORDER"/>
                    </div>
                    </form>
                <?php
                } else {
                    echo "<h3 class='section-title text-center'>Sorry, no results found!</h3>";
                } ?>    <!--/ end IF -->
                
                    
            </div> <!--/col-12-md  -->
                
        </div> <!--/row  -->
                
                
                
    </div> <!--/Container  -->
            
</div> <!--/SECTION  -->

        