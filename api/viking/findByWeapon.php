<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/viking.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/server.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/viking/service.php';

header('Content-Type: application/json');

if (!methodIsAllowed('read')) {
    returnError(405, 'Method not allowed');
    return;
}

if (!isset($_GET['id'])) {
    returnError(400, 'Missing parameter : id');
}

$vikings = findVikingsByWeaponId($_GET['id']);

if (!$vikings) {
    returnError(404, 'Weapon not found or not wear');
}

$result_vikings = createVikingsUrl($vikings);

echo json_encode($result_vikings, JSON_UNESCAPED_SLASHES);