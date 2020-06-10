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
                <th class="col-3" scope="col">ID</th>
                <th class="col-3" scope="col">Rider</th>
                <th class="col-3" scope="col">Horse</th>
                <th class="col-3" scope="col">Planned on</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($planningData as $tmpPlanning) { ?>
            <tr>
                <th><?= $tmpPlanning['id'] ?></th>
                <th><?= $tmpPlanning['rider'] ?></th>
                <th><?= $tmpPlanning['horse'] ?></th>
                <th><?= $tmpPlanning['date'] ?></th>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
