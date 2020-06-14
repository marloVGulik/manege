<div class="container my-2 col-lg-10 border rounded">
    <h1>Horse creation: </h1>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input class="col-12 p-2 my-2 border rounded" type="text" name="name" placeholder="Horse name" value="<?= $horseData['name'] ?>">
        <label for="race">Race: </label><select class="form-control col-12 p-2 my-2 border rounded" name="race" id="race"><?php foreach($allRaces as $race) { ?>
            <option value="<?= $race['id'] ?>" <?php if($race['racename'] == $horseData['race']) echo "selected"; ?>><?= $race['racename'] ?></option>
        <?php } ?></select>
        <input class="col-12 p-2 my-2 border rounded" type="number" name="witherHeight" placeholder="Wither height" value="<?= $horseData['height'] ?>">
        <input class="col-12 p-2 my-2 border rounded" type="number" name="age" placeholder="Age" value="<?= $horseData['age'] ?>">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="usedForJump" id="usedForJump" <?php if($horseData['jumps'] == "yes") echo "checked"; ?>><label for="usedForJump" class="form-check-label">Used for jumping sport</label>
        </div>
        <input class="btn btn-outline-success btn-block my-2" type="submit" value="Edit horse">
    </form>
</div>