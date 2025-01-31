<style>
    .panel-heading {
    background: #e9e9e9 none repeat scroll 0 0;
}
</style>
<?php
$this->db->where('id', 1);
$info = $this->db->get('version_control')->row();
?>

<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading custom-panel-heading">
            DEVICE LATEST VERSION
        </header>
        <div class="panel-body custom-panel-body">
            <form method="POST" action="" role="form">
                <div class="form-group col-md-6">
                    <label><i class="fa fa-android fa-spin"></i> Android</label>
                    <input required="" type="text" value="<?= $info->android; ?>" name="android" placeholder="Android Version" class="form-control input-sm">
                </div>
                <div class="form-group col-md-6">
                    <label> Android Update Type</label>
                    <select class="form-control input-sm" name="is_hard_update_android">
                        <option value="0" <?= $info->is_hard_update_android == 0 ? "selected" : ""; ?>>No</option>
                        <option value="1" <?= $info->is_hard_update_android == 1 ? "selected" : ""; ?>>Yes</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label  ><i class="fa fa-apple fa-spin"></i> IOS</label>
                    <input required="" type="text" name="ios" value="<?= $info->ios; ?>"  placeholder="Ios Version" class="form-control input-sm">
                </div>
                <div class="form-group col-md-6">
                    <label> IOS Update Type</label>
                    <select class="form-control input-sm" name="is_hard_update_ios">
                        <option value="0" <?= $info->is_hard_update_ios == 0 ? "selected" : ""; ?>>No</option>
                        <option value="1" <?= $info->is_hard_update_ios == 1 ? "selected" : ""; ?>>Yes</option>
                    </select>
                </div>
                <button class="btn btn-success btn-sm" type="submit">save</button>
            </form>
        </div>
    </section>
</div>