
<script>
    function approve(id,type){
        const form = document.getElementById('requestChange_form');
        const input1 = document.getElementById('requestChange_input1');
        const input2 = document.getElementById('requestChange_input2');
        input1.value = id;
        input2.value = type;
        form.submit();
    }

    function decline(id,type){
        const form = document.getElementById('requestChange_form');
        const input1 = document.getElementById('requestChange_input1');
        const input2 = document.getElementById('requestChange_input2');
        input1.value = id;
        input2.value = type;
        form.submit();
    }
</script>


<div class="patients_container">
    <h1 class="patients_header" style="margin-left: 100px;">Requests</h1>
    <table class="patients_table">
        <thead>
            <tr class="patient_table_header">
                <th>No.</th>
                <th>Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Place of Birth</th>
                <th>Country of Birth</th>
                <th>Date of Birth</th>
                <th>JMBG</th>   
                <th>Phone Number</th>   
                <th>Email</th>   
                <th>Approve</th>
                <th>Decline</th>
            </tr>
        </thead>
        <tbody>
            <form method="POST" action="" id="requestChange_form">
                <?php foreach ($requests as $index => $request): ?>
                    <tr class="patient_table_body">
                        <td><?php echo $index+1 ?></td>
                        <td><?php echo $request['name'] ?></td>
                        <td><?php echo $request['last_name'] ?></td>
                        <td><?php echo $request['gender'] ?></td>
                        <td><?php echo $request['place_of_birth'] ?></td>
                        <td><?php echo $request['country_of_birth'] ?></td>
                        <td><?php echo $request['date_of_birth'] ?></td>
                        <td><?php echo $request['JMBG'] ?></td>
                        <td><?php echo $request['phone_number'] ?></td>
                        <td><?php echo $request['email'] ?></td>
                        <td><button class="requestChange_approve_btn" type="button"
                        onclick="approve('<?php echo $request['id'] ?>','approve')">Approve</button></td>
                        <td><button class="requestChange_decline_btn" type="button"
                        onclick="decline('<?php echo $request['id'] ?>','decline')">Decline</button></td>
                    </tr>
                <?php endforeach; ?>
                <input style="display: none;" id="requestChange_input1" name="id"/>
                <input style="display: none;" id="requestChange_input2" name="type"/>
            </form>         
        </tbody>
    </table>
</div>