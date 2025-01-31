
<?php
//pre($device_details);
//pre($user_data);
?>

<div class="col-md-12"><a href="<?= base_url('admin-panel/all-users'); ?>"><button class="pull-right btn btn-info btn-xs bold">Back to user list</button></a></div><br><br>

<aside class="profile-nav col-lg-3">
    <section class="panel">
        <!--        <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#"> <i class="fa fa-user"></i> Profile</a></li>
                </ul>-->
        <div class="user-heading round">
            <a href="#">
                <img alt="" src="<?= (isset($user_data['profile_picture']) && !empty($user_data['profile_picture']) && ($user_data['profile_picture'] !=='null') ? $user_data['profile_picture'] : AUTH_ASSETS . '/img/user_default.png') ?> ">
            </a>
            <h1><?//php echo $user_data['username']; ?></h1>
            <p><?//php echo $user_data['email']; ?></p>
        </div>
    </section>

    <!--moderator form -->
</aside>
<aside class="profile-info col-lg-9">

    <section class="panel">
        <div class="panel-body bio-graph-info">
            <h1>User Details</h1>
            <div class="row">
                <div class="bio-row">
                    <p><span>User Id </span>: <?php echo $user_data['id']; ?></p>
                </div>
                <div class="bio-row">
                    <p><span>Name </span>: <?= ($user_data['username']?$user_data['username']:'N/A')?></p>
                </div>
                <div class="bio-row">
                    <p><span>Email </span>: <?= ($user_data['email']?$user_data['email']:'N/A')?></p>
                </div>
                <div class="bio-row">
                    <p><span>Mobile</span>: <?= ($user_data['mobile']?$user_data['mobile']:'N/A')?></p>
                </div>
                <div class="bio-row">
                    <p><span>Login-Via</span>: <?= (($user_data['login_type']==0) ? "Normal" : (($user_data['login_type']==1) ? "Facebook" : (($user_data['login_type']==2) ? "Gmail":(($user_data['login_type']==3) ? "Apple":"N/A"))))?></p>
                </div>
                <!--<div class="bio-row">
                    <p><span>Status</span>: N/A</p>
                </div>-->
                <div class="bio-row">
                    <p><span>Date/Time of Registration </span>: <?php echo date("d-m-Y H:i:s", $user_data['creation_time'] / 1000) ?></p>
                </div>
                <div class="bio-row">
                    <p><span>Date/Time of Last Login </span>: <?= ($user_data['last_login'] != '') ? date("d-m-Y H:i:s", $user_data['last_login'] / 1000) : '00-00-0000 00:00:00' ?></p>
                </div>
            </div>
            <div class="col-md-8 pull-right">

                <?php if ($user_data['status'] != '2') { ?>
                    <div class="col-md-3 pull-right">
                        <a href="<?php echo AUTH_PANEL_URL . 'web_user/delete_user/delete/' . $user_data['id']; ?>" onclick="return confirm('Are you sure to delete this user');"><button class="pull-right btn btn-danger btn-xs bold">Delete User</button></a>
                    </div>
                    <div class="col-md-3 pull-right">
                        <?php if ($user_data['status'] == '1') { ?>
                            <a href="<?php echo AUTH_PANEL_URL . 'web_user/enable_user/enable/' . $user_data['id']; ?>"><button class="pull-right btn btn-warning btn-xs bold">Enable login</button></a>
                        <?php } else { ?>
                            <a href="<?php echo AUTH_PANEL_URL . 'web_user/disable_user/disable/' . $user_data['id']; ?>" onclick="return confirm('Are you sure to disable this user');"><button class="pull-right btn btn-warning btn-xs bold">Disable login</button></a>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class="col-md-3 pull-right">
                        <a href="#"><button class="pull-right btn btn-info btn-xs bold">User Deleted</button></a>
                    </div>
                <?php } ?>

                <!-- <div class="col-md-3 pull-right">
                  <a href="<?php echo AUTH_PANEL_URL . 'bulk_messenger/bulk_message/send_bulk_message?M=' . base64_encode($user_data['mobile']); ?>"><button class="pull-right btn btn-success btn-xs bold">Send Sms</button></a>
              </div> -->

                <!-- <div class="col-md-3 pull-right">
                    <a href="<?php echo AUTH_PANEL_URL . 'bulk_messenger/push_notification/send_push_notification?q=' . base64_encode(json_encode(array('id' => $user_data['id'], 'name' => $user_data['name'], 'device_type' => $user_data['device_type'], 'device_tokken' => $user_data['device_tokken']))); ?>"><button class="pull-right btn btn-info btn-xs bold">Push Notification</button></a>
                </div> -->


            </div>
        </div>		  
    </section>
</aside>
<aside class="profile-nav col-lg-12">
    <?php if (isset($device_details) && !empty($device_details)) { ?>
        <section class="panel">
            <header class="panel-heading">
                Device Information
            </header>
            <div class="panel-body">
<!--                <form role="form" class="form-inline" method="post" action="<?php echo AUTH_PANEL_URL . 'web_user/detach_device/' . $user_data['id']; ?>">-->
                    <table class="table">
                        <thead>
                            <tr class="success">
                                <th>Sr. No.</th>
                                <th>Device Type</th>
                                <th>Device ID</th>
                                <th>Device Model</th>
                                <th>Login At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $color_array = array("warning", "active", "info", "success", "danger");
                            $i = 0;
                            foreach ($device_details as $devices) {
//                        shuffle($color_array);
                                $class = $color_array[$i];
                                ?>
                                <tr class="<?= $class ?>">
                                    <td><?= ($i+1).'.' ?></td>
                                    <td><?php
                                        switch ($devices['device_type']) {
                                            case 1:
                                                echo ' Android';
                                                break;
                                            case 2:
                                                echo 'Ios';
                                                break;
                                            case 3:
                                                echo 'Android TV';
                                                break;
                                            default:
                                                echo ' N/A';
                                                break;
                                        }
                                        ?></td>
                                    <td><span style="word-break: break-all"><?= $devices['device_id'] ?></span></td>
                                    <td><span style="word-break: break-all"><?= $devices['device_model'] ?></span></td>
                                    <td><?php echo date("d-m-Y H:i:s", $devices['creation_time'] / 1000) ?></td>
<!--                                    <td><button class="btn btn-success btn-xs bold" type="submit">Detach Device</button></td>-->
                                    <td><a href="<?php echo AUTH_PANEL_URL . 'web_user/detach_device/'.$user_data['id'].'/'. $devices['id']; ?>" onclick="return confirm('Are you sure to detach this device');"><button class="btn btn-success btn-xs bold">Detach Device</button></a></td>
                                </tr> 
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
<!--                </form>-->
            </div>
        </section>
    <?php } ?>
</aside>

<?php
$custum_js = <<<EOD
				<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
              	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
EOD;
echo modules::run('auth_panel/template/add_custum_js', $custum_js);





