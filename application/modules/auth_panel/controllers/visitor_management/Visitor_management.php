<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Visitor_management extends MX_Controller {

    function __construct() {
        parent::__construct();
        /* !!!!!! Warning !!!!!!!11
         *  admin panel initialization
         *  do not over-right or remove auth_panel/auth_panel_ini/auth_ini
         */
        modules::run('auth_panel/auth_panel_ini/auth_ini');
        $this->load->library('form_validation');
        $this->load->model("Visitor_management_model");
        $this->load->helper("services");
    }

    public function visitor_list() {
        $data['page_title'] = "Visitor List";
        $view_data['page'] = "visitor_list";
        $data['page_data'] = $this->load->view('visitor_management/visitor_list', $view_data, TRUE);
        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
    }

    public function ajax_all_visitor_list() {
        // storing  request (ie, get/post) global array to a variable
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'name',
            2 => 'mobile',
            3 => 'status'
        );

        $query = "SELECT count(id) as total
				  FROM visitor";

        $query = $this->db->query($query);
        $query = $query->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;
        $totalFiltered = $totalData;

        $sql = "SELECT * from visitor where 1=1";

        // getting records as per search parameters

        if (!empty($requestData['columns'][0]['search']['value'])) {
            $sql .= " AND id LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][1]['search']['value'])) {
            $sql .= " AND name LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][2]['search']['value'])) {
            $sql .= " AND mobile LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][3]['search']['value'])) {
            $sql .= " AND address LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
        }

        $query = $this->db->query($sql)->result();

        $totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

        $result = $this->db->query($sql)->result();

        $data = array();
        $file_directory = CONFIG_PROJECT_DOMAIN . '/uploads/visitor/';
        foreach ($result as $r) {  // preparing an array
            $status = ($r->status == 0) ? 'lock' : 'unlock';
            $alert_status = ($r->status == 0) ? 'Enable' : 'Disable';
            $button_status = ($r->status == 0) ? 'danger' : 'success';
            $nestedData = array();
            $nestedData[] = ++$requestData['start'];
            $nestedData[] = $r->name;
            $nestedData[] = $r->mobile;
            $nestedData[] = $r->address;
            $nestedData[] = "<img width='80px' height='50px' src='" . $file_directory . $r->image . "'></a>"
                    . "<a class='btn-xs bold btn btn-primary pull-right' style='margin-top:15px;' href='" . base_url(INDEX_PHP . 'admin-panel/visitor-details/') . $r->id . "'><i class='fa fa-user'></i>Visitor Profile</a>&nbsp;";
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

    public function visitor_details($id) {
        $view_data['visitor_details'] = $this->Visitor_management_model->get_visitor_details($id);
        $data['page_title'] = "Visitor Details";
        $view_data['page'] = "visitor_list";
        $data['page_data'] = $this->load->view('visitor_management/visitor_details', $view_data, TRUE);
        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
    }

    public function ajax_visitor_details() {
        // storing  request (ie, get/post) global array to a variable
        $requestData = $_REQUEST;
        $visitor_id = $requestData['visitor_id'];
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'to_whome',
            2 => 'in_time',
            3 => 'out_time'
        );

        $query = "SELECT count(id) as total
				  FROM visitor_record where visitor_id='$visitor_id'";

        $query = $this->db->query($query);
        $query = $query->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;
        $totalFiltered = $totalData;

        $sql = "SELECT * FROM visitor_record where visitor_id='$visitor_id'";

        // getting records as per search parameters

        $query = $this->db->query($sql)->result();

        $totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

        $result = $this->db->query($sql)->result();

        $data = array();

        foreach ($result as $r) {  // preparing an array
            $status = ($r->status == 0) ? 'lock' : 'unlock';
            $alert_status = ($r->status == 0) ? 'Enable' : 'Disable';
            $button_status = ($r->status == 0) ? 'danger' : 'success';
            $nestedData = array();
            $nestedData[] = ++$requestData['start'];
            $nestedData[] = $r->to_whome;
            $nestedData[] = $r->in_time;
            $nestedData[] = $r->out_time;
            $nestedData[] = $r->creation_date;
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

    public function enable_disable_visitor($id, $status) {
        if ($status == 1) {
            $header = 'Disable';
            $title = 'Visitor has been disabled successfully';
        }
        if ($status == 0) {
            $header = 'Enable';
            $title = 'Visitor has been enabled successfully';
        }
        $delete_visitor = $this->Visitor_management_model->enable_disable_visitor($id, $status);
        page_alert_box('success', $header, $title);
        redirect(base_url(INDEX_PHP . 'admin-panel/visitor-list'));
    }

}
