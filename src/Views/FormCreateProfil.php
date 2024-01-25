<?php
    include("include/Header.php");
?>
<link rel="stylesheet" href="/css/profils.css">
    <section class="section__create-profil">
        <form action="/user/profile/process-create" class="create__profile" method="post" enctype="multipart/form-data">
            <label for="name-profil">Entrez un nom de profile</label>
            <input type="text" name="name-profil" id="create-profile">
            <input type="file" name="image-profil" id="image-profil">
            <input type="submit" value="Créer le profile" class="submit__create-profil">
        </form>
    </section>
<?php
    include("include/Footer.php");
?>