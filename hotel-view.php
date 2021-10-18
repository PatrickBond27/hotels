<?php require_once 'config.php';

try {

  // The $rules array has 3 rules, festival_id must be present, must be an integer and have a minimum value of 1.  
  // note festival_id was passed in from festival_index.php when you chose a festival by clicking a radio button. 
  $rules = [
    'hotel_id' => 'present|integer|min:1'
  ];
  // $request->validate() is a function in HttpRequest(). You pass in the 3 rules above and it does it's magic. 
  $request->validate($rules);
  if (!$request->is_valid()) {
    throw new Exception("Illegal request");
  }

  // get the festival_id out of the request (remember it was passed in from festival_index.php)
  $hotel_id = $request->input('hotel_id');
 
  //Retrieve the festival object from the database by calling findById($festival_id) in the Festival.php class
  $hotel = Hotel::findById($hotel_id);
  if ($hotel === null) {
    throw new Exception("Illegal request parameter");
  }
} catch (Exception $ex) {
  $request->session()->set("flash_message", $ex->getMessage());
  $request->session()->set("flash_message_class", "alert-warning");

  // some exception/error occured so re-direct to the home page
  $request->redirect("/home.php");
}

?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>View Customer</title>

  <link href="<?= APP_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= APP_URL ?>/assets/css/template.css" rel="stylesheet">
  <link href="<?= APP_URL ?>/assets/css/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">


</head>

<body>
  <div class="container-fluid p-0">
    <?php require 'include/navbar.php'; ?>
    <main role="main">
      <div>
        <div class="row d-flex justify-content-center">
          <h1 class="t-peta engie-head pt-5 pb-5">View Hotel</h1>
        </div>

        <div class="row justify-content-center pt-4">
          <div class="col-lg-10">
            <form method="get">
              <!--This is how we pass the ID-->
              <input type="hidden" name="hotel_id" value="<?= $hotel->id ?>" />

              <!--Disabled so the user can't intereact. This form is for viewing only.-->
              <div class="form-group">
                <label class="labelHidden" for="ticketPrice">Name</label>
                <input placeholder="Title" type="text" id="title" class="form-control" value="<?= $hotel->name ?>" disabled />
              </div>

              <div class="form-group">
                <label class="labelHidden" for="date">Address</label>
                <textarea name="description" rows="3" id="description" class="form-control" disabled><?= $hotel->address ?></textarea>
              </div>

              <!-- This group is not used for my database -->
              <!-- <div class="form-group"> -->
                <!-- <label class="labelHidden" for="location">Location</label> -->
                <!-- <select class="form-control" name="location" id="location" disabled> -->
                  <!-- triple === means if it is equal. So is location is equal to "USA" display USA, if location is equal to "Belgium" display ...you get the idea..-->
                  <!-- <option value="USA" <?= (($hotel->location === "USA") ? "selected" : "") ?>>USA</option> -->
                  <!-- <option value="Belgium" <?= (($hotel->location === "Belgium") ? "selected" : "") ?>>Belgium</option> -->
                  <!-- <option value="Brazil" <?= (($hotel->location === "Brazil") ? "selected" : "") ?>>Brazil</option> -->
                  <!-- <option value="UK" <?= (($hotel->location === "UK") ? "selected" : "") ?>>UK</option> -->
                  <!-- <option value="Germany" <?= (($hotel->location === "Germany") ? "selected" : "") ?>>Germany</option> -->
                  <!-- <option value="Japan" <?= (($hotel->location === "Japan") ? "selected" : "") ?>>Japan</option> -->
                  <!-- <option value="Netherlands" <?= (($hotel->location === "Netherlands") ? "selected" : "") ?>>Netherlands</option> -->
                  <!-- <option value="Hungary" <?= (($hotel->location === "Hungary") ? "selected" : "") ?>>Hungary</option> -->
                  <!-- <option value="Morocco" <?= (($hotel->location === "Morocco") ? "selected" : "") ?>>Morocco</option> -->
                  <!-- <option value="Spain" <?= (($hotel->location === "Spain") ? "selected" : "") ?>>Spain</option> -->
                  <!-- <option value="Canada" <?= (($hotel->location === "Canada") ? "selected" : "") ?>>Canada</option> -->
                  <!-- <option value="Croatia" <?= (($hotel->location === "Croatia") ? "selected" : "") ?>>Croatia</option> -->
                  <!-- <option value="Philippines" <?= (($hotel->location === "Philippines") ? "selected" : "") ?>>Philippines</option> -->
                <!-- </select> -->
              <!-- </div> -->

              <!-- For the two groups I changed the labels to Star Rating and Phone Number -->
              <div class="form-group">
                <label class="labelHidden" for="venueDescription">Star Rating</label>
                <input placeholder="Star Rating" type="text" id="contactEmail" class="form-control" value="<?= $hotel->star_rating ?>" disabled />
              </div>

              <div class="form-group">
                <label class="labelHidden" for="venueDescription">Phone Number</label>
                <input placeholder="Phone Number" type="text" id="contactPhone" class="form-control" value="<?= $hotel->phone_number ?>" disabled />
              </div>

              <!-- I changed the festival name to my hotel name for findById to get images -->
              <div class="form-group">
                <label class="labelHidden" for="venueDescription">Image</label>
                <?php
                try {
                  $image = Image::findById($hotel->image_id);
                } catch (Exception $e) {
                }
                if ($image !== null) {
                ?>
                  <img src="<?= APP_URL . "/" . $image->filename ?>" width="205px" alt="image" class="mt-2 mb-2" />
                <?php
                }
                ?>
              </div>

              <div class="form-group">
                <a class="btn btn-default" href="<?= APP_URL ?>/home.php">Cancel</a>
                <button class="btn btn-warning" formaction="<?= APP_URL ?>/festival-edit.php">Edit</button>
                <button class="btn btn-danger btn-festival-delete" formaction="<?= APP_URL ?>/festival-delete.php">Delete</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
    <?php require 'include/footer.php'; ?>
  </div>
  <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
  <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>
  <script src="<?= APP_URL ?>/assets/js/festival.js"></script>

  <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>

</body>

</html>