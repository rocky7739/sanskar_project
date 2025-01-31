<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/helpers/jwt/src/JWT.php';
require_once APPPATH . '/helpers/jwt/src/BeforeValidException.php';
require_once APPPATH . '/helpers/jwt/src/ExpiredException.php';
require_once APPPATH . '/helpers/jwt/src/SignatureInvalidException.php';

use \Firebase\JWT\JWT;

define("JWT_KEY_INI", "ajsgd@6565)(");
define("JWT_MAX_EXPIRE_INI", 2160000); // 25 days 
define("JWT_ALGO_INI", 'HS256'); // 25 days 

define("SESSION_TABLE_REDIS", 'user_session'); // 25 days 

function create_jwt($payload = array()) {
    $issuedAt = time();
    $expirationTime = $issuedAt + JWT_MAX_EXPIRE_INI;
    $payload['iat'] = $issuedAt;
    $payload['exp'] = $expirationTime;
    $jwt = JWT::encode($payload, JWT_KEY_INI, JWT_ALGO_INI);

    $CI = & get_instance();
    $CI->load->library('redis_magic');

    $user_info = array();
    $user_info['token'] = $jwt;
    $user_info['iat'] = $issuedAt;
    $user_info['exp'] = $expirationTime;
    // $user_info['device_type'] = $payload['device_type'];
    $user_info['HTTP_USER_AGENT'] = (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : " --na--";
    $user_info['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];

    $CI->redis_magic->HMSET(SESSION_TABLE_REDIS, $payload['id'], $user_info);
    $CI->redis_magic->EXPIRE_HMSET_KEY(SESSION_TABLE_REDIS, $payload['id'], JWT_MAX_EXPIRE_INI);

    return $jwt;
}

function reset_session($user_id) {
    $CI = & get_instance();
    $CI->load->library('redis_magic');
    $CI->redis_magic->EXPIRE_HMSET_KEY(SESSION_TABLE_REDIS, $user_id, 0);
}

function validate_jwt($jwt_token) {
    $CI = & get_instance();
    $CI->load->library('redis_magic');

    try {
        $decoded = JWT::decode($jwt_token, JWT_KEY_INI, array(JWT_ALGO_INI));
        $decoded_array = (array) $decoded;
        if ($decoded_array) {
            $redis_session = $CI->redis_magic->HGETALL(SESSION_TABLE_REDIS, $decoded_array['id']);
            // if (array_key_exists("device_type", $redis_session) && !defined("DEVICE_TYPE"))
            //     define("DEVICE_TYPE", $redis_session['device_type']);

            // if (!is_array($redis_session) || !isset($redis_session['device_type']) || count($redis_session) < 1 || $jwt_token != $redis_session['token']) {
            //     return array();
            // }
            if (!is_array($redis_session) || count($redis_session) < 1 || $jwt_token != $redis_session['token']) {
                return array();
            }
        }
        return $decoded_array;
    } catch (\Exception $e) {
        return array();
    }
}

function validate_jwt_new($jwt_token) {
    $CI = & get_instance();
    $CI->load->library('redis_magic');

    try {
        $decoded = JWT::decode($jwt_token, JWT_KEY_INI, array(JWT_ALGO_INI));
        $decoded_array = (array) $decoded;
        if ($decoded) {
            $redis_session = $CI->redis_magic->HGETALL(SESSION_TABLE_REDIS, $decoded_array['id']);

            if (isset($redis_session['id'])) {
                $sess_val = $redis_session['id'];
            } else if (isset($_POST['user_id'])) {
                $sess_val = $_POST['user_id'];
            } else {
                $sess_val = 0;
            }

            if (!is_array($redis_session) || count((array) $redis_session) < 1 || $jwt_token != $redis_session['token'] || ($sess_val != $decoded_array['id'])) {
                return array();
            }
        }
        return $decoded_array;
    } catch (\Exception $e) {
        return array();
    }
}

function otp_verification($mobile, $otp, $should_verify = false, $is_admin = false) {
    $CI = & get_instance();
    $CI->load->library('redis_magic');

    $otp_session = 900; //15 minutes
    $otp_table = "OTP_" . ($is_admin ? "ADMIN" : "");
    if ($should_verify) {
        $redis_data = $CI->redis_magic->HGETALL($otp_table, $mobile);
        if (!array_key_exists("otp", $redis_data))
            return 2; //OTP expired
        if ($otp != substr($redis_data['otp'], 0, 4)) {
            $count = substr($redis_data['otp'], 4, 1);
            $remain_time = $otp_session - (time() - ($redis_data['time']));
            if ($count && $count <= 3) {
                $otp_info = array(
                    "otp" => substr($redis_data['otp'], 0, 4) . ($count + 1),
                    "time" => $redis_data['time']
                );
                $CI->redis_magic->HMSET($otp_table, $mobile, $otp_info);
                $CI->redis_magic->EXPIRE_HMSET_KEY($otp_table, $mobile, $remain_time);
                return 3; //invalid OTP
            } else if (!$remain_time || $count) {
                $CI->redis_magic->EXPIRE_HMSET_KEY($otp_table, $mobile, 0);
                return 2; //OTP expired
            }
        }
        $CI->redis_magic->EXPIRE_HMSET_KEY($otp_table, $mobile, 0);
        return 1; //OTP verified
    } else {
        $otp_info = array(
            "otp" => $otp . "1",
            "time" => time()
        );
        $CI->redis_magic->HMSET($otp_table, $mobile, $otp_info);
        $CI->redis_magic->EXPIRE_HMSET_KEY($otp_table, $mobile, $otp_session);
        return 4; //OTP session created
    }
}


