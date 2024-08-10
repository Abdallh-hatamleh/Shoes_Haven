<link rel="stylesheet" href="products.css">

<?php
include_once("header.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoes_haven";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'add_product') {
        // Adding a new product
        // ... (same as before)
    } elseif (isset($_POST['action']) && $_POST['action'] == 'edit_product') {
        // Editing an existing product
        // ... (same as before)
    } elseif (isset($_POST['action']) && $_POST['action'] == 'update_image') {
        // Updating an image
        $product_id = $_POST['product_id'];
        $new_image = $_FILES['update_image'];

        $stmt = $conn->prepare("INSERT INTO poduct_media (Pme_name, product_id) VALUES (?, ?)");
        $stmt->bind_param("si", $new_image['name'], $product_id);

        if ($stmt->execute()) {
            $message = "Image updated successfully.";
            $img_path = "../assets/Products/" . $new_image['name'];
            move_uploaded_file($_FILES['update_image']['tmp_name'], $img_path);
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<div class="title pb-20">
    <h2 class="h3 mb-0">Products Overview</h2>
</div>

<div class="card-box pb-10">
    <div class="h5 pd-20 mb-0 table_head">
        Products
        <button type="button" class="btn btn-primary add-product-btn" data-toggle="modal" data-target="#productFormModal">
            Add Product
        </button>

        <!-- Add Product Modal -->
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
                        <form method="POST" action="" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="add_product">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="productname">Product Name</label>
                                    <input type="text" class="form-control" id="productname" name="productname" placeholder="Product Name" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Product Description" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Price" required>
                                </div>
                                <div>Select image to upload: </div>
                                <input name="upload1" type="file" id="upload1" required>
                                <input name="upload2" type="file" id="upload2" required>
                                <input name="upload3" type="file" id="upload3" required>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit Form</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Product Modal -->
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
                            <input type="hidden" name="product_id" id="product_id">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" name="productname" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="product_description">Description</label>
                                    <input type="text" class="form-control" id="product_description" name="description" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price" required>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit Form</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <!-- Image Modal with Update Image -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Product Images</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="imageModalBody"></div>
                    <form id="editProductImageForm" method="POST" action="" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="update_image">
                        <input type="hidden" name="product_id" id="image_product_id">
                        <div class="form-group">
                            <label for="update_image">Select image to upload:</label>
                            <input name="update_image" type="file" id="update_image" required>
                        </div>
                        <button class="btn btn-primary" type="submit">Update Image</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Products Table -->
    <table class="data-table table">
        <thead>
            <tr>
                <th class="table-plus">Product Name</th>
                <th>Product Description</th>
                <th>Price</th>
                <th>Product Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT p.*, pm.Pme_name FROM products p LEFT JOIN poduct_media pm ON p.product_id = pm.product_id";
            $result = $conn->query($sql);
            $products = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $product_id = $row['product_id'];
                    if (!isset($products[$product_id])) {
                        $products[$product_id] = [
                            'product_name' => $row['product_name'],
                            'product_description' => $row['product_description'],
                            'price' => $row['price'],
                            'images' => []
                        ];
                    }
                    if ($row['Pme_name']) {
                        $products[$product_id]['images'][] = $row['Pme_name'];
                    }
                }
            }

            foreach ($products as $product_id => $product) {
                echo "<tr>";
                echo "<td class='table-plus'>{$product['product_name']}</td>";
                echo "<td>{$product['product_description']}</td>";
                echo "<td>{$product['price']}</td>";
                echo "<td><button type='button' class='btn btn-primary show_image_btn' data-id='$product_id' data-images='" . json_encode($product['images']) . "'>Show Images</button></td>";
                echo "<td><button type='button' class='btn btn-primary edit_btn' data-id='$product_id'>Edit</button><button type='button' class='btn btn-primary edit_image_btn' data-id='$product_id'>Update image</button></td>";
                echo "</tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Product Images</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="imageModalBody">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
 <script srt='show_update_products_image.js'></script>
<script src="products.js"></script>
<script>
    $(document).ready(function () {
        $(".edit_btn").on("click", function (e) {
        e.preventDefault();
        let productId = $(this).data("id");
        let row = $(this).closest("tr");
        $("#product_id").val(productId);
        $("#product_name").val(row.find("td:nth-child(1)").text());
        $("#product_description").val(row.find("td:nth-child(2)").text());
        $("#price").val(row.find("td:nth-child(3)").text());
        $("#editProductFormModal").modal("show");
    });

    $(".show_image_btn").on("click", function (e) {
        e.preventDefault();
        let productId = $(this).data("id");
        let images = $(this).data("images");
        $("#imageModalBody").empty();
        images.forEach(function (image) {
            $("#imageModalBody").append($("<img>").attr("src", "../assets/Products/" + image).addClass("product_img"));
        });
        $("#image_product_id").val(productId);
        $("#imageModal").modal("show");
    });

    $(".edit_image_btn").on("click", function (e) {
        e.preventDefault();
        $("#editProductImage").modal("show");
    });
    
});

</script>
<?php include_once("footer.php"); ?>
