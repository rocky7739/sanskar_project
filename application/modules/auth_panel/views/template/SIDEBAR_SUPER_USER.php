<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<?php
$page = (!isset($page)) ? "" : $page;
$dashboard = '';
$backend_user = '';
$create_backend_user = '';
$backend_user_list = '';
$web_user = '';
$device_managment = '';
$device_list = '';
$visitor = '';
$visitor_list = '';
if ($page == 'dashboard') {
    $dashboard = 'active';
}elseif ($page == 'create_backend_user') {
    $create_backend_user = 'active';
    $backend_user = 'active';
} elseif ($page == 'backend_user_list') {
    $backend_user_list = 'active';
    $backend_user = 'active';
} elseif ($page == 'device_list') {
    $device_managment = 'active';
    $device_list = 'active';
} elseif ($page == 'visitor_list') {
    $visitor = 'active';
    $visitor_list = 'active';
}


//$sidebar_url = array('web_user/all_user_list');
//
//if (is_array($sidebar_url)) {
//    $sidebar_url = implode("','", $sidebar_url);
//    $sidebar_url = "'" . $sidebar_url . "'";
//}
//$session_userdata = $this->session->userdata();
//$user_permsn = $this->db->query("SELECT pg.permission_fk_id FROM backend_user_role_permissions as burps left join permission_group as pg on pg.id = burps.permission_group_id where burps.user_id = '" . $session_userdata['active_backend_user_id'] . "' ")->row_array();
//
//$user_permsn = ($user_permsn['permission_fk_id']) ? $user_permsn['permission_fk_id'] : '0';
//
//$query = $this->db->query("SELECT * from backend_user_permission where id IN ($user_permsn)")->result_array();
//$result_side_bar = $query;
//$temp = array();
//foreach ($result_side_bar as $value) {
//
//    $temp[$value['permission_perm']] = $value['id'];
//}
?>
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- SIDEBAR MENU START HERE...-->
        <ul class="sidebar-menu" id="nav-accordion">


            <!-- ################################ DASHBOARD SECTION START  #################################################-->

            <li>
                <a class="<?php echo $dashboard; ?>" href="<?php echo base_url(INDEX_PHP.'admin-panel/dashboard'); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- ################################ DASHBOARD SECTION END  #################################################-->

            <!-- ################################ BACKEND USERS SECTION START #################################################-->
            <li class="sub-menu dcjq-parent-li">
                <a href="javascript:;" class="dcjq-parent <?php echo $backend_user; ?>">
                    <i class="fa fa-users"></i>
                    <span>Backend Users</span>
                    <span class="dcjq-icon"></span>
                </a>
                <ul class="sub" style="display: block;">
                    <li class="<?php echo $create_backend_user; ?>"><a href="<?php echo base_url(INDEX_PHP.'admin-panel/add-backend-user'); ?>"><span><i class="fa fa-user"></i>Add New</span></a></li>
                    <li class="<?php echo $backend_user_list; ?>"><a href="<?php echo base_url(INDEX_PHP.'admin-panel/backend-user-list'); ?>"><span><i class="fa fa-list"></i>View List</span></a></li>
                </ul>
            </li>
            <!-- ################################ BACKEND USERS SECTION END #################################################-->

            <!-- ################################ DEVICE SECTION START  #################################################-->
            <li class="sub-menu dcjq-parent-li">
                <a href="javascript:;" class="<?php echo $device_managment; ?>">
                    <i class="fa fa-tablet"></i>
                    <span>Device Management</span>
                    <span class="dcjq-icon"></span></a>
                <ul class="sub" style="display: block;">  
                    <li class="sub-menu <?php echo $device_list; ?>">
                        <a class="" href="<?php echo base_url(INDEX_PHP.'admin-panel/device-list'); ?>">
                            <i class="fa fa-mobile"></i>
                            <span>Device List</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- ################################ DEVICE SECTION END  #################################################-->
            
             <!-- ################################ VISITOR SECTION START  #################################################-->
            <li class="sub-menu dcjq-parent-li">
                <a href="javascript:;" class="<?php echo $visitor; ?>">
                    <i class="fa fa-user"></i>
                    <span>Visitor</span>
                    <span class="dcjq-icon"></span></a>
                <ul class="sub" style="display: block;">  
                    <li class="sub-menu <?php echo $visitor_list; ?>">
                        <a class="" href="<?php echo base_url(INDEX_PHP.'admin-panel/visitor-list'); ?>">
                            <i class="fa fa-user"></i>
                            <span>Visitor List</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- ################################ VISITOR SECTION END  #################################################-->


        </ul>
        <!-- SIDEBAR MENU END HERE...-->
    </div>
</aside>