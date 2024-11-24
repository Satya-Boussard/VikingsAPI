<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/weapon.php';

function findOneViking(string $id) {
    $db = getDatabaseConnection();
    $sql = "SELECT id, name, health, attack, defense, weaponId FROM viking WHERE id = :id";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['id' => $id]);
    if ($res) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return null;
}

function findAllVikings (string $name = "", int $limit = 10, int $offset = 0) {
    $db = getDatabaseConnection();
    $params = [];
    $sql = "SELECT id, name, health, attack, defense, weaponId FROM viking";
    if ($name) {
        $sql .= " WHERE name LIKE %:name%";
        $params['name'] = $name;
    }
    $sql .= " LIMIT $limit OFFSET $offset ";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute($params);
    if ($res) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return null;
}

function createViking(string $name, int $health, int $attack, int $defense) {
    $db = getDatabaseConnection();
    $sql = "INSERT INTO viking (name, health, attack, defense) VALUES (:name, :health, :attack, :defense)";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['name' => $name, 'health' => $health, 'attack' => $attack, 'defense' => $defense]);
    if ($res) {
        return $db->lastInsertId();
    }
    return null;
}

function updateVikingWeapon(string $id, $weaponId){
    $db = getDatabaseConnection();
    if ($weaponId !== null && checkWeaponExist($weaponId)) {
        $sqlWeapon = "UPDATE viking SET weaponId = :weaponId WHERE id = :id";
        $stmtWeapon = $db->prepare($sqlWeapon);
        $stmtWeapon->execute(['id' => $id, 'weaponId' => $weaponId]);
    } else {
        $sqlWeapon = "UPDATE viking SET weaponId = NULL WHERE id = :id";
        $stmtWeapon = $db->prepare($sqlWeapon);
        $stmtWeapon->execute(['id' => $id]);
    }
    return $stmtWeapon->rowCount();
}

function updateViking(string $id, string $name, int $health, int $attack, int $defense, ?int $weaponId = null) {
    $db = getDatabaseConnection();
    $sql = "UPDATE viking SET name = :name, health = :health, attack = :attack, defense = :defense WHERE id = :id";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['id' => $id, 'name' => $name, 'health' => $health, 'attack' => $attack, 'defense' => $defense]);
    if ($res) {
        return updateVikingWeapon($id, $weaponId);
    }
    return null;
}

function deleteViking(string $id) {
    $db = getDatabaseConnection();
    $sql = "DELETE FROM viking WHERE id = :id";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['id' => $id]);
    if ($res) {
        return $stmt->rowCount();
    }
    return null;
}

function findVikingsByWeaponId(string $weaponId) {
    $db = getDatabaseConnection();
    $sql = "SELECT id, name FROM viking WHERE weaponId = :weaponId";
    $stmt = $db->prepare($sql);
    $stmt->execute(['weaponId' => $weaponId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}