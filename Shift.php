<?php


class Shift
{
    public string $day;
    public string $start_time;
    public string $end_time;
    public string $assigned_role;

    public function __construct(string $day, string $start_time, string $end_time, string $assigned_role)
    {
        $this->day = $day;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
        $this->assigned_role = $assigned_role;
    }

    public function getDay(): string
    {
        return $this->day;
    }

    public function setDay(string $day): void
    {
        $this->day = $day;
    }

    public function getStartTime(): string
    {        
        return $this->start_time;
    }

    public function setStartTime(string $start_time): void
    {
        $this->start_time = $start_time;
    }

    public function getEndTime(): string
    {
        return $this->end_time;
    }

    public function setEndTime(string $end_time): void
    {
        $this->end_time = $end_time;
    }

    public function getAssignedRole(): string
    {
        return $this->assigned_role;
    }

    public function setAssignedRole(string $assigned_role): void
    {
        $this->assigned_role = $assigned_role;
    }

    public function getDetails(): string
    {
        return "Day: {$this->day}, Start Time: {$this->start_time}, End Time: {$this->end_time}, Assigned Role: {$this->assigned_role}";
    }

    public function setShiftDetails(string $day, string $start_time, string $end_time, string $assigned_role): void
    {
        $this->day = $day;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
        $this->assigned_role = $assigned_role;
    }

    public function __toString(): string
    {
        return $this->getDetails();
    }   

    public function assignToStaff(StaffMember $staff): string
    {
        return $staff->assignShift($this);
    }   


}

