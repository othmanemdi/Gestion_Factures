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

function e($value): string
{
    return trim(htmlentities($value));
}

function add_zero($value, $num = 2)
{
    return str_pad($value, $num, '0', STR_PAD_LEFT);
}


// number_format($produit->prix, 2, ',', ' ')
function _number_format(float $num = 0): string
{
    return number_format($num, 2, ',', ' ');
}

function set_price($value): int
{
    return $value * 100;
}

function get_price($value, $qt = 1): float
{
    return $value / 100 * $qt;
}

if (!function_exists('_date_format_year')) {
    function _date_format_year($date)
    {
        return date("y", strtotime($date));
    }
}

if (!function_exists('_date_format')) {
    function _date_format($date)
    {
        return date("d/m/Y", strtotime($date));
    }
}
