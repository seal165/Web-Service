<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'controller/PengingatController.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'] ?? '', '/'));

$controller = new PengingatController();

switch ($request[0] ?? '') {
    case 'notifikasi':
        echo json_encode($controller->getNotifikasi());
        break;

    case 'tambah_pengingat':
        if ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if (!is_array($data)) {
                echo json_encode(["error" => "Data tidak valid"]);
                exit;
            }
            echo json_encode($controller->tambahPengingat($data));
        } else {
            echo json_encode(["error" => "Metode tidak diizinkan"]);
        }
        break;

    case 'pengingat':
        echo json_encode($controller->getPengingat());
        break;

    case 'hapus_pengingat':
        if ($method === 'DELETE' && isset($request[1])) {
            echo json_encode($controller->deletePengingat($request[1]));
        } else {
            echo json_encode(["error" => "ID pengingat tidak diberikan"]);
        }
        break;

    default:
        echo json_encode(["message" => "Endpoint tidak ditemukan"]);
        break;
}
?>