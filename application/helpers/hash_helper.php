<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function createSecureHash($password) {
    $salt = "your_secure_salt_here"; // Ganti dengan salt yang aman
    return hash('sha256', $password . $salt);
}

function verifyPassword($password, $hashedPassword) {
    $salt = "your_secure_salt_here"; // Gunakan salt yang sama
    $newHash = hash('sha256', $password . $salt);
    return ($newHash === $hashedPassword);
}