<?php 
    include_once("include/Header.php"); 
?>
<link rel="stylesheet" href="/css/pages/homepage.css">
<link rel="stylesheet" href="/css/pages/search.css">

<header>
  <?php include_once ("include/NavBar.php"); ?>
</header>

<div class="container">
    <!-- Barre de recherche -->
    <div class="search-container">
        <form action="/anime/search/vf" method="post">
            <input class="search_bar_vf" type="text" name="query_vf" placeholder="Rechercher VF...">
            <button class="button_submit_searchvf" type="submit"><img src="/img/icon/magnifying-glass-solid.svg" alt=""></button>
        </form>
        <form action="/anime/search/vostfr" method="post">
            <input class="search_bar_vostfr" type="text" name="query_vostfr" placeholder="Rechercher VOSTFR...">
            <button class="button_submit_searchvostfr" type="submit"><img src="/img/icon/magnifying-glass-solid.svg" alt=""></button>
        </form>
    </div>
      <div class="anime_container_filter">
        <button class="anime_filter"><img src="\img\icon\sliders-solid.svg" alt=""></button>
    </div>
    <div id="categories">
      <form action="/anime/searchbycategories" method="post">
        <?php
          $categoryIDs = array();
          foreach($categories as $category){
              echo "<label class='label-categories' for='" . $category->getAnimeCategoryID() . "'>" .
                  "<input class='input_categories' type='checkbox' id='checkbox' name='" . $category->getAnimeCategoryID() . "'>" .
                  $category->getAnimeCategoryName() .
              "</label>";

              if (isset($_POST[$category->getAnimeCategoryID()])) {
                  $categoryIDs[] = $category->getAnimeCategoryID();
              }
          }
        ?>
        <input type="hidden" name="categoryIDs" value="<?php echo implode(',', $categoryIDs); ?>">
        <input type="submit" value="Envoyer">
      </form>
    </div>

    <div class="anime-row">
      <?php echo $content; ?>
    </div>
    <script src="https://kit.fontawesome.com/46e6162e9a.js" crossorigin="anonymous"></script>

    <?php 
include_once("include/Footer.php"); 
?>