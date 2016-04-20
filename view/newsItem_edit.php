<?php
$newsPage = $news->get_news($_GET['news']);
if($newsPage !== false && $newsPage->get_authorUUID() === $app::$user->get_uuid()){ ?>

  <div class="col col--4-of-4">
   <div class="hero-color">
       <div class="col col--4-of-4">
            <h1>Edit News <small>/news/<?= $newsPage->get_permalink() ?></small></h1>
       </div>
   </div>
    <div class="col col--2-of-4">
            <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="form-element">
                    <label for="name" class="placeholder active"><i class="fa fa-pencil fa-fw"></i> Title (Editing the title may change the permalink!)</label>
                    <input id="name" type="text" name="title_" placeholder="" autocomplete="off"  required value="<?= $newsPage->get_title() ?>">
                    <div class="wave-effect"></div>
                </div>
                <div class="form-element">
                    <label for="image" class="placeholder active"><i class="fa fa-image fa-fw"></i> Image Url</label>
                    <input id="image" type="text" name="image_" placeholder="" value="<?= $newsPage->get_ImageSource() ?>" autocomplete="off" required>
                    <div class="wave-effect"></div>
                </div>

                <div class="form-element">
                    <label for="category" class="placeholder active"><i class="fa fa-tag fa-fw"></i> Category</label>
                    <label for="category" class="select__icon"><i class="fa fa-angle-down"></i></label>
                    <select name="category_" id="category">
                          <option value="" disabled>Choose a Category</option>
                       <?php
                            $rows = $app::$sql->select('category ORDER BY name');
                            foreach($rows as $row){
                                $row = new Category($row['id'], $row['name']);
                                if($newsPage->get_categoryID() == $row->get_id()){
                                     echo "<option selected value='{$row->get_id()}'>{$row->get_name()}</option>";
                                } else {
                                     echo "<option value='{$row->get_id()}'>{$row->get_name()}</option>";
                                }
                               
                            }
                        ?>
                    </select>
                    <div class="wave-effect"></div>
                </div>
               
                <div class="textarea-element">
                    <label for="mail" class="placeholder"><i class="fa fa-pencil fa-fw"></i> Text</label>
                    <label for="" class="placeholder right">Use Markdown</label>
                    <textarea name="article_" id="" cols="30" rows="10"><?= $newsPage->get_article() ?></textarea>
                    <div class="wave-effect"></div>
                </div>
                

                <div class="form-element">
                   <input type="hidden" name="id" value="<?= $newsPage->get_id() ?>">
                   <input type="submit" name="submitEditPost" value="Update" class="btn">
                </div>
            </form>
    </div>
    <div class="col col--2-of-4">
        <div class="form__preview article__container" id="previewContainer"><?= $Parsedown->text($newsPage->get_article()) ?></div>
    </div>
</div>
<script>
    $(function(){
        var post = null;
        $("textarea[name=article_]").on("input",function(){
            clearTimeout(post);
            post = setTimeout(function(){
                //"![header image]("+$("#image").val()+")\n"+ header Image
            $.post("/ajax/preview.php", {content : $("textarea[name=article_]").val()}, 
                function(data){
                    $("#previewContainer").html(data);
                }
            );
            }, 450);
        });
    });
</script>




    
<?php } else { ?>
    <div class="col col--4-of-4">
        <div class="col col--1-of-4 col--centered">
            <h1>Access Deneid</h1>
        </div>
    </div>
<?php } ?>