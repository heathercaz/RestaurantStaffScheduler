<?php
require_once 'StaffMember.php';
require_once 'Shift.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

// Path to staff.json and shift.json files
$staffFile = 'staff.json';
$shiftFile = 'shifts.json';

// Load existing staff members from staff.json
if (file_exists($staffFile)) {
    $staffMembers = json_decode(file_get_contents($staffFile), true) ?? [];
} else {
    $staffMembers = [];
}

// Load existing shifts from shift.json
if (file_exists($shiftFile)) {
    $shiftList = json_decode(file_get_contents($shiftFile), true) ?? [];
} else {
    $shiftList = [];
}

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $data = json_decode(file_get_contents('php://input'));

    // If shift data is present, add a shift
    if (isset($data->startTime)) {
        $newShift = [
            "day" => $data->day,
            "start_time" => $data->startTime,
            "end_time" => $data->endTime,
            "assigned_role" => $data->assignedRole,
            "staff" => $data->selectedStaff
        ];

        $shiftList[] = $newShift;
        file_put_contents($shiftFile, json_encode($shiftList, JSON_PRETTY_PRINT));
        echo json_encode([
            "status" => "success",
            "message" => "Shift added.",
            "shiftList" => $shiftList
        ]);
        exit;
    }

    else if ($data->name) {

        // Otherwise, add a staff member
        $name = $data->name ?? '';
        $role = $data->role ?? '';
        $contact_info = $data->contact_info ?? null;

        $newStaffMember = [
            "name" => $name,
            "role" => $role,
            "phone_num" => $contact_info->phone_num,
            "email" => $contact_info->email
        ];

        $staffMembers[] = $newStaffMember;
        file_put_contents($staffFile, json_encode($staffMembers, JSON_PRETTY_PRINT));

        $response = [
            "status" => "success",
            "message" => "Staff member added: $name\n Role: $role\n Phone Number: {$contact_info->phone_num}\n Email: {$contact_info->email}\n Staff Count: " . count($staffMembers),
            "staffMembers" => $staffMembers
        ];

        echo json_encode($response);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid staff data."]);
    }
} else if ($_SERVER["REQUEST_METHOD"] === 'GET') {
    // Return both staff and shift data if requested
    echo json_encode([
        "staffMembers" => $staffMembers,
        "shiftList" => $shiftList
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Error Occured."]);
}

