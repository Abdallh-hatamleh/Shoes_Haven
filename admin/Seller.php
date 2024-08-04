<?php
include_once("connection.php");
?>
<?php
include_once("header.php");
?>

<div class="title pb-20">
	<h2 class="h3 mb-0">Sellers Overview</h2>
</div>

<div class="card-box pb-10">
	<div class="h5 pd-20 mb-0 table_head">
	Sellers
		<!-- Add Admin Button -->
		<button type="button" class="btn btn-primary add-admin-btn" data-toggle="modal" data-target="#adminFormModal">
			Add Seller
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
						<?php if (isset($_GET['message'])): ?>
							<div class="alert alert-info"><?php echo htmlspecialchars($_GET['message']); ?></div>
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
									<input type="email" class="form-control" id="username" name="username" placeholder="User Email" required>
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
							<input type="hidden" name="admin_id" id="edit_admin_id">
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
									<label for="editUsername">User Email</label>
									<input type="email" class="form-control" id="editUsername" name="username" required>
								</div>
								<div class="col-md-4 mb-3">
									<label for="editUserPassword">User Password</label>
									<input type="password" class="form-control" id="editUserPassword" name="user_password" required>
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
				<th>User Id</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>User Email</th>
				<th class="datatable-nosort">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql = "SELECT admin.admin_id, users.user_id, users.first_name, users.last_name, users.user_email FROM users JOIN admin ON users.user_id = admin.user_id";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					echo "<tr>
						<td class='table-plus'>".$row["admin_id"]."</td>
						<td>".$row["user_id"]."</td>
						<td>".$row["first_name"]."</td>
						<td>".$row["last_name"]."</td>
						<td>".$row["user_email"]."</td>
						<td>
							<div class='table-actions'>
								<a href='#' class='edit_btn' data-id='".$row["admin_id"]."' data-color='#265ed7'>
									<i class='icon-copy dw dw-edit2'></i>
								</a>
								<a href='#' class='delete_btn' data-id='".$row["admin_id"]."' data-color='#e95959'>
									<i class='icon-copy dw dw-delete-3'></i>
								</a>
							</div>
						</td>
					</tr>";
				}
			} else {
				echo "<tr><td colspan='6'>No admins found.</td></tr>";
			}
			$conn->close();
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
		var firstName = row.find("td:nth-child(3)").text();
		var lastName = row.find("td:nth-child(4)").text();
		var userEmail = row.find("td:nth-child(5)").text();
		
		$("#edit_admin_id").val(adminId);
		$("#editFirstName").val(firstName);
		$("#editLastName").val(lastName);
		$("#editUsername").val(userEmail);
		$("#editAdminFormModal").modal("show");
	});

	$(".delete_btn").click(function(e) {
		e.preventDefault();
		var adminId = $(this).data("id");
		if (confirm("Are you sure you want to delete this admin?")) {
			$.ajax({
				url: 'delete_admin.php',
				type: 'POST',
				data: { admin_id: adminId },
				success: function(response) {
					if (response == "success") {
						alert("Admin deleted successfully.");
						location.reload();
					} else {
						alert("Error deleting admin.");
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
