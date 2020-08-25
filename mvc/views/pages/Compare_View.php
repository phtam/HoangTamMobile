<div id="breadcrumb" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="breadcrumb-header">Compare Products</h3>
            </div>
        </div>
    </div>
</div>

<h3>
    <?php if(isset($data["notice"])){
    echo $data["notice"];
}
?>
</h3>
<!--Form -->
<div class="container-fluid">
        <table id="tableorder" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <?php
            if(isset($data["pro1"]) && isset($data["pro2"])){
                $row1 = mysqli_fetch_array($data["pro1"]); 
                $row2 = mysqli_fetch_array($data["pro2"]);
            ?>
                <tr>
                    <th><strong>Criteria</strong></th>
                    <th align="center"><strong><?= $row1["pro_name"] ?></strong></th>
                    <th align="center"><strong><?= $row2["pro_name"] ?></strong></th>
                </tr>
            </thead>

            <tbody>
                
                <tr>
                    <td>Price</td>
                    <td><script>document.write(formatNumber(<?= $row1["pro_price"] ?>));</script> VND</td>
                    <td><script>document.write(formatNumber(<?= $row2["pro_price"] ?>));</script> VND</td>
                </tr>

                <tr>
                    <td>Detail</td>
                    <td><?= $row1["pro_desc"] ?></td>
                    <td><?= $row2["pro_desc"]; ?></td>
                </tr>

                <tr>
                    <td>Specifications</td>
                    <td><?= $row1["pro_specifications"] ?></td>
                    <td><?= $row2["pro_specifications"]; ?></td>
                </tr>

                <tr>
                    <td>Brand</td>
                    <td><?= $row1["brd_name"] ?></td>
                    <td><?= $row2["brd_name"]; ?></td>
                </tr>

                <tr>
                    <td>Delete</td>
                    <td align="center"><a href="<?= $data["url"]; ?>/Home/Change_Product/1"><img src="<?= $data["url"]; ?>public/icons/bin.png" alt=""></a></td>
                    <td align="center"><a href="<?= $data["url"]; ?>/Home/Change_Product/2"><img src="<?= $data["url"]; ?>public/icons/bin.png" alt=""></a></td>
                </tr>

            <?php } ?>
            </tbody>
        </table>
        <br>
    </form>
</div>