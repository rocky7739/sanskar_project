<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Web_user extends MX_Controller {

    function __construct() {
        parent::__construct();
        /* !!!!!! Warning !!!!!!!11
         *  admin panel initialization
         *  do not over-right or remove auth_panel/auth_panel_ini/auth_ini
         */
        modules::run('auth_panel/auth_panel_ini/auth_ini');
        $this->load->model('web_user_model');
        $this->load->library('form_validation', 'uploads');
        $this->load->helper('services');
    }

    public function all_user_list() {
        $view_data['page'] = 'all';
        $view_data['device_type'] = 'all';//all
        $data['page_data'] = $this->load->view('web_user/all_user', $view_data, TRUE);
        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
    }
    public function android_user_list() {
        $view_data['page'] = 'android';
        $view_data['device_type'] = '1';//android
        $data['page_data'] = $this->load->view('web_user/all_user', $view_data, TRUE);
        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
    }
    public function ios_user_list() {
        $view_data['page'] = 'ios';
        $view_data['device_type'] = '2';//'ios';
        $data['page_data'] = $this->load->view('web_user/all_user', $view_data, TRUE);
        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
    }

    public function get_request_for_csv_download($device_type) {
        $this->ajax_all_user_list($device_type);
    }
    public function all_user_to_csv_download($array, $filename = "Users.csv", $delimiter = ";", $header) {
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        $f = fopen('php://output', 'w');
        fputcsv($f, $header);
        foreach ($array as $line) {
            fputcsv($f, $line);
        }
    }
    public function all_user_to_pdf_download($data) {
        $this->load->library('fpdf_users');
        $this->fpdf_users->pdf_out($data);
    }

    public function ajax_all_user_list($device_type) {
        $output_csv = $output_pdf = false;
        $requestData = $_REQUEST;
        if (isset($_POST['input_json'])) {
            $requestData = json_decode($_POST['input_json'], true);
            if (ISSET($_POST['download_pdf'])) {
                $output_pdf = true;
            } else {
                $output_csv = true;
            }
        }

        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'country_code',
            4 => 'mobile',
            5 => 'status',
            6 => 'wtsp_sms_send',
            7 => 'creation_time',
        );
        if($device_type=='all'){
            $where = "";
        } else {
            $where = " and device_type=$device_type";  
        }
        $query = "SELECT count(id) as total
									FROM users where status != 2 
									$where
									";
        $query = $this->db->query($query);
        $query = $query->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;
        $totalFiltered = $totalData;

        $sql = "SELECT users.id,username,email,country_code,mobile,DATE_FORMAT(FROM_UNIXTIME(creation_time/1000), '%d-%m-%Y %h:%i:%s') as creation_time,status,wtsp_sms_send,country.name as c_name"
                . " FROM  users"
                ." LEFT JOIN country ON users.country_code = country.phonecode"
                . "  where users.status != 2 $where";
//        $sql = "SELECT users.id,username,email,country_code,mobile,DATE_FORMAT(FROM_UNIXTIME(creation_time/1000), '%d-%m-%Y %h:%i:%s') as creation_time,status,wtsp_sms_send FROM  users where users.status != 2 $where";

        // getting records as per search parameters
        if (!empty($requestData['columns'][0]['search']['value'])) {   //name
            $sql .= " AND users.id LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
            $sql .= " AND username LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][2]['search']['value'])) {  //salary
            $sql .= " AND email LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
        }
        
        if (!empty($requestData['columns'][3]['search']['value'])) {  //salary
            $sql .= " AND country.name LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][4]['search']['value'])) {  //salary
            $sql .= " AND mobile LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
        }

        if (isset($requestData['columns'][5]['search']['value']) && $requestData['columns'][5]['search']['value'] != "") {  //salary
            $sql .= " AND status = " . $requestData['columns'][5]['search']['value'];
        }
      if (isset($requestData['columns'][6]['search']['value']) && $requestData['columns'][6]['search']['value'] != "") {  //salary
            $sql .= " AND wtsp_sms_send = " . $requestData['columns'][6]['search']['value'];
        }
         if (!empty($requestData['columns'][7]['search']['value'])  ) {  //salary
         	$date = explode(',',$requestData['columns'][7]['search']['value']);
         	$start = strtotime($date[0])*1000; 
         	$end = (strtotime($date[1])*1000)+86400000; 
         	$sql.="  AND  creation_time >= '$start' and creation_time <= '$end'";
         }
       // echo $requestData['columns'][5]['search']['value'];
        $query = $this->db->query($sql)->result();
      //echo $this->db->last_query();

        $totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

//        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length
        if ($output_csv == false && $output_pdf == false) {
            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length
        } else {
            $sql .= " ORDER BY users.creation_time desc";
        }

        $result = $this->db->query($sql)->result();

        $data = array();
        if ($output_csv == true || $output_pdf == true) {
            // for csv loop
            $head = array('S.no', 'Username', 'Email','Country Code', 'Mobile', 'Status','Whatsapp Status', 'Created At');
            $start = 0;
            foreach ($result as $r) {
                $nestedData = array();
                $nestedData[] = ++$start; //$r->id;
                $nestedData[] = $r->username;
                $nestedData[] = $r->email;
                $nestedData[] =  $r->country_code;
                $nestedData[] =  $r->mobile;
                $nestedData[] = ($r->status == 0 ) ? 'Active' : 'Disabled';
              $nestedData[] = ($r->wtsp_sms_send == 1 ) ? 'Success' : 'Failed';
                $nestedData[] = $r->creation_time;
                $data[] = $nestedData;
            }
            if ($output_csv == true) {
                $this->all_user_to_csv_download($data, $filename = "Users.csv", $delimiter = ";", $head);
                die;
            }
            if ($output_pdf == true) {
                $this->all_user_to_pdf_download($data);
                die;
            }
        }

        foreach ($result as $r) {  // preparing an array
            $nestedData = array();
//            $nestedData[] = $r->id;
             $nestedData[] = ++$requestData['start'];
            $nestedData[] = $r->username;
            $nestedData[] = $r->email;
             $nestedData[] =  $r->c_name;
            $nestedData[] = $r->country_code.'-'.$r->mobile;
            $nestedData[] = ($r->status == 0 ) ? '<span class="btn btn-xs bold btn-success">Active</span>' : '<span class="btn btn-xs btn-danger">Disabled</span>';
           $nestedData[] = ($r->wtsp_sms_send == 1 ) ? '<span class="btn btn-xs bold btn-success">Success</span>' : '<span class="btn btn-xs btn-danger">Failed</span>';
            $nestedData[] = $r->creation_time;
            $nestedData[] = "<a class='btn-xs bold btn btn-info' href='" . base_url('admin-panel/view-user/') . $r->id . "'>View</a>";
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  // send data as json format
    }

    public function user_profile($id) {
        if ($this->input->post()) {

            //$this->form_validation->set_rules('user_id', '', 'required');
            $this->form_validation->set_rules('u_name', 'Beneficiary name', 'required');
            $this->form_validation->set_rules('b_account', 'Beneficiary account', 'required');
            $this->form_validation->set_rules('b_ifsc', 'Bank IFSC', 'required');
            $this->form_validation->set_rules('b_name', 'Bank name', 'required');
            $this->form_validation->set_rules('b_address', 'Bank address', 'required');
            $this->form_validation->set_rules('r_sharing', 'Resource sharing', 'required');



            if ($this->form_validation->run() == FALSE) {
                
            }


            $update = array('u_name' => $this->input->post('u_name'), 'b_account' => $this->input->post('b_account'), 'b_ifsc' => $this->input->post('b_ifsc'), 'b_name' => $this->input->post('b_name'), 'b_address' => $this->input->post('b_address'), 'r_sharing' => $this->input->post('r_sharing'));
            //print_r($insert_data); die;

            $this->db->where('user_id', $id);
            $this->db->update('course_instructor_information', $update);

            $data['page_toast'] = 'File added successfully.';
            $data['page_toast_type'] = 'success';
            $data['page_toast_title'] = 'Action performed.';
        }



        $view_data['user_data'] = $this->web_user_model->get_user_profile($id);
        $view_data['device_details'] = $this->web_user_model->get_user_device_details($id);
        if($view_data['user_data']['device_type']==1){
            $view_data['page'] = 'android';
        }elseif ($view_data['user_data']['device_type']==2) {
            $view_data['page'] = 'ios';
        } else {
            $view_data['page'] = 'all';
        }
//        pre( $view_data['user_data']);die;
        $data['page_data'] = $this->load->view('web_user/user_profile', $view_data, TRUE);
        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
    }

    public function delete_user($status, $id) {

        $status = $this->web_user_model->update_user_status($status, $id);
        if ($status == 'TRUE') {
             page_alert_box('success', 'Action performed', 'User deleted successfully');
            redirect(base_url('admin-panel/view-user/'.$id)); 
//            redirect('auth_panel/web_user/user_profile/' . $id);
        }
    }

    public function disable_user($status, $id) {
        $status = $this->web_user_model->update_user_status($status, $id);

        if ($status) {
             page_alert_box('success', 'Action performed', 'User disabled successfully');
            redirect(base_url('admin-panel/view-user/'.$id)); 
//            redirect('auth_panel/web_user/user_profile/' . $id);
        }
    }

    public function enable_user($status, $id) {
        $status = $this->web_user_model->update_user_status($status, $id);

        if ($status) {
            page_alert_box('success', 'Action performed', 'User enabled successfully');
            redirect(base_url('admin-panel/view-user/'.$id)); 
//            redirect('auth_panel/web_user/user_profile/' . $id);
        }
    }

    public function is_moderator($id) {
        if ($id > 0) {
            $this->db->where('id', $id);
            $this->db->update('users', array('is_moderate' => $_POST['modrator']));
            //creating backend log
            $user_details = $this->web_user_model->get_user_basic_detail($id);
            if ($_POST['modrator'] == 1) {
                backend_log_genration($this->session->userdata('active_backend_user_id'),
                        'Assigned Modrator role to ' . $user_details['name'] . '.',
                        'WEB USER');
            } else {
                backend_log_genration($this->session->userdata('active_backend_user_id'),
                        'Removed Modrator role from ' . $user_details['name'] . '.',
                        'WEB USER');
            }
        }

        redirect('auth_panel/web_user/user_profile/' . $id);
    }

    public function is_instructor($id) {
        if ($id > 0) { //print_r($_POST); die;
            $this->db->where('id', $id);
            $update = $this->db->update('users', array('is_instructor' => $_POST['instructor']));

            $is_instructor = $_POST['instructor'];

            $this->db->select("name,email,password");
            $this->db->where('id', $id);
            $user_details = $this->db->get('users')->row_array();

            $add_instructor = array('username' => $user_details['name'], 'email' => $user_details['email'], 'password' => $user_details['password'], 'creation_time' => time(), '	instructor_id' => $id, 'status' => 0);

            if ($_POST['instructor'] == 1) {
                $status = $this->web_user_model->add_instructor_id($id);

                $this->db->where('instructor_id', $id);
                $instructor_details_backend_user = $this->db->get('backend_user')->row_array();
                if (empty($instructor_details_backend_user)) {
                    $add_instructor_to_backend_user = $this->db->insert("backend_user", $add_instructor);
                } elseif ($instructor_details_backend_user['status'] == 1) {
                    $this->db->where('instructor_id', $id);
                    $update = $this->db->update('backend_user', array('status' => 0));
                }
            } elseif ($_POST['instructor'] == 0) {
                $this->db->where('instructor_id', $id);
                $update = $this->db->update('backend_user', array('status' => 1));
            }
        }

        redirect('auth_panel/web_user/user_profile/' . $id);
    }

    public function is_expert($id) {
        if ($id > 0) { //print_r($_POST); die;
            $this->db->where('id', $id);
            $update = $this->db->update('users', array('is_expert' => $_POST['expert']));
            $user_details = $this->web_user_model->get_user_basic_detail($id);
            if ($_POST['expert'] == 1) {
                $status = $this->web_user_model->add_instructor_id($id);
                backend_log_genration($this->session->userdata('active_backend_user_id'),
                        'Assigned Expert role to ' . $user_details['name'] . '.',
                        'WEB USER');
            } else {
                backend_log_genration($this->session->userdata('active_backend_user_id'),
                        'Removed Expert role from ' . $user_details['name'] . '.',
                        'WEB USER');
            }
        }

        redirect('auth_panel/web_user/user_profile/' . $id);
    }

    public function all_user_location() {

        $view_data['page'] = 'location';
        $data['page_data'] = $this->load->view('web_user/all_user_location', $view_data, TRUE);
        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
    }

    public function ajax_all_user_location() {

        // storing  request (ie, get/post) global array to a variable
        $requestData = $_REQUEST;

        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'country',
            4 => 'state',
            5 => 'city'
        );

        $query = "SELECT count(id) as total
									FROM user_registerd_location
									where 1 = 1"
        ;
        $query = $this->db->query($query);
        $query = $query->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;
        $totalFiltered = $totalData;

        $sql = "SELECT url.*,u.name,u.email,u.creation_time FROM  user_registerd_location as url
				JOIN users as u ON url.user_id = u.id
				where 1 = 1 
				";
        // getting records as per search parameters
        if (!empty($requestData['columns'][0]['search']['value'])) {   //name
            $sql .= " AND id LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
            $sql .= " AND name LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][2]['search']['value'])) {  //salary
            $sql .= " AND email LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][3]['search']['value'])) {  //salary
            $sql .= " AND country LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][4]['search']['value'])) {  //salary
            $sql .= " AND state LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][5]['search']['value'])) {  //salary
            $sql .= " AND city LIKE '" . $requestData['columns'][5]['search']['value'] . "%' ";
        }


        //echo $requestData['columns'][5]['search']['value'];
        $query = $this->db->query($sql)->result();

        $totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

        $result = $this->db->query($sql)->result();

        $data = array();

        foreach ($result as $r) {  // preparing an array
            $nestedData = array();
//            $nestedData[] = $r->id;
            $nestedData[] = ++$requestData['start'];
            $nestedData[] = $r->name;
            $nestedData[] = $r->email;
            $nestedData[] = $r->country;
            $nestedData[] = $r->state;
            $nestedData[] = $r->city;
            $nestedData[] = $r->latitude;
            $nestedData[] = $r->longitude;
            $nestedData[] = $r->ip_address;
            $nestedData[] = date("d-m-Y", $r->creation_time / 1000);
            $nestedData[] = "<a class='btn-xs bold btn btn-info' href='#'>View</a>";
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  // send data as json format
    }

    /*     * *******************End User************************* */

    public function ajax_instructor_ratings_list($id) {
        // storing  request (ie, get/post) global array to a variable
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'name',
            2 => 'rating',
            3 => 'text',
            4 => 'creation_time'
        );

        $query = "SELECT count(id) as total FROM course_instructor_rating";
        $query = $this->db->query($query);
        $query = $query->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;
        $totalFiltered = $totalData;

        $sql = "SELECT cir.*,u.name,DATE_FORMAT(FROM_UNIXTIME(cir.creation_time/1000), '%d-%m-%Y %h:%i:%s') as creation_time  
								FROM course_instructor_rating as  cir
								 join users as u 
								on cir.user_id = u.id where instructor_id = $id";

        // getting records as per search parameters
        if (!empty($requestData['columns'][0]['search']['value'])) {   //name
            $sql .= " AND id LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
            $sql .= " AND name LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][2]['search']['value'])) {  //salary
            $sql .= " AND rating LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][3]['search']['value'])) {  //salary
            $sql .= " AND text LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][4]['search']['value'])) {  //salary
            $sql .= " AND creation_time LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
        }



        $query = $this->db->query($sql)->result();

        $totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

        $result = $this->db->query($sql)->result();

        $data = array();
        foreach ($result as $r) {  // preparing an array
            $nestedData = array();

            $star = "";
            if ($r->rating > 0) {
                for ($i = 0; $i < $r->rating; $i++) {
                    $star .= '<i class =  "fa fa-star text-danger"></i>';
                }
                if ($i < 5) {
                    $j = 5 - $i;
                    for ($i = 0; $i < $j; $i++) {
                        $star .= '<i class =  "fa fa-star-o text-danger"></i>';
                    }
                }
            }

//            $nestedData[] = $r->id;
             $nestedData[] = ++$requestData['start'];
            $nestedData[] = $r->name;
            $nestedData[] = $star;
            $nestedData[] = substr($r->text, 0, 30);
            $nestedData[] = $r->creation_time;
            $action = "<a class='btn-xs btn btn-success btn-xs bold' href='" . AUTH_PANEL_URL . "web_user/edit_instructor_rating/" . $r->id . "'>Edit</a>";
            $action .= "<a class='btn-xs btn btn-danger btn-xs bold' href='" . AUTH_PANEL_URL . "web_user/delete_review/" . $r->id . "?instructor_id=" . $r->instructor_id . "'>delete</a>";
            $nestedData[] = $action;

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  // send data as json format
    }

    public function edit_instructor_rating($id) {
        $view_data['page'] = 'edit_instructor_rating';
        $data['page_title'] = "Edit Instructor Rating";
        if ($this->input->post('update_instructor_review')) {
            /* handle submission */
            $this->update_instructor_review();
        }
        $view_data['instructor_rating_detail'] = $this->web_user_model->get_instructor_rating_details_by_id($id);
        $data['page_data'] = $this->load->view('web_user/edit_instructor_details', $view_data, TRUE);
        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
    }

    private function update_instructor_review() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('rating', 'Rating', 'required');
            $this->form_validation->set_rules('text', 'Review', 'required');
            $review_id = $this->input->post('id');
            $user_id = $this->input->post('instructor_id');
            if ($this->form_validation->run() == FALSE) {
                $error = validation_errors();
            } else {
                $update = array(
                    'rating' => $this->input->post('rating'),
                    'text' => $this->input->post('text'),
                );
                $this->db->where('id', $review_id);
                $this->db->update('course_instructor_rating', $update);
                page_alert_box('success', 'Action performed', 'Review updated successfully');
            }
        }
    }

    public function delete_review($id) {
        $user_id = $_GET['instructor_id'];
        $status = $this->web_user_model->delete_review($id);
        page_alert_box('success', 'Action performed', 'Review deleted successfully');
        if ($status) {
            redirect('auth_panel/web_user/user_profile/' . $user_id);
        }
    }
    
    public function detach_device($id,$device_id) {
         $this->db->where('id', $device_id);
        $result=$this->db->delete('user_device_login_record');
        if ($this->db->affected_rows() > 0){
            page_alert_box('success', 'Action performed', 'Device detached successfully');
            redirect(base_url('admin-panel/view-user/'.$id)); 
        }
    }

}
