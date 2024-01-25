<?php
    include("include/Header.php");
    include("include/NavBar.php");
    if(isset($_SESSION['user'])):
?>

    <link rel="stylesheet" href="/css/pages/ModifyAccount.css">
    <link rel="stylesheet" href="/css/pages/HomePage.css">
    <section class="modify-account">
        <div class="container-modify">
            <form action="/user/modify-mail" method="post" class="modify-mail">
                <p class="modify__title">Modifier votre email</label>
                <p class="actualy__mail">Mail actuel : <?php echo $_SESSION["user"]["user_email"]?></p>
                <input type="email" name="user_mail" id="user_mail" placeholder="Nouvel email" required>
                <input type="submit" value="Modifier" class="modify">
                <?php
                    if (isset($_GET['error'])) {;
                        echo '<p class="error">Le mail est déjà utilisé</p>';
                    }
                    if (isset($_GET['success'])) {;
                        echo '<p class="success">Le mail a été modifier avec succès</p>';
                    }
                ?>
            </form> 
        </div>
        <div class="container-modify">
            <form action="/user/modify-password" class="modify-password" method="post">
                <p class="modify__title">Modifier vôtre mot de passe</h2>
                <div class="container__input">
                    <label for="actualy-password">Entrez votre mots de passe actuel</label>
                    <input type="password" name="actualy-password" id="actualy-password" placeholder="Mot de passe actuelle">
                    <?php
                        if (isset($_GET['error-password'])) {;
                            echo '<p class="error">Le mot de passe est incorrect</p>';
                        }
                    ?>
                </div>
                <div class="container__input">
                    <label for="new-password">Entrez votre nouveau de passe actuel</label>
                    <input type="password" name="new-password" id="new-password" placeholder="Nouveau mot passe">
                </div>
                <div class="container__input">
                    <label for="new-re-password">Ré-entrez votre nouveau de passe actuel</label>
                    <input type="password" name="new-re-password" id="new-re-password" placeholder="Nouveau mot de passe">
                    <?php 
                        if (isset($_GET['error-new-password'])) {;
                            echo '<p class="error">Les mots de passe ne corresponde pas</p>';
                         }
                    ?>
                </div>
                <input type="submit" value="Modifier" class="modify">
                    <?php 
                        if (isset($_GET['success-modify-password'])) {;
                            echo '<p class="success">Mots changer avec succées</p>';
                         }
                    ?>
            </form>
        </div>
    </section>

<?php
    include("include/Footer.php");
    else:
        echo "Vous n'avez pas accès à cette page, veuillez vous connecter";
    endif;
?>