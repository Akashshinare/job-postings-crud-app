<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Job Postings with Filters & DataTables</title>
  <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- DataTables CSS & JS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    form {
      margin-bottom: 20px;
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
    }
    label {
      font-weight: bold;
    }
    select, input {
      padding: 6px;
      font-size: 14px;
      width: 180px;
    }
    .btn {
      padding: 6px 12px;
      border: none;
      color: #fff;
      cursor: pointer;
      border-radius: 4px;
      font-size: 14px;
    }
    .btn-update { background-color: #007bff; }
    .btn-delete { background-color: #dc3545; }
    .btn-filter { background-color: #28a745; color: #fff; margin-top: 22px; }
  </style>
</head>
<body>

  <h2>Filter Job Postings</h2>
  <form id="filterForm" onsubmit="filterTable(event)">
    <div>
      <label for="jobTitle">Job Title</label><br>
      <input type="text" id="jobTitle" placeholder="e.g. Software Developer">
    </div>
    <div>
      <label for="department">Department</label><br>
      <select id="department">
        <option value="">All</option>
        <option value="IT">IT</option>
        <option value="Designing">Designing</option>
        <option value="Information Technology">Information Technology</option>
      </select>
    </div>
    <div>
      <label for="location">Location</label><br>
      <input type="text" id="location" placeholder="e.g. Pune">
    </div>
    <div>
      <label for="type">Job Type</label><br>
      <select id="type">
        <option value="">All</option>
        <option value="Full-time">Full-time</option>
        <option value="Internship">Internship</option>
      </select>
    </div>
    <div>
      <label for="mode">Mode</label><br>
      <select id="mode">
        <option value="">All</option>
        <option value="On-site">On-site</option>
        <option value="Hybrid">Hybrid</option>
      </select>
    </div>
    <div>
      <label for="experience">Experience</label><br>
      <select id="experience">
        <option value="">All</option>
        <option value="0-1">0-1 years</option>
        <option value="1–3">1–3 years</option>
        <option value="2+">2+ years</option>
        <option value="5+">5+ years</option>
      </select>
    </div>
    <div>
      <button type="submit" class="btn btn-filter">Apply Filters</button>
    </div>
  </form>

  <table id="jobsTable" class="display">
    <thead>
      <tr>
        <th>ID</th>
        <th>Job Title</th>
        <th>Department</th>
        <th>Location</th>
        <th>Type</th>
        <th>Experience</th>
        <th>Mode</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Software Developer</td>
        <td>IT</td>
        <td>Pune, Maharashtra</td>
        <td>Full-time</td>
        <td>1–3 years</td>
        <td>On-site</td>
        <td>
          <button class="btn btn-update" onclick="updateJob(1)">Update</button>
          <button class="btn btn-delete" onclick="deleteJob(1)">Delete</button>
        </td>
      </tr>
      <tr>
        <td>2</td>
        <td>UI/UX Designer</td>
        <td>Designing</td>
        <td>Mumbai, India</td>
        <td>Full-time</td>
        <td>2+ years</td>
        <td>Hybrid</td>
        <td>
          <button class="btn btn-update" onclick="updateJob(2)">Update</button>
          <button class="btn btn-delete" onclick="deleteJob(2)">Delete</button>
        </td>
      </tr>
      <tr>
        <td>3</td>
        <td>Trainee Software Developer</td>
        <td>Information Technology</td>
        <td>Pune, Maharashtra</td>
        <td>Internship</td>
        <td>0-1 years</td>
        <td>On-site</td>
        <td>
          <button class="btn btn-update" onclick="updateJob(3)">Update</button>
          <button class="btn btn-delete" onclick="deleteJob(3)">Delete</button>
        </td>
      </tr>
      <tr>
        <td>4</td>
        <td>Software Engineer</td>
        <td>Information Technology</td>
        <td>Pune, Maharashtra</td>
        <td>Full-time</td>
        <td>2+ years</td>
        <td>Hybrid</td>
        <td>
          <button class="btn btn-update" onclick="updateJob(4)">Update</button>
          <button class="btn btn-delete" onclick="deleteJob(4)">Delete</button>
        </td>
      </tr>
      <tr>
        <td>5</td>
        <td>Senior Software Developer</td>
        <td>IT</td>
        <td>Bangalore, Karnataka</td>
        <td>Full-time</td>
        <td>5+ years</td>
        <td>Hybrid</td>
        <td>
          <button class="btn btn-update" onclick="updateJob(5)">Update</button>
          <button class="btn btn-delete" onclick="deleteJob(5)">Delete</button>
        </td>
      </tr>
    </tbody>
  </table>

  <script>
    $(document).ready(function () {
      window.dataTable = $('#jobsTable').DataTable();
    });

    function updateJob(id) {
      alert("Update clicked for job ID: " + id);
    }

    function deleteJob(id) {
      if (confirm("Are you sure you want to delete job ID: " + id + "?")) {
        alert("Job ID " + id + " deleted.");
      }
    }

    function filterTable(event) {
      event.preventDefault();

      const title = $('#jobTitle').val().toLowerCase();
      const department = $('#department').val().toLowerCase();
      const location = $('#location').val().toLowerCase();
      const type = $('#type').val().toLowerCase();
      const mode = $('#mode').val().toLowerCase();
      const experience = $('#experience').val().toLowerCase();

      dataTable.rows().every(function () {
        const data = this.data();
        const match =
          (!title || data[1].toLowerCase().includes(title)) &&
          (!department || data[2].toLowerCase() === department) &&
          (!location || data[3].toLowerCase().includes(location)) &&
          (!type || data[4].toLowerCase() === type) &&
          (!experience || data[5].toLowerCase().includes(experience)) &&
          (!mode || data[6].toLowerCase() === mode);

        if (match) {
          $(this.node()).show();
        } else {
          $(this.node()).hide();
        }
      });
    }
  </script>
</body>
</html>
