<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $username = "root";
    $password = "root";
    $database = "testdb";

    $conn = new mysqli($host, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $title = $_POST['title'] ?? '';
    $department = trim($_POST['department']) ?? '';
    $location = $_POST['location'] ?? '';
    $job_type = $_POST['job_type'] ?? '';
    $description = $_POST['description'] ?? '';
    $responsibilities = $_POST['responsibilities'] ?? '';
    $qualifications = $_POST['qualifications'] ?? '';
    $experience = $_POST['experience'] ?? '';
    $posted_date = $_POST['posted_date'] ?? '';
    $last_date_to_apply = $_POST['last_date_to_apply'] ?? '';
    $status = $_POST['status'] ?? '';
    $apply_link = $_POST['apply_link'] ?? '';
    $salary_range = $_POST['salary_range'] ?? '';
    $company_benefits = $_POST['company_benefits'] ?? '';
    $work_mode = $_POST['work_mode'] ?? '';

    $sql = "INSERT INTO job_postings (title, department, location, job_type, description, responsibilities, qualifications, experience, posted_date, last_date_to_apply, status, apply_link, salary_range, company_benefits, work_mode)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssss", $title, $department, $location, $job_type, $description, $responsibilities, $qualifications, $experience, $posted_date, $last_date_to_apply, $status, $apply_link, $salary_range, $company_benefits, $work_mode);

    if ($stmt->execute()) {
        header("Location: success.html");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Post a Job</title>
  <link rel="stylesheet" href="CSS/job_posting.css">
</head>
<body>
<div class="form-container">
  <form action="job_posting.php" method="post">
    <h2>Post a New Job</h2>
    <label for="title">Job Title *</label><br>
    <input type="text" id="title" name="title" required><br><br>

    <label for="department">Department *</label><br>
    <input type="text" id="department" name="department" required><br><br>

    <label for="location">Location</label><br>
    <input type="text" id="location" name="location"><br><br>

    <label for="job_type">Job Type</label><br>
    <select id="job_type" name="job_type">
      <option value="Full-time">Full-time</option>
      <option value="Part-time">Part-time</option>
      <option value="Internship">Internship</option>
      <option value="Contract">Contract</option>
    </select><br><br>

    <label for="description">Job Description</label><br>
    <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>

    <label for="responsibilities">Responsibilities</label><br>
    <textarea id="responsibilities" name="responsibilities" rows="3" cols="50"></textarea><br><br>

    <label for="qualifications">Qualifications</label><br>
    <textarea id="qualifications" name="qualifications" rows="3" cols="50"></textarea><br><br>

    <label for="experience">Experience</label><br>
    <input type="text" id="experience" name="experience"><br><br>

    <label for="posted_date">Posted Date</label><br>
    <input type="date" id="posted_date" name="posted_date"><br><br>

    <label for="last_date_to_apply">Last Date to Apply</label><br>
    <input type="date" id="last_date_to_apply" name="last_date_to_apply"><br><br>

    <label for="status">Status</label><br>
    <select id="status" name="status">
      <option value="Active">Active</option>
      <option value="Inactive">Inactive</option>
    </select><br><br>

    <label for="apply_link">Apply Link</label><br>
    <input type="url" id="apply_link" name="apply_link"><br><br>

    <label for="salary_range">Salary Range</label><br>
    <input type="text" id="salary_range" name="salary_range"><br><br>

    <label for="company_benefits">Company Benefits</label><br>
    <textarea id="company_benefits" name="company_benefits" rows="3" cols="50"></textarea><br><br>

    <label for="work_mode">Work Mode</label><br>
    <select id="work_mode" name="work_mode">
      <option value="On-site">On-site</option>
      <option value="Remote">Remote</option>
      <option value="Hybrid">Hybrid</option>
    </select><br><br>

    <button type="submit">Submit Job</button>
  </form>
</div>
</body>
</html>
