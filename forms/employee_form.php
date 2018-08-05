<fieldset>
    <!-- Form Name -->
    <legend>Add New Employee</legend>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Full Name</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                <input  type="text" name="full_name" placeholder="Full Name" class="form-control" value="<?php echo ($edit) ? $user_account['full_name'] : ''; ?>" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">User Name</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input  type="text" name="user_name" placeholder="User Name" class="form-control" value="<?php echo ($edit) ? $user_account['user_name'] : ''; ?>" autocomplete="off">
            </div>
        </div>
    </div>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" >Password</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" name="password" placeholder="Password " class="form-control" required="" autocomplete="off">
            </div>
        </div>
    </div>
    <!-- radio checks -->
    <div class="form-group">
        <label class="col-md-4 control-label">User type</label>
        <div class="col-md-4">
            <div class="radio">
                <label>
                    <?php //echo $admin_account['admin_type'] ?>
                    <input type="radio" name="type" value="administrator" required="" <?php echo ($edit && $user_account['type'] =='administrator') ? "checked": "" ; ?>/> Administrator
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="type" value="employee" required="" <?php echo ($edit && $user_account['type'] =='employee') ? "checked": "" ; ?>/> Employee
                </label>
            </div>
        </div>
    </div>
    <!-- Button -->
    <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-4">
            <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
        </div>
    </div>
</fieldset>