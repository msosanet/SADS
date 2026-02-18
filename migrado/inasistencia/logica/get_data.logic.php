<?php
try {
    $conn = new PDO('mysql:host=192.168.0.249;dbname=sid','root','');
} catch (PDOException $exception) {
    die($exception->getMessage());
}
$sql = "SELECT * FROM sigeTMP2";
$st = $conn
    ->query($sql);
if ($st) {
    $rs = $st->fetchAll(PDO::FETCH_FUNC, fn($id, $plaza, $usuario) => [$id, $plaza, $uuario] );
    echo json_encode([
        'data' => $rs,
    ]);
} else {
    var_dump($conn->errorInfo());
    die;
}

