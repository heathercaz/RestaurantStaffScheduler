<?php
require_once 'StaffMember.php';
require_once 'Shift.php';


$shift1 = new Shift("Monday", "08:00", "16:00", "Cook");
$staffMember1 = new StaffMember("John Doe", "Cook", array("Name" => "John Doe","Phone" => "123-456-7890", "Email" => "johndoe@gmail.com"), shift: $shift1);



echo "$staffMember1";




