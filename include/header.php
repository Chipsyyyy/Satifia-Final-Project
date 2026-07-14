<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> — Satifia</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= $css_path ?? 'css/style.css'; ?>">
</head>
<body>

    <div class="announcement-bar">
        Free shipping on orders over &#8369;1,500 &nbsp;|&nbsp; New arrivals every week
    </div>

    <header class="site-header">
        <div class="header-inner">
            <div style="width: 160px;"></div>

            <a href="<?= $root_path ?? ''; ?>index.php" class="header-logo">
            Sati<span>fia</span>
            </a>

            <div class="header-actions">
                <?php if(isset($_SESSION['buyer_id'])): ?>
                    <span style="font-size:13px;">Hi, <?= htmlspecialchars($_SESSION['buyer_name']); ?></span>
                    <a href="<?= $root_path ?? ''; ?>process/logout.php">Logout</a>
                <?php else: ?>
                    <a href="<?= $root_path ?? ''; ?>login.php">Login</a>
                    <a href="<?= $root_path ?? ''; ?>register.php">Register</a>
                <?php endif; ?>
                <a href="<?= $root_path ?? ''; ?>cart.php" class="cart-icon">
                    &#128717; Cart
                    <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                        <span class="cart-badge"><?= count($_SESSION['cart']); ?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </header>