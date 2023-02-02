<table class="table table-borderless table-data3">
    <thead>
        <tr>
            <th>Sr #</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?
        $sr = 1;
        foreach ($arrayRow as $key => $row) :
            $id = $row['id'];
            $email = $row['email'];
            $password = $row['password'];
            $role = $row['role'];
            $status = $row['status'];
        ?>
        <tr>
            <td><?= $sr ?></td>
            <td><?= $email ?></td>
            <td>
                <? if ($role == 1) : ?>
                <span class="badge badge-info">Admin</span>
                <? endif; ?>
                <? if ($role == 2) : ?>
                <span class="badge badge-warning">Member</span>
                <? endif; ?>
            </td>
            <td>
                <? if ($status == 1) : ?>
                <span class="badge badge-success">Active</span>
                <? endif; ?>
                <? if ($status != 1) : ?>
                <span class="badge badge-danger">In Active</span>
                <? endif; ?>
            </td>
            <td>
                <div class="table-data-feature">
                    <button data-id-user="<?= $id ?>" type="button" class="btn btn-info btnEditUser"
                        data-toggle="modal" data-target="#modalEditUser">
                        <i class="zmdi zmdi-edit zmdi-hc-lg"></i>
                    </button>
                </div>
            </td>
            <td>
                <div class="table-data-feature">
                    <button data-id-user="<?= $id ?>" type="button" class="btn btn-danger btnEliminarUser">
                        <i class="zmdi zmdi-delete zmdi-hc-lg"></i>
                    </button>
                </div>
            </td>
        </tr>
        <?
            $sr++;
        endforeach;
        ?>
    </tbody>
</table>