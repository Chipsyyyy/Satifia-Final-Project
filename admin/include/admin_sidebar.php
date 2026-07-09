<aside class="admin-sidebar">
    <a href="index.php" class="admin-sidebar-logo">Sati<span>fia</span> <span style="font-size:11px; font-family: var(--font-body); color: rgba(255,255,255,0.4); letter-spacing: 0.05em;">Admin</span></a>

    <span class="admin-nav-label">Main</span>
    <nav class="admin-nav">
        <a href="index.php" class="<?= ($admin_active == 'dashboard') ? 'active' : ''; ?>">&#9783; Dashboard</a>
    </nav>

    <span class="admin-nav-label">Manage</span>
    <nav class="admin-nav">
        <a href="products.php" class="<?= ($admin_active == 'products') ? 'active' : ''; ?>">&#9776; Products &amp; Stock</a>
        <a href="users.php" class="<?= ($admin_active == 'users') ? 'active' : ''; ?>">&#9786; Admin Users</a>
    </nav>

    <span class="admin-nav-label">Reports</span>
    <nav class="admin-nav">
        <a href="reports.php" class="<?= ($admin_active == 'reports') ? 'active' : ''; ?>">&#9998; Reports &amp; Logs</a>
    </nav>

    <span class="admin-nav-label">Account</span>
    <nav class="admin-nav">
        <a href="process/admin_logout.php">&#8594; Logout</a>
    </nav>
</aside>