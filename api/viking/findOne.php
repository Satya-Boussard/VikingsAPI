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

$viking = findOneViking($_GET['id']);

if (!$viking) {
    returnError(404, 'Viking not found');
}

$result_viking = createWeaponUrl($viking);

echo json_encode($result_viking, JSON_UNESCAPED_SLASHES);
