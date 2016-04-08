<?php 
    if(isset($_POST['submitLogin'])){
        if($account->login($_POST['username_'], $_POST['password_'], false)){
            echo '<script>window.location = "/"</script>';
        };
    }

?>
<div class="row">
    
    <div class="col col--1-of-4 col--centered">
       <div class="clip"></div>
        <form action="" method="POST" autocomplete="off">
            <div class="form-element">
               <label for="username">Username</label>
                <input id="username" type="text" name="username_" placeholder="Username" required>
                
                
            </div>
            <div class="form-element">
                <label for="password">Password</label>
                <input id="password" type="password" name="password_" placeholder="Password" required>
               
            </div>
            <div class="form-element">
                <input type="submit" name="submitLogin" value="Login" class="btn">
            </div>
        </form>

    </div>
    
</div>