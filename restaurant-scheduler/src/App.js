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

  const handleSubmit = async (e) => {
    e.preventDefault();
    const contact_info = {
      name: name,
      phone_num: phoneNum,
      email: email
    };
    console.log("Submitting:", { name, role, contact_info }); // Print submitted data to console
    const response = await axios.post('http://localhost/php-backend/index.php', { name, role, contact_info });
    console.log(response);
    setResp(response.data.message);
    setName('');
    setRole('');
    setPhoneNum('');
    setEmail('');
    setShowForm(false); // Hide form after submit
  };

  return (
    <div className="App">
      <h1>Heather's Restaurant Scheduler</h1>
      <button
        style={{fontSize: '1.2em', marginRight: '10px'}}
        onClick={() => setShowForm(true)}
      >
        + Add Staff
      </button>
      <button style={{fontSize: '1.2em'}}>+ Add Shift</button>
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
      {submittedName && (
        <p>You entered: {submittedName}</p>
      )}
    </div>
  );
}

export default App;
