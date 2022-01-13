<!--//This will be view for selecting doctor for the first time(after login) where the patient that don't have doctor will be redirected-->

<script>
    function choice_btn_submit(id,type) {
        const input1 = document.getElementById('choice_input1');
        const input2 = document.getElementById('choice_input2');
        const form = document.getElementById('choice_form');
        input1.value = id;
        input2.value = type;
        form.submit();
    }
</script>



<div class="patients_container">
    <h1 class="patients_header" style="margin:20px">Choose one of available doctors</h1>
    <table class="patients_table">
        <thead>
            <tr class="patient_table_header">
                <th>No.</th>
                <th>Name</th> 
                <th>Last Name</th>
                <th>Gender</th>
                <th>Country of Birth</th>
                <th>Phone Number</th>   
                <th>Email</th>
                <th>Number of patients</th>
                <th><?php echo $_SESSION['user']['doctor_id']!==null ? 'CHANGE' : 'SELECT' ?></th>   
            </tr>
        </thead>
        <tbody>
            <?php foreach ($doctors as $index => $doctor): ?>
                <tr class="patient_table_body">
                    <td><?php echo $index+1 ?></td>
                    <td><?php echo $doctor['name'] ?></td>
                    <td><?php echo $doctor['last_name'] ?></td>
                    <td><?php echo $doctor['gender'] ?></td>
                    <td><?php echo $doctor['country_of_birth'] ?></td>
                    <td><?php echo $doctor['phone_number'] ?></td>
                    <td><?php echo $doctor['email'] ?></td>
                    <td><?php echo $doctor['number'] ?></td>
                        <td>
                            <form action="" method="POST" id="choice_form">
                                <button class="choice_btnSelect" type="button"
                                onclick="choice_btn_submit(<?php echo $doctor['id'] ?>,
                                    '<?php echo $_SESSION['user']['doctor_id']!==null ? 'change' : 'select' ?>'
                                )"
                                <?php 
                                    if($totalNumberOfDoctors >= $totalNumberOfPatients){
                                        if($doctor['number'] >= ceil($totalNumberOfDoctors/$totalNumberOfPatients) || $_SESSION["user"]["doctor_id"] === $doctor["id"])
                                        {?>disabled <?php }
                                    } else{
                                        if($doctor['number'] >= ceil($totalNumberOfPatients/$totalNumberOfDoctors)|| $_SESSION["user"]["doctor_id"] === $doctor["id"])
                                        {?>disabled <?php }
                                    }
                                ?>
                                ><?php 
                                if($_SESSION['user']['doctor_id'] === $doctor['id'])
                                {
                                    ?>CURRENT<?php
                                }else if($_SESSION['user']['doctor_id']!==null){
                                    ?>CHANGE<?php
                                }else{
                                    ?>SELECT<?php
                                }
                                ?></button> 
                                <input style="display: none;" name="doctor_id" id="choice_input1"/>
                                <input type="text" style="display: none;" name="type" id="choice_input2">
                            </form>
                        </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>