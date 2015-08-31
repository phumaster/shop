<?php

class C_List_user extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/M_admin');
        $this->load->model('M_website');
        $config = [
            'upload_path' => './upload',
            'allowed_types' => 'png|gif|jpg',
            'max_size' => 2048
        ];
        $this->upload->initialize($config);
    }

    public function index($row = 0) {
        $where = isset($_GET['by']) ? $_GET['by'] : 'asc';
        $conf['total_rows'] = $this->M_admin->countAll(); // count total record
        $conf['per_page'] = 10; // total record per page
        $conf['base_url'] = site_url('admin/C_list_user/index');
        $conf['uri_segment'] = 4;
        $conf['next_tag_open'] = '<li>';
        $conf['next_tag_close'] = '</li>';
        $conf['next_link'] = 'Next';
        $conf['prev_tag_open'] = '<li>';
        $conf['prev_tag_close'] = '</li>';
        $conf['prev_link'] = 'Previous';
        $conf['cur_tag_open'] = '<li class="active"><a>';
        $conf['cur_tag_close'] = '</a></li>';
        $conf['num_tag_open'] = '<li>';
        $conf['num_tag_close'] = '</li>';
        $conf['first_tag_open'] = '<li>';
        $conf['first_tag_close'] = '</li>';
        $conf['last_tag_open'] = '<li>';
        $conf['last_tag_close'] = '</li>';
        $this->pagination->initialize($conf);
        $data['pagination'] = $this->pagination->create_links();
        $data['info'] = $this->M_admin->getLimit($conf['per_page'], $row, $where);
        $data['js'] = 'admin/list_user';
        $data['title'] = 'Danh sách người dùng';
        $this->load->view('admin/V_list_user', $data);
    }

    public function edit($id = '') {
        $query = $this->M_admin->getUser($id); // query
        $data = $query->get(); // get array
        $data['title'] = 'Chỉnh sửa thông tin';
        /*
         * process until submit
         */
        if ($_POST) {
            $dataArr = [
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'birthday' => $this->input->post('birthday'),
                'type' => $this->input->post('type'),
            ];
            if ($this->input->post('disable') == 'on') {
                $dataArr['disable'] = 0;
            } else {
                $dataArr['disable'] = 1;
            }
            /*
             * process upload image
             */

            $this->session->set_flashdata('success_message', 'Cập nhật thành công!');
            $this->M_admin->update($dataArr, $id);
            redirect('admin/C_list_user');
        }
        // load view
        if ($query->count()) {
            $this->load->view('admin/V_edit_user', $data);
        } else {
            redirect('admin/C_list_user');
        }
    }

    public function delete($id = '') {
        $query = $this->M_admin->getUser($id);
        if ($query->count()) {
            $this->M_admin->delete($id);
            $web = $this->M_website->getByUserId($id);
            if (count($web) > 0) {
                $this->M_website->delByUserId($id);
                $director = './Working/users/' . $id . '-' . $web['subdomain'];
                $this->M_website->delDatabase($web['subdomain']);
                self::del_dir($director);
            }
            if ($this->is_ajax()) {
                echo 'Xóa thành công!';
            } else {
                $this->session->set_flashdata('success_message', 'Xóa thành công!');
                redirect('admin/C_list_user');
            }
        } else {
            if ($this->is_ajax()) {
                echo 'User không tồn tại hoặc đã bị xóa.';
            } else {
                $this->session->set_flashdata('error_message', 'User không tồn tại hoặc đã bị xóa.');
                redirect('admin/C_list_user');
            }
        }
    }

    public function delete_all() {
        if ($_POST) {
            $i = 0;
            foreach ($this->input->post('check') as $key => $vals) {
                $this->M_admin->delete($vals);
                if (count($this->M_website->selectByUserid($vals)) > 0) {
                    $this->M_website->delByUserid($vals);
                }
                $i++;
            }
            $this->session->set_flashdata('success_message', 'Đã xóa thành công ' . $i . ' mục!');
        } else {
            $this->session->set_flashdata('error_message', 'Bạn chưa chọn mục nào để xóa!');
        }
        redirect('admin/C_list_user');
    }

    private static function del_dir($dir) {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? self::del_dir("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

}
