x<?php
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
    // Handle adding admin
    if (isset($_POST['action']) && $_POST['action'] == 'add_admin') {
        $first_name = $_POST['firstName'];
        $last_name = $_POST['lastName'];
        $user_email = $_POST['user_email'];
        $user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT); // Hash password

        // Check if the email already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "Error: Email already exists.";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, user_email, password, admin) VALUES (?, ?, ?, ?, 1)");
            $stmt->bind_param("ssss", $first_name, $last_name, $user_email, $user_password);

            if ($stmt->execute()) {
                    $message = "New admin added successfully";
                } else {
                $message = "Error: " . $stmt->error;
                }
        }
        $stmt->close();
    }

    // Handle editing admin
    if (isset($_POST['action']) && $_POST['action'] == 'edit_admin') {
        $user_id = $_POST['user_id'];
        $first_name = $_POST['firstName'];
        $last_name = $_POST['lastName'];
        $user_email = $_POST['user_email'];

        $stmt = $conn->prepare("UPDATE users SET first_name=?,last_name=?,user_email=? WHERE user_id=?");
        $stmt->bind_param("sssi", $first_name, $last_name, $user_email, $user_id);

        if ($stmt->execute()) {
            echo "Admin ان شاء الله updated successfully";
        } else {
            echo "Error updating admin: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<div class="title pb-20">
    <h2 class="h3 mb-0">Admins Overview</h2>
</div>

<div class="card-box pb-10">
    <div class="h5 pd-20 mb-0 table_head">
        Admins
        <!-- Add Admin Button -->
        <button type="button" class="btn btn-primary add-admin-btn" data-toggle="modal" data-target="#adminFormModal">
            Add Admin
        </button>

        <!-- Modal Structure for Adding Admin -->
        <div class="modal fade" id="adminFormModal" tabindex="-1" role="dialog" aria-labelledby="adminFormModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="adminFormModalLabel">Add Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php if (isset($message)): ?>
                            <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
                        <?php endif; ?>
                        <form method="POST" action="">
                            <input type="hidden" name="action" value="add_admin">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="firstName">First name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First name" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="lastName">Last name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last name" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="username">User Email</label>
                                    <input type="email" class="form-control" id="username" name="user_email" placeholder="User Email" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="user_password">User Password</label>
                                    <input type="password" class="form-control" id="user_password" name="user_password" placeholder="User Password" required>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Structure for Editing Admin -->
        <div class="modal fade" id="editAdminFormModal" tabindex="-1" role="dialog" aria-labelledby="editAdminFormModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAdminFormModalLabel">Edit Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editAdminForm" method="POST" action="">
                            <input type="hidden" name="action" value="edit_admin">
                            <input type="hidden" name="user_id" id="edit_admin_id">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="editFirstName">First name</label>
                                    <input type="text" class="form-control" id="editFirstName" name="firstName" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="editLastName">Last name</label>
                                    <input type="text" class="form-control" id="editLastName" name="lastName" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="editUserEmail">User Email</label>
                                    <input type="email" class="form-control" id="editUserEmail" name="user_email" required>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="data-table table nowrap">
        <thead>
            <tr>
                <th class="table-plus">Admin Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>User Email</th>
                <th class="datatable-nosort">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `users` WHERE 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if($row['admin'] == 1){

                    echo "<tr>
                        <td class='table-plus'>".$row["user_id"]."</td>
                        <td>".$row["first_name"]."</td>
                        <td>".$row["last_name"]."</td>
                        <td>".$row["user_email"]."</td>

                        <td>
                            <div class='table-actions'>
                                <a href='#' class='edit_btn' data-id='".$row["user_id"]."' data-color='#265ed7'>
                                    <i class='icon-copy dw dw-edit2'></i>
                                </a>
                                <a href='delete_admin.php?adid=".$row["user_id"]."' class='delete_btn' data-id='".$row["user_id"]."' data-color='#e95959'>
                                    <i class='icon-copy dw dw-delete-3 hidden'></i>
                                    // <i>SURE?</i>
                                    // <i class='delete'>Yes</i>
                                    // <i class='delete'>Cancel</i>
                                </a>
                            </div>
                        </td>
                    </tr>";

                }
                }
            } else {
                echo "<tr><td colspan='6'>No admins found.</td></tr>";
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
        var adminId = $(this).data("id");
        var row = $(this).closest("tr");
        var admin_user_id = row.find("td:nth-child(1)").text();
        var firstName = row.find("td:nth-child(2)").text();
        var lastName = row.find("td:nth-child(3)").text();
        var userEmail = row.find("td:nth-child(4)").text();
        
        $("#edit_admin_id").val(admin_user_id);
        $("#editFirstName").val(firstName);
        $("#editLastName").val(lastName);
        $("#editUserEmail").val(userEmail);
        $("#editAdminFormModal").modal("show");
    });
});



</script>

<?php
include_once("footer.php");
$conn->close();
?>
