<?php include("class/app.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--    Basic Meta tags     -->
    <meta charset="UTF-8">
    <meta name="application-name" content="Newspaper">
    <meta name="author" content="Agne Ødegaard">
    <meta name="description" content="Online newspaper site, made for Assignment 2 at NTNU Gjøvik IMT3851">
    <meta name="theme-color" content="#112233">
    
    <!--    Mobile     -->
    
    
    <!--    Save to Home Screen     -->
    
    
    <!--    Google Fonts     -->
    
    
    <!--    Links     -->
    
    <title><?= $app->page->title ?></title>
</head>
<body>
    <main>
        <!--    Menu     -->
        <div class="row">
            <?php include($app->get_menu()); ?>
        </div>

        <!--    Page Content     -->
        <div class="row">
            <h1><?= $app->page->header ?></h1>
            <?php include($app->config['viewFolder'].$app->page->get_content()); ?>
        </div>

        <!--    HTML Footer     -->
        <div class="row">
            <?php include($app->get_footer()); ?>
        </div>
    </main>
    <!--    Scripts     -->
    <script></script>
</body>
</html>