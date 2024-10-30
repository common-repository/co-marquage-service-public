<div id="co-bar">

    <a href="./" class="co-home" title="accueil des démarches">
        <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/home.svg"); ?>
    </a>

    <form id="co-search" action="<?php the_permalink(); ?>" name="cosearch" method="POST">
        <input type="hidden" name="action" value="cosearch">
        <input type="search" name="co-search"  id="co-searchinput" title="recherche" placeholder="ex. : Passeport, acte de naissance, ..." value="<?php echo (isset($_POST['co-search']))? htmlentities($_POST['co-search']) : null ?>">
        <input type="submit" value="Ok" id="co-searchbtn" class="co-btn">
    </form>

    <a href="https://www.service-public.fr/" target="_blank" class="co-btn btn-monsp" title="vers Service-public.fr">
        <img src="<?php echo KIENSO_COMARQUAGE_URL . "assets/images/service-public.jpg"; ?>" width="220px" alt="logo service-public.fr">
    </a>

</div>
<div id="co-top"></div>
