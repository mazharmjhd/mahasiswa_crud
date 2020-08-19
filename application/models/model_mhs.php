<?php

class Model_mhs extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('mhs');
    }

    public function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function hapus_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function detail_data($id = NULL)
    {
        $query = $this->db->get_where('mhs', array('id' => $id))->row();
        return $query;
    }

    //search
    public function get_keyword($keyword)
    {
        $this->db->select('*'); // * memilih semua data di database
        
        //mengambil data yang ada ditable database
        //$this->db->from('mhs');
        $this->db->or_like('nim', $keyword);
        $this->db->like('nama', $keyword);
        $this->db->or_like('alamat', $keyword);
        $this->db->or_like('tgl_lahir', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('no_tlp', $keyword);

        //return $this->db->get()->result();
        $query = $this->db->get('mhs');
        return $query;
    }

    //pagination
    function get_mhs($limit, $start)
    {
        $query = $this->db->get('mhs', $limit, $start);
        return $query;
    }
}
