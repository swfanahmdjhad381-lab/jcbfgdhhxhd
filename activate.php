<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($username)) {
    echo json_encode([
        "success" => false,
        "message" => "قيمة نصية غير صالحة",
        "device_pin" => ""
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($username) || empty($password)) {
    echo json_encode([
        "success" => false,
        "message" => "قيمة نصية غير صالحة"
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// ⚙️ إعداداتك (تاجر، محظور، إلخ)
$is_dealer      = false;     
$is_banned      = false;     
$device_pin     = "12345";   
$dealer_name    = "Test";    
$dealer_balance = 999999.0;  

if ($is_banned) {
    echo json_encode([
        "success" => false,
        "is_banned" => true,
        "ban_reason" => "تم حظر حسابك",
        "message" => "تم حظر حسابك"
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$response = [
    "success"           => true,
    "is_banned"         => false,
    "is_dealer"         => $is_dealer,
    "device_pin"        => $device_pin,
    "dealer_name"       => $dealer_name,
    "dealer_country"    => "SA",
    "dealer_balance"    => $dealer_balance,
    "game_name"         => "",
    "time_left_seconds" => 0,
    "message"           => "تم تسجيل الدخول بنجاح"
];

echo json_encode($response, JSON_UNESCAPED_UNICODE);