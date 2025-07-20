<?php

require_once 'Shift.php';

class StaffMember
{
    public string $name;
    public string $role;
    public array $contact_info;
    public array $shifts;

    public function __construct(string $name, string $role, array $contact_info, array $shifts)
    {
        $this->name = $name;
        $this->role = $role;
        $this->contact_info = $contact_info;
        $this->shifts = $shifts;
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

    public function getContactInfo(): array
    {
        return $this->contact_info;
    }  
    
    public function setContactInfo(array $contact_info): void
    {
        $this->contact_info = $contact_info;
    }

    public function getDetails(): string
    {
        $contact_info_str = implode(', ', $this->contact_info);
        // $shifts_str = implode(', ', $this->shifts);
        $shifts_str = '';
        $i = 1;
        foreach ($this->shifts as $shift) {
            $shifts_str .= "Shift $i $shift\n";
            $i++;
        }
        return "Name: {$this->name}, Role: {$this->role}, Contact: {$contact_info_str},\nShifts:\n{$shifts_str}";

    }

    public function setStaffMemberDetails(string $name, string $role, array $contact_info, array $shifts): void
    {
        $this->name = $name;
        $this->role = $role;
        $this->contact_info = $contact_info;
        $this->shifts = $shifts;
    }

    public function assignShift(Shift $shift): string
    {
        $this->shifts[] = $shift;
        return "{$this->name} has been assigned to a shift on {$shift->day} from {$shift->start_time} to {$shift->end_time} as a {$shift->assigned_role}.";
    }

    public function __toString(): string
    {
        return $this->getDetails();
    }   

}