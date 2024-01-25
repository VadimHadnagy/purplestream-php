<nav id="nav" class="mobile-nav">
        <a href="/home" class="nav-link">
            <img src="/img/logo.png" alt="Logo" class="logo__home">
        </a>
    <ul>

        <li>
            <a href="/anime/search" class="nav-link">
                <img src="/img/icon/magnifying-glass-solid.svg" alt="Btn-search" class="search-icon">
            </a>
        </li>
        <li>
            <?php 
                if(isset($_SESSION['user'])):
            ?>
            <a href="/user/account" class="nav-link">
                <img src="/img/icon/user-solid.svg" alt="Btn-profils">
            </a>
            <?php 
                else:
            ?>
            <a href="/login" class="nav-link">
                <img src="/img/icon/user-solid.svg" alt="Btn-profils">
            </a>
            <?php 
                endif;
            ?>
        </li>
    </ul>
</nav>
