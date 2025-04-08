<?php
require_once './model/PengingatModel.php';

class PengingatController {
    private $model;

    public function __construct() {
        $this->model = new PengingatModel();
    }

    public function tampilkanJumlah() {
        $data = $this->model->hitungPengingat();
        echo json_encode(["data" => $data['jumlah']]);
    }

    public function tambah() {
        $input = json_decode(file_get_contents("php://input"), true);
        if ($this->model->tambahPengingat($input['waktu'], $input['pesan'])) {
            echo json_encode(["data" => "Pengingat berhasil ditambahkan"]);
        } else {
            echo json_encode(["data" => "Gagal menambahkan pengingat"]);
        }
    }

    public function daftar() {
        $data = $this->model->getDaftar();
        echo json_encode(["data" => $data]);
    }
}