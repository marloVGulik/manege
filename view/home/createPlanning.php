<div class="container my-2 col-lg-10 border rounded">
    <h1>Planning creation: </h1>
    <form action="" method="post">
        <label for="horseId">Race: </label><select class="form-control col-12 p-2 my-2 border rounded" name="horseId" id="horseId"><?php foreach($allHorses as $horse) { ?>
            <option value="<?= $horse['id'] ?>"><?= $horse['name'] ?></option>
        <?php } ?></select>
        <input class="col-12 p-2 my-2 border rounded" type="date" name="setDate" placeholder="Date">
        <input class="col-12 p-2 my-2 border rounded" type="time" name="setTime" placeholder="Time">
        <input class="btn btn-outline-success btn-block my-2" type="submit" value="Create planning">
    </form>
</div>
