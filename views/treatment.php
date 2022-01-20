<script>
    function submitTreatment(){
        const form = document.getElementById('treatment_form');
        form.submit();
    }
</script>

<?php 
    $appointments = [
        "10:00","10:30","11:00","11:30","12:00","12:30","13:00","13:30",
        "14:00","14:30","15:00","15:30","16:00","16:30","17:00","17:30"
    ];
?>

<div class="appointment_container1">
    <form method="GET" action="">
        <div class="appointment_container2">
            <p class="appointment_date_text">Enter the date to schedule an appointment:</p>
            <input class="appointment_date" placeholder="Y-m-d" name="date" value=""/>
            <button class="appointment_confirm" type="submit">Confirm</button>
        </div>
        <?php if($treatments !== "") :?>
            <div class="treatment_choose">
                <p>Choose one of the offered diseases:</p>  
                <div class="treatment_diseases">
                    <div class="treatment_disease">
                        <input type="radio" name="type_of_disease" value="Genital herpes"
                        form="treatment_form"/> 
                        <p>Genital herpes</p>
                    </div>
                    <div class="treatment_disease">
                        <input type="radio" name="type_of_disease" value="Hepatitis"
                        form="treatment_form"/> 
                        <p>Hepatitis</p>
                    </div>
                    <div class="treatment_disease">
                        <input type="radio" name="type_of_disease" value="Meningitis"
                        form="treatment_form"/> 
                        <p>Meningitis</p>
                    </div>
                </div>
        </div>
        <?php endif; ?>
        <div class="appointment_container3">    
        <?php foreach($appointments as $appointment) :?>
                <?php $flag=0 ?>
                <?php if(isset($treatments) && $treatments !== "") :?>
                    <?php foreach($treatments as $treatment) :?>
                        <?php if($appointment === date('H:i',strtotime($treatment['date_time']))) :?>
                            <?php $flag=1; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if($flag===0) :?>
                        <div class="appointment_container4">
                            <p class="appointment_treatment"><?php echo $appointment ?></p> 
                            <input type="button" class="appointment_schedule_btn" value="Schedule"
                            onclick="submitTreatment()"/>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </form>
    <form method="POST" action="" id="treatment_form" style="display: none;"></form>
</div>