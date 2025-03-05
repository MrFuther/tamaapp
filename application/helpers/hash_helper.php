<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function createSecureHash($password) {
    $salt = "cgk"; // Ganti dengan salt yang aman
    return hash('sha256', $password . $salt);
}

function verifyPassword($password, $hashedPassword) {
    $salt = "cgk"; // Gunakan salt yang sama
    $newHash = hash('sha256', $password . $salt);
    return ($newHash === $hashedPassword);
}