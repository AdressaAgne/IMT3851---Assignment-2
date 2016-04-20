<div class="row">
   <div class="hero-color">
       <div class="col col--3-of-4 col--centered">
            <h1><?= $app::$user ?><small><?= $app::$user->get_rank(true) ?></small>
                 <?php 
                if(isset($_GET['success'])){
                    echo '<small class="success">'.$_GET['success'].'</small>';
                } 
                if(isset($_GET['error'])){
                    echo '<small class="error">'.$_GET['error'].'</small>';
                }
            ?>
            </h1>
       </div>
   </div>
    <div class="col col--2-of-4 col--centered">
        <div class="col col--4-of-4">
           <h2>Font Page Settings <small><strong>Note:</strong> This will be stored in cookies, if you leave the page for more then 30days this will be reset</small></h2>
            <form action="" method="POST">
                <div class="form-element form-element--inline">
                    <label for="radio_recent" class="hand">
                        <input id="radio_recent" type="radio" name="frontPage" value="recent" <?= isset($_COOKIE['frontpage']) && $_COOKIE['frontpage'] == "recent" ? "checked" : (!isset($_COOKIE['frontpage']) ? "checked" : "") ?>> Recent
                    </label>
                </div>
                <div class="form-element form-element--inline">  
                    <label for="radio_popular" class="hand">
                        <input id="radio_popular" type="radio" name="frontPage" value="hot"  <?= isset($_COOKIE['frontpage']) && $_COOKIE['frontpage'] == "hot" ? "checked" : "" ?>> Popular
                    </label>
                </div>
                <div class="form-element">
                    <input type="submit" name="submitChangeCookie" value="Change" class="btn">
                </div>
            </form>
        </div>
        <div class="col col--2-of-4 col--margin-top">
            <h2>Basic Settings</h2>
            <form action="" method="POST" autocomplete="off">
                <div class="form-element">
                    <label for="name" class="placeholder active"><i class="fa fa-user fa-fw"></i> Name</label>
                    <input id="name" type="text" name="name_" placeholder="" autocomplete="off" value="<?= $app::$user->get_name() ?>" required>
                    <div class="wave-effect"></div>
                </div>
                <div class="form-element">
                    <label for="sirname" class="placeholder active"><i class="fa fa-user fa-fw"></i> Surname</label>
                    <input id="sirname" type="text" name="surname_" placeholder="" autocomplete="off" value="<?= $app::$user->get_surname() ?>"  required>
                    <div class="wave-effect"></div>
                </div>

                <div class="form-element">
                    <label for="mail" class="placeholder active"><i class="fa fa-envelope fa-fw"></i> Mail</label>
                    <input id="mail" type="text" name="mail_" placeholder="" value="<?= $app::$user->get_mail() ?>" required>
                    <div class="wave-effect"></div>
                </div>


                <div class="form-element">
                    <input type="submit" name="submitUpdateAccountInfo" value="Change" class="btn">
                </div>
            </form>
        </div>

        <div class="col col--2-of-4 col--margin-top">
            <h2>Change Password
            </h2>
            <form action="" method="POST" autocomplete="off">
                <div class="form-element">
                    <label for="password_old" class="placeholder"><i class="fa fa-key fa-fw"></i> Old Password</label>
                    <input id="password_old" type="password" name="password_old" placeholder="" autocomplete="off" value="" required>
                    <div class="wave-effect"></div>
                </div>
                <div class="form-element">
                    <label for="password_new_1" class="placeholder"><i class="fa fa-key fa-fw"></i> New Password</label>
                    <input id="password_new_1" type="password" name="password_new_1" placeholder="" autocomplete="off" value=""  required>
                    <div class="wave-effect"></div>
                </div>

                <div class="form-element">
                    <label for="password_new_2" class="placeholder"><i class="fa fa-key fa-fw"></i> New Password Again</label>
                    <input id="password_new_2" type="password" name="password_new_2" placeholder="" value="" required>
                    <div class="wave-effect"></div>
                </div>


                <div class="form-element">
                    <input type="submit" name="submitChangePassword" value="Change" class="btn">
                </div>
            </form>
        </div>
        
    </div>
    <div class="col col--3-of-4 col--centered">
            <div class="hero-color">
                <h1>Your News</h1>
            </div>
            <div class="table">
                <div class="table__head">
                    <div class="table__cell">Title</div>
                    <div class="table__cell">Category</div>
                    <div class="table__cell">Posted</div>
                    <div class="table__cell"><i class="fa fa-thumbs-up"></i></div>
                    <div class="table__cell"><i class="fa fa-thumbs-down"></i></div>
                    <div class="table__cell">%</div>
                </div>
                <?php 
                    $posts = $app::$sql->sql('SELECT  n.*, c.name as cat_name, a.name as username,
                                               COUNT(v.news_id) as totalVotes,
                                               SUM(v.vote = 1) as upVotes,
                                               SUM(v.vote = -1) as downVotes,
                                               SUM(v.vote) - SUM(v.vote = -1) as score
                                               
                                               FROM news as n
                                               
                                               LEFT JOIN votes as v ON n.id = v.news_id
                                               LEFT JOIN category as c ON n.category = c.id
                                               INNER JOIN account as a ON n.author = a.uuid
                                               
                                               WHERE n.author = :id
                                               GROUP BY n.id
		                                       ORDER BY n.timestamp DESC', ['id' => $app::$user->get_uuid()]);

                    foreach($posts as $key => $newsPage){ 
                    $newsPage = new NewsPage($newsPage);
                    ?>
                    <div class="table__row">
                        <div class="table__cell"><a href="/news/<?= $newsPage->get_permalink() ?>"><?= $newsPage->get_title() ?></a></div>
                        <div class="table__cell"><?= $newsPage->get_cat_name() ?></div>
                        <div class="table__cell"><?= $newsPage->get_timestamp() ?></div>
                        <div class="table__cell"><?= $newsPage->get_votes()['up'] ?></div>
                        <div class="table__cell"><?= $newsPage->get_votes()['down'] ?></div>
                        <div class="table__cell"><?= $newsPage->get_votes()['percent'] ?>%</div>
                    </div>
                <?php } ?>
            </div>
        </div>
</div>