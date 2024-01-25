<?php include_once ("include/Header.php"); ?>
<link rel="stylesheet" href="/css/pages/HomePage.css">
    <header>
        <?php include_once("include/NavBar.php"); ?>
    </header>
<link rel="stylesheet" href="/css/pages/user-form.css">

<main class="main main--f-end main--background">
    <div class="container header-container">
        <img class='logo' src="img/logo.png" alt="logo PurpleStream">
        <h2 class="header__title">Créez votre compte</h2>
    </div>
    <div class="container form__container">
        <form action="/process-register" method="post" class="form register-form">
            <input 
                type="text" 
                id="username" 
                name="user_name" 
                placeholder="Nom d'utilisateur" 
                required
            >
            <input 
                type="email" 
                id="email" 
                name="user_email" 
                placeholder="Email"
                class="<?php if (isset($_GET['error']) && $_GET['error'] == '2') echo "input-error" ?>"
                required
            >
            <?php 
                if (isset($_GET['error']) && $_GET['error'] == '2') {
                    echo "<p class='error-message'>Cet email est déjà utilisé</p>";
                }
            ?>
            <input 
                type="password" 
                id="password" 
                name="user_password" 
                placeholder="Mot de passe" 
                required
            >
            <input 
                type="password" 
                id="confirm-password" 
                name="user_confirm_password" 
                placeholder="Mot de passe de confirmation" 
                class="<?php if (isset($_GET['error']) && $_GET['error'] == '1') echo "input-error"; ?>"
                required
            >
            <?php 
                if (isset($_GET['error']) && $_GET['error'] == '1') {
                    echo "<p class='error-message'>Mot de passe de confirmation incorrect</p>";
                }
            ?>
            <button type="submit" class="button submit-button">Créer ton compte</button>
        </form>
        <a href="/login">Vous avez déjà un compte? <span>Connectez-vous</span></a>
    </div>
</main>

<?php include_once ("include/Footer.php"); ?>