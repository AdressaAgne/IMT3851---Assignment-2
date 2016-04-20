<?php
$newsPage = $news->get_news($_GET['news']);
if($newsPage !== false && $newsPage->get_authorUUID() === $app::$user->get_uuid()){

  $app::$sql->sql("DELETE FROM news WHERE id = :id", ['id' => $newsPage->get_id()], false);
?>

<div class="col col--4-of-4">
    <div class="col col--3-of-4 col--centered">
        <h1><?= $newsPage->get_title() ?> Has been deleted! <small>Redirection to home in 3 seconds</small></h1>
    </div>
    <script>
        setTimeout(function(){
            location.href = "/";
        }, 3000);
    
    </script>
</div>

<?php } else { ?>
    <div class="col col--4-of-4">
        <div class="col col--3-of-4 col--centered">
            <h1>Access Deneid</h1>
        </div>
    </div>
<?php } ?>