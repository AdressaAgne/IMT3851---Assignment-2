
<div class="row">
   <div class="hero-color">
       <div class="col col--3-of-4 col--centered">
            <h1>Login</h1>
       </div>
   </div>
    <div class="col col--1-of-4 col--centered">
      <div class="error">
          <?php echo isset($error) ? $error : "" ?>
      </div>
       <div class="clip"></div>
        <form action="" method="POST" autocomplete="off">
            <div class="form-element">
                <label for="username" class="placeholder"><i class="fa fa-envelope fa-fw"></i> Mail</label>
                <input id="username" type="text" name="username_" placeholder="" required>
                <div class="wave-effect"></div>
            </div>
            <div class="form-element">
                <label for="password" class="placeholder"><i class="fa fa-key fa-fw"></i> Password</label>
                <input id="password" type="password" name="password_" placeholder="" required>
                <div class="wave-effect"></div>
            </div>
            <div class="form-element">
                <input type="submit" name="submitLogin" value="Login" class="btn">
            </div>
        </form>

    </div>
    
</div>