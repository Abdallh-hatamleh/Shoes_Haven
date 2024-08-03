<?php
include_once("connection.php");
?>
<?php
include_once("header.php");
?>
<?php
include_once("edit-tags.php")
?>
<div class="title pb-20">
    <h2 class="h3 mb-0">Tags Overview</h2>
</div>

<div class="card-box pb-10">
    <div class="h5 pd-20 mb-0 table_head">
        Tags
        <!-- Add Tag Button -->
        <button type="button" class="btn btn-primary add-tag-btn" data-toggle="modal" data-target="#tagFormModal">
            Add Tag
        </button>

        <!-- Modal Structure for Adding Tag -->
        <div class="modal fade" id="tagFormModal" tabindex="-1" role="dialog" aria-labelledby="tagFormModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tagFormModalLabel">Add Tag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php if (isset($_GET['message'])): ?>
                            <div class="alert alert-info"><?php echo htmlspecialchars($_GET['message']); ?></div>
                        <?php endif; ?>
                        <form method="POST" action="">
                            <input type="hidden" name="action" value="add_tag">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="tagName">Tag Name</label>
                                    <input type="text" class="form-control" id="tagName" name="tag_name" placeholder="Tag Name" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="sale_amount">Sale Amount</label>
                                    <input type="number" step="0.01" class="form-control" id="sale_amount" name="sale_amount" placeholder="sale_amount" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="featured">Featured</label>
                                    <select class="form-control" id="featured" name="featured" required>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Structure for Editing Tag -->
        <div class="modal fade" id="editTagFormModal" tabindex="-1" role="dialog" aria-labelledby="editTagFormModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTagFormModalLabel">Edit Tag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editTagForm" method="POST" action="">
                            <input type="hidden" name="action" value="edit_tag">
                            <input type="hidden" name="tag_id" id="edit_tag_id">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="editTagName">Tag Name</label>
                                    <input type="text" class="form-control" id="editTagName" name="tag_name" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="editSaleAmount">Sale Amount</label>
                                    <input type="number" step="0.01" class="form-control" id="editSaleAmount" name="sale_amount" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="editFeatured">Featured</label>
                                    <select class="form-control" id="editFeatured" name="featured" required>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-striped table-bordered data-table nowrap">
        <thead>
            <tr>
                <th class="table-plus">Tag ID</th>
                <th>Tag Name</th>
                <th>Sale Amount</th>
                <th>Featured</th>
                <!-- <th>Product Name</th> -->
                <th class="datatable-nosort">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "select * from tags";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td class='table-plus'>".$row["tag_id"]."</td>
                        <td>".$row["tad_name"]."</td>
                        <td>".$row["sale_amount"]."</td>
                        <td>".($row["featured"] ? 'Yes' : 'No')."</td>
                        <td>
                            <div class='table-actions'>
                                <a href='#' class='edit_btn' data-id='".$row["tag_id"]."' data-color='#265ed7'>
                                    <i class='icon-copy dw dw-edit2'></i>
                                </a>
                                <a href='#' class='delete_btn' data-id='".$row["tag_id"]."' data-color='#e95959'>
                                    <i class='icon-copy dw dw-delete-3'></i>
                                </a>
                            </div>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No tags found.</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
	<div class="modal fade" id="tagFormModal" tabindex="-1" role="dialog" aria-labelledby="tagFormModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tagFormModalLabel">Add Tag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php if (isset($_GET['message'])): ?>
                            <div class="alert alert-info"><?php echo htmlspecialchars($_GET['message']); ?></div>
                        <?php endif; ?>
                        <form method="POST" action="">
                            <input type="hidden" name="action" value="add_tag">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="tagName">Tag Name</label>
                                    <input type="text" class="form-control" id="tagName" name="tag_name" placeholder="Tag Name" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="saleAmount">Sale Amount</label>
                                    <input type="number" step="0.01" class="form-control" id="saleAmount" name="sale_amount" placeholder="Sale Amount" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="featured">Featured</label>
                                    <select class="form-control" id="featured" name="featured" required>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Structure for Editing Tag -->
        <div class="modal fade" id="editTagFormModal" tabindex="-1" role="dialog" aria-labelledby="editTagFormModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTagFormModalLabel">Edit Tag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editTagForm" method="POST" action="">
                            <input type="hidden" name="action" value="edit_tag">
                            <input type="hidden" name="tag_id" id="edit_tag_id">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="editTagName">Tag Name</label>
                                    <input type="text" class="form-control" id="editTagName" name="tag_name" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="editSaleAmount">Sale Amount</label>
                                    <input type="number" step="0.01" class="form-control" id="editSaleAmount" name="sale_amount" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="editFeatured">Featured</label>
                                    <select class="form-control" id="editFeatured" name="featured" required>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
								<div class="col-md-4 mb-3">
                                    <label for="editSaleAmount">product name</label>
                                    <input type="text" class="form-control" id="editSaleAmount" name="product_name" required>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-striped table-bordered data-table nowrap">
        <thead>
            <tr>
                <th class="table-plus">Tag ID</th>
                <th>Tag Name</th>
                <th>Sale Amount</th>
                <th>Featured</th>
                <th>Product Name</th>
                <th class="datatable-nosort">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // $sql = "select * from tags";
            // $result = $conn->query($sql);

            // if ($result->num_rows > 0) {
            //     while ($row = $result->fetch_assoc()) {
            //         echo "<tr>
            //             <td class='table-plus'>".$row["tag_id"]."</td>
            //             <td>".$row["tad_name"]."</td>
            //             <td>".$row["sale_amount"]."</td>
            //             <td>".($row["featured"] ? 'Yes' : 'No')."</td>
            //             <td>
            //                 <div class='table-actions'>
            //                     <a href='#' class='edit_btn' data-id='".$row["tag_id"]."' data-color='#265ed7'>
            //                         <i class='icon-copy dw dw-edit2'></i>
            //                     </a>
            //                     <a href='#' class='delete_btn' data-id='".$row["tag_id"]."' data-color='#e95959'>
            //                         <i class='icon-copy dw dw-delete-3'></i>
            //                     </a>
            //                 </div>
            //             </td>
            //         </tr>";
            //     }
            // } else {
            //     echo "<tr><td colspan='6'>No tags found.</td></tr>";
            // }
            // $conn->close();
            ?>
        </tbody>
    </
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
	$(".edit_btn").click(function() {
    var tagId = $(this).data("id");
    var row = $(this).closest("tr");
    var tagName = row.find("td:nth-child(2)").text();
    var saleAmount = row.find("td:nth-child(3)").text();
    var featured = row.find("td:nth-child(4)").text() === "Yes" ? 1 : 0;
    var productName = row.find("td:nth-child(5)").text();
    
    $("#edit_tag_id").val(tagId);
    $("#editTagName").val(tagName);
    $("#editSaleAmount").val(saleAmount);
    $("#editFeatured").val(featured);
    $("#editProductName").val(productName);
    $("#editTagFormModal").modal("show");
});


$(".delete_btn").click(function(e) {
    e.preventDefault();
    var tagId = $(this).data("id");
    if (confirm("Are you sure you want to delete this tag?")) {
        $.ajax({
            url: 'delete-tags.php',
            type: 'POST',
            data: { tag_id: tagId },
            success: function(response) {
                if (response == "success") {
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

<?php
include_once("footer.php");
?>

