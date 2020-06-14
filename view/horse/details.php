<div class="container col-10 pt-2">
    <h1><?= $horseData['name'] ?></h1>
    <h3><?= $horseData['ageStatus'] ?></h3>
    <p>Race: <?= $horseData['race'] ?></p>
    <p>Age: <?= $horseData['age'] ?></p>
    <p>Heigth: <?= $horseData['height'] ?></p>
    <p>Used for jumping: <?= $horseData['jumps'] ?></p>
    <?php if($_SESSION['adminCode'] > 0) { ?>
    <div class="d-inline col-12 p-0">
        <a href="<?= URL ?>horses/edit/horse/<?= $id ?>" class="col-12 btn btn-outline-primary my-2">Edit horse</a>
        <form action="<?= URL ?>horses/delete/horse" method="post" class="col-6 d-inline p-0">
            <input type="hidden" value="<?= $id ?>" name="id">
            <input type="submit" value="Delete horse" class="col-12 btn btn-outline-danger my-2">
        </form>    
    </div>
    <?php } ?>
</div>