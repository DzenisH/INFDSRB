<script>
    function submitTreatment(date){
        const form = document.getElementById('lumbar_puncture_form');
        const time = document.getElementById('lumbar_puncture_time');
        time.value = date;
        const radio1 = document.getElementById("lumbar_puncture_radio1");
        const radio2 = document.getElementById("lumbar_puncture_radio2");
        if(radio1.checked || radio2.checked){
            form.submit();
        }else{
            document.getElementById("lumbar_puncture_mandatory").style.display="block";
        }
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
                <button class="appointment_confirm" type="submit"
                style="padding-left: 15px;padding-right:15px">Confirm</button>
            </div>
            <?php if($lumbar_punctures !== "") :?>
            <div class="treatment_choose">
                <div>
                    <p style="font-weight: bold;">Are you taking any of the blood clotting or pain medications?</p>  
                    <p class="lumbar_puncture_mandatory" style="color: red;font-size:14px"
                    id="lumbar_puncture_mandatory">
                        Answering this question is mandatory!
                    </p>
                </div>
                <div class="treatment_diseases">
                    <div class="treatment_disease" style="margin-left: 30px;">
                        <input type="radio" name="takes_medication" value="1"
                        form="lumbar_puncture_form" id="lumbar_puncture_radio1"/> 
                        <p>Yes</p>
                    </div>
                    <div class="treatment_disease" style="margin-left: 30px;">
                        <input type="radio" name="takes_medication" value="0"
                        form="lumbar_puncture_form" id="lumbar_puncture_radio2"/> 
                        <p>No</p>
                    </div>
                </div>
            </div>
    <?php endif; ?>
        <div class="appointment_container3" style="align-items: center;">    
        <?php foreach($appointments as $appointment) :?>
                <?php $flag=0 ?>
                <?php if(isset($lumbar_punctures) && $lumbar_punctures !== "") :?>
                    <?php foreach($lumbar_punctures as $lumbar_puncture) :?>
                        <?php if($appointment === date('H:i',strtotime($lumbar_puncture['date_time']))) :?>
                            <?php $flag=1; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if($flag===0) :?>
                        <div class="appointment_container4">
                            <p class="appointment_treatment"><?php echo $appointment ?></p> 
                            <input type="button" class="appointment_schedule_btn" value="Schedule"
                            onclick="submitTreatment('<?php  echo isset($lumbar_punctures) ?  $date.' '.$appointment.':00' : '0000-00-00 10:10:10' ?>')"/>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </form>
    <input type="text" name="lumbar_puncture_time" id="lumbar_puncture_time" style="display: none;"
    form="lumbar_puncture_form">
    <form method="POST" action="" id="lumbar_puncture_form" style="display: none;"></form>
</div>