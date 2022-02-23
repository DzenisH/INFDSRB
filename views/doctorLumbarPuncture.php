<script>
    function perform($patientId,$treatmentId){
        const form = document.getElementById('doctorLumbarPuncture_form');
        const patient_id = document.getElementById('doctorLumbarPuncture_patient_id');
        const done = document.getElementById('lumbar_puncture_done');
        const treatment_id = document.getElementById('lumbar_puncture_id');
        patient_id.value = $patientId;
        done.value = "1";
        treatment_id.value = $treatmentId;
        form.submit();
    }
</script>

<div class="patients_container">
    <h1 class="patients_header">Lumbar Punctures</h1>
    <table class="patients_table">
        <thead>
            <tr class="patient_table_header">
                <th>No.</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Phone Number</th>   
                <th>Email</th> 
                <th>Taking Medication?</th> 
                <th>Date and time of Lumbar Puncture</th> 
                <th>Finish treatment</th>  
            </tr>
        </thead>
        <tbody>
            <form action="/examination" method="GET" id="doctorLumbarPuncture_form">
            <?php foreach ($lumbar_puntures as $index => $lumbar_punture): ?>
                <tr class="patient_table_body">
                    <td><?php echo $index+1 ?></td>
                    <td><?php echo $lumbar_punture['name'] ?></td>
                    <td><?php echo $lumbar_punture['last_name'] ?></td>
                    <td><?php echo $lumbar_punture['gender'] ?></td>
                    <td><?php echo $lumbar_punture['date_of_birth'] ?></td>
                    <td><?php echo $lumbar_punture['phone_number'] ?></td>
                    <td><?php echo $lumbar_punture['email'] ?></td>
                    <td><?php echo $lumbar_punture['takes_medication'] === "1" ? "YES" : "NO" ?></td>
                    <td><?php echo $lumbar_punture['date_time'] ?></td>
                    <td><button class="doctorAppointments_perform_btn"
                    onclick="perform('<?php echo $lumbar_punture['patient_id'] ?>','<?php echo $lumbar_punture['id'] ?>')">Finish</button></td>
                </tr>
            <?php endforeach; ?>
            <input style="display: none;" name="patient_id" id="doctorLumbarPuncture_patient_id"/>
            <input style="display: none;" value="0" name="lumbar_puncture_done" id="lumbar_puncture_done"/>
            <input style="display: none;" name="lumbar_puncture_id" id="lumbar_puncture_id"/>
            </form>
        </tbody>
    </table>
</div>