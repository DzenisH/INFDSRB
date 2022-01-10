

<script>
    function show(id) {
        const form = document.getElementById("form");
        const input = document.getElementById("input");
        input.value = id;
        form.submit();
    }
</script>

<div class="chat_container">
    <div class="chat_container2">
        <ul class="chat_list">
            <form method="GET" action="" id="form">
                <input type="text" id="input" style="display: none;" name="id" value=""/>
                    <?php if($_SESSION["user"]["type"] === "doctor") :?>
                        <?php foreach ($patients as $patient) :?>
                            <li style="margin-top:20px;border-bottom:1px solid #fff">
                                <div class="chat_list_content">
                                    <div class="chat_image_container">
                                        <img class="chat_image" src="/images/chat/patient.jpg" alt="patient"/>
                                    </div>
                                    <div class="chat_container3">
                                        <button class="submitBtn" onclick="show(<?php echo $patient['id'] ?>)"
                                        style="background-color: transparent;border:none">
                                            <p class="chat_name"><?php echo $patient["name"]?> <?php echo $patient["last name"] ?></p>
                                        </button>
                                        <p class="chat_email"><?php echo $patient["email"]?></p>
                                    </div> 
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li style="margin-top:20px;border-bottom:1px solid #fff">
                            <div class="chat_list_content">
                                <div class="chat_image_container">
                                    <img class="chat_image" src="/images/chat/patient.jpg" alt="patient"/>
                                </div>
                                <div class="chat_container3">
                                    <button class="submitBtn" onclick="show(<?php echo $CurrentDoctor['id'] ?>)"
                                    style="background-color: transparent;border:none">
                                        <p class="chat_name"><?php echo $CurrentDoctor["name"]?> <?php echo $CurrentDoctor["last name"] ?></p>
                                    </button>
                                    <p class="chat_email"><?php echo $CurrentDoctor["email"]?></p>
                                </div> 
                            </div>
                        </li>
                    <?php endif; ?> 
                </form>
        </ul>
    </div>
    
    <div class="chat_container4">
        <div class="chat_container5">
            <div class="chat_image_container2">
                <img class="chat_image" src="/images/chat/patient.jpg" alt="patient"/>
            </div>
            <div class="chat_container6">
                <p class="chat_chat_with">Chat with <?php echo $_SESSION["user"]["type"] === "doctor" ?  $CurrentPatient["name"] : $CurrentDoctor["name"] ?></p>
            </div>
        </div>

        <div class="chat_container7">
            <?php foreach($messages as $message) :?>  
                    <!--blue message-->
                    <?php if((($message["type_of_sender"] === "patient" && $_SESSION["user"]["type"] === "doctor")||
                        ($message["type_of_sender"] === "doctor" && $_SESSION["user"]["type"] === "patient")) && $CurrentPatient["id"] === $message["patient_id"]):?>
                        <div style="margin-top: 50px;">
                            <div class="chat_message">
                                <div class="chat_message_container">
                                    <div class="chat_message_top">
                                        <p class="chat_date"><?php echo $message['date_of_sending'] ?></p>
                                        <p class="chat_patient_name"><?php echo $_SESSION["user"]["type"] === "doctor" ? $CurrentPatient["name"] : $CurrentDoctor["name"] ?></p>
                                        <div class="chat_circle"></div>
                                    </div>
                                    <div class="chat_message_content">
                                        <?php echo $message["content"] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
               
                
                
                    <?php if(($message["type_of_sender"] === "doctor" && $_SESSION["user"]["type"] === "doctor")||
                        ($message["type_of_sender"] === "patient" && $_SESSION["user"]["type"] === "patient")) :?>
                        <div style="margin-top: 50px;">
                            <div>
                                <div>
                                    <div class="chat_message_top2">
                                        <div class="chat_circle2"></div>
                                        <p class="chat_patient_name2"><?php echo $_SESSION["user"]["name"] ?></p>
                                        <p class="chat_date"><?php echo $message["date_of_sending"] ?></p>
                                    </div>
                                    <div class="chat_message_content2">
                                        <?php echo $message["content"] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif;  ?>
                <?php endforeach; ?>
            

        </div>

        <div class="chat_sent_message_container">
            <div class="chat_sent_message">
                <input class="chat_input"></input>
                <button type="submit" class="chat_button">SEND</button>
            </div>
        </div>
    </div>
    <img src="/images/chat/help.jpeg" alt="help" class="chat_help"/>
</div>