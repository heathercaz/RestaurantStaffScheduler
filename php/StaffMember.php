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
        
        $shifts_str = '';
        foreach ($this->shifts as $shift) {
            $shift_day = $shift->day;
            $shifts_str .= "$shift_day shift: $shift\n";
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

    /**
     * Assigns a shift to the staff member.
     * 
     * @param Shift $shift
     * @return string
     */
    public function assignShift(Shift $shift): string
    {
        if (!isset($this->shifts[$shift->day])) {
            $this->shifts[$shift->day] = $shift;
            return "{$this->name} has been assigned to a shift on {$shift->day} from {$shift->start_time} to {$shift->end_time} as a {$shift->assigned_role}.";
        } else {
            // Prompt for overwrite
            echo "{$this->name} already has a shift on {$shift->day}. Overwrite? (y/n): ";
            $handle = fopen ("php://stdin","r");
            $line = trim(fgets($handle));
            if (strtolower($line) === 'y') {
                $this->shifts[$shift->day] = $shift;
                return "Shift on {$shift->day} has been overwritten for {$this->name}.";
            } else {
                return "No changes made. {$this->name} still has the original shift on {$shift->day}.";
            }
        }
    }

    /**
     * Removes a shift from the staff member.
     * 
     * @param Shift $shift
     * @return string
     */

    public function removeShift(Shift $shift): string
    {
        
        if (!isset($this->shifts[$shift->day])) {
            return "{$this->name} has no shift on {$shift->day}.";
        }
        else{
            return "{$this->name} has been removed from the shift on {$shift->day} from {$shift->start_time} to {$shift->end_time} as a {$shift->assigned_role}.";
        }
        
    }

    public function __toString(): string
    {
        return $this->getDetails();
    }   

}