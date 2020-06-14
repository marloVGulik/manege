<div class="d-flex flex-column align-items-center my-3">
    <div class="border col-lg-6 rounded">
        <h1>Edit user</h1>
        <form action="" method="post">
            <input class="col-12 border rounded my-2 p-2" type="text" name="loginName" placeholder="Login name" value="<?= $userData['login-name'] ?>">
            <input class="col-12 border rounded my-2 p-2" type="text" name="name" placeholder="Real name" value="<?= $userData['name'] ?>">
            <input class="col-12 border rounded my-2 p-2" type="text" name="address" placeholder="Address" value="<?= $userData['address'] ?>">
            <input class="col-12 border rounded my-2 p-2" type="number" name="phoneNumber" placeholder="Phone number" value="<?= $userData['phonenumber'] ?>">
            <input class="col-12 border rounded my-2 p-2" type="password" name="password" placeholder="Password">
            <input class="btn btn-outline-success btn-block my-2" type="submit" value="Edit data">
        </form>
    </div>
</div>