<?php
    include "layouts/header.php";
    include_once "Calendar.php";

    $calendar = new Calendar();
?>
    <div class="container">
        <div class="row">
            <div class="col h1 text-center">
                <?php  $calendar->showMonth(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php  $calendar->showCalendar(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="col text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-5"><?php  $calendar->lastMonth(); ?></div>
                            <div class="col-2 h3">Месяц</div>
                            <div class="col-5"><?php  $calendar->nextMonth(); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
    include "layouts/footer.php";