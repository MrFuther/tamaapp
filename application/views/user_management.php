<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Manage Users</h1>
    <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-secondary mb-3">Back to Dashboard</a>
    <form action="<?php echo base_url('usermanagement/add_user'); ?>" method="post" class="mb-4">
        <h4>Add New User</h4>
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="col-md-4">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="col-md-4">
                <select name="role" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="management">Management</option>
                    <option value="spv">Supervisor</option>
                    <option value="teknisi">Technician</option>
                </select>
            </div>
            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary">Add User</button>
            </div>
        </div>
    </form>

    <h4>All Users</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td><?php echo $user['created_at']; ?></td>
                <td>
                    <!-- Tambahkan aksi lainnya jika diperlukan -->
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
