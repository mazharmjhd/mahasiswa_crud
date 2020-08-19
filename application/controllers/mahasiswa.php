<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //load library pagination
        $this->load->library('pagination');

        //load the department_model
        $this->load->model('model_mhs');
    }

    public function index()
    {
        //konfigurasi pagination
        $config['base_url'] = site_url('mahasiswa/index'); //site url
        $config['total_rows'] = $this->db->count_all('mhs'); //total row
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['data'] = $this->model_mhs->get_mhs($config["per_page"],  $data['page']);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('view_mhs', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_aksi()
    {
        $nim   = $this->input->post('nim');
        $nama   = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $tgl_lahir   = $this->input->post('tgl_lahir');
        $jurusan   = $this->input->post('jurusan');
        $email  = $this->input->post('email');
        $no_tlp = $this->input->post('no_tlp');
        $foto = $_FILES['foto'];
        //pengkondisian
        if ($foto = '') {
        } else {
            //config foto
            $config['upload_path'] = './assets/foto'; //penyimpanan
            $config['allowed_types'] = 'jpg|png|gif|jpeg';

            //load library upload
            $this->load->library('upload', $config);
            //pengkondisian apa bila upload gagal
            if (!$this->upload->do_upload('foto')) {
                echo "Upload Gagal";
                die();
            } else {
                // berhasil
                $foto = $this->upload->data('file_name');
            }
        }

        $data = array(
            'nim'  => $nim,
            'nama'  => $nama,
            'alamat' => $alamat,
            'tgl_lahir'  => $tgl_lahir,
            'jurusan'  => $jurusan,
            'email' => $email,
            'no_tlp' => $no_tlp,
            'foto' => $foto,
        );

        $this->model_mhs->input_data($data, 'mhs');
        // notifikasi dengan flashdata
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Data Berhasil Di Tambahkan!</div>');
        redirect('mahasiswa/index');
    }

    public function hapus($id)
    {
        $where = array('id' => $id);
        $this->model_mhs->hapus_data($where, 'mhs');
        // notifikasi dengan flashdata
        $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Data Berhasil Di Hapus!</div>');
        redirect('mahasiswa/index');
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $data['mahasiswa'] = $this->model_mhs->edit_data($where, 'mhs')->result();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('edit', $data);
        $this->load->view('templates/footer');
    }


    public function update()
    {
        $id = $this->input->post('id');
        $nim   = $this->input->post('nim');
        $nama   = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $tgl_lahir   = $this->input->post('tgl_lahir');
        $jurusan   = $this->input->post('jurusan');
        $email  = $this->input->post('email');
        $no_tlp = $this->input->post('no_tlp');
        $foto = $_FILES['foto'];
        //pengkondisian
        if ($foto = '') {
        } else {
            //config foto
            $config['upload_path'] = './assets/foto'; //penyimpanan
            $config['allowed_types'] = 'jpg|png|gif|jpeg';

            //load library upload
            $this->load->library('upload', $config);
            //pengkondisian apa bila upload gagal
            if (!$this->upload->do_upload('foto')) {
                echo "Upload Gagal";
                die();
            } else {
                // berhasil
                $foto = $this->upload->data('file_name');
            }
        }

        $data = array(
            'nim'  => $nim,
            'nama'  => $nama,
            'alamat' => $alamat,
            'tgl_lahir'  => $tgl_lahir,
            'jurusan'  => $jurusan,
            'email' => $email,
            'no_tlp' => $no_tlp,
            'foto' => $foto,
        );

        $where = array(
            'id' => $id
        );

        $this->model_mhs->update_data($where, $data, 'mhs');
        // notifikasi dengan flashdata
        $this->session->set_flashdata('message','<div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Data Berhasil Di Update!</div>');
        redirect('mahasiswa/index');
    }

    //DETAIL
    public function detail($id)
    {
        $this->load->model('model_mhs');
        $detail = $this->model_mhs->detail_data($id);
        $data['detail'] = $detail;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('detail', $data);
        $this->load->view('templates/footer');
    }

    /** public function print()
    {
        $data['mahasiswa'] = $this->model_mhs->tampil_data("mhs")->result();
        $this->load->view('print_mahasiswa', $data);
    } */

    // PDF
    public function export_pdf()
    {
        $this->load->library('dompdf_gen');

        $data['mahasiswa'] = $this->model_mhs->tampil_data("mhs")->result();
        $this->load->view('export_filepdf', $data);

        /**ukuran kertas A4 */

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("laporan_mahasiswa.pdf", array('Attachment' => 0));
    }

    // EXCEL
    public function excel()
    {
        $data['mahasiswa'] = $this->model_mhs->tampil_data("mhs")->result();

        /** memanggil folder PHPExcel */
        require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $object = new PHPExcel();

        /** keterangan file */
        $object->getProperties()->setCreator("ZAR TECH");
        $object->getProperties()->setLastModifiedBy("ZAR TECH");
        $object->getProperties()->setTitle("Daftar Mahasiswa");

        $object->setActiveSheetIndex(0);

        $object->getActiveSheet()->setCellValue('A1', 'NO');
        $object->getActiveSheet()->setCellValue('B1', 'NIM');
        $object->getActiveSheet()->setCellValue('C1', 'NAMA');
        $object->getActiveSheet()->setCellValue('D1', 'ALAMAT');
        $object->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
        $object->getActiveSheet()->setCellValue('F1', 'JURUSAN');
        $object->getActiveSheet()->setCellValue('G1', 'EMAIL');
        $object->getActiveSheet()->setCellValue('H1', 'NO TELP');

        $baris = 2;
        $no = 1;

        foreach($data['mahasiswa'] as $mhs){
            $object->getActiveSheet()->setCellValue('A'.$baris, $no++);
            $object->getActiveSheet()->setCellValue('B'.$baris, $mhs->nim);
            $object->getActiveSheet()->setCellValue('C'.$baris, $mhs->nama);
            $object->getActiveSheet()->setCellValue('D'.$baris, $mhs->alamat);
            $object->getActiveSheet()->setCellValue('E'.$baris, $mhs->tgl_lahir);
            $object->getActiveSheet()->setCellValue('F'.$baris, $mhs->jurusan);
            $object->getActiveSheet()->setCellValue('G'.$baris, $mhs->email);
            $object->getActiveSheet()->setCellValue('H'.$baris, $mhs->no_tlp);

            $baris++;
        }

        $filename="Data_Mahasiswa".'.xlsx';

        $object->getActiveSheet()->setTitle("Data Mahasiswa");

        header('Content-Type: application/vnd.openxmlformats-offcedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer=PHPExcel_IOFactory::createWriter($object,'Excel2007');
        $writer->save('php://output');

        exit;
    }

    public function search()
    {
        //konfigurasi pagination
        $config['base_url'] = site_url('mahasiswa/index'); //site url
        $config['total_rows'] = $this->db->count_all('mhs'); //total row
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['data'] = $this->model_mhs->get_mhs($config["per_page"],  $data['page']);
        $data['pagination'] = $this->pagination->create_links();

        $keyword = $this->input->post('keyword');
        //$this->model_mhs->get_keyword($keyword);
        $data['data'] = $this->model_mhs->get_keyword($keyword);
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('view_mhs', $data);
        $this->load->view('templates/footer');
    }
}
