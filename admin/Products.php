<?php
ob_start(); // Start output buffering
include_once("header.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoes_haven";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'add_products') {
        $product_name = $_POST['productname'];
        $product_description = $_POST['productdescription'];
        $price = $_POST['price'];

        $stmt = $conn->prepare("SELECT * FROM products WHERE product_name = ?");
        $stmt->bind_param("s", $product_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "Error: Product already exists.";
        } else {
            $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, price) VALUES (?, ?, ?)");
            $stmt->bind_param("ssd", $product_name, $product_description, $price);

            if ($stmt->execute()) {
                $message = "Product added successfully.";
            } else {
                $message = "Error adding product: " . $stmt->error;
            }
        }
        $stmt->close();
        $conn->close();

        header("Location: " . $_SERVER['PHP_SELF'] . "?message=" . urlencode($message));
        exit();
    }

    if (isset($_POST['action']) && $_POST['action'] == 'edit_product') {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['productname'];
        $product_description = $_POST['productdescription'];
        $price = $_POST['price'];

        $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?, price=? WHERE product_id=?");
        $stmt->bind_param("ssdi", $product_name, $product_description, $price, $product_id);

        if ($stmt->execute()) {
            $message = "Product updated successfully.";
        } else {
            $message = "Error updating product: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();

        header("Location: " . $_SERVER['PHP_SELF'] . "?message=" . urlencode($message));
        exit();
    }
}
?>

<div class="title pb-20">
    <h2 class="h3 mb-0">Product Overview</h2>
</div>

<div class="card-box pb-10">
    <div class="h5 pd-20 mb-0 table_head">
        Product
        <button type="button" class="btn btn-primary add-product-btn" data-toggle="modal" data-target="#productFormModal">
            Add Product
        </button>

        <div class="modal fade" id="productFormModal" tabindex="-1" role="dialog" aria-labelledby="productFormModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productFormModalLabel">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php if (isset($_GET['message'])): ?>
                            <div class="alert alert-info"><?php echo htmlspecialchars($_GET['message']); ?></div>
                        <?php endif; ?>
                        <form method="POST" action="">
                            <input type="hidden" name="action" value="add_products">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="productname">Product Name</label>
                                    <input type="text" class="form-control" id="productname" name="productname" placeholder="Product Name" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="productdescription">Description</label>
                                    <input type="text" class="form-control" id="productdescription" name="productdescription" placeholder="Description" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="price">Price</label>
                                    <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Price" required>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit Form</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editProductFormModal" tabindex="-1" role="dialog" aria-labelledby="editProductFormModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductFormModalLabel">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editProductForm" method="POST" action="">
                            <input type="hidden" name="action" value="edit_product">
                            <input type="hidden" name="product_id" id="edit_product_id">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="editproductname">Product Name</label>
                                    <input type="text" class="form-control" id="editproductname" name="productname" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="editproductdescription">Description</label>
                                    <input type="text" class="form-control" id="editproductdescription" name="productdescription" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="editprice">Price</label>
                                    <input type="number" step="0.01" class="form-control" id="editprice" name="price" required>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit Form</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="data-table table nowrap">
        <thead>
            <tr>
                <th class="table-plus">Product Name</th>
                <th>Description</th>
                <th class="datatable-nosort">Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td class='table-plus'>".$row["product_name"]."</td>
                        <td>".$row["product_description"]."</td>
                        <td>".$row["price"]."</td>
                        <td>
                            <div class='table-actions'>
                                <a href='#' class='edit_btn' data-id='".$row["product_id"]."' data-color='#265ed7'>
                                    <i class='icon-copy dw dw-edit2'></i>
                                </a>
                                <a href='#' class='delete_btn' data-id='".$row["product_id"]."' data-color='#e95959'>
                                    <i class='icon-copy dw dw-delete-3'></i>
                                </a>
                            </div>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No products found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $(".edit_btn").click(function() {
        var productId = $(this).data("id");
        var row = $(this).closest("tr");
        var productName = row.find("td:nth-child(1)").text();
        var productDescription = row.find("td:nth-child(2)").text();
        var price = row.find("td:nth-child(3)").text();
        
        $("#edit_product_id").val(productId);
        $("#editproductname").val(productName);
        $("#editproductdescription").val(productDescription);
        $("#editprice").val(price);
        $("#editProductFormModal").modal("show");
    });

    $(".delete_btn").click(function(e) {
        e.preventDefault();
        var productId = $(this).data("id");
        if (confirm("Are you sure you want to delete this product?")) {
            $.ajax({
                url: 'delete_product.php',
                type: 'POST',
                data: { product_id: productId },
                success: function(response) {
                    if (response == "success") {
                        alert("Product deleted successfully.");
                        location.reload();
                    } else {
                        alert("Error deleting product.");
                    }
                }
            });
        }
    });
});
</script>

<?php
include_once("footer.php");
ob_end_flush(); // End output buffering and flush output
$conn->close();
?>
