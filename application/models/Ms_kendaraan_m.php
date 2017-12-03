<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ms_kendaraan_m
 *
 * @author Selamet Subu - Dell 5459
 */
class Ms_kendaraan_m extends My_model {

    //put your code here
    var $table = "ms_kendaraan";
    var $view = "ms_kendaraan_view";
    var $primary_key = "id_kendaraan";

    function get_data($where = NULL, $order_by = NULL) {
        if (!empty($where))
            $this->db->where($where);
        if (!empty($order_by))
            $this->db->order_by($order_by);
        $query = $this->db->get($this->view);
        return $query->result();
    }

    function get_data_count() {
        if (!empty($where))
            $this->db->where(array($this->primary_key => $id));
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    function get_data_by_id($id = NULL) {
        $this->db->where(array($this->primary_key => $id));
        $query = $this->db->get($this->view);
        return $query->result();
    }

    public function insert($data = NULL, $gambar=null) {
        $this->db->trans_begin();
        
        if(!empty($gambar)){
            // insert foto sebelum
            $this->db->insert('sys_attach', array('userinput' => $data['userinput']));
            $id_foto_kendaraan = $this->db->insert_id();
            $data['id_foto_kendaraan'] = $id_foto_kendaraan;

            $dfs = array(
                'attachid' => $id_foto_kendaraan,
                'title' => 'Foto Kendaraan',
                'description' => 'Foto Kendaraan',
                'filename' => $gambar
            );
            $this->db->insert('sys_attach_dtl', $dfs);
        }
        
        $this->db->insert($this->table, $data);
        
        if ($this->db->trans_status() === FALSE)
        {
            return $this->db->trans_rollback();
        }
        else
        {
            return $this->db->trans_commit();
        }
    }

    public function update_by_id($data = NULL, $id = NULL, $gambar=null) {
        $this->db->trans_begin();
        
        if(!empty($gambar)){
            $this->db->delete('sys_attach_dtl', array('attachid' => $data['id_foto_kendaraan']));
            // insert foto sebelum
            if( empty($data['id_foto_kendaraan']) ){
                $this->db->insert('sys_attach', array('userinput' => $data['userupdate']));
                $id_foto_kendaraan = $this->db->insert_id();
                $data['id_foto_kendaraan'] = $id_foto_kendaraan;
            }

            $dfs = array(
                'attachid' => $data['id_foto_kendaraan'],
                'title' => 'Foto Kendaraan',
                'description' => 'Foto Kendaraan',
                'filename' => $gambar
            );
            $this->db->insert('sys_attach_dtl', $dfs);
        }
        
        $this->db->update($this->table, $data, array($this->primary_key => $id));
        
        if ($this->db->trans_status() === FALSE)
        {
            return $this->db->trans_rollback();
        }
        else
        {
            return $this->db->trans_commit();
        }
    }

    public function delete_by_id($id) {
        return $this->db->delete($this->table, array($this->primary_key => $id));
    }

    // For Data Tables
    private function _get_datatables_query($column_order, $order, $column_search) {
        // you can use table or view
        $this->db->from($this->view);

        $i = 0;

        foreach ($column_search as $item) { // loop column 
            if (isset($_POST[$item]) && !empty($_POST[$item])) { // if datatable send GET for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST[$item]);
                } else {
                    $this->db->like($item, $_POST[$item]);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($column_order, $order, $column_search, $where = null) {
        $this->_get_datatables_query($column_order, $order, $column_search);
        if (!empty($where))
            $this->db->where($where);

        if ($_POST['length'] != -1)           
            $this->db->limit($_POST['length'], $_POST['start']);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    function count_filtered($column_order, $order, $column_search, $where = null) {
        if (!empty($where))
            $this->db->where($where);
        $this->_get_datatables_query($column_order, $order, $column_search);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($where = null) {
        if (!empty($where))
            $this->db->where($where);
        $this->db->from($this->view);
        return $this->db->count_all_results();
    }

    // end fata tables
    
    // summary
    public function get_summary_status_stnk(){
        $sql = 'select      "expired" as status_stnk, count(*) as total
                from        ms_kendaraan x
                where       x.masa_berlaku_stnk < date(now())
                union all
                select      "valid" as status_stnk, count(*) as total
                from        ms_kendaraan x
                where       x.masa_berlaku_stnk >= date(now())';
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    
    public function get_summary_jenis_kendaraan(){
        $sql = 'select      y.id_jenis, y.jenis,
                            count(x.id_kendaraan) as total
                from        ms_jenis y
                left join   ms_kendaraan x on x.id_jenis = y.id_jenis
                group by    x.id_jenis,  y.jenis';
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    
}
