<link rel="stylesheet" href="products.css">


<?php
include_once ("header.php");

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
        $product_name = $_POST['productname'];
        $product_description = $_POST['description'];
        $price = $_POST['price'];
        $img1 = $_FILES['upload1'];
        $img2 = $_FILES['upload2'];
        $img3 = $_FILES['upload3'];

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
                $message = "New product added successfully.";

                // Get the new product_id
                $new_product_id = $stmt->insert_id;
                // $img1_name=$img1['name'];

                $stmt = $conn->prepare("INSERT INTO poduct_media (Pme_name, product_id) VALUES (?, ?), (?, ?), (?, ?)");
                $stmt->bind_param("sisisi", $img1['name'], $new_product_id, $img2['name'], $new_product_id, $img3['name'], $new_product_id);

                if ($stmt->execute()) {
                    $message .= " Images added successfully.";
                    $img_path1 ="../assets/Products/".$img1['name'];
                    $img_path2 ="../assets/Products/".$img2['name'];
                    $img_path3 ="../assets/Products/".$img3['name'];

                    move_uploaded_file($_FILES['upload1']['tmp_name'], $img_path1 );
                    move_uploaded_file($_FILES['upload2']['tmp_name'], $img_path2 );
                    move_uploaded_file($_FILES['upload3']['tmp_name'], $img_path3 );
                } else {
                    $message = "Error: " . $stmt->error;
                }
            } else {
                $message = "Error: " . $stmt->error;
            }
        }
        $stmt->close();

    } elseif (isset($_POST['action']) && $_POST['action'] == 'edit_product') {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['productname'];
        $product_description = $_POST['description'];
        $price = $_POST['price'];

        $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?, price=? WHERE product_id=?");
        $stmt->bind_param("ssdi", $product_name, $product_description, $price, $product_id);

        if ($stmt->execute()) {
            $message = "Product updated successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    } 
    } elseif (isset($_POST['action']) && $_POST['action'] == 'upload_new') {
        $Pme_id = $_POST['Pme_id'];
        $imgNew = $_FILES['upload_new'];

        $stmt = $conn->prepare("UPDATE poduct_media SET Pme_name=? WHERE Pme_id=?");
        $stmt->bind_param("si", $imgNew['name'], $Pme_id);

        if ($stmt->execute()) {
            $message = "image updated successfully.";

            $new_img_path ="../assets/Products/".$imgNew['name'];
            move_uploaded_file($_FILES['upload_new']['tmp_name'], $new_img_path );
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
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
                                        <input name="upload1" type="file" id='upload1' required>
                                        <input name="upload2" type="file" id='upload2' required>
                                        <input name="upload3" type="file" id='upload3' required>
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

        <div class="modal fade" id="editProductImage" tabindex="-1" role="dialog" aria-labelledby="editProductImageLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductImageLabel">Update Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editProductImage" method="POST" action="">
                            <input type="hidden" name="action" value="upload_new">
                            <input type="hidden" name="Pme_id" id="Pme_id">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <input name="upload_new" type="file" id='upload_new' required>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="data-table table">
        <thead>
            <tr>
                <th class="table-plus">ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th class="datatable-nosort">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT product_id, product_name, product_description, price FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td class='table-plus'>" . $row["product_id"] . "</td>
                        <td>" . $row["product_name"] . "</td>
                        <td>" . $row["product_description"] . "</td>
                        <td>" . $row["price"] . "</td>
                        <td>
                            <div class='table-actions'>
                                <a href='' class='edit_btn' data-id='" . $row["product_id"] . "' data-color='#265ed7'>
                                    <i class='icon-copy dw dw-edit2'></i>
                                </a>
                                <a href='delete_product.php?adid=" . $row["product_id"] . "' class='delete_btn' data-id='" . $row["product_id"] . "' data-color='#e95959'>
                                    <i class='icon-copy dw dw-delete-3'></i>
                                </a>
                                <input type='hidden' id='' name='adid' value='".$row["product_id"]."'>
                                <a href='Products.php?adid=" . $row["product_id"] . "' class='show_image_btn' data-id='".$row["product_id"]."' data-color='black'>
                                   <i class='fa-solid fa-eye'> </i>
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


<div class='img_show_container'>

<?php
    if (isset($_GET['adid'])) {
        $product_id = $_GET['adid'];

        $stmt = $conn->prepare("SELECT * FROM poduct_media WHERE product_id = ?");
        $stmt->bind_param("s", $product_id);
        if($stmt->execute()) {     
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            
            echo "<div class='img_show'>
            <img class='product_img' src='../assets/Products/". $row["Pme_name"] . "' alt=''>
             <button class='edit_image_btn' data-id='". $row["Pme_id"] . "' data-color='#265ed7'>
            <i class='icon-copy dw dw-edit2'></i></button></div>";
            
                }}
        }
    }
?>



<!-- 
    
<div class='img_show'>
    
    <img class='product_img' src="../assets/Products/1701413835aaffaba51186b567bc5dbdc067a46116_thumbnail_900x.webp" alt=""> <button class='edit_image_btn' data-id='" . $row["product_id"] . "' data-color='#265ed7'><i class='icon-copy dw dw-edit2'></i></button>
    
    </div>
<div class='img_show'>
    
    <img class='product_img' src="../assets/Products/1701413835aaffaba51186b567bc5dbdc067a46116_thumbnail_900x.webp" alt=""> <button class='edit_image_btn' data-id='" . $row["product_id"] . "' data-color='#265ed7'><i class='icon-copy dw dw-edit2'></i></button>
    
    </div>
<div class='img_show'>
    
    <img class='product_img' src="../assets/Products/1701413835aaffaba51186b567bc5dbdc067a46116_thumbnail_900x.webp" alt=""> <button class='edit_image_btn' data-id='" . $row["product_id"] . "' data-color='#265ed7'><i class='icon-copy dw dw-edit2'></i></button>
    
</div> -->

</div>

<!-- ------------------------------------------------------------ -->
<?php
// session_start(); // Start session to store feedback messages

// include("../includes/connection2.php");

// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["add_slide"])) {
//     // Upload slider images
//     $valid = 1;
//     $error_message = '';

//     foreach ($_FILES['photo']['name'] as $key => $val) {
//         $photo_name = $_FILES['photo']['name'][$key];
//         $photo_tmp = $_FILES['photo']['tmp_name'][$key];

//         if ($photo_name != '') {
//             $ext = pathinfo($photo_name, PATHINFO_EXTENSION);
//             $file_name = basename($photo_name, '.' . $ext);
//             $photo_name_new = $file_name . '_' . time() . '.' . $ext;
//             $target = '../assets/Products/' . $photo_name_new;

//             if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
//                 $valid = 0;
//                 $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
//             }

//             if ($valid == 1) {
//                 if (move_uploaded_file($photo_tmp, $target)) {
//                     $sqlInsertPhoto = "INSERT INTO product_media $photo_name,product_id VALUES (?)";
//                     $stmtPhoto = $conn->prepare($sqlInsertPhoto);
//                     $stmtPhoto->bind_param("s", $photo_name_new);
//                     $stmtPhoto->execute();
//                     $stmtPhoto->close();
//                     $_SESSION['message'] = "Images uploaded successfully!";
//                 } else {
//                     $error_message .= 'Failed to upload photo ' . $photo_name . '<br>';
//                     $valid = 0;
//                 }
//             }
//         }
//     }

//     if ($valid == 0) {
//         $_SESSION['error'] = $error_message;
//     }
//     header("Location: " . $_SERVER['PHP_SELF']);
//     exit();
// }

?>

<!-- <div class="card m-t-25">
    <div class="card-header">
        <strong>Image Slider</strong> Form
    </div>
    <div class="card-body card-block">
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['message']) . '</div>';
            unset($_SESSION['message']);
        } elseif (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error']) . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Slider's Images</label>
                <div class="col-sm-4" style="padding-top:4px;">
                    <table id="ProductTable" style="width:100%;">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="upload-btn">
                                        <input type="file" name="photo[]" style="margin-bottom:5px;">
                                    </div>
                                </td>
                                <td style="width:28px;"><a href="javascript:void(0);" class="Delete btn btn-danger btn-xs">X</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-2">
                    <input type="button" id="btnAddNew" value="Add Item" style="margin-top: 5px;margin-bottom:10px;border:0;color: #fff;font-size: 14px;border-radius:3px;" class="btn btn-warning btn-xs">
                </div>
            </div>
            <input type="submit" class="btn btn-primary btn-sm" name="add_slide" value="Add Image">
            <button type="reset" class="btn btn-danger btn-sm">
                <i class="fa fa-ban"></i> Reset
            </button>
        </form>
    </div>
</div> -->

<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Add new row
        document.getElementById("btnAddNew").addEventListener("click", function() {
            var newRow = document.createElement("tr");

            newRow.innerHTML = `
            <td>
                <div class="upload-btn">
                    <input type="file" name="photo[]" style="margin-bottom:15px;">
                </div>
            </td>
            <td style="width:28px;">
                <a href="javascript:void(0);" class="Delete btn btn-danger btn-xs">X</a>
            </td>
        `;

            document.querySelector("#ProductTable tbody").appendChild(newRow);
        });

        // Delegate event for dynamically added delete buttons
        document.querySelector("#ProductTable").addEventListener("click", function(event) {
            if (event.target && event.target.matches("a.Delete")) {
                var row = event.target.closest("tr");
                row.style.transition = "opacity 0.5s";
                row.style.opacity = 0;
                setTimeout(function() {
                    row.remove();
                }, 500);
                event.preventDefault();
            }
        });
    });
