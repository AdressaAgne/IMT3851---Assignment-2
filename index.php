<?php require_once("class/app.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    Basic Meta tags     -->
    <meta name="application-name" content="Newspaper">
    <meta name="author" content="Agne Ødegaard">
    <meta name="description" content="Online newspaper site, made for Assignment 2 at NTNU Gjøvik IMT3851">
    <meta name="theme-color" content="#112233">
    
    <!--    Mobile     -->
    
    
    <!--    Save to Home Screen     -->
    
    
    <!--    Google Fonts     -->
    
    
    <!--    Stylesheets     -->
    
    <title><?= $pages->get_title(); ?></title>
</head>
<body>
   
    <!--    Menu     -->
    <div class="row">
        <?= $pages->get_menu(); ?>
    </div>
    
    <!--    Page Content     -->
    <?= $pages->get_content(); ?>
    
    <!--    HTML Footer     -->
    <div class="row">
        <?= $pages->get_footer(); ?>
    </div>
    
    <!--    Scripts     -->
    <script></script>
</body>
</html>