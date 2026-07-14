<nav class="site-nav">
        <div class="nav-inner">
            <a href="<?= $root_path ?? ''; ?>index.php"
                class="<?= ($active_nav == 'home') ? 'active' : ''; ?>">Home</a>

            <a href="<?= $root_path ?? ''; ?>store.php"
                class="<?= ($active_nav == 'store' && (!isset($_GET['category']) || $_GET['category'] == '')) ? 'active' : ''; ?>">Shop All</a>

            <a href="<?= $root_path ?? ''; ?>store.php?category=tops"
                class="<?= (isset($_GET['category']) && $_GET['category'] == 'tops') ? 'active' : ''; ?>">Tops</a>

            <a href="<?= $root_path ?? ''; ?>store.php?category=bottoms"
                class="<?= (isset($_GET['category']) && $_GET['category'] == 'bottoms') ? 'active' : ''; ?>">Bottoms</a>

            <a href="<?= $root_path ?? ''; ?>store.php?category=dresses"
                class="<?= (isset($_GET['category']) && $_GET['category'] == 'dresses') ? 'active' : ''; ?>">Dresses</a>

            <a href="<?= $root_path ?? ''; ?>store.php?category=outerwear"
                class="<?= (isset($_GET['category']) && $_GET['category'] == 'outerwear') ? 'active' : ''; ?>">Outerwear</a>

            <a href="<?= $root_path ?? ''; ?>store.php?category=accessories"
                class="<?= (isset($_GET['category']) && $_GET['category'] == 'accessories') ? 'active' : ''; ?>">Accessories</a>

            <a href="<?= $root_path ?? ''; ?>about.php"
                class="<?= ($active_nav == 'about') ? 'active' : ''; ?>">About</a>
        </div>
</nav>