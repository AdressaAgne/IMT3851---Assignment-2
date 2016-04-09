<?php include("class/app.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!--    Basic Meta tags     -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="application-name" content="Newspaper">
    <meta name="author" content="Agne Ødegaard">
    <meta name="description" content="Online newspaper site, made for Assignment 2 at NTNU Gjøvik IMT3851">
    <meta name="theme-color" content="#112233">
    
    <!--    Mobile     -->
    
    
    <!--    Save to Home Screen     -->
    
    
    <!--    Google Fonts     -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400' rel='stylesheet' type='text/css'>
    
    <!--    Links     -->
    <link rel="stylesheet" href="/css/main.css">
    <title><?= $app::$page->get_title() ?></title>
</head>
<body>
    <!--    Menu     -->
    <nav>
        <div class="row">
            <div class="col col--4-of-4">
                <?php include($app->get_menu()); ?>
            </div>
        </div>
    </nav>

    <!--    Page Content     -->
    <main>
        <div class="row">
            <?php include($app::$config['view_folder'].$app::$page->get_content()); ?>
        </div>
        
        <pre><?php print_r($_SESSION); ?></pre>
    </main>
    
    <!--    HTML Footer     -->
    <div class="row">
        <div class="col col--4-of-4">
            <?php include($app->get_footer()); ?>
        </div>
    </div>
        
    <!--    Scripts     -->
    <script src="/js/jquery-1.12.3.min.js"></script>
    <script>
        $(function(){
            $("#burger").click(function(){
                $(".menu__item:not(.visible--phone)").toggle();
            });
            
            
            $("input[type=text], input[type=password]").on("focus", function(){
                $(this).prev("label.placeholder").addClass("active");
            }).on("blur", function(){
                if($(this).val().length == 0){
                    $(this).prev("label.placeholder").removeClass("active");
                }
                
            });
        });
    </script>
</body>
</html>