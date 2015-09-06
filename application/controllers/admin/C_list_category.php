<?php
/*
 * @creater Pham Ngoc Phu
 * @email phumaster.dev@gmail.com
 * @controller Admin - List category
 * @project faceweb.vn
 * @company picker
 * @add 10 Hoang Ngoc Phach - Lang Ha - Dong Da - Ha Noi
 */
if (!defined('BASEPATH'))
    exit('Hacking attempt!');

class C_list_category extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/M_category');
    }

    public function index() {
        $data['data'] = $this->M_category->getAll();
        $data['title'] = 'Danh mục';
        $data['js'] = 'admin/delete_category';
        $this->load->view('admin/V_list_category', $data);
    }

    public function add() {
        $data['title'] = 'Thêm thư mục mới';
        if ($_POST) {
            $name = $this->input->post('name');
            $value = mb_strtolower($this->convert_str($name), 'UTF-8');
            try {
                if ($this->validate()) {
                    if ($this->M_category->insert(['name' => $name, 'value' => $value])) {
                        $this->session->set_flashdata('success_msg', 'Thêm danh mục thành công');
                        redirect('admin/C_list_category');
                    } else {
                        throw new Exception("Insert error!");
                    }
                }
            } catch (Exception $error) {
                $data['error_msg'] = $error->getMessage();
            }
        }
        $this->load->view('admin/V_add_category', $data);
    }

    public function edit($id = '') {
        $id = (int) $id;
        $data['title'] = 'Sửa danh mục';
        $query = $this->M_category->getId($id);
        if (count($query) == 0) {
            redirect('admin/C_list_category');
        } else {
            $data['data'] = $query;
        }
        if ($_POST) {
            $name = $this->input->post('name');
            $value = mb_strtolower($this->convert_str($name), 'UTF-8');
            try {
                if ($this->validate()) {
                    if ($this->M_category->update($id, ['name' => $name, 'value' => $value])) {
                        $this->session->set_flashdata('success_msg', 'Đã lưu thay đổi.');
                        redirect('admin/C_list_category');
                    } else {
                        throw new Exception("Insert error!");
                    }
                }
            } catch (Exception $ex) {
                $data['error_msg'] = $ex->getMessage();
            }
        }
        $this->load->view('admin/V_edit_category', $data);
    }

    public function delete($id = '') {
        $id = (int) $id;
        if ($this->is_ajax()) {
            if (count($this->M_category->getId($id)) == 0) {
                $data['success'] = false;
                $data['msg'] = 'Danh mục không tồn tại hoặc đã bị xóa.';
            } else {
                if ($this->M_category->delete($id)) {
                    $data['success'] = true;
                    $data['msg'] = 'Xóa thành công';
                } else {
                    $data['success'] = false;
                    $data['msg'] = 'Không thể xóa do lỗi truy vấn';
                }
            }
            echo json_encode($data);
        } else {
            redirect('admin/C_list_category');
        }
    }

    private function validate() {
        $this->form_validation->set_rules('name', 'Tiêu đề', 'trim|required|max_length[255]|xss_clean');
        $this->form_validation->set_message('required', '%s không được để trống.');
        if ($this->form_validation->run()) {
            return TRUE;
        } else {
            throw new Exception(validation_errors());
            return FALSE;
        }
    }

    private function convert_str($string = '') {
        $string = trim($string);
        $str = [
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư'
        ];
        foreach ($str as $key => $vals) {
            $string = preg_replace("/($vals)/i", $key, $string);
        }
        $string = str_replace(' ', '-', $string);
        return $string;
    }

}
