<?php
include("includes/init.php");
$title = "Contact Us";

// default to form
$show_confirmation= FALSE;

// default to no feedback
$show_name_feedback = FALSE;
$show_email_feedback = FALSE;
$show_team_feedback = FALSE;

// Form default values
$name = '';
$email = '';
$pitch = '';

//Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // $is_form_valid = TRUE;
  $show_confirmation = TRUE;

  // name requirement, sanitize input
  $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
  $name = trim($_POST['name']);
  if(empty($name)){
    // $is_form_valid = FALSE;
    $show_name_feedback = TRUE;
    $show_confirmation = FALSE;
  }

  // email requirement
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
  if(empty($email)){
    // $is_form_valid = FALSE;
    $show_email_feedback = TRUE;
    $show_confirmation = FALSE;
  }
  //pitch requirement
  $pitch = filter_input(INPUT_POST, "pitch", FILTER_SANITIZE_STRING);
  // $pitch = trim($_POST['pitch']);
  // if(empty($pitch)){
  //   // $is_form_valid = FALSE;
  //   $show_pitch_feedback = TRUE;
  //   $show_confirmation = FALSE;
  // }

  $team = trim($_POST['team']);
  if (!in_array($team, array("graphics", "marketing", "production", "research", "audio", "na"))) {
    $team = NULL;
    $show_team_feedback = TRUE;
  }

  $join = $_POST['join'];


  //order valid or invalid
  // $show_confirmation = !$is_form_valid;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Contact Us </title>
  <link rel="stylesheet" type="text/css" href="styles/theme1.css" media="all"/>
</head>

<body>

  <?php include("includes/header.php"); ?>

  <img class="banner" src="images/team-pic.jpg" alt="State of the Pod Team" title="Join Us Today!">
      <!--Original work by Keenan Ashbrook -->

      <p>Photo Credit: <cite>Keenan Ashbrook</cite></p>

  <main>

      <h2>Join the Team</h2>

      <?php if ($show_confirmation) { ?>

        <h2> Connection form summary for <?php echo htmlspecialchars($name); ?></h2>

        <ol>
          <?php
          echo ("<li> Email Address: " . htmlspecialchars($email) . "</li>");
          echo ("<li> Interest on team: " . htmlspecialchars($student_interest) . "</li>");
          echo ("<li> Episode pitch: " . htmlspecialchars($pitch) . "</li>");

          echo ("<li> Team Interests: " . htmlspecialchars($team) . "</li>");

          echo ("<li> Collaboration interest: " . htmlspecialchars($join) . "</li>");

          ?>
        </ol>
        <p><a href="contact.php">Submit Another Connection Form</a></p>
      <?php } else { ?>
        <h2> Connection Form</h2>

        <form id="interestForm" method="post" action="contact.php" novalidate>

          <div class="input-pair">
            <label for="name">First and Last Name: </label>
            <input type="text" id="name" name="name" placeholder= "John Smith" value="<?php echo htmlspecialchars($name); ?>" />
          </div>

          <p class= "error_msg <?php echo ($show_name_feedback) ? '' : 'hidden'; ?>"> Please provide your first and last name.</p>

          <div class="input-pair">
            <label for="email">Email: </label>
            <input type="email" id="email" name="email" placeholder="johnnyappleseed@gmail.com" value="<?php echo htmlspecialchars($email); ?>" />
          </div>

          <p class= "error_msg <?php echo ($show_email_feedback) ? '' : 'hidden'; ?>"> Please provide a valid email address.</p>

          <!-- <div class="input-pair">
            <label for="favorite_Podcast"> Favorite Podcast: </label>
            <input type="text" id="favorite_Podcast" name="favorite_Podcast" required/>
          </div>
          <span class="error_msg hidden" id="favorite_Error">
            Please provide your favorite podcast using only letters and numbers.
          </span> -->

          <div class="input-pair">
            <label for="join">Contact Purpose: </label>
            <select name="join" id="join">
                <option value="">  --Please choose an option below--</option>
                <option>Join the Team</option>
                <option>Collaborate</option>
                <option>Sponsorship</option>
            </select>
          </div>

          <div class="flex checkbox">
            <label for="graphics"> Team Interest Area: </label>
            <div class="checkbox-pair">
              <input type="radio" id="graphics" name="team" value="graphics">
              <label for="graphics">Graphics</label>
            </div>

            <div class="checkbox-pair">
              <input type="radio" id="marketing" name="team" value="marketing">
              <label for="marketing">Marketing</label>
            </div>

            <div class="checkbox-pair">
              <input type="radio" id="production" name="team" value="production">
              <label for="production">Production</label>
            </div>

            <div class="checkbox-pair">
              <input type="radio" id="research" name="team" value="research">
              <label for="research">Research</label>
            </div>

            <div class="checkbox-pair">
              <input type="radio" id="audio" name="team" value="audio">
              <label for="audio">Audio-Editing</label>
            </div>

            <div class="checkbox-pair">
              <input type="radio" id="na" name="team" value="na">
              <label for="na">Not Applicable</label>
            </div>

          </div>
          <p class= "error_msg <?php echo ($show_team_feedback) ? '' : 'hidden'; ?>"> Please check at least one option.</p>

          <div class="input-pair">
            <label for="pitch">Episode Pitch: </label>
            <input type="text" id="pitch" name="pitch" placeholder=" please provide a one-sentence episode pitch" value="<?php echo htmlspecialchars($pitch); ?>"/>
          </div>

          <!-- <p class="error_msg <?php echo ($show_pitch_feedback) ? '' : 'hidden'; ?>">Please provide a short description of an episode idea you would like to produce.</p> -->

          <!-- <div class="input-pair">
            <label for="comments">Additional Comments: </label>
            <input type="text" id="comments" name="comments" value="<?php echo htmlspecialchars($sponsor_comments); ?>"/>
          </div> -->


        <!-- <button type="submit" class="submit">Submit</button> -->

        <div class="input-pair">
          <span>
            <!-- empty element; used to align submit button --></span>
          <input type="submit" value="Send Form" />
        </div>

        </form>
      <?php } ?>

  </main>

  <?php include("includes/footer.php"); ?>

</body>

</html>
