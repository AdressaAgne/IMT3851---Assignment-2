<?php require_once("class/app.php"); ?>
<!-- © Agne Ødegaard 2016 - 140699-->
<!DOCTYPE html>
<html lang="en">
<head>
    <!--    Basic Meta tags     -->
    <meta charset="UTF-8">
    <meta name="application-name" content="Newspaper">
    <meta name="author" content="Agne Ødegaard">
    <meta name="description" content="Online newspaper site, made for Assignment 2 at NTNU Gjøvik IMT3851">
    
    <!--    Mobile     -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!--    Android    -->
    <meta name="theme-color" content="#009688">
    <link rel="icon" type="image/png"            href="/img/favicons/android-chrome-192x192.png" sizes="192x192">
    
    <!--    Apple    -->
    <link rel="apple-touch-icon" sizes="57x57"   href="/img/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60"   href="/img/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72"   href="/img/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76"   href="/img/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/img/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/img/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/img/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicons/apple-touch-icon-180x180.png">
    
    <!--    Windows Phone    -->
    <meta name="msapplication-TileColor" content="#009688">
    <meta name="msapplication-TileImage" content="/img/favicons//mstile-144x144.png">

    <!--    Other Icon Stuff    -->
    <link rel="manifest" href="/img/favicons/manifest.json">
    <link rel="mask-icon" href="/img/favicons/safari-pinned-tab.svg" color="#009688">
    <link rel="icon" type="image/png"            href="/img/favicons/favicon-96x96.png"          sizes="96x96">
    <link rel="icon" type="image/png"            href="/img/favicons/favicon-32x32.png"          sizes="32x32">
    <link rel="icon" type="image/png"            href="/img/favicons/favicon-16x16.png"          sizes="16x16">

    <!--    Google Fonts     -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400' rel='stylesheet' type='text/css'>
    
    <!--    Links     -->
    <link rel="stylesheet" href="/css/main.css">
    <title><?= $app::$page->get_title() ?> - News App</title>
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