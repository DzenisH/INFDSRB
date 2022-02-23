<script>
    function perform($patientId,$appointmentId){
        const form = document.getElementById('doctorAppointments_form');
        const patient_id = document.getElementById('doctorAppointments_patient_id');
        const done = document.getElementById('appointment_done');
        const appointment_id = document.getElementById('appointment_id');
        patient_id.value = $patientId;  
        done.value = "1";
        appointment_id.value = $appointmentId;
        form.submit();
    }
</script>

<div class="patients_container">
    <h1 class="patients_header">Your appointments</h1>
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
                <th>Date and Time of appointment</th> 
                <th>Perform an examination</th>  
            </tr>
        </thead>
        <tbody>
            <form action="/examination" method="GET" id="doctorAppointments_form">
            <?php foreach ($appointments as $index => $appointment): ?>
                <tr class="patient_table_body">
                    <td><?php echo $index+1 ?></td>
                    <td><?php echo $appointment['name'] ?></td>
                    <td><?php echo $appointment['last_name'] ?></td>
                    <td><?php echo $appointment['gender'] ?></td>
                    <td><?php echo $appointment['date_of_birth'] ?></td>
                    <td><?php echo $appointment['phone_number'] ?></td>
                    <td><?php echo $appointment['email'] ?></td>
                    <td><?php echo $appointment['date_time'] ?></td>
                    <td>
                        <button class="doctorAppointments_perform_btn"
                        onclick="perform('<?php echo $appointment['patient_id'] ?>','<?php echo $appointment['id'] ?>')">
                            Perform
                        </button>
                </td>
                </tr>
            <?php endforeach; ?>
            <input style="display: none;" name="patient_id" id="doctorAppointments_patient_id"/>
            <input style="display: none;" value="0" name="appointment_done" id="appointment_done"/>
            <input style="display: none;" name="appointment_id" id="appointment_id"/>
            </form>
        </tbody>
    </table>
</div>