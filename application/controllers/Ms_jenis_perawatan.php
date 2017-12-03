<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ms_jenis_perawatan
 *
 * @author Selamet Subu - Dell 5459
 */
class Ms_jenis_perawatan extends MY_Controller {

    var $tmp_path = 'templates/layout_horizontal_sidebar_menu/index';
    var $main_path = 'pages/jenis_perawatan/';

    public function __construct() {
        parent::__construct();
        $this->load->model('Ms_jenis_perawatan_m');
        $this->load->library('form_validation');

        $this->is_logged_in();
        if (empty($this->auth_role))
            redirect('login');
    }

    public function index() {
        $this->load->model('Ms_jenis_perawatan_group_m');
        $x = $this->input->get('x');
        $y = $this->input->get('y');
        $dx = $this->Sys_sitemap->get_data_by_id($x);
        $dy = $this->Sys_sitemap->get_data_by_id($y);

        // set breadcrumb, tidak usah pake Home karena itu sudah default
        $breadcrumb = array(
            $dx[0]->displayname => base_url() . 'page/get_left_menu?x=' . $x,
            $dy[0]->displayname => base_url() . $dy[0]->url . '?x=' . $x . '&y=' . $y
        );
        
        $data['group'] = $this->Ms_jenis_perawatan_group_m->get_data();
        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'main.php';
        $data['title'] = "Jenis Perawatan"; // Capitalize the first letter
        $data['htitle'] = "Jenis Perawatan";
        $this->load->view($this->tmp_path, $data);
    }

    public function simpan_json() {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();

        // check user  login
        if (!$this->verify_role('admin')) {
            redirect("login");
        }

        // set validation rules
        $config = array(
            array(
                'field' => 'id_group',
                'label' => 'Group',
                'rules' => 'required|is_natural_no_zero|min_length[1]|max_length[255]'
            ),
            array(
                'field' => 'perawatan',
                'label' => 'Jenis Perawatan',
                'rules' => 'required|min_length[2]|max_length[255]'
            )
        );
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        // end validation rules

        if ($this->form_validation->run() !== false) {
            // Post data
            $id = $this->input->post('id_jenis_perawatan');
            $id_group = $this->input->post('id_group');
            $perawatan = $this->input->post('perawatan');
            $userinput = $this->auth_user_id;

            // set POST data in Array
            $data = array(
                'id_group' => $id_group,
                'perawatan' => $perawatan
            );

            if (!empty($id)) {
                $result = $this->Ms_jenis_perawatan_m->update_by_id($data, $id);
            } else {
                $result = $this->Ms_jenis_perawatan_m->insert($data);
            }

            if ($result) {
                $r = array('status' => '1', 'message' => 'Data tersimpan');
            } else {
                $r = array('status' => '0', 'message' => 'Data gagal tersimpan');
            }
        } else {
            $r = array('status' => '0');
            foreach ($_POST as $key => $value) {
                $r['message'][$key] = form_error($key);
            }
        }

        echo json_encode($r);
    }

    public function hapus_json() {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();

        if (!$this->verify_role('admin')) {
            redirect("login");
        }
        $id = $this->input->get('id');
        $result = $this->Ms_jenis_perawatan_m->delete_by_id($id);
        if ($result) {
            $r = array('status' => '1', 'message' => 'Data terhapus');
        } else {
            $r = array('status' => '0', 'message' => 'Data gagal terhapus');
        }

        echo json_encode($r);
    }

    public function admin_ajax_list() {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();

        if (!$this->verify_role('admin')) {
            redirect("login");
        }

        $this->load->model('Ms_jenis_perawatan_m');
        $where = null;
        $column_order = array(
            'id_jenis_perawatan', 'perawatan', 'group', 'id_jenis_perawatan'
        );
        $column_search = $column_order;
        $order = array('id_jenis_perawatan' => 'desc'); // default order 

        $list = $this->Ms_jenis_perawatan_m->get_datatables($column_order, $order, $column_search, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
            for ($i = 0; $i < count($column_search); $i++) {
                $row[] = $r[$column_search[$i]];
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Ms_jenis_perawatan_m->count_all($where),
            "recordsFiltered" => $this->Ms_jenis_perawatan_m->count_filtered($column_order, $order, $column_search, $where),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function get_data_by_id_json() {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();


        $id = $this->input->get("id");
        $data = $this->Ms_jenis_perawatan_m->get_data_by_id($id);
        echo json_encode($data);
    }

}
