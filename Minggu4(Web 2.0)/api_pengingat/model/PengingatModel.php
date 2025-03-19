<?php
class PengingatModel {
    private $pdo;

    public function __construct() {
        $dsn = "mysql:host=localhost;dbname=pengingat_db;charset=utf8mb4";
        $username = "root"; // Sesuaikan dengan username database
        $password = ""; // Sesuaikan dengan password database
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $this->pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            die(json_encode(["error" => "Koneksi database gagal: " . $e->getMessage()]));
        }
    }

    public function getNotifikasi() {
        $stmt = $this->pdo->query("SELECT * FROM pengingat WHERE waktu = CURTIME()");
        return $stmt->fetchAll();
    }

    public function getPengingat() {
        $stmt = $this->pdo->query("SELECT * FROM pengingat ORDER BY waktu ASC");
        return $stmt->fetchAll();
    }

    public function addPengingat($waktu, $jumlah_air) {
        $stmt = $this->pdo->prepare("INSERT INTO pengingat (waktu, jumlah_air) VALUES (?, ?)");
        return $stmt->execute([$waktu, $jumlah_air]);
    }

    public function deletePengingat($id) {
        $stmt = $this->pdo->prepare("DELETE FROM pengingat WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>