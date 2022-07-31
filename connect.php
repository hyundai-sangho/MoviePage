<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host     = $_ENV['HOST'];
$database = $_ENV['DATABASE'];
$user     = $_ENV['USER'];
$password = $_ENV['PASSWORD'];

try {
  $PDO = new PDO("mysql:host=$host; dbname=$database; charset=utf8", $user, $password);
  $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $Exception) {
  die('연결 실패: ' . $Exception->getMessage());
}