<div class="row">
   <div class="hero-color">
       <div class="col col--3-of-4 col--centered">
            <h1><?= $app::$user ?> (WIP)<small><?= $app::$user->get_rank(true) ?></small></h1>
       </div>
   </div>
    <div class="col col--2-of-4 col--centered">
        <div class="col col--2-of-4">
            <h2>Basic Settings</h2>
            <form action="" method="POST" autocomplete="off">
                <div class="form-element">
                    <label for="name" class="placeholder active"><i class="fa fa-user fa-fw"></i> Name</label>
                    <input id="name" type="text" name="name_" placeholder="" autocomplete="off" value="<?= $app::$user->get_name() ?>" required>
                    <div class="wave-effect"></div>
                </div>
                <div class="form-element">
                    <label for="sirname" class="placeholder active"><i class="fa fa-user fa-fw"></i> Sirname</label>
                    <input id="sirname" type="text" name="sirname_" placeholder="" autocomplete="off" value="<?= $app::$user->get_sirname() ?>"  required>
                    <div class="wave-effect"></div>
                </div>

                <div class="form-element">
                    <label for="mail" class="placeholder active"><i class="fa fa-envelope fa-fw"></i> Mail</label>
                    <input id="mail" type="text" name="mail_" placeholder="" value="<?= $app::$user->get_mail() ?>" required>
                    <div class="wave-effect"></div>
                </div>


                <div class="form-element">
                    <input type="submit" name="submitRegister" value="Change" class="btn">
                </div>
            </form>
        </div>

        <div class="col col--2-of-4">
            <h2>Change Password</h2>
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
                    <input type="submit" name="submitRegister" value="Change" class="btn">
                </div>
            </form
        </div>
    </div>
</div>