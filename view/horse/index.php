<nav class="navbar navbar-expand-lg">
    <ul class="navbar-nav mr-auto">
        <li class="mx-1"><a href="<?= URL ?>horses/create/horse" class="btn btn-outline-primary">Create new horse</a></li>
        <li class="mx-1"><a href="<?= URL ?>horses/races" class="btn btn-outline-primary">View races</a></li>
    </ul>
</nav>
<div class="col-lg-10 my-2">
    <?php foreach($allHorses as $tmpHorse) { ?>
        <div class="d-inline-block col-lg-4 m-2 p-1 col-12 border rounded">
            <h2>Name: <?= $tmpHorse['name'] ?></h2>
            <p>Race: <?= $tmpHorse['race'] ?></p>
            <p>Is used for jumping sport: <?= $tmpHorse['used-for-jump'] ?></p>
            <div class="col-12">
                <a class="btn btn-outline-primary btn-block" href="<?= URL . "horses/details/" . $tmpHorse['id'] ?>">Details</a>
            </div>
        </div>
    <?php } ?>
</div>