<?php 
include_once("include/Header.php"); 

if(isset($_SESSION['user'])):
?>
    <link rel="stylesheet" href="/css/pages/Account.css">
    <link rel="stylesheet" href="/css/pages/HomePage.css">
    <header>
        <?php include_once("include/NavBar.php"); ?>
    </header>
    <section class="user">
        <div class="user__div">
            <div class="user_information">
                <h1 class="personal__title">Panel de gestion utilisateur</h1>
                <?php echo "<h2 class='welcome__name'>Bienvenue " . $_SESSION["user"]["user_name"] . "</h2" ?>
            </div>
            <?php 
                if($_SESSION['user']['user_role'] == 1):
            ?>
                <div class="container__admin-panel">
                    <a href="/user/admin-panel" class="btn-admin">Admin Panel</a>
                </div>
            <?php
                endif;
            ?>
            <div class="personal__information">
                <?php
                    echo "<p class='user_name'>Nom d'utilisateur : " . $_SESSION["user"]["user_name"] . "</p>";
                    echo "<p class='user_mail'>Email : " . $_SESSION["user"]["user_email"] . "</p>";
                    echo "<p class='user_password'>Password : **********</p>";
                    echo "<a href='/user/change-user' class='btn-account'>Modifier utilisateur</a>";
                    echo "<a href='/logout' class='btn-logout'>Déconnexion</a>";
                ?>
            </div>
            <?php
                if (isset($content)) {
                    echo $content;
                }
            ?>
        </div>
    </section>
<?php 
include_once("include/Footer.php"); 
else:
    echo "Vous n'avez pas accès à cette page, veuillez vous connecter";
endif;
?>