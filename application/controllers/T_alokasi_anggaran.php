<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of T_alokasi_anggaran
 *
 * @author Selamet Subu - Dell 5459
 */
class T_alokasi_anggaran extends MY_Controller {

    var $tmp_path = 'templates/layout_horizontal_sidebar_menu/index';
    var $main_path = 'pages/alokasi/';

    public function __construct() {
        parent::__construct();
        $this->load->model('T_alokasi_anggaran_m');
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
        $dy = $this->Sys_sitemap->get_data_by_id($y);

        // set breadcrumb, tidak usah pake Home karena itu sudah default
        $breadcrumb = array(
            $dx[0]->displayname => base_url() . 'page/get_left_menu?x=' . $x,
            $dy[0]->displayname => base_url() . $dy[0]->url . '?x=' . $x . '&y=' . $y
        );
        
        $data['dkendaraan'] = $this->Ms_kendaraan_m->get_data(array(), 'platno');
        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'main.php';
        $data['title'] = $dy[0]->displayname; // Capitalize the first letter
        $data['htitle'] = $dy[0]->displayname;
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
                'field' => 'id_kendaraan',
                'label' => 'Kendaraan',
                'rules' => 'required|is_natural_no_zero|min_length[1]|max_length[10]'
            ),
            array(
                'field' => 'tahun_anggaran',
                'label' => 'Tahun Anggaran',
                'rules' => 'required|is_natural_no_zero|min_length[1]|max_length[10]'
            ),
            array(
                'field' => 'jumlah',
                'label' => 'Alokasi',
                'rules' => 'required|min_length[1]|max_length[20]'
            )
        );
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        // end validation rules

        if ($this->form_validation->run() !== false) {
            // Post data
            $id = $this->input->post('id_alokasi');
            $id_kendaraan = $this->input->post('id_kendaraan');
            $tahun_anggaran = $this->input->post('tahun_anggaran');
            $jumlah = $this->input->post('jumlah');
            $userinput = $this->auth_user_id;

            // set POST data in Array
            $data = array(
                'id_kendaraan' => $id_kendaraan,
                'tahun_anggaran' => $tahun_anggaran,
                'jumlah' => preg_replace("/[^0-9]/", "", $jumlah),
            );

            if (!empty($id)) {
                $result = $this->T_alokasi_anggaran_m->update_by_id($data, $id);
            } else {
                $result = $this->T_alokasi_anggaran_m->insert($data);
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
        $result = $this->T_alokasi_anggaran_m->delete_by_id($id);
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

        $this->load->model('T_alokasi_anggaran_m');

        $column_order = array(
            'id_alokasi', 'merk', 'nama_kendaraan', 'platno', 'tahun_anggaran', 'jumlah', 'id_alokasi'
        );
        $column_search = $column_order;
        $order = array('id_alokasi' => 'desc'); // default order 

        $list = $this->T_alokasi_anggaran_m->get_datatables($column_order, $order, $column_search);
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
            "recordsTotal" => $this->T_alokasi_anggaran_m->count_all(),
            "recordsFiltered" => $this->T_alokasi_anggaran_m->count_filtered($column_order, $order, $column_search),
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
        $data = $this->T_alokasi_anggaran_m->get_data_by_id($id);
        echo json_encode($data);
    }
    
    

}
