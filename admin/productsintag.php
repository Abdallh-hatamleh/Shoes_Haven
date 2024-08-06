 <?php
include_once("connection.php");
?>
<?php
include_once("addtagproduct.php");
?>
<?php
include_once("deleeteprodutctag.php");
?>


<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productintag">
        Add Product to Tag
    </button>

<div class="modal fade" id="productintag" tabindex="-1" role="dialog" aria-labelledby="productintagLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productintagLabel">Add Products to Tags</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> 
            </div>
            <div class="modal-body">
                <?php if (isset($_GET['message'])) : ?>
                    <div class="alert alert-info"><?php echo htmlspecialchars($_GET['message']); ?></div>
                <?php endif; ?>
                <form method="POST" action="tags.php?tagid=<?php echo  $_GET['tagid'] ?>">
                    <input type="hidden" name="action" value="add_tag_prod">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="product_id">Product ID</label>
                            <input type="text" class="form-control" id="product_id" name="product_id" placeholder="Product ID" required>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

        <table class="table table-striped table-bordered data-table nowrap">
            <thead>
                <tr>
                    <th class="table-plus">Products ID</th>
                    <th>Product Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
        <?php
        $conn = mysqli_connect($servername,$username,$password,$dbname);
        $stmt = $conn->prepare("SELECT products.product_id,products.product_name from tags join product_tags USING 
        (tag_id) JOIN products USING (product_id) where tag_id=?");
        $stmt->bind_param("i", $_GET['tagid']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["product_id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["product_name"]) . "</td>";
                    echo "<td><a href='#' class='delete_btn' data-id='".$row["product_id"]."' data-color='#e95959'>
                                    <i class='icon-copy dw dw-delete-3'></i>
                                </a></td>
                                </tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No products found</td></tr>";
            }
            ?>
            <tbody>
            </tbody>
        </table> 

     

      <!-- - Add CSS for spacing and centering  -->
        <style>
            .table-container {
                display: flex;
                justify-content: center;
                padding: 20px;
            }

            .table-container table {
                width: 100%;
                max-width: 1200px;
                margin: 0 auto;
            }

            .card-box {
                padding: 20px;
            }
        </style>
        <script>
            $(document).ready(function() {
$(".delete_btn").click(function(e) {
    e.preventDefault();
    var tagId = $(this).data("id");
    if (confirm("Are you sure you want to delete this tag?")) {
        alert('hi')
        $.ajax({
            url: 'deleeteproducttad.php',
            type: 'POST',
            data: { prod_id: tagId, tag_id: '<?php echo $_GET['tagid'] ?>' },
            success: function(response) {
                if (response === "success") {
                    alert("Tag deleted successfully.");
                    location.reload();
                } else {
                    alert("Error deleting tag.");
                }
            }
        });
    }
});


});
        </script>