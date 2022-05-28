<?php
include "layouts/header.php";
include_once "DayTable.php";

if(empty($_GET['year'])){
    $year = date('Y', time());
}else{
    $year = $_GET['year'];
}
if(empty($_GET['month'])){
    $month = date('m', time());
}else{
    $month = $_GET['month'];
}
if(empty($_GET['day'])){
    $day = date('d', time());
}else{
    $day = $_GET['day'];
    if($day < 10){
        $day = '0' . $day;
    }
}
$thisDay = $year.'-'.$month.'-'.$day;;

$dayObj = new DayTable('Ivan', $year,$month,$day);
?>
<div class="container">
    <div class="row">
        <div class="col text-center">
            <h1><?php echo $thisDay; ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p>
                <button id="buttonSigar" type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#formSugar" aria-expanded="false" aria-controls="formSugar">Добавить сахар</button>
                <button id="buttonMeal" type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#formMealTime" aria-expanded="false" aria-controls="formMealTime">Добавить прием пищи</button>
            </p>
            <div class="collapse mb-2" id="formSugar">
                <div class="card card-body">
                    <form name="Sugar" action="sugarHandler.php/insert" method="post">
                        <input type="hidden" name="day" value="<?= $thisDay ?>">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="InputTime" class="form-label">Time</label>
                                        <input type="time" name="sugarTime" class="form-control" id="InputTime" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="InputNumber" class="form-label">Sugar in blood</label>
                                        <input type="number" placeholder="00.00" step="0.1" min="0" max="200" name="sugar" class="form-control" id="InputNumber" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="collapse mb-2" id="formMealTime">
                <div class="card card-body">
                    <form name="MealTime" action="sugarHandler.php/insert" method="post">
                        <input type="hidden" name="day" value="<?= $thisDay ?>">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="InputTime2" class="form-label">Time</label>
                                        <input type="time" name="sugarTime" class="form-control" id="InputTime2" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="InputInsulin" class="form-label">Insulin</label>
                                        <input type="number" placeholder="00.00" min="0" max="200" name="sugarInsulin" class="form-control" id="InputInsulin" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="InputBU" class="form-label">Bread units</label>
                                        <input type="number" placeholder="00.00" min="0" max="200" name="sugarBU" class="form-control" id="InputBU" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="InputNumber2" class="form-label">Sugar in blood</label>
                                        <input type="number" placeholder="00.00" step="0.1" min="0" max="200" name="sugar" class="form-control" id="InputNumber2" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="InputComment" class="form-label">Comment</label>
                                        <textarea class="form-control" placeholder="Enter your comment..." name="sugarComment" id="InputComment" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
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
                <?php $dayObj->showTrs(); ?>
            </table>
        </div>
    </div>
</div>
<?php
include "layouts/footer.php";