<!--//This will be view for selecting doctor for the first time(after login) where the patient that don't have doctor will be redirected-->

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
                <th>SELECT</th>   
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
                            <form action="" method="POST">
                                <button class="choice_btnSelect" type="submit"
                                <?php 
                                    if($totalNumberOfDoctors >= $totalNumberOfPatients){
                                        if($doctor['number'] >= ceil($totalNumberOfDoctors/$totalNumberOfPatients))
                                        {?>disabled <?php }
                                    } else{
                                        if($doctor['number'] >= ceil($totalNumberOfPatients/$totalNumberOfDoctors))
                                        {?>disabled <?php }
                                    }
                                ?>
                                >SELECT</button> 
                                <input style="display: none;" name="doctor_id" value="<?php echo $doctor["id"] ?>"/>
                            </form>
                        </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>