<div class="cardboard_container">
    <div class="cardboard_container2">
        <div class="cardboard_container3">
            <p>No of cardboard:1</p>
            <h2>MEDICAL RECORD</h2>
            <p>Date:<?php echo $cardboard !== '' ? $cardboard["date"] : '' ?></p>
        </div>
        <div class="cardboard_container4">
            <div class="cardboard_container5">
                <p class="cardboard_name">Name</p>
                <input value="<?php echo $patient["name"] ?>" class="cardboard_input">
            </div>
            <div class="cardboard_container5">
                <p class="cardboard_name">Last Name</p>
                <input value="<?php echo $patient["last_name"] ?>" class="cardboard_input">
            </div>
            <div class="cardboard_container5">
                <p class="cardboard_name">Date of birth</p>
                <input value="<?php echo $patient["date_of_birth"] ?>" class="cardboard_input">
            </div>
            <div class="cardboard_container5">
                <p class="cardboard_name">Country of birth</p>
                <input value="<?php echo $patient["country_of_birth"] ?>" class="cardboard_input">
            </div>
            <div class="cardboard_container5">
                <p class="cardboard_name">JMBG</p>
                <input value="<?php echo $patient["JMBG"] ?>" class="cardboard_input">
            </div>
            <div class="cardboard_container5">
                <p class="cardboard_name">Gender</p>
                <input value="<?php echo $patient["gender"] === "M" ? "Male" : "Female" ?>" class="cardboard_input">
            </div>
        </div>
        <div style="display: flex;justify-content:center;margin-top:15px">
            <h3>Anamnesis</h3>
        </div>
        <table style="width: 100%;border:1px solid black;" class="cardboard_table">
            <tr>
                <th style="border-right: 1px solid black;">No.</th>
                <th style="border-right: 1px solid black;">Doctor</th>
                <th style="border-right: 1px solid black;">Date of examination</th>
                <th style="border-right: 1px solid black;">Diagnosis</th>
                <th>Therapy</th>
            </tr>
            <?php foreach ($examinations as $key => $examination): ?>
                <tr>
                    <th style="border-right: 1px solid black;border-top:1px solid black;"><?php echo $key+1 ?></th>
                    <th style="border-right: 1px solid black;border-top:1px solid black;"><?php echo $examination["name"] ?> <?php echo $examination["last_name"] ?></th>
                    <th style="border-right: 1px solid black;border-top:1px solid black;"><?php echo $examination["date"] ?></th>
                    <th style="border-right: 1px solid black;border-top:1px solid black;"><?php echo $examination["diagnosis"] ?></th>
                    <th style="border-top:1px solid black;"><?php echo $examination["therapy"] ?></th>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>