<div class="container col-12 border-bottom py-2">
    <h1>Welcome to the admin panel <?= $_SESSION['loggedInRName'] ?></h1>
</div>
<div class="container col-10 p-0">
    <ul class="d-flex justify-content-around list-inline p-0 col-12">
        <li class="col-5 px-0 my-2 list-inline-item"><a class="btn btn-primary btn-block py-3" href="<?= URL ?>adminPanel/horseManagement">Horse management</a></li>
        <li class="col-5 px-0 my-2 list-inline-item"><a class="btn btn-primary btn-block py-3" href="<?= URL ?>adminPanel/userManagement">User management</a></li>
    </ul>
</div>