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

				// Determine the current year using the date() function
				$current_year = date('Y');

				// Assign the users year of birth to 'year_of_birth'
				$year_of_birth = $_POST['year'];

				// Assign the users month of birth to 'month_of_birth'
				$month_of_birth = $_POST['month'];

				if ($year_of_birth < $current_year) {
					$age = $current_year - $year_of_birth;

					// Based on the month value specified by the user, ensure that the specified day makes sense:
					// January has 31 days, ...
					//
					// We only verify the user's day of birth if the year is 'sane'

					$day_of_birth = $_POST['day'];
					switch($month_of_birth)
					{
					/*
					 * The following months have 31 days:
				 	 *
				 	 * January
				 	 * March
					 * May
				 	 * July
					 * August
				 	 * October
				 	 * December
				 	*/

						case 1:
						case 3:
						case 5:
						case 7:
						case 8:
						case 10:
						case 12:
							$days_in_month = 31;
							break;

					/*
					 * The following months have 30 days:
				 	 *
					 * April
				 	 * June
				 	 * September
				 	 * November
				 	 */

						case 4:
						case 6:
						case 9:
						case 11:
							$days_in_month = 30;
							break;

					/*
				 	 * The number of days is based on the following:
				 	 *
					 * if year is divisible by 400 then
   					 * 		the month has 29 days
				 	 * else if year is divisible by 100 then
				 	 * 		the month has 28 days
					 * else if year is divisible by 4 then
				 	 * 		the month has 29 days
				 	 * else
				 	 * 		the month has 28 days
					 */
						case 2:
							if ($year_of_birth % 400 == 0) {
								$days_in_month = 29;
							} elseif ($year_of_birth % 100 == 0) {
								$days_in_month = 28;
							} elseif ($year_of_birth % 4 == 0) {
								$days_in_month = 29;
		 					} else
		 						$days_in_month = 28;
							break;
					}

					// If the day of month specified by the user is greater than the number of days in that month,
					// print an error message and set the 'okay' boolean flag to FALSE

					if ($day_of_birth > $days_in_month) {
						$mth_name = date('F', mktime(0 ,0, 0, $month_of_birth,  '1', $year_of_birth));
						print "<p class='error'>There were only $days_in_month days in $mth_name in the year " . $year_of_birth . ".<br /><br />Please enter a day between 1 and $days_in_month.</p>";
						$okay = FALSE;
					}
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
				print "<p>To summarize, your birthday is " . sprintf("%02d", $day_of_birth) . '/' . sprintf("%02d", $month_of_birth) . '/' . $year_of_birth . '.</p>';
			}
		?>
	</body>
</html>
