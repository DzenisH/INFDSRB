<script>
    function signupPatient(){
        const type = document.getElementById("type");
        const form = document.getElementById("signup_form");
        type.value = "patient";
        form.submit();
    }

    function signupDoctor(){
        const type = document.getElementById("type");
        const form = document.getElementById("signup_form");
        type.value = "doctor";
        form.submit();
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
                        <input class="signup_input" placeholder="First Name" name="name"/>
                        <input class="signup_input" placeholder="Last Name" name="last_name"/>
                        <select id="pet-select" class="signup_input"
                            style="cursor: pointer;" name="gender">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                        <input class="signup_input" placeholder="Place of birth" name="place_of_birth"/>
                        <input class="signup_input" placeholder="Country of birth" name="country_of_birth"/>
                        <input class="signup_input" placeholder="Email" name="email"/>
                    </div>
                    <div class="signup_container7">
                        <input class="signup_input" placeholder="Date of birth" name="date_of_birth"/>
                        <input class="signup_input" placeholder="JMBG" type="number" name="jmbg"/>
                        <input class="signup_input" placeholder="Phone Number" type="number" name="phone_number"/>
                        <input class="signup_input" placeholder="Password" name="password"/>
                        <input class="signup_input" placeholder="Confirm Password"/>
                        <div style="margin-top: 14px;">
                            <p style="margin-bottom: 5px;">Image</p>
                            <input  placeholder="Image" name="image" type="file"/>
                        </div>
                        <input class="signup_input" style="display: none;" id="type" name="type"/>
                    </div>
                </div>
                <div class="signup_container8">
                    <div class="signup_buttons">   
                        <button class="signup_button" style="margin-left: 0px;"
                        onclick="signupPatient()">SIGNUP AS PATIENT</button>
                        <button class="signup_button"
                        onclick="signupDoctor()">SINGUP AS DOCTOR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>