<?php
	// Start session
	session_start();

	// Connect to the database
	$conn = mysqli_connect('localhost', 'username', 'password', 'database_name');

	// Check for errors
	if (mysqli_connect_errno()) {
		die('Failed to connect to the database: ' . mysqli_connect_error());
	}

	// Get user input
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	// Get user from the database
	$sql = "SELECT * FROM users WHERE username = '$username'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 1) {
		$user = mysqli_fetch_assoc($result);

		// Verify password
		if (password_verify($password, $user['password'])) {
			// Set session variables
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['username'] = $user['username'];

		
