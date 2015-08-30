<?php

class C_list_web extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_website');
    }

    public function index($row = 0) {
        $data['title'] = 'Danh sách website';
        $pagination['total_rows'] = $this->M_website->countAll();
        $pagination['per_page'] = 20;
        $pagination['base_url'] = site_url('admin/C_list_web/index');
        $pagination['uri_segment'] = 4;
        $pagination['next_tag_open'] = '<li>';
        $pagination['next_tag_close'] = '</li>';
        $pagination['next_link'] = 'Next';
        $pagination['prev_tag_open'] = '<li>';
        $pagination['prev_tag_close'] = '</li>';
        $pagination['prev_link'] = 'Previous';
        $pagination['cur_tag_open'] = '<li class="active"><a>';
        $pagination['cur_tag_close'] = '</a></li>';
        $pagination['num_tag_open'] = '<li>';
        $pagination['num_tag_close'] = '</li>';
        $pagination['first_tag_open'] = '<li>';
        $pagination['first_tag_close'] = '</li>';
        $pagination['last_tag_open'] = '<li>';
        $pagination['last_tag_close'] = '</li>';
        $this->pagination->initialize($pagination);
        $data['pagination'] = $this->pagination->create_links();
        $data['data'] = $this->M_website->getLimit($pagination['per_page'], $row);
        $data['js'] = 'admin/delete_web';
        $this->load->view('admin/V_list_web', $data);
    }

    public function delete($id = '') {
        $id = (int) $id;
        if ($this->is_ajax()) {
            if (count($this->M_website->getId($id)) == 0) {
                $data['success'] = false;
                $data['msg'] = 'Website không tồn tại hoặc đã bị xóa';
            } else {
                if ($this->M_website->delete($id)) {
                    $data['success'] = true;
                    $data['msg'] = 'Xóa thành công';
                } else {
                    $data['success'] = false;
                    $data['msg'] = 'Xóa không thành công. Lỗi truy vấn SQL';
                }
            }
            echo json_encode($data);
        } else {
            redirect('admin/C_list_web');
        }
    }

    public function edit($id = '') {
        $id = (int) $id;
        $data['title'] = 'Chỉnh sửa website';
        $query = $this->M_website->getId($id);
        if (count($query) != 0) {
            $data['data'] = $query;
            if ($_POST) {
                $this->form_validation->set_rules('subdomain', 'Tên miền', 'trim|required|max_length[255]|xss_clean');
                $this->form_validation->set_message('required', '%s không được để trống.');
                $this->form_validation->set_message('max_length', '%s quá dài [max 255].');
                $subdomain = $this->input->post('subdomain');
                if ($this->form_validation->run()) {
                    if ($this->M_website->update($id, ['subdomain' => $subdomain])) {
                        $this->session->set_flashdata('success_msg', 'Đã lưu thay đổi.');
                        redirect('admin/C_list_web');
                    } else {
                        $data['error_msg'] = 'Lỗi truy vấn SQL';
                    }
                }
            }
            $this->load->view('admin/V_edit_web', $data);
        } else {
            redirect('admin/C_list_web');
        }
    }

}
