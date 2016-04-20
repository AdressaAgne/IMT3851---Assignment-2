<div class="row">
   <div class="hero-color">
       <div class="col col--3-of-4 col--centered">
            <h1>Admin (WIP)</h1>
       </div>
   </div>
    <div class="col col--3-of-4 col--centered">
            <div class="hero-color">
                <h1>News</h1>
            </div>
            <div class="table">
                <div class="table__head">
                    <div class="table__cell">ID</div>
                    <div class="table__cell">Author</div>
                    <div class="table__cell">Title</div>
                    <div class="table__cell">Category</div>
                    <div class="table__cell">Votes</div>
                    <div class="table__cell table__cell--center table__cell--fixed">Delete</div>
                </div>
                <?php foreach($news as $key => $newsPage){ ?>
                   
                    <div class="table__row">
                        <div class="table__cell"><?= $newsPage->get_id() ?></div>
                        <div class="table__cell"><?= $newsPage->get_author() ?></div>
                        <div class="table__cell"><a href="/news/<?= $newsPage->get_permalink() ?>"><?= $newsPage->get_title() ?></a></div>
                        <div class="table__cell"><?= $newsPage->get_cat_name() ?></div>
                        <div class="table__cell"><?= $newsPage->get_votes()['percent'] ?>%</div>
                        <div class="table__cell table__cell--center"><a href="#"><i class="fa fa-trash"></i></a></div>
                    </div>
                <?php } ?>
            </div>
            
            <div class="hero-color">
                <h1>Users</h1>
            </div>
            <div class="table">
                <div class="table__head">
                    <div class="table__cell">ID</div>
                    <div class="table__cell">Name</div>
                    <div class="table__cell">Mail</div>
                    <div class="table__cell">Posts</div>
                    <div class="table__cell">Rank</div>
                    <div class="table__cell table__cell--center table__cell--fixed">Delete</div>
                </div>
                <?php 
                $users = $app::$sql->sql("SELECT a.*, COUNT(n.id) as posts
                                          FROM account as a
                                          LEFT JOIN news as n ON n.author = a.uuid
                                          GROUP BY a.uuid
                                          ORDER BY a.rank");
                foreach($users as $key => $user){ ?>
                    <div class="table__row">
                        <div class="table__cell"><?= $user['uuid'] ?></div>
                        <div class="table__cell"><?= $user['name'] ?> <?= $user['surname'] ?></div>
                        <div class="table__cell"><?= $user['mail'] ?></div>
                        <div class="table__cell"><?= $user['posts'] ?></div>
                        <div class="table__cell"><?= $user['rank'] ?></div>
                        <div class="table__cell table__cell--center"><a href="#"><i class="fa fa-trash"></i></a></div>
                    </div>
                <?php } ?>
            </div>
            
            <div class="hero-color">
                <h1>Categorys</h1>
            </div>
            <div class="table">
                <div class="table__head">
                    <div class="table__cell">ID</div>
                    <div class="table__cell">Name</div>
                    <div class="table__cell">Posts</div>
                    <div class="table__cell table__cell--center table__cell--fixed">Edit</div>
                    <div class="table__cell table__cell--center table__cell--fixed">Delete</div>
                </div>
                <?php 
                $users = $app::$sql->sql("SELECT c.*, COUNT(n.id) as total
                                          FROM category as c
                                          LEFT JOIN news as n ON n.category = c.id
                                          GROUP BY c.id
                                          ORDER BY c.name");
                foreach($users as $key => $user){ ?>
                    <div class="table__row">
                        <div class="table__cell"><?= $user['id'] ?></div>
                        <div class="table__cell"><?= $user['name'] ?></div>
                        <div class="table__cell"><?= $user['total'] ?></div>
                        <div class="table__cell table__cell--center"><a href="#"><i class="fa fa-pencil"></i></a></div>
                        <div class="table__cell table__cell--center"><a href="#"><i class="fa fa-trash"></i></a></div>
                    </div>
                <?php } ?>
            </div>
    </div>
</div>