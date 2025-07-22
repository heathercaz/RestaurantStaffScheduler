<?php
// require_once 'StaffMember.php';
// require_once 'Shift.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");


  if($_SERVER["REQUEST_METHOD"] === 'POST') {
    $data = json_decode(file_get_contents('php://input'));
    $name = $data->name;
    $role = $data->role;
    $contact_info = $data->contact_info;

    $response = [
        "status" => "success",
        "message" => "Name: $name\n Role: $role\n Phone Number: $contact_info->phone_num\n Email: $contact_info->email",
    ];

    echo json_encode($response);
    } else {
        echo json_encode(["status" => "error", "message" => "Error Occured."]);
    }

