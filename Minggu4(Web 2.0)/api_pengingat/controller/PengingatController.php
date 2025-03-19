<?php
require_once __DIR__ . '/../model/PengingatModel.php';

class PengingatController {
    private $model;

    public function __construct() {
        $this->model = new PengingatModel();
    }

    public function getNotifikasi() {
        return ["notifikasi" => $this->model->getNotifikasi()];
    }

    public function tambahPengingat($data) {
        if (!isset($data['waktu']) || !isset($data['jumlah_air'])) {
            return ["error" => "Data tidak lengkap"];
        }

        if (!is_string($data['waktu']) || !is_numeric($data['jumlah_air'])) {
            return ["error" => "Format data tidak valid"];
        }

        $result = $this->model->addPengingat($data['waktu'], (int) $data['jumlah_air']);
        return $result ? ["message" => "Pengingat berhasil ditambahkan"] : ["error" => "Gagal menambahkan pengingat"];
    }

    public function getPengingat() {
        return ["data" => $this->model->getPengingat()];
    }

    public function deletePengingat($id) {
        if (!is_numeric($id)) {
            return ["error" => "ID tidak valid"];
        }

        $result = $this->model->deletePengingat((int) $id);
        return $result ? ["message" => "Pengingat berhasil dihapus"] : ["error" => "Gagal menghapus pengingat"];
    }
}
?>