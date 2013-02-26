<!doctype html>
<html>
  <head>
		<style type="text/css" media="screen">
			.error { color: red; }
	</style>
		<title>Registration</title>
	</head>

	<body>
		<h1>Registration Results</h1>
		<?php
			// Flag variable to indicate success
			$okay = TRUE;

			if (empty($_POST['email'])) {
				print '<p class="error">Please enter your email address.</p>';
				$okay = FALSE;
			}

			if (empty($_POST['password'])) {
				print '<p class="error">Please enter your password.</p>';
				$okay = FALSE;
			}

			if ($_POST['password'] != $_POST['confirm']) {
				print '<p class="error">Your confirmed password does not match the original password.</p>';
				$okay = FALSE;
			}

			if ( is_numeric($_POST['year']) AND (strlen($_POST['year']) == 4) ) {

				// Retrieve the current year using the date function
				$current_year = date('Y');

				if ($_POST['year'] < $current_year) {
					$age = $current_year - $_POST['year'];
				 } else {
					print '<p class="error">Either you entered your birth year wrong or you come from the future!</p>';
					$okay = FALSE;
				} // End of 2nd conditional.
			} else { // Else for 1st conditional.
				print '<p class="error">Please enter the year you were born as four digits.</p>';
				$okay = FALSE;
			} // End of 1st conditional.

			if (!isset($_POST['terms'])) {
				print '<p class="error">You must accept the terms.</p>';
				$okay = FALSE;
			}

			switch ($_POST['color'])
			{
				case "red":
				case "yellow":
				case "green":
				case "blue":
					$color_type = "primary";
					break;

				default:
					print "<p>Please enter your favorite color.</p>";
					$okay = FALSE;
					break;
			}

			if ($okay) {
				$color = $_POST['color'];
				print '<p>You have been successfully registered (but not really).</p>';
				print "<p>You will turn $age this year.</p>";
				print "<p>Your favorite color (<span style=\"color:$color\">" . $color . "</span>) is a $color_type color.</p>";
			}
		?>
	</body>
</html>
