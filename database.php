<?php
try {
    $db = new PDO('sqlite:../university.db'); // 如果数据库在 coursework 文件夹中
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
?>

