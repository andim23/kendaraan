<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ms_kendaraan
 *
 * @author Selamet Subu - Dell 5459
 */
class Ms_kendaraan extends MY_Controller {

    var $tmp_path = 'templates/layout_horizontal_sidebar_menu/index';
    var $main_path = 'pages/ms_kendaraan/';

    public function __construct() {
        parent::__construct();
        $this->load->model('Ms_kendaraan_m');
        $this->load->model('Ms_merk_m');
        $this->load->model('Ms_jenis_m');
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
        
        $djenis = $this->Ms_jenis_m->get_data(null, 'jenis');
        $dmerk = $this->Ms_merk_m->get_data(null, 'merk');
        
        $data['djenis'] = $djenis;
        $data['dmerk'] = $dmerk;
        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'main.php';
        $data['title'] = "Master Kendaraan"; // Capitalize the first letter
        $data['htitle'] = "Master Kendaraan";
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
        
        $id = $this->input->post('id_kendaraan');
        
        // set validation rules
        $config = array(
            array(
                'field' => 'id_jenis',
                'label' => 'Jenis',
                'rules' => 'required|is_natural_no_zero|min_length[1]|max_length[10]'
            ),
            array(
                'field' => 'id_merk',
                'label' => 'Merk',
                'rules' => 'required|is_natural_no_zero|min_length[1]|max_length[10]'
            ),
            array(
                'field' => 'nama_kendaraan',
                'label' => 'Nama',
                'rules' => 'required|min_length[3]|max_length[50]'
            ),
            array(
                'field' => 'platno',
                'label' => 'Plat No',
                'rules' => 'required|min_length[3]|max_length[50]|edit_unique[ms_kendaraan.platno.id_kendaraan.'.$id.']'
            ),
        );
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        // end validation rules

        if ($this->form_validation->run() !== false) {
            // Post data
            $id = $this->input->post('id_kendaraan');
            $id_jenis = $this->input->post('id_jenis');
            $id_merk = $this->input->post('id_merk');
            $nama_kendaraan = $this->input->post('nama_kendaraan');
            $platno = $this->input->post('platno');
            $warna = $this->input->post('warna');
            $bahan_bakar = $this->input->post('bahan_bakar');
            $no_mesin = $this->input->post('no_mesin');
            $no_rangka = $this->input->post('no_rangka');
            $no_stnk = $this->input->post('no_stnk');
            $masa_berlaku_stnk = $this->input->post('masa_berlaku_stnk');
            $catatan = $this->input->post('catatan');
            $id_foto_kendaraan = $this->input->post('id_foto_kendaraan');
            $gambar = $this->input->post('gambar');
            $userinput = $this->auth_user_id;

            // set POST data in Array
            $data = array(
                'id_jenis' => $id_jenis,
                'id_merk' => $id_merk,
                'nama_kendaraan' => $nama_kendaraan,
                'platno' => $platno,
                'warna' => $warna,
                'bahan_bakar' => $bahan_bakar,
                'no_mesin' => $no_mesin,
                'no_rangka' => $no_rangka,
                'no_stnk' => $no_stnk,
                'masa_berlaku_stnk' => date_sql($masa_berlaku_stnk),
                'catatan' => $catatan,
                'id_foto_kendaraan' => $id_foto_kendaraan
            );

            if (!empty($id)) {
                $data['userupdate'] = $userinput;
                $data['dateupdate'] = date('Y-m-d');
                $result = $this->Ms_kendaraan_m->update_by_id($data, $id, $gambar);
            } else {
                $data['userinput'] = $userinput;
                $result = $this->Ms_kendaraan_m->insert($data, $gambar);
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
        $result = $this->Ms_kendaraan_m->delete_by_id($id);
        if ($result) {
            $r = array('status' => '1', 'message' => 'Data terhapus');
        } else {
            $r = array('status' => '0', 'message' => 'Data gagal terhapus');
        }

        echo json_encode($r);
    }
    
    public function hapusf_json() {
        $this->load->model('Sys_attach_dtl_m');
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
        $gambar = $this->input->get('gambar');
        
        $result = $this->Sys_attach_dtl_m->delete_by_id($id);
        
        $file_path = UPLOAD_PATH . 'kendaraan/' . $gambar;
        
        if(is_file($file_path))
            unlink ($file_path);
            
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



        $this->load->model('Ms_kendaraan_m');

        $column_order = array(
            'id_kendaraan', 'jenis', 'nama_kendaraan', 'platno', 'merk', 'no_stnk', 'masa_berlaku_stnk_char', 'status_stnk', 'status_perawatan', 'id_kendaraan'
        );
        $column_search = $column_order;
        $order = array('dateinput' => 'desc'); // default order 

        $list = $this->Ms_kendaraan_m->get_datatables($column_order, $order, $column_search);
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
            "recordsTotal" => $this->Ms_kendaraan_m->count_all(),
            "recordsFiltered" => $this->Ms_kendaraan_m->count_filtered($column_order, $order, $column_search),
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
        $data = $this->Ms_kendaraan_m->get_data_by_id($id);
        echo json_encode($data);
    }

}
