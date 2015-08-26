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
        $this->load->view('admin/V_list_web', $data);
    }

    public function delete($id = '') {
        
    }

}