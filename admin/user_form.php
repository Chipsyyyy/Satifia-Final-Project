<?php
    session_start();

    if(!isset($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit();
    }

    include('../db.php');

    $is_edit = isset($_GET['id']);
    $title = $is_edit ? "Edit Admin User" : "Add Admin User";
    $admin_active = "users";
    $css_path = "../css/style.css";
    $root_path = "../";

    $user = array("id"=>"", "fullname"=>"", "username"=>"", "role"=>"Admin");

    if($is_edit) {
        $user_id = (int) $_GET['id'];
        $sql = "SELECT * FROM tbladmins WHERE id = '$user_id'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
        } else {
            header('Location: users.php');
            exit();
        }
    }

    include('../include/header.php');
?>

<div class="admin-layout">
    <?php include('include/admin_sidebar.php'); ?>
    <main class="admin-main">
        <div class="admin-topbar">
            <h1 class="admin-page-title"><?= $is_edit ? 'Edit User' : 'Add Admin User'; ?></h1>
            <a href="users.php" class="btn-outline">&larr; Back to Users</a>
        </div>

        <?php if(isset($_SESSION['admin_errors'])): ?>
            <div class="alert alert-danger">
                <?php foreach($_SESSION['admin_errors'] as $e): ?>
                    <p><?= $e; ?></p>
                <?php endforeach; ?>
            </div>
            <?php unset($_SESSION['admin_errors']); ?>
        <?php endif; ?>

        <div class="admin-card" style="max-width: 560px;">
            <p class="admin-card-title"><?= $is_edit ? 'Edit User Details' : 'New Admin User'; ?></p>

            <form action="process/save_user.php" method="post" novalidate>
                <input type="hidden" name="user_id" value="<?= $user['id']; ?>">

                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="fullname"
                        value="<?= htmlspecialchars($user['fullname']); ?>" placeholder="e.g. Juan dela Cruz">
                </div>

                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username"
                        value="<?= htmlspecialchars($user['username']); ?>" placeholder="Login username">
                </div>

                <div class="form-group">
                    <label class="form-label">Role</label>
                    <select class="form-control" name="role">
                        <option value="Admin" <?= $user['role']=='Admin' ? 'selected':''; ?>>Admin</option>
                        <option value="Staff" <?= $user['role']=='Staff' ? 'selected':''; ?>>Staff</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><?= $is_edit ? 'New Password' : 'Password'; ?></label>
                        <input type="password" class="form-control" name="password"
                            placeholder="<?= $is_edit ? 'Leave blank to keep current' : 'Min. 8 characters'; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmpassword"
                            placeholder="Repeat password">
                    </div>
                </div>

                <div style="display:flex; gap:12px; margin-top:8px;">
                    <button type="submit" name="submit" class="form-submit" style="width:auto; padding:14px 32px;">
                        <?= $is_edit ? 'Save Changes' : 'Add User'; ?>
                    </button>
                    <a href="users.php" class="btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </main>
</div>

<?php
    mysqli_close($conn);
    include('../include/footer.php');
?>