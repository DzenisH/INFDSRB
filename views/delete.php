<script>

let userId = 0;
let typeT = '';

function showPopup(id,name,type,last_name){
    const table = document.getElementById('delete_table');
    const popup = document.getElementById('delete_popup');
    const text = document.getElementById('delete_popup_text');
    userId = id;
    typeT = type;
    text.textContent = `Are you sure you want to delete ${name} ${last_name}?`;
    popup.style.display = 'flex';
    popup.style.opacity = 1;
    popup.style.zIndex = 1000;
    table.style.opacity = 0.4;
}

function accept(){
    const input = document.getElementById('delete_input');
    const input2 = document.getElementById('delete_input2');
    input.value = userId;
    input2.value = typeT;
    const form = document.getElementById('delete_form'); 
    form.submit();
}

function reject(){
    const table = document.getElementById('delete_table');
    const popup = document.getElementById('delete_popup');
    popup.style.display = 'none';
    table.style.opacity = 1;
}

</script>

<div class="patients_container" style="position: relative;">
    <h1 class="patients_header" style="margin-right:150px">Delete User</h1>
    <div class="requests_popup" id="delete_popup">
        <p class="delete_popup_text" id="delete_popup_text"></p>
        <div class="requests_btn_container">
            <form method="POST" action="" id="delete_form">
                <button class="requests_btn_yes" onclick="accept()" type="button">YES</button>
                <button class="requests_btn_no" onclick="reject()" type="button">NO</button>
                <input id="delete_input" style="display:none" name="id"/> 
                <input id="delete_input2" style="display: none;" name="type"/>
            </form>
        </div>
    </div>
    <table class="patients_table" id="delete_table">
        <thead>
            <tr class="patient_table_header">
                <th>No.</th>
                <th>Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Country of Birth</th>
                <th>Date of Birth</th>
                <th>Phone Number</th>   
                <th>Email</th>   
                <th>Type of user</th>   
                <th>Delete</th>   
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $index => $user): ?>
                <tr class="patient_table_body">
                    <td><?php echo $index+1 ?></td>
                    <td><?php echo $user['name'] ?></td>
                    <td><?php echo $user['last_name'] ?></td>
                    <td><?php echo $user['gender'] ?></td>
                    <td><?php echo $user['country_of_birth'] ?></td>
                    <td><?php echo $user['date_of_birth'] ?></td>
                    <td><?php echo $user['phone_number'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['type'] ?></td>
                    <td><button class="requests_btn" style="background-color:red;"
                    onclick="showPopup(<?php echo $user['id'] ?>,'<?php echo $user['name'] ?>','<?php echo $user['type'] ?>','<?php echo $user['last_name'] ?>')"
                    >DELETE</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>