<div class="container my-2 col-lg-10 border rounded">
    <h1>Race creation: </h1>
    <form action="" method="post">
        <input hidden type="text" name="id" value="<?= $raceInfo['id'] ?>">
        <input class="col-12 p-2 my-2 border rounded" type="text" name="raceName" placeholder="Race name" value="<?= $raceInfo['racename'] ?>">
        <input class="col-12 p-2 my-2 border rounded" type="text" name="minWitherHeight" placeholder="Min wither height" value="<?= $raceInfo['witherheight-min'] ?>">
        <input class="col-12 p-2 my-2 border rounded" type="text" name="maxWitherHeight" placeholder="Max wither height" value="<?= $raceInfo['witherheight-max'] ?>">
        <input class="btn btn-outline-success btn-block my-2" type="submit" value="Update race">
    </form>
</div>
