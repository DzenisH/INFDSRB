
<script>
    function changeSubmit(password){
        const form = document.getElementById('changePassword_form');
        const passwordRegex = /^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,}$/;
        const oldPassword = document.getElementById('oldPassword');
        const errorOldPassword = document.getElementById('changePassword_oldPasswordText');
        const newPassword = document.getElementById('newPassword');
        const errorNewPassword = document.getElementById('changePassword_newPasswordText');
        if(oldPassword.value !== password ){
            errorOldPassword.style.display = 'block';
            errorNewPassword.style.display = "none";
            return;
        }else{
            errorOldPassword.style.display = 'none';
        }
        if(newPassword.value.match(passwordRegex)){
            errorNewPassword.style.display = "none";
            form.submit();
        }else{
            errorNewPassword.style.display = "block";
        }
    
    }
</script>

<div class="login_container">
    <div class="login_container2" style="position: relative;">
        <h4 class="login_header">Change password</h4>
        <form class="login_form" action="" method="POST" id="changePassword_form">
            <input class="login_input" placeholder="Old Password" name="odlPassword"
            id="oldPassword"/>
            <p id="changePassword_oldPasswordText">Please enter correct password!</p>
            <input class="login_input" placeholder="New Password" name="newPassword"
            id="newPassword"/>
            <p id="changePassword_newPasswordText">At least 8 characters long,Include at least 1 lowercase letter,1 capital letter,1 number,1 special character</p>
            <button class="login_sign" type="button"
            onclick="changeSubmit('<?php echo ($_SESSION['user'])['password'] ?>')">CONFIRM</button>
            <p class="changePassword_info">*New password must be different from the last three passwords!</p>
        </form>
    </div>
</div>