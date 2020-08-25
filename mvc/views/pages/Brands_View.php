<script language="javascript">
function deleteConfirm() {
    if (confirm("Do you want to delete?")) {
        return true;
    } else {
        return false;
    }
}
</script>

<script language="javascript">
$(document).ready(function() {
    var table = $('#tablebrand').DataTable({
        responsive: true,
        "lengthMenu": [
            [10, 2, 5, 15, 20, 25, 30, -1],
            [10, 2, 5, 15, 20, 25, 30, "All"]
        ]
    });
    new $.fn.dataTable.FixedHeader(table);
});
</script>


<div id="breadcrumb" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="breadcrumb-header">Manage Brand</h3>
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
        <a href="<?php echo $data["url"]; ?>Brands/display_Add_Brand"><img
                src="<?= $data["url"]; ?>public/icons/add.png"> Create New</a>
    </p>
    <table id="tablebrand" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>    <strong>Brand ID</strong>       </th>
                <th>    <strong>Brand Name</strong>     </th>
                <th>    <strong>Describe</strong>       </th>
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
                <td>    <?php echo $row["brd_id"] ?>        </td>
                <td>    <?php echo $row["brd_name"] ?>      </td>
                <td>    <?php echo $row["brd_desc"] ?>      </td>

                <td align='center'>
                    <a href="<?php echo $data["url"]; ?>Brands/display_Update_Brand/<?php echo $row['brd_id']; ?>">
                        <img src="<?= $data["url"]; ?>public/icons/edit.png"></a>
                </td>

                <td align='center'>
                    <a onclick="return deleteConfirm()"
                        href="<?php echo $data["url"]; ?>Brands/Delete_Brand/<?php echo $row['brd_id']; ?>">
                        <img src="<?= $data["url"]; ?>public/icons/delete.png"></a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table><br>
</div>