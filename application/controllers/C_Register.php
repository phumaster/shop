<?php

class C_Register extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('admin/M_admin', 'M_website', 'admin/M_opencart', 'admin/M_category'));
    }

    public function index() {
        $data['category'] = $this->M_category->getAll();
        $this->load->view('V_Register', $data);
    }

    public function Register() {
        if ($_POST) {
            $salt = substr(md5(uniqid(rand(), true)), 0, 9); // create unique id
            $email = $this->input->post('email');
            $password = addslashes($this->input->post('password'));
            $password = sha1($salt . sha1($salt . sha1($password)));
            $website = $this->input->post('website');
            $category = $this->input->post('category');
            $user = [
                'email' => $email,
                'password' => $password
            ];
            try {
                // Check hop le cau  email, website
                if ($this->validate($email, $website)) {
                    /*
                     * insert user info
                     */
                    $insert = $this->M_admin->insert($user);
                    if ($insert) {
                        // kiem tra insert co hop le k
                        $web = [
                            'IDcategoryLevel1' => $this->input->post('category'),
                            'IDuser' => $insert,
                            'subdomain' => $website
                        ];
                        // set path
                        $path = './Working/users';
                        $destination = $path . '/' . $insert . '-' . $website;
                        $root_dir = $_SERVER['DOCUMENT_ROOT'] . '/shop/Working/users/' . $insert . '-' . $website . '/';
                        $subdomain = 'http://' . $website . '.phumaster.dev/';
                        /*
                         * insert web info
                         */
                        if ($this->M_website->insert($web)) {
                            // extracting file
                            if ($this->archive($insert, $destination, $category)) {
                                //create database
                                if ($this->CreateDatabase($website)) {
                                    // config opencart
                                    if ($this->ConfigOpencart($destination, $subdomain, $root_dir, $website)) {
                                        if ($this->ConfigAdminOpencart($destination, $subdomain, $root_dir, $website)) {
                                            //create admin for opencart
                                            $this->CreateAdminOpencart($password, $salt, $email);
                                            $this->configHttpd($insert, $website);
                                            // throw exception
                                            $responsive['error'] = 0;
                                            $responsive['redirect'] = $subdomain.'admin';
                                            $responsive['msg'] = 'Tạo trang web thành công. Đang chuyển hướng...';
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        $responsive['error'] = 1;
                        $responsive['msg'] = 'Có lỗi xảy ra trong quá trình đăng ký.';
                    }
                }
            } catch (Exception $error) {
                $responsive['error'] = 1;
                $responsive['msg'] = $error->getMessage();
            }
            echo json_encode($responsive);
        } else {
            die('Errors!');
        }
    }

    private function check_mail($email) {
        $regex = '/^([a-zA-Z0-9])+(.[a-zA-Z0-9]+)\@([a-zA-Z0-9]+)\.([a-zA-Z]{2,4})/';
        $query = $this->M_admin->getByEmail($email);
        if (preg_match($regex, $email) == FALSE) {
            return FALSE;
        } else if ($query->count() > 0) {
            return FALSE;
        } else {
            return true;
        }
    }

    private function archive($id, $destination, $category) {
        // create folder website for user
        $zip = new ZipArchive;
        $file = './SubSystemDefault/Source/opencart-2.0.1-'.$category.'.zip';
        mkdir($destination);
        /*
         * extracting...
         */
        if ($zip->open($file) == TRUE) {
            $zip->extractTo($destination);
            $zip->close();
            return TRUE;
        } else {
            return false;
        }
    }

    private function validate($email, $website) {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('password', 'password', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('website', 'website', 'trim|required|max_length[255]');
        if ($this->form_validation->run() == false) {
            throw new Exception(validation_errors());
            return FALSE;
        } else if (!$this->check_mail($email)) {
            throw new Exception('Email không hợp lệ, vui lòng kiểm tra lại.');
            return FALSE;
        } else if ($this->M_website->count($website) > 0) {
            throw new Exception('Trang web đã được sử dụng.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    private function CreateDatabase($website) {
        $file = file('./SubSystemDefault/Database/opencart.sql');
        if ($file) {
            mysql_query("CREATE DATABASE `$website`");
            mysql_query("USE `$website`");

            //print_r($file);
            $tem = '';
            foreach ($file as $line) {
                if (substr($line, 0, 2) == '--' || $line == '') {
                    continue;
                }
                $tem .=$line;
                if (substr(trim($line), -1, 1) == ';') {
                    mysql_query($tem);
                    // Reset tem variable to empty
                    $tem = '';
                }
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function CreateAdminOpencart($password, $salt, $email) {
        $arr = [
            'user_group_id' => 1,
            'username' => 'admin',
            'password' => $password,
            'salt' => $salt,
            'firstname' => 'Admin',
            'lastname' => 'User',
            'email' => $email,
            'status' => 1,
            'date_added' => date('Y-m-d H:i:s'),
        ];

        if ($this->M_opencart->addAdmin($arr)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function ConfigOpencart($destination, $subdomain, $root_dir, $database) {
        $fileconfig = $destination . '/config.php';
        $str = file_get_contents($fileconfig);
        $str .= "\ndefine('HTTP_SERVER', '" . $subdomain . "');\n";
        $str .= "define('HTTPS_SERVER', '" . $subdomain . "');\n";

        $str .= "define('DIR_APPLICATION', '" . $root_dir . "catalog/');\n";
        $str .= "define('DIR_SYSTEM', '" . $root_dir . "system/');\n";
        $str .= "define('DIR_LANGUAGE', '" . $root_dir . "catalog/language/');\n";
        $str .= "define('DIR_TEMPLATE', '" . $root_dir . "catalog/view/theme/');\n";
        $str .= "define('DIR_CONFIG', '" . $root_dir . "system/config/');\n";
        $str .= "define('DIR_IMAGE', '" . $root_dir . "image/');\n";
        $str .= "define('DIR_CACHE', '" . $root_dir . "system/cache/');\n";
        $str .= "define('DIR_DOWNLOAD', '" . $root_dir . "system/download/');\n";
        $str .= "define('DIR_UPLOAD', '" . $root_dir . "system/upload/');\n";
        $str .= "define('DIR_MODIFICATION', '" . $root_dir . "system/modification/');\n";
        $str .= "define('DIR_LOGS', '" . $root_dir . "system/logs/');\n";

        $str .= "define('DB_DRIVER', 'mysqli');\n";
        $str .= "define('DB_HOSTNAME', 'localhost');\n";
        $str .= "define('DB_USERNAME', 'root');\n";
        $str .= "define('DB_PASSWORD', '');\n";
        $str .= "define('DB_DATABASE', '" . $database . "');\n";
        $str .= "define('DB_PORT', '3306');\n";
        $str .= "define('DB_PREFIX', 'oc_');\n";
        if (file_put_contents($fileconfig, $str)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function ConfigAdminOpencart($destination, $subdomain, $root_dir, $database) {
        $fileconfig = $destination . '/admin/config.php';
        $str = file_get_contents($fileconfig);
        $str .= "\ndefine('HTTP_SERVER', '" . $subdomain . "admin/');\n";
        $str .= "define('HTTP_CATALOG', '" . $subdomain . "');\n";
        $str .= "define('HTTPS_SERVER', '" . $subdomain . "admin/');\n";
        $str .= "define('HTTPS_CATALOG', '" . $subdomain . "');\n";

        $str .= "define('DIR_APPLICATION', '" . $root_dir . "admin/');\n";
        $str .= "define('DIR_SYSTEM', '" . $root_dir . "system/');\n";
        $str .= "define('DIR_LANGUAGE', '" . $root_dir . "admin/language/');\n";
        $str .= "define('DIR_TEMPLATE', '" . $root_dir . "admin/view/template/');\n";
        $str .= "define('DIR_CONFIG', '" . $root_dir . "system/config/');\n";
        $str .= "define('DIR_IMAGE', '" . $root_dir . "image/');\n";
        $str .= "define('DIR_CACHE', '" . $root_dir . "system/cache/');\n";
        $str .= "define('DIR_DOWNLOAD', '" . $root_dir . "system/download/');\n";
        $str .= "define('DIR_UPLOAD', '" . $root_dir . "system/upload/');\n";
        $str .= "define('DIR_LOGS', '" . $root_dir . "system/logs/');\n";
        $str .= "define('DIR_MODIFICATION', '" . $root_dir . "system/modification/');\n";
        $str .= "define('DIR_CATALOG', '" . $root_dir . "catalog/');\n";

        $str .= "define('DB_DRIVER', 'mysqli');\n";
        $str .= "define('DB_HOSTNAME', 'localhost');\n";
        $str .= "define('DB_USERNAME', 'root');\n";
        $str .= "define('DB_PASSWORD', '');\n";
        $str .= "define('DB_DATABASE', '" . $database . "');\n";
        $str .= "define('DB_PORT', '3306');\n";
        $str .= "define('DB_PREFIX', 'oc_');\n";
        if (file_put_contents($fileconfig, $str)) {
            return true;
        } else {
            return false;
        }
    }
    
    private function configHttpd($id, $subdomain) {
        $path = 'C:/xampp/apache/conf/httpd.conf';
        $file = fopen($path, 'a');
        $str = "\n<VirtualHost *:80>\n";
        $str .= "DocumentRoot C:/xampp/htdocs/shop/Working/users/$id-$subdomain\n";
        $str .= "ServerName $subdomain.phumaster.dev\n";
        $str .= "</VirtualHost>\n";
        if(fwrite($file, $str)){
            return TRUE;
        }else{
            return FALSE;
        }
        fclose($file);
    }

}
