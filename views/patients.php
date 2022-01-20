<div class="patients_container">
    <h1 class="patients_header">Your Patients</h1>
    <table class="patients_table">
        <thead>
            <tr class="patient_table_header">
                <th>No.</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Place of Birth</th>
                <th>Country of Birth</th>
                <th>Date of Birth</th>
                <th>JMBG</th>   
                <th>Phone Number</th>   
                <th>Email</th>   
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $index => $patient): ?>
                <tr class="patient_table_body">
                    <td><?php echo $index+1 ?></td>
                    <td><?php echo $patient['name'] ?></td>
                    <td><?php echo $patient['last_name'] ?></td>
                    <td><?php echo $patient['gender'] ?></td>
                    <td><?php echo $patient['place_of_birth'] ?></td>
                    <td><?php echo $patient['country_of_birth'] ?></td>
                    <td><?php echo $patient['date_of_birth'] ?></td>
                    <td><?php echo $patient['JMBG'] ?></td>
                    <td><?php echo $patient['phone_number'] ?></td>
                    <td><?php echo $patient['email'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>