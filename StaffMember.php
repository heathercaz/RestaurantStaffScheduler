<?php

class StaffMember
{
    public string $name;
    public string $role;
    public string $contact_info;

    public function __construct(string $name, string $role, string $contact_info)
    {
        $this->name = $name;
        $this->role = $role;
        $this->contact_info = $contact_info;
    }
}
?>