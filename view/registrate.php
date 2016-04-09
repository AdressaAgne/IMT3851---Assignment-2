<div class="row">
    <div class="col col--1-of-4 col--centered">
      <div class="error">
          <?php echo isset($error) ? $error : "" ?>
      </div>
       <div class="clip"></div>
        <form action="" method="POST" autocomplete="off">
            <div class="form-element">
                <label for="name" class="placeholder"><i class="fa fa-user fa-fw"></i> Name</label>
                <input id="name" type="text" name="name_" placeholder="" autocomplete="off"  required>
                <div class="wave-effect"></div>
            </div>
            <div class="form-element">
                <label for="sirname" class="placeholder"><i class="fa fa-user fa-fw"></i> Sirname</label>
                <input id="sirname" type="text" name="sirname_" placeholder="" autocomplete="off"  required>
                <div class="wave-effect"></div>
            </div>
            
            <div class="form-element">
                <label for="password1" class="placeholder"><i class="fa fa-key fa-fw"></i> Password</label>
                <input id="password1" type="password" name="password_1" placeholder="" required>
                <div class="wave-effect"></div>
            </div>
            
            <div class="form-element">
                <label for="password2" class="placeholder"><i class="fa fa-key fa-fw"></i> Password Again</label>
                <input id="password2" type="password" name="password_2" placeholder="" required>
                <div class="wave-effect"></div>
            </div>
            
            <div class="form-element">
                <label for="mail" class="placeholder"><i class="fa fa-envelope fa-fw"></i> Mail</label>
                <input id="mail" type="text" name="mail_" placeholder="" required>
                <div class="wave-effect"></div>
            </div>
            
            
            <div class="form-element">
                <input type="submit" name="submitRegister" value="Register" class="btn">
            </div>
        </form>

    </div>
    
</div>