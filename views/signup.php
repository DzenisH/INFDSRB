<script>

    function checkValidation(){
        //At least 8 characters long,Include at least 1 lowercase letter,1 capital letter,1 number,1 special character => !@#$%^&*
        const passwordRegex = /^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,}$/g;
        const password = document.getElementById('signup-password');
         //anystring@anystring.anystring(without multiple @)
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const email = document.getElementById('signup-email');
        //exactly 14 characters
        const jmbg = document.getElementById('signup-jmbg');
        const passwordConfirm = document.getElementById('signup-passwordConfirm');
        const name = document.getElementById('signup-name');
        const last_name = document.getElementById('signup-last_name');
        const place_of_birth = document.getElementById('signup-place_of_birth');
        const country_of_birth = document.getElementById('signup-country_of_birth');
        const phone_number = document.getElementById('signup-phone_number');
        const phoneRegex = /\D/;
        let flag = false;
        const image = document.getElementById('signup_image');
        if(image.value === ''){
            flag = true;
        }
        if(flag){
            image.style.border = '2px solid red';
        }else{
            image.style.border = 'none';
        }
        if(phone_number.value.match(phoneRegex)){
            phone_number.style.border = '2px solid red';
        }else{
            phone_number.style.border = 'none';
        }
        if(!password.value.match(passwordRegex)){
            password.style.border = '2px solid red';
            document.getElementById('password-error').style.display = 'block';
        }else{
            password.style.border = 'none';
            document.getElementById('password-error').style.display = 'none';
        }
        if(!email.value.match(emailRegex)){
            email.style.border = '2px solid red';
            document.getElementById('email-error').style.display = 'block';
        }else{
            email.style.border = 'none';
            document.getElementById('email-error').style.display = 'none';
        }
        if((jmbg.value).length !== 14){
            jmbg.style.border = '2px solid red';
            document.getElementById('jmbg-error').style.display = 'block';
        }else{
            jmbg.style.border = 'none';
            document.getElementById('jmbg-error').style.display = 'none';
        }
        if(password.value !== passwordConfirm.value){
            passwordConfirm.style.border="2px solid red";
            document.getElementById('passwordConfirm-error').style.display = 'block';
        }else{
            passwordConfirm.style.border="none";
            document.getElementById('passwordConfirm-error').style.display = 'none';
        }
        if((name.value).length === 0){
            name.style.border = "2px solid red";
        }else{
            name.style.border = "none";
        }
        if((last_name.value).length === 0){
            last_name.style.border = "2px solid red";
        }else{
            last_name.style.border = "none";
        }
        if((place_of_birth.value).length === 0){
            place_of_birth.style.border = "2px solid red";
        }else{
            place_of_birth.style.border = "none";
        }
        if((country_of_birth.value).length === 0){
            country_of_birth.style.border = "2px solid red";
        }else{
            country_of_birth.style.border = "none";
        }
        if(password.value.match(passwordRegex) && email.value.match(emailRegex)
            && (jmbg.value).length === 14 && password.value === passwordConfirm.value &&
            (name.value).length > 0 && (last_name.value).length > 0 && (place_of_birth.value).length > 0 
            && (country_of_birth.value).length > 0 && !phone_number.value.match(phoneRegex)
            && (phone_number.value).length > 0 && !flag){   
            return true;
        }else{
            return false;
        }
    }

    function signupPatient(){
        const type = document.getElementById("type");
        const form = document.getElementById("signup_form");
        type.value = "patient";
        if(checkValidation()){
            form.submit();
        }
    }

    function signupDoctor(username){
        const type = document.getElementById("type");
        const form = document.getElementById("signup_form");
        type.value = "doctor";
        if(checkValidation()){
            form.submit();
        }
    }
</script>

<div class="signup_container">
    <div class="signup_container1">
        <div class="signup_container2">
            <div>
                <p class="signup_welcome">Welcome Back!</p>
                <p class="sigunp_login_text">Login with your existing account</p>
                <a href="/login">
                    <button class="signup_login_btn">LOG IN</></button>
                </a>
            </div>
        </div>
        <div class="signup_container3">
            <form action="" method="POST" id="signup_form" enctype="multipart/form-data">
                <p class="signup_create">Create Account</p>
                <div class="signup_container5">
                    <div class="signup_container6">
                        <input class="signup_input" placeholder="First Name" name="name" id="signup-name"/>
                        <input class="signup_input" placeholder="Last Name" name="last_name" id="signup-last_name"/>
                        <select id="pet-select" class="signup_input"
                            style="cursor: pointer;" name="gender">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                        <input class="signup_input" placeholder="Place of birth" name="place_of_birth" id="signup-place_of_birth"/>
                        <input class="signup_input" placeholder="Country of birth" name="country_of_birth" id="signup-country_of_birth"/>
                        <input class="signup_input" placeholder="Email" name="email" id="signup-email"/>
                        <p id="email-error" class="signup_error">anystring@anystring.anystring(without multiple @)</p>
                    </div>
                    <div class="signup_container7">
                        <!-- <input class="signup_input" placeholder="Date of birth(dd-mm-yyyy)" name="date_of_birth"/> -->
                        <input type="date" required name="date_of_birth" class="signup_input"/>
                        <input class="signup_input" placeholder="JMBG" type="number" name="jmbg" id="signup-jmbg"/>
                        <p id="jmbg-error" class="signup_error">Enter exactly 14 characters</p>
                        <input class="signup_input" placeholder="Phone Number" name="phone_number" id="signup-phone_number"/>
                        <input class="signup_input" placeholder="Password" name="password" id="signup-password" type="password"/>
                        <p id="password-error" class="signup_error">At least 8 characters long,Include at least 1 lowercase letter,1 capital letter,1 number,1 special character</p>
                        <input class="signup_input" placeholder="Confirm Password" id="signup-passwordConfirm" type="password"/>
                        <p id="passwordConfirm-error" class="signup_error">Please enter correct password</p>
                        <div style="margin-top: 14px;">
                            <p style="margin-bottom: 5px;">Image</p>
                            <input name="image" type="file" id="signup_image"/>
                        </div>
                        <input class="signup_input" style="display: none;" id="type" name="type"/>
                    </div>
                </div>
                <div class="signup_container8">
                    <div class="signup_buttons">   
                        <button class="signup_button" style="margin-left: 0px;"
                        onclick="signupPatient()" type="button">SIGNUP AS PATIENT</button>
                        <button class="signup_button" type="button"
                        onclick="signupDoctor('<?php echo  isset($username) ? $username : '' ?>')">SINGUP AS DOCTOR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>