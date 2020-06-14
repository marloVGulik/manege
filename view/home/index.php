<?php 
// print_r($planningData);
// die;
?>

<div class="container">
    <div class="col-12 border-bottom">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item px-1"><a class="nav-link my-2 btn btn-primary" href="<?= URL ?>home/createplanning">Create Planning</a></li>
            <li class="nav-item px-1"><a class="nav-link my-2 btn btn-primary" href="<?= URL ?>home/all">View all plannings</a></li>
        </ul>
    </div>
    <h1>Planning: </h1>
    <table class="col-10">
        <thead>
            <tr>
                <th class="col-3" scope="col">ID and buttons</th>
                <th class="col-3" scope="col">Rider</th>
                <th class="col-3" scope="col">Horse</th>
                <th class="col-3" scope="col">Planned on</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($planningData as $tmpPlanning) { ?>
            <tr>
                <th>
                <?php echo $tmpPlanning['id'];
                if($_SESSION['loggedIn'] == $tmpPlanning['rider-id'] || $_SESSION['adminCode'] > 0) { ?>
                    <a href="<?= URL ?>home/editPlanning/<?= $tmpPlanning['id'] ?>" class="btn btn-outline-primary">Edit</a>
                    <form action="<?= URL ?>home/delete" method="post" class="d-inline p-0">
                        <input type="hidden" name="id" value="<?= $tmpPlanning['id'] ?>">
                        <input type="submit" value="Delete" class="btn btn-outline-danger">
                    </form>
                <?php } ?>
                </th>
                <th><?= $tmpPlanning['rider'] ?></th>
                <th><?= $tmpPlanning['horse'] ?></th>
                <th><?= $tmpPlanning['date'] ?></th>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
