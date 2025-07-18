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
}
?>
