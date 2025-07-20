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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getContactInfo(): string
    {
        return $this->contact_info;
    }  
    
    public function setContactInfo(string $contact_info): void
    {
        $this->contact_info = $contact_info;
    }

    public function getDetails(): string
    {
        return "Name: {$this->name}, Role: {$this->role}, Contact: {$this->contact_info}";
    }

    public function setStaffMemberDetails(string $name, string $role, string $contact_info): void
    {
        $this->name = $name;
        $this->role = $role;
        $this->contact_info = $contact_info;
    }


    public function assignShift(Shift $shift): string
    {
        return "{$this->name} has been assigned to a shift on {$shift->day} from {$shift->start_time} to {$shift->end_time} as a {$shift->assigned_role}.";
    }

    public function __toString(): string
    {
        return $this->getDetails();
    }   



}