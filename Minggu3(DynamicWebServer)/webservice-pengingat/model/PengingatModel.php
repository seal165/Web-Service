<?php
require_once './config/Database.php';

class PengingatModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function hitungPengingat() {
        $stmt = $this->db->query("SELECT COUNT(*) as jumlah FROM pengingat");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function tambahPengingat($waktu, $pesan) {
        $stmt = $this->db->prepare("INSERT INTO pengingat (waktu, pesan) VALUES (?, ?)");
        return $stmt->execute([$waktu, $pesan]);
    }

    public function getDaftar() {
        $stmt = $this->db->query("SELECT * FROM pengingat");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}