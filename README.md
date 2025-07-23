# Restaurant Staff Scheduler

A web application for managing restaurant staff and scheduling shifts.

## Features

- Add, view, and manage staff members
- Schedule shifts for staff by day and time
- View all shifts and staff in a clean, organized interface
- Data persists using a PHP backend and JSON files

## Technologies Used

- React (frontend)
- PHP (backend)
- JSON file storage
- Axios for HTTP requests
- CSS for styling

## Getting Started

### Prerequisites

- Node.js and npm
- PHP (e.g., XAMPP, WAMP, or built-in server)

### Installation

1. Clone this repository.
2. Install frontend dependencies:
    ```bash
    cd restaurant-scheduler
    npm install
    ```
3. Set up the PHP backend:
    - Place the `php-backend` folder in your PHP server's root directory (e.g., `htdocs` for XAMPP).
    - Ensure `staff.json` and `shift.json` exist and are writable.

### Running the App

- **Frontend:**  
  ```bash
  npm start
  ```
  (Runs on [http://localhost:3000](http://localhost:3000))

- **Backend:**  
  Start your PHP server and ensure it serves the backend files at `http://localhost/php-backend/`.

## Usage

- Click "+ Add Staff" to add a new staff member.
- Click "+ Add Shift" to schedule a shift for a staff member.
- View all staff and shifts in the main dashboard.

## Folder Structure

```
restaurant-scheduler/
  ├── src/
  │   ├── App.js
  │   ├── App.css
  │   └── ...
  ├── php-backend/
  │   ├── index.php
  │   ├── staff.json
  │   ├── shift.json
  │   └── ...
  └── README.md
```

## Features to be added
Backend:
  - Handling of repeat staff and shifts
  - Esure the staff's shifts don't conflict
  - Ability to set number of roles needed per shift and fill them
  - Store data in a database rather than JSON files

Frontend:
  - Click on staff member to assign shift to them
  - Sort Shifts by day and time, list each staff member + role for each shift
  - Better interface for selecting day and time like a calendar and dropdown 

## Author

Heather Caswell