<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of T_keluhan
 *
 * @author Selamet Subu - Dell 5459
 */
class T_keluhan extends MY_Controller {

    var $tmp_path = 'templates/index_horizontal_menu/index';
    var $main_path = 'pages/keluhan/';

    public function __construct() {
        parent::__construct();
        $this->load->model('T_keluhan_m');
        $this->load->model('Ms_kendaraan_m');
        $this->load->library('form_validation');

        $this->is_logged_in();
        if (empty($this->auth_role))
            redirect('login');
    }

    public function index() {
        $x = $this->input->get('x');
        $y = $this->input->get('y');
        $dx = $this->Sys_sitemap->get_data_by_id($x);

        // set breadcrumb, tidak usah pake Home karena itu sudah default
        $breadcrumb = array(
            $dx[0]->displayname => base_url() . 'page/get_left_menu?x=' . $x
        );

        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'kendaraan_main.php';
        $data['title'] = $dx[0]->displayname; // Capitalize the first letter
        $data['htitle'] = $dx[0]->displayname;
        $this->load->view($this->tmp_path, $data);
    }
    
    public function daftar($id_kendaraan) {
        $x = $this->input->get('x');
        $y = $this->input->get('y');
        $dx = $this->Sys_sitemap->get_data_by_id($x);

        // set breadcrumb, tidak usah pake Home karena itu sudah default
        $breadcrumb = array(
            $dx[0]->displayname => base_url() . 'page/get_left_menu?x=' . $x
        );

        $data['dkendaraan'] = $this->Ms_kendaraan_m->get_data_by_id($id_kendaraan);
        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'main.php';
        $data['title'] = $dx[0]->displayname; // Capitalize the first letter
        $data['htitle'] = $dx[0]->displayname;
        $this->load->view($this->tmp_path, $data);
    }
    
    public function form($id_kendaraan=null, $id_keluhan=null) {
        $x = $this->input->get('x');
        $y = $this->input->get('y');
        $dx = $this->Sys_sitemap->get_data_by_id($x);

        // set breadcrumb, tidak usah pake Home karena itu sudah default
        $breadcrumb = array(
            $dx[0]->displayname => base_url() . 'page/get_left_menu?x=' . $x,
            'Form' => ''
        );
        
        if(!empty($id_keluhan)){
            $data["dkeluhan"] = $this->T_keluhan_m->get_data_by_id($id_keluhan);
        }
        
        $data['dkendaraan'] = $this->Ms_kendaraan_m->get_data_by_id($id_kendaraan);
        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'form_main.php';
        $data['title'] = 'Form Keluhan'; // Capitalize the first letter
        $data['htitle'] = 'Form Keluhan';
        $this->load->view($this->tmp_path, $data);
    }

    public function simpan_json() {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();


        // set validation rules
        $config = array(
            array(
                'field' => 'no_keluhan',
                'label' => 'No Keluhan',
                'rules' => 'required'
            ),
            array(
                'field' => 'pengguna',
                'label' => 'Pengguna',
                'rules' => 'required|min_length[2]|max_length[255]'
            ),
            array(
                'field' => 'pemohon',
                'label' => 'Pemohon',
                'rules' => 'required|min_length[2]|max_length[255]'
            ),
            array(
                'field' => 'keluhan',
                'label' => 'Keluhan',
                'rules' => 'required|min_length[2]|max_length[4000]'
            ),
            array(
                'field' => 'id_kendaraan',
                'label' => 'Kendaraan',
                'rules' => 'required|is_natural_no_zero|min_length[1]|max_length[10]'
            )
        );
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        // end validation rules

        if ($this->form_validation->run() !== false) {
            // Post data
            $id = $this->input->post('id_keluhan');
            $id_kendaraan = $this->input->post('id_kendaraan');
            $user_id = $this->input->post('user_id');
            $id_berkas = $this->input->post('id_berkas');
            $no_keluhan = $this->input->post('no_keluhan');
            $pengguna = $this->input->post('pengguna');
            $pemohon = $this->input->post('pemohon');
            $keluhan = $this->input->post('keluhan');

            
            $userinput = $this->auth_user_id;

            // set POST data in Array
            $data = array(
                'id_kendaraan' => $id_kendaraan,
                'user_id' => $this->auth_user_id,
                'no_keluhan' => $no_keluhan,
                'pengguna' => $pengguna,
                'pemohon' => $pemohon,
                'keluhan' => $keluhan
            );

            if (!empty($id)) {
                $data['userupdate'] = $userinput;
                $data['dateupdate'] = date('Y-m-d');
                $result = $this->T_keluhan_m->update_by_id($data, $id);
            } else {
                $data['userinput'] = $userinput;
                $result = $this->T_keluhan_m->insert($data);
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


        
        $id = $this->input->get('id');
        $result = $this->T_keluhan_m->delete_by_id($id);
        if ($result) {
            $r = array('status' => '1', 'message' => 'Data terhapus');
        } else {
            $r = array('status' => '0', 'message' => 'Data gagal terhapus');
        }

        echo json_encode($r);
    }

    public function ajax_list($id_kendaraan=null) {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();

        $this->load->model('T_keluhan_m');
        
        $xstatus_keluhan = $this->input->post('xstatus_keluhan');
        
        $where = null;
        
        $where['id_kendaraan'] = $id_kendaraan;
        
        if( $this->auth_role != 'admin' ){
            $where['user_id'] = $this->auth_user_id;
        }
        
        if( !empty($xstatus_keluhan) )
            $where['status_keluhan'] = $xstatus_keluhan;
        
        
        $column_order = array(
            'id_keluhan', 'dateinput_char', 'no_keluhan', 'pengguna', 'pemohon', 'status_keluhan', 'id_keluhan'
        );
        $column_search = $column_order;
        $order = array('dateinput' => 'desc'); // default order 

        $list = $this->T_keluhan_m->get_datatables($column_order, $order, $column_search, $where);
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
            "recordsTotal" => $this->T_keluhan_m->count_all($where),
            "recordsFiltered" => $this->T_keluhan_m->count_filtered($column_order, $order, $column_search, $where),
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
        $data = $this->T_keluhan_m->get_data_by_id($id);
        echo json_encode($data);
    }

}
