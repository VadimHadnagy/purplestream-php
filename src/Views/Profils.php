<?php
    include("include/Header.php");
?>
<link rel="stylesheet" href="/css/profils.css">
<section class="section__profils">
    <div class="container__profils">
        <?php
            if($profils < 0) {
                echo "<p class='notHaveProfil'>Vous n'avez pas encore de profile</p>";
        ?>
            <div class="createProfils">
                <a href="/user/profil/create"><img src="/img/icon/plus-solid.svg" alt="addProfil" class="svg-addProfil"></a>
                <p class="p-createProfil">Crée un profile</p>
            </div>
        <?php
            } else {
                foreach($profils as $profil)
                {
        ?>
                    <div class="profil">
                        <a href="/user/profil/"><img src="/img/avatar/<?= $profil["user_image"] ?>" alt="profil" class="profil__img"></a>
                        <p class="profil__name"><?= $profil["user_profilname"] ?></p>
                    </div>
        <?php
                }
            }
        ?>
            <div class="createProfils">
                <a href="/user/profil/create"><img src="/img/icon/plus-solid.svg" alt="addProfil" class="svg-addProfil"></a>
                <p class="p-createProfil">Crée un profile</p>
            </div>
    </div>
</section>
<?php 
include("include/Footer.php");
?>