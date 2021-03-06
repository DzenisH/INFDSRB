<div class="overview_container1">
    <div class="overview_container2">
        <div class="overview_container3">
            <img src="/images/overview/appointment.jpeg"/>
            <div class="overview_container5">
                <p class="overview_title">Make an appointment with an infectious disease specialist</p>
                <p class="overview_text">Make an appointment with one of the best specialists in the field of infectology</p>
                <?php if(isset($_SESSION['user'])) :?>
                    <?php if($_SESSION['user']['doctor_id'] !== null) :?>
                        <a href="/appointment" class="overview_schedule_link">
                            Schedule
                        </a>
                    <?php else :?>
                        <a href="/choice" class="overview_schedule_link">
                            For making an appointment you must first chose your Doctor
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="overview_container4">
            <img src="/images/overview/treatment.jpeg"/>
            <div class="overview_container5">
                <p class="overview_title">Schedule treatment with us and see why we are the best</p>
                <p class="overview_text">You are treated in the most modern conditions under the supervision of the best experts</p>
                <?php if(isset($_SESSION['user'])) :?>
                    <?php if($_SESSION['user']['doctor_id'] !== null) :?>
                        <a href="/treatment" class="overview_schedule_link">
                            Schedule
                        </a>
                    <?php else :?>
                        <a href="/choice" class="overview_schedule_link">
                            For scheduling a treatment you must first chose your Doctor
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="overview_container3" style="height: 190px;">
            <img src="/images/overview/puncture.jpg" style="align-self:stretch"/>
            <div class="overview_container5">
                <p class="overview_title">Schedule a lumbar puncture</p>
                <p class="overview_text">The most modern devices are used when taking cerebrospinal fluid, so that the pain that is inevitable during this request is reduced to a minimum</p>
                <?php if(isset($_SESSION['user'])) :?>
                    <?php if($_SESSION['user']['doctor_id'] !== null) :?>
                        <a href="/lumbar-puncture" class="overview_schedule_link">
                            Schedule
                        </a>
                    <?php else :?>
                        <a href="/choice" class="overview_schedule_link">
                            For scheduling a lumbar puncture treatment you must first chose your Doctor
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>