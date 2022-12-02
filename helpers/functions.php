<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

define("IP_SERVER", $_SERVER['SERVER_ADDR']);

function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    exit();
}

function array_to_json($array): string
{
    return json_encode($array);
}

function json_to_array($json): array
{
    return json_decode($json, true);
}

function create_cookie_json(string $key, array $array, int $lifetime): void
{
    $value = array_to_json($array);
    setcookie($key, $value, $lifetime);
}

function create_cookie(string $key, string $value, int $lifetime): void
{
    setcookie($key, $value, $lifetime);
}

function destroy_cookie($key): void
{
    setcookie($key, "", -1);
}


function e($value)
{
    return trim(htmlentities($value));
}

function add_zero($value)
{
    return str_pad($value, 2, '0', STR_PAD_LEFT);
}
