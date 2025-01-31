<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Admin extends MX_Controller {



    function __construct() {

        parent::__construct();

        /* !!!!!! Warning !!!!!!!11

         *  admin panel initialization

         *  do not over-right or remove auth_panel/auth_panel_ini/auth_ini

         */

        $this->load->helper('aul');

        modules::run('auth_panel/auth_panel_ini/auth_ini');

        $this->load->library('form_validation', 'uploads');

        $this->load->model("backend_user");

        $this->load->model('web_user_model');

        $this->load->helper('services');

    }



    public function index($id = '') {

        $view_data['attendance_record'] = $this->backend_user->get_updated_attendance_count();
        $view_data['visitor_record'] = $this->backend_user->get_updated_visitor_count();

        $user_data = $this->session->userdata('active_user_data');

        $view_data['page'] = 'dashboard';

        $data['page_data'] = $this->load->view('admin/WELCOME_PAGE_SUPER_USER', $view_data, TRUE);

        $data['page_title'] = "welcome page";

        echo modules::run('auth_panel/template/call_default_template', $data);

    }



    function otp_authentication() {

        if ($this->session->userdata('active_user_verified')) {

            redirect(base_url(INDEX_PHP . 'admin-panel/dashboard'));

        }

        if ($this->input->post()) {

            $this->load->helper("jwt_validater");

            if ($otp = $this->input->post("otp")) {

                $res_code = 1; // otp_verification($this->input->post("mobile"), $otp, true, true);

                if ($res_code != 1) {

                    $message = "";

                    switch ($res_code) {

                        case 2:

                            $message = "OTP expired";

                            break;

                        case 3:

                            $message = "You Have Entered Invalid OTP";

                            break;

                    }

                    echo json_encode(array("data" => 2, "type" => "error", "title" => "Verification Error!", "message" => $message));

                    die;

                }

            } else {

                if ($this->input->post("mobile") == '9818524882') {

                    $otp = '1234';

                } else {

                    $this->load->helper("message_sender");

                    $otp = rand(1000, 9999);

                    send_message_global("+91", $this->input->post("mobile"), "Dear User, Your OTP for Sanskar mobile verification is $otp.Sanskar Tv"); //TEMPLATEID_TWO

                }

//                otp_verification($this->input->post("mobile"), $otp, false, true);

                echo json_encode(array("data" => 1, "type" => "success", "title" => "OTP sent", "message" => "OTP Sent to your registered mobile number"));

                die;

            }



            $remote_ip = $_SERVER['REMOTE_ADDR'] ?? "";

            $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? "";

            $this->db->where('id', $this->session->userdata('active_backend_user_id'));

            $this->db->update('backend_user',

                    array(

                        'ip_address' => $remote_ip,

                        'user_agent' => $user_agent

                    )

            );

            $_SESSION['active_user_verified'] = 1;

            echo json_encode(array("data" => 3, "type" => "success", "title" => "Congratulations..", "message" => "Thanks For OTP Verification"));

            die;

        }

        $this->load->view('login/otp_authentication');

    }



    public function user_list() {

        $data['page_title'] = "user list";

        $data['page_data'] = $this->load->view('admin/user_list/user_list', '', TRUE);

        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);

    }



    public function create_backend_user() {



        if ($this->input->post()) {

            $this->form_validation->set_rules('username', 'User Name', 'required|trim|is_unique[backend_user.username]');

            $this->form_validation->set_rules('password', 'Password', 'required|trim');

            $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim');

            $this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[backend_user.email]');

            $this->form_validation->set_rules('permission_group', 'Permission Group', 'required');



            if ($this->form_validation->run() != False) {

                $insert_array = array(

                    'username' => $this->input->post('username'),

                    'email' => $this->input->post('email'),

                    'mobile' => $this->input->post('mobile'),

                    'password' => md5($this->input->post('password')),

                    'creation_time' => time(),

                );



                $insetData = $this->backend_user->create_backend_user($insert_array);

                if ($insetData == true) {

                    $user_added_id = $this->db->insert_id();

                    $permission_data = array();

                    $permission_data = array(

                        'user_id' => $user_added_id,

                        'permission_group_id' => $_POST['permission_group'],

                    );

                    $this->db->insert('backend_user_role_permissions', $permission_data);

                    $data['page_toast'] = 'User created successfully.';

                    $data['page_toast_type'] = 'success';

                    $data['page_toast_title'] = 'Action performed.';

                } else {

                    $data['page_toast'] = 'User can not be created.';

                    $data['page_toast_type'] = 'error';

                    $data['page_toast_title'] = 'Action performed.';

                }

            }

        }

        $view_data = array();

        $view_data['page'] = 'create_backend_user';

        $data['page_data'] = $this->load->view('admin/backend_user/create_new_backend_user', $view_data, TRUE);

        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);

    }



    public function backend_user_list() {

        $view_data['page'] = 'backend_user_list';

        $data['page_title'] = "Backend User List";

        $data['page_data'] = $this->load->view('admin/backend_user/backend_user_list', $view_data, TRUE);

        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);

    }



    public function ajax_backend_user_list() {

        // storing  request (ie, get/post) global array to a variable

        $requestData = $_REQUEST;



        $columns = array(

            // datatable column index  => database column name

            0 => 'username',

            1 => 'email',

            2 => 'mobile',

            3 => 'user_state',

            4 => 'permission_group_name',

        );



        $query = "SELECT count(id) as total

								FROM backend_user where status != 2

								";

        $query = $this->db->query($query);

        $query = $query->row_array();

        $totalData = (count($query) > 0) ? $query['total'] : 0;

        $totalFiltered = $totalData;



        $sql = "SELECT bu.*,pg.permission_group_name,

											case bu.status

											when '0' then 'Active'

											when '1' then 'Blocked'

											end as user_state

					 FROM backend_user as bu LEFT JOIN

					 backend_user_role_permissions as burp ON

					 bu.id = burp.user_id LEFT JOIN

					 permission_group as pg ON

					 burp.permission_group_id = pg.id

					 WHERE  bu.status != 2 ";



        /* $sql = "SELECT * ,

          case status

          when '0' then 'Active'

          when '1' then 'Blocked'

          end as user_state

          FROM backend_user   where status != 2 "; */



        // getting records as per search parameters

        if (!empty($requestData['columns'][0]['search']['value'])) {

            //name

            $sql .= " AND username LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";

        }

        if (!empty($requestData['columns'][1]['search']['value'])) {

            //salary

            $sql .= " AND email LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";

        }

        if (!empty($requestData['columns'][2]['search']['value'])) {

            //salary

            $sql .= " AND mobile LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";

        }

        if (!empty($requestData['columns'][3]['search']['value']) || !empty($requestData['columns'][3]['search']['value'])) {

            //salary

            $sql .= " having user_state LIKE '" . $requestData['columns'][2]['search']['value'] . "%' AND permission_group_name LIKE '" . $requestData['columns'][3]['search']['value'] . "%'";

        }



        $query = $this->db->query($sql)->result();



        $totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.



        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   "; // adding length



        $result = $this->db->query($sql)->result();

        $data = array();

        foreach ($result as $r) {

            // preparing an array

            $nestedData = array();



            $nestedData[] = $r->username;

            $nestedData[] = $r->email;

            $nestedData[] = $r->mobile;

            $nestedData[] = $r->user_state;

            $nestedData[] = $r->permission_group_name;

            $action = "<a class='btn-xs bold  btn btn-info' href='" . AUTH_PANEL_URL . "admin/edit_backend_user/" . $r->id . "'>Edit</a>&nbsp;"

                    . "<a class='btn-xs bold btn btn-danger' onclick=\"return confirm('Are you sure you want to delete?')\" href='" . AUTH_PANEL_URL . "admin/delete_backend_user/" . $r->id . "'>Delete</a>&nbsp;";

            if ($r->user_state == 'Active') {

                $action .= "<a class='btn-xs btn  bold btn-warning' href='" . AUTH_PANEL_URL . "admin/block_backend_user/" . $r->id . "/1'>Block</a>";

            } else {

                $action .= "<a class='btn-xs bold btn btn-success' href='" . AUTH_PANEL_URL . "admin/block_backend_user/" . $r->id . "/0'>Unblock</a>";

            }

            $nestedData[] = $action;



            $data[] = $nestedData;

        }



        $json_data = array(

            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.

            "recordsTotal" => intval($totalData), // total number of records

            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData

            "data" => $data, // total data array

        );



        echo json_encode($json_data); // send data as json format

    }



    public function edit_backend_user($id = null) {

        if (!$this->input->post()) {

            if ($this->input->get('password_change')) {

                $data['page_toast'] = 'Password changed successfully.';

                $data['page_toast_type'] = 'success';

                $data['page_toast_title'] = 'Action performed.';

            }

            $view_data['page'] = '';

            $view_data['user_data'] = $this->backend_user->get_user_data($id);

            $data['page_data'] = $this->load->view('admin/backend_user/edit_backend_user', $view_data, TRUE);

            echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);

        } else {

            if ($this->input->post()) {



                $this->form_validation->set_rules('username', 'User Name', 'required|trim');

                $this->form_validation->set_rules('email', 'Email', 'required|trim');

                $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim');



                if ($this->form_validation->run() == False) {

                    

                } else {

                    $id = $this->input->post('id');

                    $username = $this->input->post('username');

                    $email = $this->input->post('email');

                    $mobile = $this->input->post('mobile');

                    $permission_group = $this->input->post('permission_group');

                    $update_array = array(

                        'username' => $username,

                        'email' => $email,

                        'mobile' => $mobile,

                        'updated_time' => time(),

                    );

                    $update_data = $this->backend_user->update_backend_user($update_array, $id);

                    if ($update_data == true) {

                        // ####### UPDATE BACKEND USER ROLE PERMISSION TABLE ###########

                        if (isset($_POST['permission_group'])) {

                            $this->db->where('user_id', $id);

                            $this->db->update('backend_user_role_permissions', array('permission_group_id' => $permission_group));

                        }

                        page_alert_box('success', 'Updated', 'User has been Updated successfully');

                        //$this->session->set_flashdata('success_message', 'User has been Updated succssfully');

                    } else {

                        page_alert_box('error', 'Failed', 'User not Updated');

//                        $this->session->set_flashdata('error_message', 'User not Updated');

                    }

//                    redirect(AUTH_PANEL_URL . 'admin/backend_user_list');

                    redirect(base_url(INDEX_PHP . 'admin-panel/backend-user-list'));

                }

                $view_data['page'] = '';

                $view_data['user_data'] = $this->backend_user->get_user_data($id);

                $data['page_data'] = $this->load->view('admin/backend_user/edit_backend_user', $view_data, TRUE);

                echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);

            }

        }

    }



    public function delete_backend_user($id) {

        $delete_user = $this->backend_user->delete_backend_user($id);

        page_alert_box('success', 'Action Performed', 'User status change successfully');

        redirect(base_url(INDEX_PHP . 'admin-panel/backend-user-list'));

    }



    public function block_backend_user($id, $status) {

        $delete_user = $this->backend_user->block_backend_user($id, $status);

        page_alert_box('success', 'Action Performed', 'User status change successfully');

        redirect(base_url(INDEX_PHP . 'admin-panel/backend-user-list'));

    }



    public function change_password_backend_user() {

        $id = $this->input->post('id');

        if ($this->input->post('new_password') != '') {

            $update_data = $this->backend_user->change_password_backend_user($this->input->post());

        }

        redirect(AUTH_PANEL_URL . "admin/edit_backend_user/$id?password_change=true");

    }



    public function get_dashboard_by_search() {

        $date = $this->input->post('date');

        if ($date == 'today') {

            $today = date("Y-m-d");

            $query = $this->db->query("SELECT * FROM users where date(FROM_UNIXTIME( creation_time /1000, '%Y-%m-%d %H:%i:%s' )) = '$today'")->result_array();

        } elseif ($date == 'yesterday') {

            $yesterday = date("Y-m-d", strtotime("-1 days"));

            $query = $this->db->query("SELECT * FROM users where date(FROM_UNIXTIME( creation_time /1000, '%Y-%m-%d %H:%i:%s' )) = '$yesterday'")->result_array();

        } elseif ($date == 'Week') {

            $week = date('Y-m-d', strtotime("-7 days"));

            $today = date("Y-m-d");

            $query = $this->db->query("SELECT * FROM users where date(FROM_UNIXTIME( creation_time /1000, '%Y-%m-%d %H:%i:%s' )) BETWEEN '$week' AND '$today'")->result_array();

        } elseif ($date == 'Month') {

            $month = date('Y-m-d', strtotime("-1 Months"));

            $today = date("Y-m-d");

            $query = $this->db->query("SELECT * FROM users where date(FROM_UNIXTIME( creation_time /1000, '%Y-%m-%d %H:%i:%s' )) BETWEEN '$month' AND '$today'")->result_array();

        } elseif ($date == 'Year') {

            $year = date('Y-m-d', strtotime("-1 year"));

            $today = date("Y-m-d");

            $query = $this->db->query("SELECT * FROM users where date(FROM_UNIXTIME( creation_time /1000, '%Y-%m-%d %H:%i:%s' )) BETWEEN '$year' AND '$today'")->result_array();

        }

        $total = 0;

        $dams_student = 0;

        $non_dams_student = 0;

        $result = array();

        foreach ($query as $key => $sql) {

            $total = $total + 1;

            if ($sql['dams_tokken'] != '') {

                $dams_student = $dams_student + 1;

            } else {

                $non_dams_student = $non_dams_student + 1;

            }

        }

        $result['total_student'] = $total;

        $result['dams_student'] = $dams_student;

        $result['non_dams_student'] = $non_dams_student;

        $html = '<div class=col-lg-3><section class=panel><div class=panel-body><a href=#><span class="fa fa-2x fa-users"></span></a><div class=task-thumb-details><h1><a href=#>Student Summary</a></h1></div></div><table class="personal-task table table-hover"><tr><td><i class="fa fa-tasks"></i><td>Total Student<td>' . $result['total_student'] . '<tr><td><i class="fa fa-tasks"></i><td>DAMS Student<td>' . $result['dams_student'] . '<tr><td><i class="fa fa-tasks"></i><td>NON DAMS Student<td>' . $result['non_dams_student'] . '</table></section></div><div class=col-lg-3><section class=panel><div class=panel-body><a href=#><span class="fa fa-2x fa-users"></span></a><div class=task-thumb-details><h1><a href=#>Faculty Summary</a></h1></div></div><table class="personal-task table table-hover"><tr><td><i class="fa fa-tasks"></i><td>Total Faculty<td>N/A<tr><td><i class="fa fa-tasks"></i><td>DAMS Faculty<td>N/A<tr><td><i class="fa fa-tasks"></i><td>NON DAMS Faculty<td>N/A</table></section></div><div class=col-lg-3><section class=panel><div class=panel-body><a href=#><span class="fa fa-2x fa-users"></span></a><div class=task-thumb-details><h1><a href=#>Member Summary</a></h1></div></div><table class="personal-task table table-hover"><tr><td><i class="fa fa-tasks"></i><td>Student<td>N/A<tr><td><i class="fa fa-tasks"></i><td>Faculty<td>N/A<tr><td><i class="fa fa-tasks"></i><td>HOD<td>N/A</table></section></div><div class=col-lg-3><section class=panel><div class=panel-body><a href=#><span class="fa fa-2x fa-users"></span></a><div class=task-thumb-details><h1><a href=#>Course Summary</a></h1></div></div><table class="personal-task table table-hover"><tr><td><i class="fa fa-tasks"></i><td>Total Course<td>N/A<tr><td><i class="fa fa-tasks"></i><td>DAMS Faculty Course<td>N/A<tr><td><i class="fa fa-tasks"></i><td>Non DAMS Faculty Course<td>N/A<tr><td><i class="fa fa-tasks"></i><td>Today Rated Course<td>N/A</table></section></div><div class=col-lg-3><section class=panel><div class=panel-body></div><table class="personal-task table table-hover"><tr><td><i class="fa fa-tasks"></i><td>Total Revenue<td>N/A<tr><td><i class="fa fa-tasks"></i><td>Order<td>N/A<tr><td><i class="fa fa-tasks"></i><td>Recent Order<td>N/A<tr><td><i class="fa fa-tasks"></i><td>Pending Order<td>N/A</table></section></div>';

        echo json_encode(array('status' => true, 'html' => $html));

        die;

    }



    public function make_permission_group() {

        //set message on delete group..

        if ($this->session->userdata('delete_permission_group') != '' && $this->session->userdata('delete_permission_group') == 'Yes') {



            $data['page_toast'] = 'Information Deleted  successfully.';

            $data['page_toast_type'] = 'success';

            $data['page_toast_title'] = 'Action performed.';

            $this->session->unset_userdata('delete_permission_group');

        }

        //post data for add group..

        if ($_POST) {

            $this->form_validation->set_rules('permission_id[]', 'Permission', 'required');

            $this->form_validation->set_rules('permission_group_name', 'Permission Group Name', 'required');



            if ($this->form_validation->run() != FALSE) {



                if (!empty($_POST['permission_id'])) {

                    $permission_ids = implode(',', $_POST['permission_id']);

                } else {

                    $permission_ids = '';

                }

                $insert_data = array('permission_group_name' => $_POST['permission_group_name'], 'permission_fk_id' => $permission_ids);

                $this->db->insert('permission_group', $insert_data);



                $data['page_toast'] = 'Information Inserted  successfully.';

                $data['page_toast_type'] = 'success';

                $data['page_toast_title'] = 'Action performed.';

            }

        }

        //if data not post to add..

        $view_data['page'] = 'permission_group';

        $view_data['permission_lists'] = $this->backend_user->get_permission_list();

        $data['page_data'] = $this->load->view('admin/backend_user/make_permission_group', $view_data, TRUE);

        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);

    }



    public function ajax_get_permission_group_list() {

        // storing  request (ie, get/post) global array to a variable

        $requestData = $_REQUEST;



        $columns = array(

            // datatable column index  => database column name

            0 => 'id',

            1 => 'permission_group_name',

        );



        $query = "SELECT count(id) as total

								FROM permission_group where 1= 1

								";

        $query = $this->db->query($query);

        $query = $query->row_array();

        $totalData = (count($query) > 0) ? $query['total'] : 0;

        $totalFiltered = $totalData;



        $sql = "SELECT * FROM permission_group   where 1= 1 ";



        // getting records as per search parameters

        if (!empty($requestData['columns'][0]['search']['value'])) {

            //name

            $sql .= " AND id LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";

        }

        if (!empty($requestData['columns'][1]['search']['value'])) {

            //salary

            $sql .= " AND permission_group_name LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";

        }



        $query = $this->db->query($sql)->result();



        $totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.



        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   "; // adding length



        $result = $this->db->query($sql)->result();

        $data = array();

        foreach ($result as $r) {

            // preparing an array

            $nestedData = array();



            $nestedData[] = ++$requestData['start'];

            $nestedData[] = $r->permission_group_name;

            $action = "<a class='btn-xs bold  btn btn-info' href='" . AUTH_PANEL_URL . "admin/edit_permission_group/" . $r->id . "'>Edit</a>&nbsp;"

                    . "<a class='btn-xs bold btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this group?')\" href='" . AUTH_PANEL_URL . "admin/delete_permission_group/" . $r->id . "'>Delete</a>&nbsp;";



            $nestedData[] = $action;



            $data[] = $nestedData;

        }



        $json_data = array(

            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.

            "recordsTotal" => intval($totalData), // total number of records

            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData

            "data" => $data, // total data array

        );



        echo json_encode($json_data); // send data as json format

    }



    public function edit_permission_group($id) {

        if ($_POST) {

            //echo "<pre>";print_r($_POST);die;

            $this->form_validation->set_rules('permission_id[]', 'Permission', 'required');

            $this->form_validation->set_rules('permission_group_name', 'Permission Group Name', 'required');



            if ($this->form_validation->run() != FALSE) {



                if (!empty($_POST['permission_id'])) {

                    $permission_ids = implode(',', $_POST['permission_id']);

                } else {

                    $permission_ids = '';

                }

                $update_data = array('permission_group_name' => $_POST['permission_group_name'], 'permission_fk_id' => $permission_ids);



                $this->db->where('id', $id);

                $this->db->update('permission_group', $update_data);



                $data['page_toast'] = 'Information Updated successfully.';

                $data['page_toast_type'] = 'success';

                $data['page_toast_title'] = 'Action performed.';

            }

        }



        $view_data['page'] = 'permission_group';

        $view_data['permission_lists'] = $this->backend_user->get_permission_list();

        $view_data['permission_detail'] = $this->backend_user->get_permission_detail_by_id($id);

        $data['page_data'] = $this->load->view('admin/backend_user/edit_permission_group', $view_data, TRUE);

        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);

    }



    public function delete_permission_group($id) {

        $this->db->where('id', $id)

                ->delete('permission_group');

        $this->session->set_userdata('delete_permission_group', 'Yes');

        redirect('auth_panel/admin/make_permission_group');

    }



}

