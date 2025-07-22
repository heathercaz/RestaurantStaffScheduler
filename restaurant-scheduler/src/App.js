import './App.css';
import { useState } from 'react';
import axios from 'axios';

function App() {
  const [name, setName] = useState('');
  const [role, setRole] = useState('');
  const [phoneNum, setPhoneNum] = useState('');
  const [email, setEmail] = useState('');
  const [submittedName, setResp] = useState('');
  const [showForm, setShowForm] = useState(false);

  // Shift form state
  const [showShiftForm, setShowShiftForm] = useState(false);
  const [startTime, setStartTime] = useState('');
  const [endTime, setEndTime] = useState('');
  const [assignedRole, setAssignedRole] = useState('');
  const [selectedStaff, setSelectedStaff] = useState('');

  // Example staff list for dropdown (replace with backend data if needed)
  const [staffList, setStaffList] = useState([]);
  const foo = "bar";

  // Example shift list for display (replace with backend data if needed)
  const [shiftList, setShiftList] = useState([
    {
      day: 'Tuesday',
      start_time: '08:00',
      end_time: '12:00',
      assigned_role: 'Waiter',
      staff: 'Alice Smith'
    },
    {
      day: 'Wednesday',
      start_time: '10:00',
      end_time: '14:00',
      assigned_role: 'Chef',
      staff: 'Bob Jones'
    }
  ]);

  const handleSubmit = async (e) => {
    e.preventDefault();
    const contact_info = {
      name: name,
      phone_num: phoneNum,
      email: email
    };
    console.log("Submitting:", { name, role, contact_info });
    const response = await axios.post('http://localhost/php-backend/index.php', { name, role, contact_info });
    console.log(response);
    setResp(response.data.message); // Assuming the first staff member is the one just added
    setName('');
    setRole('');
    setPhoneNum('');
    setEmail('');
    setShowForm(false);

    console.log("Staff members from response:", response.data.staffMembers);
    // Fill staffList with staff members from response.data if available
    if (response.data.staffMembers) {
      setStaffList(response.data.staffMembers);
    }

    console.log("Updated staff list:", staffList);
  };

  const handleShiftSubmit = async (e) => {
    e.preventDefault();
    console.log("Submitting shift:", { startTime, endTime, assignedRole, selectedStaff });
    // Send shift data to backend if needed
    setStartTime('');
    setEndTime('');
    setAssignedRole('');
    setSelectedStaff('');
    setShowShiftForm(false);
  };

  return (
    <div className="App">
      <h1>Heather's Restaurant Scheduler</h1>
      <button
        style={{fontSize: '1.2em', marginRight: '10px'}}
        onClick={() => { setShowForm(true); setShowShiftForm(false); }}
      >
        + Add Staff
      </button>
      <button
        style={{fontSize: '1.2em'}}
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
            <input
              type="text"
              value={role}
              onChange={e => setRole(e.target.value)}
            />
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
            <input
              type="text"
              value={assignedRole}
              onChange={e => setAssignedRole(e.target.value)}
            />
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
      {submittedName && (
        <p>You entered: {submittedName}</p>
      )}

      {/* Section: List all shifts and assigned staff */}
      <h2>All Shifts</h2>
      <ul>
        {shiftList.map((shift, idx) => (
          <li key={idx}>
            <strong>{shift.day}</strong>: {shift.start_time} - {shift.end_time}, Role: {shift.assigned_role}, Staff: {shift.staff}
          </li>
        ))}
      </ul>

      {/* Section: List all staff */}
      <h2>All Staff</h2>
      <ul>
        {staffList.map((staff, idx) => (
          <li key={idx}>
            {staff.name} - {staff.role}, Phone: {staff.phone_num}, Email: {staff.email}
          </li> 
          ))}
      </ul>
      <h3>Raw Staff Array</h3>
      <pre>{JSON.stringify(staffList)}</pre>
    </div>
  );
}

export default App;
