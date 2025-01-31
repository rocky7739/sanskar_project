<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Version extends MX_Controller {

    function __construct() {
        parent::__construct();
        /* !!!!!! Warning !!!!!!!11
         *  admin panel initialization
         *  do not over-right or remove auth_panel/auth_panel_ini/auth_ini
         */
        modules::run('auth_panel/auth_panel_ini/auth_ini');
        $this->load->library('form_validation');
    }

    public function versioning() {
        if ($_POST) {
            $array = array(
                "android" => $this->input->post('android'),
                "is_hard_update_android" => $this->input->post("is_hard_update_android"),
                "ios" => $this->input->post('ios'),
                "is_hard_update_ios" => $this->input->post("is_hard_update_ios")
            );
            $this->db->where('id', 1);
            $this->db->update('version_control', $array);
            if ($this->db->affected_rows() > 0) {
                page_alert_box("success", "Operation Successful", "Settings changed successfully");
            } else {
                page_alert_box("warning", "Operation Successful", "There was no changes");
            }
        }
        $view_data['page']  = "version_control";
        $data['page_data'] = $this->load->view('version/version_view', $view_data, TRUE);
        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
    }

    

}
