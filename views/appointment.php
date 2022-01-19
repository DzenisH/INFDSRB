
<script>
    function submitAppointment($time){
        const form = document.getElementById('appointment_form');
        const time = document.getElementById('time');
        time.value = $time;
        form.submit();
    }
</script>

<?php 
    $treatments = [
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
        <div class="appointment_container3">
            <?php foreach($treatments as $treatment) :?>
                <?php $flag=0 ?>
                <?php if(isset($appointments) && count($appointments)>0) :?>
                    <?php foreach($appointments as $appointment) :?>
                        <?php if($treatment === date('H:i',strtotime($appointment['date_time']))) :?>
                            <?php $flag=1; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if($flag===0) :?>
                        <div class="appointment_container4">
                            <p class="appointment_treatment"><?php echo $treatment ?></p>
                            <input value="$treatment" name="time" form="appointment_form"
                            style="display: none;" id="time" />
                            <input value="<?php isset($appointment) ? date('Y-m-d',strtotime($appointments[0]['date_time'])) : '0000-00-00' ?>"
                            name="date2" form="appointment_form" style="display:none"/> 
                            <input type="button" class="appointment_schedule_btn" value="Schedule"
                            onclick="submitAppointment('<?php  echo isset($appointment) ? date('Y-m-d H:i:s',strtotime($appointments[0]['date_time'].' '.$treatment)) : ' ' ?>')"/>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </form>
    <form method="POST" action="" id="appointment_form" style="display: none;"></form>
</div>