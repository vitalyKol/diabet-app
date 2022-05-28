<?php
include "layouts/header.php";
include_once "sugarHandler.php";

$record = SugarHandler::selectRecord($_GET['id']);
$thisDay = $record['day'];

?>
<div class="container">
    <div class="row">
        <div class="col text-center">
            <h1><?php echo $thisDay ?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <tr class="text-center">
                    <th>Время</th>
                    <th>Инсулин</th>
                    <th>Хлебные единицы</th>
                    <th>Сахар</th>
                    <th>Примечание</th>
                    <th>Action</th>
                </tr>
                <form name='MealTime' action='sugarHandler.php/update' method='post'>
                    <input type='hidden' name='id' value='<?=$_GET['id']?>'>
                    <input type='hidden' name='day' value='<?=$record['day']?>'>
                    <tr><td><input type='time' value='<?= $record['timeEnter']?>' name='sugarTime' class='form-control' required>
                        </td>
                        <td>
                            <input type='number' value='<?= $record['insulin']?>' placeholder='00.00' min='0' max='200' name='sugarInsulin' class='form-control'>
                        </td>
                        <td>
                            <input type='number' value='<?= $record['XE']?>' placeholder='00.00' min='0' max='200' name='sugarBU' class='form-control' id='InputBU'>
                        </td>
                        <td>
                            <input type='number' placeholder='00.00' step='0.1' min='0' max='200' name='sugar' class='form-control' id='InputNumber2' value='<?= $record['sugar_blood']?>'>
                        </td>
                        <td>
                            <textarea class='form-control' placeholder='Enter your comment...' name='sugarComment' id='InputComment' rows='3'><?= $record['comments']?></textarea>
                        </td>
                        <td class='text-center'><button type='submit' class='btn btn-primary'>Submit</button>
                        </td>
                    </tr></form>
            </table>
        </div>
    </div>
</div>
<?php
include "layouts/footer.php";