<?php
require_once './controller/PengingatController.php';

$controller = new PengingatController();

$url = $_GET['url'] ?? ''; // amanin nilai url

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $url === 'jumlah_pengingat') {
    $controller->tampilkanJumlah();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $url === 'tambah_pengingat') {
    $controller->tambah();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $url === 'daftar_pengingat') {
    $controller->daftar();
} else {
    echo json_encode(["message" => "Endpoint tidak ditemukan"]);
}