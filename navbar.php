<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link <?php if ($current_page == 'index') echo 'active'; ?>" href="./index.php">Home</a>
                <a class="nav-link <?php if ($current_page == 'informatica') echo 'active'; ?>" href="informatica.php">Informatica</a>
                <a class="nav-link <?php if ($current_page == 'tep') echo 'active'; ?>" href="tep.php">TPS</a>
                <a class="nav-link <?php if ($current_page == 'gpo') echo 'active'; ?>" href="#">GPO</a>
                <a class="nav-link <?php if ($current_page == 'urbanfix') echo 'active'; ?>" href="urbanfix.php">UrbanFix</a>
            </div>
        </div>
    </div>
</nav>