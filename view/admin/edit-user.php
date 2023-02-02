<form action="" method="post">
    <div class="form-group">
        <label for="cc-payment" class="control-label mb-1">Role</label>
        <select name="role" id="" class="form-control">
            <option value="1" <?php if(isset($role) && $role == 1){echo "selected"; }?>>Admin</option>
            <option value="2" <?php if(isset($role) && $role == 2){echo "selected"; }?>>Member</option>
        </select>
    </div>
    <div class="form-group">
        <label for="cc-payment" class="control-label mb-1">Status</label>
        <select name="status" id="" class="form-control">
            <option value="0" <?php if(isset($status) && $status == 0){echo "selected"; }?>>In Active</option>
            <option value="1" <?php if(isset($status) && $status == 1){echo "selected"; }?>>Active</option>
        </select>
    </div>
    <input type="hidden" name="user-id" value="<?php if(isset($userId)){echo $userId; }?>">


    <div>
        <button type="submit" name="upd_user_btn" class="btn btn-lg btn-info btn-block">
            <i class="fas fa-exchange-alt fa-lg"></i>&nbsp;
            <span>Update User</span>

        </button>
    </div>
</form>