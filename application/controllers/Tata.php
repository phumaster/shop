<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tata extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $dbconnect = $this->load->database();
        // To use site_url and redirect on this controller.
        $this->load->helper('url');

        $this->load->model('M_facebook');
        $this->load->model('M_fanpage');
        //$this->load->controller('HelperFace');
    }

    public function resignter() {
        $this->load->library('facebook'); // Automatically picks appId and secret from config
        // OR
        // You can pass different one like this
        //$this->load->library('facebook', array(
        //    'appId' => 'APP_ID',
        //    'secret' => 'SECRET',
        //    ));
        $user = $this->facebook->getUser();

        //Kiem tra gia tri nguoi dung facebook
        if ($user) {
            try {
                //Lay thoi gian hien tai khi nguoi dung dang ky
                $this->load->helper('date');
                $data['current_time'] = date('Y-m-d');

                $data['profileFace'] = $this->facebook->api('/me');
                $data['fanpageFace'] = $this->facebook->api('/me/accounts');
                $count_fanpage = count($data['fanpageFace']);

                //Insert user on database
                $data['userFace'] = array(
                    'faceID' => $data['profileFace']['id'],
                    'name' => $data['profileFace']['name'],
                    'email' => $data['profileFace']['email'],
                    'firstName' => $data['profileFace']['first_name'],
                    'lastName' => $data['profileFace']['last_name'],
                    'gender' => $data['profileFace']['gender'],
                    'link' => $data['profileFace']['link'],
                    'created_at' => $data['current_time'],
                );
                $this->M_facebook->Ins($data['userFace']);
                //End insert userFace
                //Insert fanpage user on database
                if (isset($count_fanpage)) {
                    foreach ($data['fanpageFace']['data'] as $key => $value) {
                        $data['fanpage'] = array(
                            'IDFanpage' => $data['fanpageFace']['data'][$key]['id'],
                            'accessToken' => $data['fanpageFace']['data'][$key]['access_token'],
                            'category' => $data['fanpageFace']['data'][$key]['category'],
                            'name' => $data['fanpageFace']['data'][$key]['name'],
                            'permit' => $data['fanpageFace']['data'][$key]['perms']['0'],
                            'status' => 0,
                            'type' => 1,
                            'disable' => 0,
                        );
                        $this->M_fanpage->Ins($data['fanpage']);
                    }
                }
                //End insert fanpageFace
                //$nameUser = $this->removeCircumflex($data['profileFace']['name']);
                //Duong dan den thu muc chua project cua user
                $pathUserId = '/home/dohakien/www/fshop.dev/users/' . $data['profileFace']['id'];
                $pathOpencartFolder = '/home/dohakien/www/fshop.dev/opencart';


                if (!file_exists($pathUserId)) {
                    @mkdir($pathUserId, 0777, true);
                    $this->recurse_copy($pathOpencartFolder, $pathUserId);
                }

                if (file_exists($pathUserId)) {

                    //pathHostSub, đường dẫn tạo url subdomain khi tạo website cho user
                    $pathHostSub = 'http://' . $data['profileFace']['id'] . '.fshop.dev/';
                    //Url tới thư mục website user 
                    $pathHost = '/home/dohakien/www/fshop.dev/users/' . $data['profileFace']['id'] . '/';

                    //Change config file
                    $this->configOPC($pathUserId, $pathHostSub, $pathHost, $data['profileFace']['id']);
                    $this->configAdminOPC($pathUserId, $pathHostSub, $pathHost, $data['profileFace']['id']);
                }

                //Auto create database
                // Name of the file
                $filename = file_get_contents(base_url() . 'opencart.sql');
                // MySQL host
                $mysql_host = 'localhost';
                // MySQL username
                $mysql_username = 'root';
                // MySQL password
                $mysql_password = 'root';
                // Database name
                $mysql_database = $data['profileFace']['id'];

                $this->db->query("CREATE DATABASE `" . $mysql_database . "`");
                //mysqli_connect($mysql_host, $mysql_username, $mysql_password,$mysql_database);
                if ($mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database)) {

                    mysqli_multi_query($mysqli, $filename);
                    $mysqli->close();
                }
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } else {
            $this->facebook->destroySession();
        }

        if ($user) {
            $data['logout_url'] = site_url('tata/logout'); // Logs off application
            // OR 
            // Logs off FB!
            // $data['logout_url'] = $this->facebook->getLogoutUrl();
        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('tata/resignter'),
                'scope' => array("public_profile, publish_actions, email, manage_pages") // permissions here
            ));
        }
        $this->template->load('template', 'facebook/index', $data);
    }

    public function logout() {
        $this->load->library('facebook');
        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.
        redirect('tata/resignter');
    }

    public function configOPC($pathUserId, $pathHostSub, $pathHost, $data) {
        $config1 = $pathUserId . '/config.php';
        $current1 = file_get_contents($config1);
        $current1 .= "\ndefine('HTTP_SERVER', '" . $pathHostSub . "');\n";
        $current1 .= "define('HTTPS_SERVER', '" . $pathHostSub . "');\n";

        $current1 .= "define('DIR_APPLICATION', '" . $pathHost . "catalog/');\n";
        $current1 .= "define('DIR_SYSTEM', '" . $pathHost . "system/');\n";
        $current1 .= "define('DIR_LANGUAGE', '" . $pathHost . "catalog/language/');\n";
        $current1 .= "define('DIR_TEMPLATE', '" . $pathHost . "catalog/view/theme/');\n";
        $current1 .= "define('DIR_CONFIG', '" . $pathHost . "system/config/');\n";
        $current1 .= "define('DIR_IMAGE', '" . $pathHost . "image/');\n";
        $current1 .= "define('DIR_CACHE', '" . $pathHost . "system/cache/');\n";
        $current1 .= "define('DIR_DOWNLOAD', '" . $pathHost . "system/download/');\n";
        $current1 .= "define('DIR_UPLOAD', '" . $pathHost . "system/upload/');\n";
        $current1 .= "define('DIR_MODIFICATION', '" . $pathHost . "system/modification/');\n";
        $current1 .= "define('DIR_LOGS', '" . $pathHost . "system/logs/');\n";

        $current1 .= "define('DB_DRIVER', 'mysqli');\n";
        $current1 .= "define('DB_HOSTNAME', 'localhost');\n";
        $current1 .= "define('DB_USERNAME', 'root');\n";
        $current1 .= "define('DB_PASSWORD', 'root');\n";
        $current1 .= "define('DB_DATABASE', '" . $data . "');\n";
        $current1 .= "define('DB_PORT', '3306');\n";
        $current1 .= "define('DB_PREFIX', 'oc_');\n";
        file_put_contents($config1, $current1);
    }

    public function configAdminOPC($pathUserId, $pathHostSub, $pathHost, $data) {
        $config2 = $pathUserId . '/admin/config.php';
        $current2 = file_get_contents($config2);
        $current2 .= "\ndefine('HTTP_SERVER', '" . $pathHostSub . "admin/');\n";
        $current2 .= "define('HTTP_CATALOG', '" . $pathHostSub . "');\n";
        $current2 .= "define('HTTPS_SERVER', '" . $pathHostSub . "admin/');\n";
        $current2 .= "define('HTTPS_CATALOG', '" . $pathHostSub . "');\n";

        $current2 .= "define('DIR_APPLICATION', '" . $pathHost . "admin/');\n";
        $current2 .= "define('DIR_SYSTEM', '" . $pathHost . "system/');\n";
        $current2 .= "define('DIR_LANGUAGE', '" . $pathHost . "admin/language/');\n";
        $current2 .= "define('DIR_TEMPLATE', '" . $pathHost . "admin/view/template/');\n";
        $current2 .= "define('DIR_CONFIG', '" . $pathHost . "system/config/');\n";
        $current2 .= "define('DIR_IMAGE', '" . $pathHost . "image/');\n";
        $current2 .= "define('DIR_CACHE', '" . $pathHost . "system/cache/');\n";
        $current2 .= "define('DIR_DOWNLOAD', '" . $pathHost . "system/download/');\n";
        $current2 .= "define('DIR_UPLOAD', '" . $pathHost . "system/upload/');\n";
        $current2 .= "define('DIR_LOGS', '" . $pathHost . "system/logs/');\n";
        $current2 .= "define('DIR_MODIFICATION', '" . $pathHost . "system/modification/');\n";
        $current2 .= "define('DIR_CATALOG', '" . $pathHost . "catalog/');\n";

        $current2 .= "define('DB_DRIVER', 'mysqli');\n";
        $current2 .= "define('DB_HOSTNAME', 'localhost');\n";
        $current2 .= "define('DB_USERNAME', 'root');\n";
        $current2 .= "define('DB_PASSWORD', 'root');\n";
        $current2 .= "define('DB_DATABASE', '" . $data . "');\n";
        $current2 .= "define('DB_PORT', '3306');\n";
        $current2 .= "define('DB_PREFIX', 'oc_');\n";
        file_put_contents($config2, $current2);
    }

    //Phương thức chuyển đổi một chuỗi thành chữ thường không dấu
    public function removeCircumflex($value) {
        $value = strtolower($value);

        $characterA = '#(a|à|ả|ã|á|ạ|ă|ằ|ẳ|ẵ|ắ|ặ|â|ầ|ẩ|ẫ|ấ|ậ)#imsU';
        $replaceA = 'a';
        $value = preg_replace($characterA, $replaceA, $value);

        $characterD = '#(đ|Đ)#imsU';
        $replaceD = 'd';
        $value = preg_replace($characterD, $replaceD, $value);

        $characterE = '#(è|ẻ|ẽ|é|ẹ|ê|ề|ể|ễ|ế|ệ)#imsU';
        $replaceE = 'e';
        $value = preg_replace($characterE, $replaceE, $value);

        $characterI = '#(ì|ỉ|ĩ|í|ị)#imsU';
        $replaceI = 'i';
        $value = preg_replace($characterI, $replaceI, $value);

        $charaterO = '#(ò|ỏ|õ|ó|ọ|ô|ồ|ổ|ỗ|ố|ộ|ơ|ờ|ở|ỡ|ớ|ợ)#imsU';
        $replaceCharaterO = 'o';
        $value = preg_replace($charaterO, $replaceCharaterO, $value);

        $charaterU = '#(ù|ủ|ũ|ú|ụ|ư|ừ|ử|ữ|ứ|ự)#imsU';
        $replaceCharaterU = 'u';
        $value = preg_replace($charaterU, $replaceCharaterU, $value);

        $charaterY = '#(ỳ|ỷ|ỹ|ý)#imsU';
        $replaceCharaterY = 'y';
        $value = preg_replace($charaterY, $replaceCharaterY, $value);

        $charaterSpecial = '#(,|$)#imsU';
        $replaceSpecial = '';
        $value = preg_replace($charaterSpecial, $replaceSpecial, $value);

        $value = trim($value);
        $value = str_replace(' ', '', $value);
        $value = preg_replace('#(-)+#', '', $value);

        return $value;
    }

    public function recurse_copy($src, $dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ( $file = readdir($dir))) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

}
