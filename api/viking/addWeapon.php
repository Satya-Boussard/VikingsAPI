<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/viking.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/weapon.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/server.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/viking/service.php';

header('Content-Type: application/json');

if (!methodIsAllowed('update')) {
    returnError(405, 'Method not allowed');
    return;
}

$data = getBody();

if (!isset($_GET['id'])) {
    returnError(400, 'Missing parameter : id');
}

$id = intval($_GET['id']);

if (!isset($data['weaponId'])) {
    returnError(412, 'Mandatory parameters : weaponId');
    return;
}

$weaponId = intval($data['weaponId']);

if (!checkWeaponExist($weaponId)) {
    returnError(404, 'Weapon not found or viking not found');
    return;
}

$updated = updateVikingWeapon($id, $weaponId);

if ($updated == 1) {
    http_response_code(204);
} else {
    returnError(500, 'Could not update the viking');
}

