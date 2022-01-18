
# Attendance Manager API

REST api for a web app that manages attendance.


## Tech Stack

**Lang:** PHP, SQLITE3

**Server:** Apache


## API Reference

**Base URL:** https://alphacoders.ga/projects/attendance-manager-api/

**Method:** POST

**Response Type:** JSON
| Action | End Point     | Parameters                |
| :-------- | :------- | :------------------------- |
| `Add User` | `addUser.php` | `name, email, password` |
| `User Login` | `userLogin.php` | `email, password` |
| `Submit Attendance` | `submitAttendance.php` | `class, section, teacher, roll, absent` |
| `Admin Login` | `adminLogin.php` | `username, password` |
| `Fetch Submissions (Date)` | `fetchSubmissionsByDate.php` | `date (e.g. 06-12-2021` |