</script> -->

<?php
// echo "<script>alert('Delete Product');</script>";
// include("../includes/footer.php");
?>
<!-- ------------------------------------------------------------ -->
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
 <script srt='show_update_products_image.js'></script>
 <script>
     $(document).ready(function () {


///////////     edit product details
        $(".edit_btn").click(function (e) {
            // alert('hi');
            e.preventDefault();
            var productId = $(this).data("id");
            var row = $(this).closest("tr");
            var name = row.find("td:nth-child(2)").text();
            var description = row.find("td:nth-child(3)").text();
            var price = row.find("td:nth-child(4)").text();

            // $("#product_id").val(name);
            $("#product_name").val(name);
            $("#product_description").val(description);
            $("#price").val(price);
            $("#editProductFormModal").modal("show");
            // $("#editProductFormModal").classList.toggle("show");
        });



        ////////    show product image eye button
        $(".show_image_btn").click(function (e) {
            $('.show_img_form').submit()
                    // $("#editProductFormModal").classList.toggle("show");
                });



                ///////////     upload new image
                $(".edit_image_btn").click(function (e) {
                    e.preventDefault();
                    var Pme_id = $(this).data("id");
                    $("#editProductImage").modal("show");
                    // $("#editProductFormModal").classList.toggle("show");
            $("#Pme_id").val(Pme_id);
        });


// const show_image_btn = document.queryS   electorAll('.show_image_btn');

//     if (let i = 0 ; i < show_image_btn.length; i++) {
//         show_image_btn[i].addEventListener("click", () => {
//                     e.preventDefault();
//                     console.log(';asdihflkasdf')
//         })

    // }
});

</script>

<?php
include_once ("footer.php");
$conn->close();
?>
