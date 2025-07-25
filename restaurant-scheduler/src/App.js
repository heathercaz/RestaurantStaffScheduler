import './App.css';
import { useState, useEffect } from 'react';
import axios from 'axios';

function App() {

  // Staff form state
  const [name, setName] = useState('');
  const [role, setRole] = useState('');
  const [phoneNum, setPhoneNum] = useState('');
  const [email, setEmail] = useState('');
  const [resp, setResp] = useState('');
  const [showForm, setShowForm] = useState(false);

  // Shift form state
  const [showShiftForm, setShowShiftForm] = useState(false);
  const [day, setDay] = useState('');
  const [startTime, setStartTime] = useState('');
  const [endTime, setEndTime] = useState('');
  const [assignedRole, setAssignedRole] = useState('');
  const [selectedStaff, setSelectedStaff] = useState('');

  // Staff and shift lists
  const [staffList, setStaffList] = useState([]);
  const [shiftList, setShiftList] = useState([]);

  // Initialize app data on refresh
  useEffect(() => {
    const fetchData = async () => {
      try {
        const res = await axios.get('http://localhost/php-backend/index.php');
        if (res.data.staffMembers) setStaffList(res.data.staffMembers);
        if (res.data.shiftList) setShiftList(res.data.shiftList);
      } catch (err) {
        console.error("Failed to fetch initial data:", err);
      }
    };
    fetchData();
  }, []);

  // Handle add staff submission
  const handleSubmit = async (e) => {
    e.preventDefault();
    const contact_info = {
      name: name,
      phone_num: phoneNum,
      email: email
    };
    const response = await axios.post('http://localhost/php-backend/index.php', { name, role, contact_info });
    setResp(response.data.message);
    setName('');
    setRole('');
    setPhoneNum('');
    setEmail('');
    setShowForm(false);

    // Fill staffList with staff members from response.data if available
    if (response.data.staffMembers) {
      setStaffList(response.data.staffMembers);
    }
  };

  // Handle add shift submission
  const handleShiftSubmit = async (e) => {
    e.preventDefault();
    const response = await axios.post('http://localhost/php-backend/index.php', { day, startTime, endTime, assignedRole, selectedStaff });
    setResp(response.data.message);
    setDay('');
    setStartTime('');
    setEndTime('');
    setAssignedRole('');
    setSelectedStaff('');
    setShowShiftForm(false);
    if (response.data.shiftList) setShiftList(response.data.shiftList);
  };

  // Helper to sort shifts by day of week
  const dayOrder = [
    "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"
  ];

  // Function to get index of day in the dayOrder array
  function getDayIndex(day) {
    return dayOrder.indexOf(day);
  }

  // Sort shifts by day of the week
  const sortedShiftList = [...shiftList].sort((a, b) => {
    return getDayIndex(a.day) - getDayIndex(b.day);
  });

  // Sort staff alphabetically by name
  const sortedStaffList = [...staffList].sort((a, b) => {
    if (a.name && b.name) {
      return a.name.localeCompare(b.name);
    }
    return 0;
  });

  // Add this function to handle staff removal
  const handleRemoveStaff = async (staffName) => {
    if (!window.confirm(`Remove staff member "${staffName}"?`)) return;
    try {
      const response = await axios.post('http://localhost/php-backend/index.php', {
        removeStaff: true,
        name: staffName
      });
      if (response.data.staffMembers) {
        setStaffList(response.data.staffMembers);
        setResp(`Removed staff member: ${staffName}`);
      }
    } catch (err) {
      setResp("Failed to remove staff member.");
      console.error(err);
    }
  };

  // Add this function to handle shift removal
  const handleRemoveShift = async (shiftToRemove) => {
    if (!window.confirm(
      `Remove shift for ${shiftToRemove.staff} on ${shiftToRemove.day} (${shiftToRemove.start_time} - ${shiftToRemove.end_time})?`
    )) return;
    try {
      const response = await axios.post('http://localhost/php-backend/index.php', {
        removeShift: true,
        day: shiftToRemove.day,
        start_time: shiftToRemove.start_time,
        end_time: shiftToRemove.end_time,
        assigned_role: shiftToRemove.assigned_role,
        staff: shiftToRemove.staff
      });
      if (response.data.shiftList) {
        setShiftList(response.data.shiftList);
        setResp("Removed shift.");
      }
    } catch (err) {
      setResp("Failed to remove shift.");
      console.error(err);
    }
  };

  return (
    <div className="App">
      <h1>Heather's Restaurant Scheduler</h1>
      <button
        style={{ fontSize: '1.2em', marginRight: '10px' }}
        onClick={() => { setShowForm(true); setShowShiftForm(false); }}
      >
        + Add Staff
      </button>
      <button
        style={{ fontSize: '1.2em' }}
        onClick={() => { setShowShiftForm(true); setShowForm(false); }}
      >
        + Add Shift
      </button>
      <br />
      {showForm && (
        <form onSubmit={handleSubmit}>
          <label>
            Name:
            <input
              type="text"
              value={name}
              onChange={e => setName(e.target.value)}
            />
          </label>
          <br />
          <label>
            Role:
            <select
              value={role}
              onChange={e => setRole(e.target.value)}
            >
              <option value="">Select Role</option>
              <option value="Cook">Cook</option>
              <option value="Dishwasher">Dishwasher</option>
              <option value="Host">Host</option>
              <option value="Waiter">Waiter</option>
            </select>
          </label>
          <br />
          <label>
            Phone Number:
            <input
              type="text"
              value={phoneNum}
              onChange={e => setPhoneNum(e.target.value)}
            />
          </label>
          <br />
          <label>
            Email:
            <input
              type="email"
              value={email}
              onChange={e => setEmail(e.target.value)}
            />
          </label>
          <br />
          <button type="submit">Submit</button>
        </form>
      )}
      {showShiftForm && (
        <form onSubmit={handleShiftSubmit}>
          <label>
            Day:
            <select
              value={day}
              onChange={e => setDay(e.target.value)}
            >
              <option value="">Select Day</option>
              <option value="Monday">Monday</option>
              <option value="Tuesday">Tuesday</option>
              <option value="Wednesday">Wednesday</option>
              <option value="Thursday">Thursday</option>
              <option value="Friday">Friday</option>
              <option value="Saturday">Saturday</option>
              <option value="Sunday">Sunday</option>
            </select>
          </label>
          <br />
          <label>
            Start Time:
            <input
              type="text"
              value={startTime}
              onChange={e => setStartTime(e.target.value)}
            />
          </label>
          <br />
          <label>
            End Time:
            <input
              type="text"
              value={endTime}
              onChange={e => setEndTime(e.target.value)}
            />
          </label>
          <br />
          <label>
            Assigned Role:
            <select
              value={assignedRole}
              onChange={e => setAssignedRole(e.target.value)}
            >
              <option value="">Select Role</option>
              <option value="Cook">Cook</option>
              <option value="Dishwasher">Dishwasher</option>
              <option value="Host">Host</option>
              <option value="Waiter">Waiter</option>
            </select>
          </label>
          <br />
          <label>
            Staff Member:
            <select
              value={selectedStaff}
              onChange={e => setSelectedStaff(e.target.value)}
            >
              <option value="">Select Staff</option>
              {staffList.map((staff, idx) => (
                <option key={idx} value={staff.name}>
                  {staff.name} ({staff.role})
                </option>
              ))}
            </select>
          </label>
          <br />
          <button type="submit">Submit Shift</button>
        </form>
      )}
      {resp && (
        <p>{resp}</p>
      )}

      {/* Section: List all shifts and assigned staff */}
      <h2>All Shifts</h2>
      <ul style={{ listStyleType: 'none' }}>
        {sortedShiftList.map((shift, idx) => (
          <li key={idx} style={{ display: 'flex', alignItems: 'center' }}>
            <span style={{ flex: 1 }}>
              <strong>{shift.day}</strong>: {shift.start_time} - {shift.end_time}, Role: {shift.assigned_role}, Staff: {shift.staff}
            </span>
            <span
              style={{
                color: '#f67280',
                marginLeft: 12,
                cursor: 'pointer',
                fontWeight: 'bold',
                fontSize: '1.2em',
                userSelect: 'none'
              }}
              title="Remove shift"
              onClick={() => handleRemoveShift(shift)}
            >
              ×
            </span>
          </li>
        ))}
      </ul>

      {/* Section: List all staff */}
      <h2>All Staff</h2>
      <ul style={{ listStyleType: 'none' }}>
        {sortedStaffList.map((staff, idx) => (
          <li key={idx} style={{ display: 'flex', alignItems: 'center' }}>
            <span style={{ flex: 1 }}>
              <strong>{staff.name}</strong> - {staff.role}, Phone: {staff.phone_num}, Email: {staff.email}
            </span>
            <span
              style={{
                color: '#f67280',
                marginLeft: 12,
                cursor: 'pointer',
                fontWeight: 'bold',
                fontSize: '1.2em',
                userSelect: 'none'
              }}
              title="Remove staff member"
              onClick={() => handleRemoveStaff(staff.name)}
            >
              ×
            </span>
          </li>
        ))}
      </ul>
    </div>
  );
}

export default App;
