<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Device_management extends MX_Controller {

    function __construct() {
        parent::__construct();
        /* !!!!!! Warning !!!!!!!11
         *  admin panel initialization
         *  do not over-right or remove auth_panel/auth_panel_ini/auth_ini
         */
        modules::run('auth_panel/auth_panel_ini/auth_ini');
        $this->load->library('form_validation');
        $this->load->model("Device_management_model");
        $this->load->helper("services");
    }

    public function device_list() {
        $data['page_title'] = "Device List";
        $view_data['page'] = "device_list";
        $data['page_data'] = $this->load->view('device_management/device_list', $view_data, TRUE);
        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
    }

    public function ajax_all_device_list() {
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
				  FROM device_record";

        $query = $this->db->query($query);
        $query = $query->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;
        $totalFiltered = $totalData;

        $sql = "SELECT * from device_record";

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

        $query = $this->db->query($sql)->result();

        $totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

        $result = $this->db->query($sql)->result();

        $data = array();

        foreach ($result as $r) {  // preparing an array
            $status = ($r->status == 0) ? 'lock' : 'unlock';
            $alert_status = ($r->status == 0) ? 'Enable' : 'Disable';
            $button_status=($r->status == 0) ? 'danger' : 'success';
            $nestedData = array();
            $nestedData[] = ++$requestData['start'];
            $nestedData[] = $r->name;
            $nestedData[] = $r->mobile;
            $nestedData[] = $r->device_model;
            $nestedData[] = $r->device_id;
            $nestedData[] = date("d-m-Y h:i:s A", $r->creation_time / 1000);
            $nestedData[] = ($r->status == 0 ) ? 'Disabled' : 'Enabled';
            $nestedData[] = "<a class='btn-xs bold btn btn-$button_status' onclick=\"return confirm('Are you sure you want to $alert_status?')\" href='" . AUTH_PANEL_URL . "device_management/Device_management/enable_disable_device/" . $r->id . '/' . $r->status . "'><i class='fa fa-$status'></i></a>&nbsp;";
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

    public function enable_disable_device($id, $status) {
        if ($status == 1) {
            $header = 'Disable';
            $title = 'Device has been disabled successfully';
        }
        if ($status == 0) {
            $header = 'Enable';
            $title = 'Device has been enabled successfully';
        }
        $delete_videos = $this->Device_management_model->enable_disable_device($id, $status);
        page_alert_box('success', $header, $title);
        redirect(base_url(INDEX_PHP.'admin-panel/device-list'));
    }

}
