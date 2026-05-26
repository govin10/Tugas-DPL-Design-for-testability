<?php

function createGear($pdo, $user_id, $name, $type, $is_gore_tex, $notes)
{
    // cek user
    $checkUser = $pdo->prepare("SELECT id FROM users WHERE id = ?");
    $checkUser->execute([$user_id]);

    if (!$checkUser->fetch()) {
        return false;
    }

    // insert gear
    $stmt = $pdo->prepare(
        "INSERT INTO gears (user_id, name, type, is_gore_tex, notes)
         VALUES (?, ?, ?, ?, ?)"
    );

    return $stmt->execute([
        $user_id,
        $name,
        $type,
        $is_gore_tex,
        $notes
    ]);
}