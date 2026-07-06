<?php
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<main>

<h2>Student Registration</h2>

<form>

<label>Student ID</label>
<input type="text">

<label>Full Name</label>
<input type="text">

<label>Gender</label>

<select>
<option>Male</option>
<option>Female</option>
</select>

<label>Date of Birth</label>
<input type="date">

<label>Course</label>

<select>
<option>ICT</option>
<option>Networking</option>
<option>Computer Science</option>
</select>

<label>Phone</label>
<input type="text">

<label>Email</label>
<input type="email">

<button type="submit">
Save Student
</button>

<button type="reset">
Reset
</button>

</form>

</main>

<?php
include 'includes/footer.php';
?>