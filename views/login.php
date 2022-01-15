<div class="login_container">
    <div class="login_container2">
        <h4 class="login_header">Login</h4>
        <p class="login_account">Have an account?</p>
        <form class="login_form" action="" method="POST">
            <input class="login_input" placeholder="Email" name="email"/>
            <input class="login_input" placeholder="Password" name="password"/>
            <button type="submit" class="login_sign">SIGN IN</button>
            <div class="login_container3">
                <a href="/signup" class="login_signup">- Or Sign Up -</a>
                <?php if(isset($_SESSION['user'])) :?>
                    <a href="/changePassword" class="login_forgot">Change Password</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>