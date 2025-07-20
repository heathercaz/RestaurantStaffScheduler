<?php
require_once 'StaffMember.php';
require_once 'Shift.php';

class RestaurantSchedulerTestbench
{
    public function run()
    {
        // Create a Shift
        $shift1 = new Shift("Monday", "09:00", "17:00", "Waiter");
        $shift2 = new Shift("Tuesday", "08:00", "12:00", "Waiter");

        // Create a StaffMember
        $staff1 = new StaffMember("Alice Smith", "Waiter", array("Name" => "Alice Smith","Phone" => "123-456-7890", "Email" => "alicesmith@gmail.com"), shifts: array($shift1->day => $shift1));

        // Output StaffMember details
        echo "StaffMember Details:\n";
        echo "Name: " . $staff1->name . "\n";
        echo "Role: " . $staff1->role . "\n";
        echo "Contact Info: " .implode(',', $staff1->contact_info). "\n\n";

        // Output Shift details
        echo "Shift 1 Details:\n";
        echo "Day: " . $shift1->day . "\n";
        echo "Start Time: " . $shift1->start_time . "\n";
        echo "End Time: " . $shift1->end_time . "\n";
        echo "Assigned Role: " . $shift1->assigned_role . "\n";
        echo "\n";

        // Output Shift details
        echo "Shift 2 Details:\n";
        echo "Day: " . $shift2->day . "\n";
        echo "Start Time: " . $shift2->start_time . "\n";
        echo "End Time: " . $shift2->end_time . "\n";
        echo "Assigned Role: " . $shift2->assigned_role . "\n";
        echo "\n";

        // Assign a new shift to the staff member
        $staff1->assignShift($shift2);

        echo "\nStaffMember after assigning new shift:\n";
        echo $staff1->getDetails() . "\n";

        // Remove a shift from the staff member
        $staff1->removeShift($shift1);

        echo "StaffMember after removing a shift:\n";
        echo $staff1->getDetails() . "\n";  



    }
}

// Run the testbench
$testbench = new RestaurantSchedulerTestbench();
$testbench->run();


