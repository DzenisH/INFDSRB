<script>
    function submitTreatment(date){
        const form = document.getElementById('treatment_form');
        const time = document.getElementById('treatment_time');
        time.value = date;
        form.submit();
    }
</script>

<?php 
    $appointments = [
        "10:00","10:30","11:00","11:30","12:00","12:30","13:00","13:30",
        "14:00","14:30","15:00","15:30","16:00","16:30","17:00","17:30"
    ];
?>

<div class="appointment_container1" style="flex-direction: column;align-items:center">
    <form method="GET" action="" style="display: flex;flex-direction:column;">
            <div class="appointment_container2" style="margin-top: 20px;">
                <p class="appointment_date_text">Enter the date to schedule an appointment:</p>
                <input class="appointment_date" type="date" name="date" style="width: 180px;"
                min="<?php echo (new DateTime('tomorrow'))->format('Y-m-d'); ?>"/>
                <button class="appointment_confirm" type="submit">Confirm</button>
            </div>
            <?php if($treatments !== "") :?>
                <div>
                    <div class="treatment_choose">
                        <p>Choose one of the offered diseases:</p>  
                        <div class="treatment_diseases">
                            <div class="treatment_disease">
                                <input type="radio" name="type_of_disease" value="Genital herpes"
                                form="treatment_form" checked/> 
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
                    <div class="treatment_choose">
                        <p>Choose where you want to be treated:</p>
                        <div class="treatment_diseases" style="margin-left: -10px;">
                            <div class="treatment_disease">
                                <input type="radio" name="place_of_treatment" value="Hospital treatment"
                                form="treatment_form" checked/> 
                                <p>Hospital treatment</p>
                            </div>
                            <div class="treatment_disease">
                                <input type="radio" name="place_of_treatment" value="Home treatment"
                                form="treatment_form"/> 
                                <p>Home treatment</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <div class="appointment_container3" style="align-items: center;">    
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
                            onclick="submitTreatment('<?php  echo isset($treatments) ?  $date.' '.$appointment.':00' : '0000-00-00 10:10:10' ?>')"/>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </form>
    <input type="text" name="treatment_time" id="treatment_time" style="display: none;"
    form="treatment_form">
    <form method="POST" action="" id="treatment_form" style="display: none;"></form>
</div>