<script>

    window.onload = function(){
        const queryString = window.location.search;
        const parameters = new URLSearchParams(queryString);
        const value = parameters.get('email');
        document.getElementById("verification_field").innerText = value;
    }

</script>


<div class="verification_Container2">
    <div class="verification_paper">
        <hr/>
        <p class="verification_header">Verify your e-mail to finish signing up for Leprog</p>
        <p class="verification_thanks">Thank you for choosing <span style="color:rgb(50, 222, 132)">Leprog</span>.</p>
        <p class="verification_confirm">
            Please confirm that <span style="font-weight:bold" id="verification_field"></span> is your e-mail address by entering
            the code  previously sent to your e-mail account.
        </p>
        <input class="verification_input" id="codeInput"/>
        <button class="verification_verifyBtn" onclick="Verify()">
            VERIFY
        </button>
        <hr style="margin-top:30px"/>
    </div>
</div>