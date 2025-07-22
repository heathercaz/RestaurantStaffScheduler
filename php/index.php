<?php
require_once 'StaffMember.php';
require_once 'Shift.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

// Path to staff.json file
$staffFile = 'staff.json';

// Load existing staff members from staff.json
if (file_exists($staffFile)) {
    $staffMembers = json_decode(file_get_contents($staffFile), true) ?? [];
} else {
    $staffMembers = [];
}

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $data = json_decode(file_get_contents('php://input'));
    $name = $data->name;
    $role = $data->role;
    $contact_info = $data->contact_info;

    // Create new staff member array
    $newStaffMember = [
        "Name" => $name,
        "Role" => $role,
        "Phone" => $contact_info->phone_num,
        "Email" => $contact_info->email
    ];

    // Add to staff members array
    $staffMembers[] = $newStaffMember;

    // Save updated staff members to staff.json
    file_put_contents($staffFile, json_encode($staffMembers, JSON_PRETTY_PRINT));

    $response = [
        "status" => "success",
        "message" => "Staff member added: $name\n Role: $role\n Phone Number: $contact_info->phone_num\n Email: $contact_info->email\n Staff Count: " . count($staffMembers),
        "staffMembers" => $staffMembers
    ];

    echo json_encode($response);
} else {
    echo json_encode(["status" => "error", "message" => "Error Occured."]);
}

