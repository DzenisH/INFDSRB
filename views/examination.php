<script>

function checkValidation(){
    const diagnosis = document.getElementById("examination_diagnosis").value;
    const therapy = document.getElementById("examination_therapy").value;

    const diagnosisError = document.getElementById("examination_error_diagnosis");
    const therapyError = document.getElementById("examination_error_therapy");
    
    if(diagnosis === ''){
        diagnosisError.style.display = "block"
    }else{
        diagnosisError.style.display = "none"
    }

    if(therapy === ''){
        therapyError.style.display = "block"
    }else{
        therapyError.style.display = "none"
    }

    if(diagnosis === '' || therapy === ''){
        return false;
    }
    return true
}

function submitExamination(){
    const form = document.getElementById("examination_form");
    if(checkValidation()){
        form.submit();
    }
}

</script>


<div class="examination_container1">
    <form method="POST" action="" id="examination_form">
        <div class="examination_container2">
            <div class="examination_container3">
                <p>Diagnosis</p>
                <textarea name="diagnosis" id="examination_diagnosis"></textarea>
            </div>
            <p id="examination_error_diagnosis" style="margin-left: 130px;">
                Diagnosis is required!
            </p>
            <div class="examination_container4">
                <p>Therapy</p>
                <textarea name="therapy" id="examination_therapy"></textarea>
            </div>
            <p id="examination_error_therapy" style="margin-left: 130px;">
                Therapy is required!
            </p>
            <button type="button" class="examination_submit"
            onclick="submitExamination()">
                Submit
            </button>
        </div>
    </form>
</div>
