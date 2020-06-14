<div>
    <table class="col-12">
        <thead>
            <tr class="border-bottom">
                <th class="col-3">ID and actions</th>
                <th class="col-3">Admin code</th>
                <th class="col-3">Login name</th>
                <th class="col-3">Real name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $tmpUser) { ?>
                <tr class="border-bottom">
                    <th>
                        <a class="btn btn-primary my-2" href="<?= URL . "adminPanel/editUser/" . $tmpUser['id'] ?>">Edit</a>
                        <form action="<?= URL ?>adminPanel/deleteUser" method="post" class="d-inline">
                            <input type="hidden" name="id" value="<?= $tmpUser['id'] ?>">
                            <input type="submit" value="Delete" class="btn btn-danger my-2">
                        </form>
                    </th>
                    <th>
                        <?= $tmpUser['admin'] ?>
                        <?php if($tmpUser['admin'] > 0) { ?>
                            <form action="<?= URL ?>adminPanel/revokeAdmin" method="post" class="d-inline">
                                <input type="hidden" name="id" value="<?= $tmpUser['id'] ?>">
                                <input type="submit" value="Revoke admin" class="btn btn-danger my-2">
                            </form>
                        <?php } else { ?>
                            <form action="<?= URL ?>adminPanel/grantAdmin" method="post" class="d-inline">
                                <input type="hidden" name="id" value="<?= $tmpUser['id'] ?>">
                                <input type="submit" value="Grant admin" class="btn btn-danger my-2">
                            </form>
                        <?php } ?>
                    </th>
                    <th><?= $tmpUser['login-name'] ?></th>
                    <th><?= $tmpUser['name'] ?></th>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>