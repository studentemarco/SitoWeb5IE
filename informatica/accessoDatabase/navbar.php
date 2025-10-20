<?php
// Lista casuale di elementi solo per provare
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $userid = null;
    $mylists = null;

    if (isset($_SESSION["name"])): 
        require "accesso/usersdata.php";
        $userid = $_SESSION['userid'];
        $_SESSION["userdata"] = UserData::getData($userid);
        $mylists = ((array)$_SESSION["userdata"]->lists);
    endif;
?>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #08225aff; padding: 20px;">
    <a class="navbar-brand" href="index.php">
        ShelfSpace
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link <?php if ($current_page == 'home') echo 'active'; ?>" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($current_page == 'preferiti.php') echo 'active'; ?>" href="preferiti.php">Preferiti</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($current_page == 'libri_letti.php') echo 'active'; ?>" href="libri_letti.php">Libri letti</a>
            </li>
        </ul>
        </li>
        </ul>
        <form class="d-flex" action="search.php" method="get">
            <input class="form-control me-2" type="search" placeholder="Cerca" name="query" id="query">
            <button class="btn btn-outline-light" type="submit" onclick="search()">Cerca</button>
        </form>
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        <?php 
            
            if (isset($_SESSION["name"])){ ?>

            <span class="navbar-text" style="color: white; margin-right: 15px;">
                <a href="account.php" style="color: white; text-decoration: none;">
                    Benvenuto, <?php echo htmlspecialchars($_SESSION["name"]); ?>!
                </a>
            </span>
            <button class="btn btn-outline-light" type="button" onclick="location.href='accesso/logout.php'">Logout</button>
            
            <?php } else { ?>
            <span class="navbar-text" style="color: white; margin-right: 15px;">
                <button class="btn btn-outline-light" type="button" onclick="location.href='./accesso/accedi.php'">Accedi/Registrati</button>
                <a class="btn btn-outline-light" type="button" href='./accesso/accedi.php'>Accedididi</a>
            </span>
        <?php } ?>
    </div>
</nav>

<script>
    function search(){
        var query = document.getElementById('query').value;
        window.location.href = 'search.php?query=' + encodeURIComponent(query);
    }
</script>
