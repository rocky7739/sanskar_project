<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  if( !function_exists('page_alert_box') ) {

    function page_alert_box( $type = '',$title = '',$message = '') {
			$_SESSION['page_alert_box_type'] = $type;
			$_SESSION['page_alert_box_title'] = $title;
			$_SESSION['page_alert_box_message'] = $message;
    }
	}
	
	if (!function_exists('milliseconds')){
		function milliseconds() {
				$mt = explode(' ', microtime());
				return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
		}
	}
        if (!function_exists('backend_log_genration')) {

    function backend_log_genration($user_id = "", $comment = "", $segment = "") {

        $CI = & get_instance();
        $array = array(
            'user_id' => $user_id,
            'comment' => $comment,
            'segment' => $segment,
            'creation_time' => milliseconds(),
            'json' => json_encode($_POST)
        );
        $CI->db->insert('backend_user_activity_log', $array);
    }

}

