<script>

    function getEmail(){
        const queryString = window.location.search;
        const parameters = new URLSearchParams(queryString);
        const value = parameters.get('email');
        return value;
    }

    window.onload = function(){
        document.getElementById("verification_field").innerText = getEmail();
    }

    function Verify(){
        document.getElementById("verification_email").value = getEmail();
        const form = document.getElementById("verification_form");
        form.submit();  
    }

</script>

<?php 

    if(isset($result) === true && $result === true){
        header('Location:/login');
    }
?>


<div class="verification_Container2">
    <form action="" method="POST" id="verification_form">
        <div class="verification_paper">
            <hr/>
            <p class="verification_header">Verify your e-mail to finish signing up for INFDSRB</p>
            <p class="verification_thanks">Thank you for choosing <span style="color:red">INFDSRB</span>.</p>
            <p class="verification_confirm">
                Please confirm that <span style="font-weight:bold" id="verification_field"></span> is your e-mail address by entering
                the code  previously sent to your e-mail account.
            </p>
            <input class="verification_codeInput1" id="verification_codeInput" name="code"/>
            <input style="display: none;" id="verification_email" name="email"/>
            <?php if(isset($result) === true && $result === false) :?>
                <p class="verification_error">Verification code is incorrect!</p>
            <?php endif; ?>
            <button class="verification_verifyBtn" onclick="Verify()">
                VERIFY
            </button>
            <hr style="margin-top:30px"/>
        </div>
    </form>
</div>