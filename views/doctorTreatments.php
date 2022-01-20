<script>
    function perform($patientId,$treatmentId){
        const form = document.getElementById('doctorTreatments_form');
        const patient_id = document.getElementById('doctorTreatments_patient_id');
        const done = document.getElementById('treatment_done');
        const treatment_id = document.getElementById('treatment_id');
        patient_id.value = $patientId;
        done.value = "1";
        treatment_id.value = $treatmentId;
        form.submit();
    }
</script>

<div class="patients_container">
    <h1 class="patients_header">Your treatments</h1>
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
                <th>Type of Disease</th> 
                <th>Finish treatment</th>  
            </tr>
        </thead>
        <tbody>
            <form action="/examination" method="GET" id="doctorTreatments_form">
            <?php foreach ($treatments as $index => $treatment): ?>
                <tr class="patient_table_body">
                    <td><?php echo $index+1 ?></td>
                    <td><?php echo $treatment['name'] ?></td>
                    <td><?php echo $treatment['last_name'] ?></td>
                    <td><?php echo $treatment['gender'] ?></td>
                    <td><?php echo $treatment['date_of_birth'] ?></td>
                    <td><?php echo $treatment['phone_number'] ?></td>
                    <td><?php echo $treatment['email'] ?></td>
                    <td><?php echo $treatment['type_of_disease'] ?></td>
                    <td><button class="doctorAppointments_perform_btn"
                    onclick="perform('<?php echo $treatment['patient_id'] ?>','<?php echo $treatment['id'] ?>')">Finish</button></td>
                </tr>
            <?php endforeach; ?>
            <input style="display: none;" name="patient_id" id="doctorTreatments_patient_id"/>
            <input style="display: none;" value="0" name="treatment_done" id="treatment_done"/>
            <input style="display: none;" name="treatment_id" id="treatment_id"/>
            </form>
        </tbody>
    </table>
</div>