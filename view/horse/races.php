<nav class="navbar navbar-expand-lg">
    <ul class="navbar-nav mr-auto">
        <li class="mx-1"><a href="<?= URL ?>horses/create/race" class="btn btn-outline-primary">Create new race</a></li>
    </ul>
</nav>

<div class="container col-lg-10 my-2">
    <table class="col-12">
        <thead>
            <tr class="border-bottom">
                <th class="col-4">Race name</th>
                <th class="col-4">Wither height</th>
                <th class="col-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($allRaces as $tmpRace) { ?>
                <tr class="border-bottom">
                    <th><?= $tmpRace['racename'] ?></th>
                    <th><?= $tmpRace['witherheight-min'] . " to " . $tmpRace['witherheight-max'] ?></th>
                    <th>
                        <a class="btn btn-primary my-2" href="<?= URL . "horses/edit/race/" . $tmpRace['id'] ?>">Edit</a>
                        <form action="<?= URL ?>horses/delete/race" method="post" class="d-inline">
                            <input type="hidden" name="id" value="<?= $tmpRace['id'] ?>">
                            <input type="submit" value="Delete" class="btn btn-danger my-2">
                        </form>
                    </th>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>