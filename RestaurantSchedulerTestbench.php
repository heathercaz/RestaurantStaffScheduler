<?php
require_once 'StaffMember.php';
require_once 'Shift.php';

class RestaurantSchedulerTestbench
{
    public function run()
    {
        // Create a Shift
        $shift = new Shift("Monday", "09:00", "17:00", "Waiter");

        // Create a StaffMember
        $staff = new StaffMember("Alice Smith", "Waiter", array("Name" => "Alice Smith","Phone" => "123-456-7890", "Email" => "alicesmith@gmail.com"), shift: $shift);

        // Output StaffMember details
        echo "StaffMember Details:\n";
        echo "Name: " . $staff->name . "\n";
        echo "Role: " . $staff->role . "\n";
        echo "Contact Info: " . $staff->contact_info . "\n\n";

        // Output Shift details
        echo "Shift Details:\n";
        echo "Day: " . $shift->day . "\n";
        echo "Start Time: " . $shift->start_time . "\n";
        echo "End Time: " . $shift->end_time . "\n";
        echo "Assigned Role: " . $shift->assigned_role . "\n";
    }
}

// Run the testbench
$testbench = new RestaurantSchedulerTestbench();
$testbench->run();


