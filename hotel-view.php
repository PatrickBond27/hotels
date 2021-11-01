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

              <!-- This group is not used for my database -->
              <div class="form-group">
                <label class="labelHidden" for="address">Address</label>
                <select class="form-control" name="address" id="address" disabled>
                  <!-- triple === means if it is equal. So is location is equal to "USA" display USA, if location is equal to "Belgium" display ...you get the idea..-->
                  <option value="2864 S Pacific Ave, Cannon Beach, OR 97110-3153" <?= (($hotel->address === "2864 S Pacific Ave, Cannon Beach, OR 97110-3153") ? "selected" : "") ?>>2864 S Pacific Ave, Cannon Beach, OR 97110-3153</option>
                  <option value="Rue Duquesnoy 5, Brussels 1000 Belgium" <?= (($hotel->address === "Rue Duquesnoy 5, Brussels 1000 Belgium") ? "selected" : "") ?>>Rue Duquesnoy 5, Brussels 1000 Belgium</option>
                  <option value="33 Wilmington Ave, Rehoboth Beach, DE 19971-2218" <?= (($hotel->address === "33 Wilmington Ave, Rehoboth Beach, DE 19971-2218") ? "selected" : "") ?>>33 Wilmington Ave, Rehoboth Beach, DE 19971-2218</option>
                  <option value="Av. Atlantica, 4240 Copacabana, Rio de Janeiro, State of Rio de Janeiro 22070-002 Brazil" <?= (($hotel->address === "Av. Atlantica, 4240 Copacabana, Rio de Janeiro, State of Rio de Janeiro 22070-002 Brazil") ? "selected" : "") ?>>Av. Atlantica, 4240 Copacabana, Rio de Janeiro, State of Rio de Janeiro 22070-002 Brazil</option>
                  <option value="51 Bedford Street what3words Address: ///drift.every.atoms, London WC2R 0PZ England" <?= (($hotel->address === "51 Bedford Street what3words Address: ///drift.every.atoms, London WC2R 0PZ England") ? "selected" : "") ?>>51 Bedford Street what3words Address: ///drift.every.atoms, London WC2R 0PZ England</option>
                  <option value="Meadfoot Road, Torquay TQ1 2JP England" <?= (($hotel->address === "Meadfoot Road, Torquay TQ1 2JP England") ? "selected" : "") ?>>Meadfoot Road, Torquay TQ1 2JP England</option>
                  <option value="Rothenbaumchaussee 10, 20148 Hamburg Germany" <?= (($hotel->address === "Rothenbaumchaussee 10, 20148 Hamburg Germany") ? "selected" : "") ?>>Rothenbaumchaussee 10, 20148 Hamburg Germany</option>
                  <option value="10 Palace Place what3words Address: ///fairly.trim.behind, London SW1E 5BW England" <?= (($hotel->address === "10 Palace Place what3words Address: ///fairly.trim.behind, London SW1E 5BW England") ? "selected" : "") ?>>10 Palace Place what3words Address: ///fairly.trim.behind, London SW1E 5BW England</option>
                  <option value="914 Shimojiyonaha, Miyakojima 906-0305 Okinawa Prefecture" <?= (($hotel->address === "914 Shimojiyonaha, Miyakojima 906-0305 Okinawa Prefecture") ? "selected" : "") ?>>914 Shimojiyonaha, Miyakojima 906-0305 Okinawa Prefecture</option>
                  <option value="Javakade 766, 1019 SH Amsterdam The Netherlands" <?= (($hotel->address === "Javakade 766, 1019 SH Amsterdam The Netherlands") ? "selected" : "") ?>>Javakade 766, 1019 SH Amsterdam The Netherlands</option>
                  <option value="Andrassy ut 8., Budapest 1061 Hungary" <?= (($hotel->address === "Andrassy ut 8., Budapest 1061 Hungary") ? "selected" : "") ?>>Andrassy ut 8., Budapest 1061 Hungary</option>
                  <option value="No. 99 Sidi Moussa, Bahia, Marrakech 40000 Morocco" <?= (($hotel->address === "No. 99 Sidi Moussa, Bahia, Marrakech 40000 Morocco") ? "selected" : "") ?>>No. 99 Sidi Moussa, Bahia, Marrakech 40000 Morocco</option>
                  <option value="La Rambla, 109, 08001 Barcelona Spain" <?= (($hotel->address === "La Rambla, 109, 08001 Barcelona Spain") ? "selected" : "") ?>>La Rambla, 109, 08001 Barcelona Spain</option>
                  <option value="655 Burrard Street, Vancouver, British Columbia V6C 2R7 Canada" <?= (($hotel->address === "655 Burrard Street, Vancouver, British Columbia V6C 2R7 Canada") ? "selected" : "") ?>>655 Burrard Street, Vancouver, British Columbia V6C 2R7 Canada</option>
                  <option value="Grabovac 209, Grabovac, Plitvice Lakes National Park 47246 Croatia" <?= (($hotel->address === "Grabovac 209, Grabovac, Plitvice Lakes National Park 47246 Croatia") ? "selected" : "") ?>>Grabovac 209, Grabovac, Plitvice Lakes National Park 47246 Croatia</option>
                  <option value="Corner of Ayala and Makati Avenues, Makati, Luzon 1226 Philippines" <?= (($hotel->address === "Corner of Ayala and Makati Avenues, Makati, Luzon 1226 Philippines") ? "selected" : "") ?>>Corner of Ayala and Makati Avenues, Makati, Luzon 1226 Philippines</option>
                </select>
              </div>

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
                <button class="btn btn-warning" formaction="<?= APP_URL ?>/hotel-edit.php">Edit</button>
                <button class="btn btn-danger btn-festival-delete" formaction="<?= APP_URL ?>/hotel-delete.php">Delete</button>
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