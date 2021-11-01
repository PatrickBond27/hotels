<?php require_once 'config.php';

try {
  $rules = [
    'hotel_id' => 'present|integer|min:1'
  ];
  $request->validate($rules);
  if (!$request->is_valid()) {
    throw new Exception("Illegal request");
  }
  $hotel_id = $request->input('hotel_id');
  /*Retrieving a customer object*/
  $hotel = Hotel::findById($hotel_id);
  if ($hotel === null) {
    throw new Exception("Illegal request parameter");
  }
} catch (Exception $ex) {
  $request->session()->set("flash_message", $ex->getMessage());
  $request->session()->set("flash_message_class", "alert-warning");

  $request->redirect("/hotel-index.php");
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Edit Hotel</title>

  <link href="<?= APP_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= APP_URL ?>/assets/css/template.css" rel="stylesheet">
  <link href="<?= APP_URL ?>/assets/css/style.css" rel="stylesheet">
  <link href="<?= APP_URL ?>/assets/css/form.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">


</head>

<body>
  <div class="container-fluid p-0">
    <?php require 'include/navbar.php'; ?>
    <main role="main">
      <div>
        <div class="row d-flex justify-content-center">
          <h1 class="t-peta engie-head pt-5 pb-5">Edit Hotel</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-8">
            <?php require "include/flash.php"; ?>
          </div>
        </div>

        <div class="row justify-content-center pt-4">
          <div class="col-lg-10">
            <form method="post" action="<?= APP_URL ?>/hotel-update.php" enctype="multipart/form-data">

              <!--This is how we pass the ID-->
              <input type="hidden" name="hotel_id" value="<?= $hotel->id ?>" />


              <div class="form-group">
                <label class="labelHidden" for="ticketPrice">Name</label>
                <input placeholder="Name" name="name" type="text" id="name" class="form-control" value="<?= old('name', $hotel->name) ?>" />
                <span class="error"><?= error("name") ?></span>
              </div>

              <!--textarea does not have a 'value' attribute, so in this case we have to put our php for filling in the old form data INSIDE the textarea tag.-->

              <div class="form-group">
                <label class="t-deci" for="address">Select your address</label>
                <select class="form-control" name="address" id="address">
                  <!--Check to see if the data in our form value was this location.-->
                  <option value="2864 S Pacific Ave, Cannon Beach, OR 97110-3153" <?= chosen("address", "2864 S Pacific Ave, Cannon Beach, OR 97110-3153", $hotel->address) ? "selected" : "" ?>>2864 S Pacific Ave, Cannon Beach, OR 97110-3153</option>
                  <option value="Rue Duquesnoy 5, Brussels 1000 Belgium" <?= chosen("address", "Rue Duquesnoy 5, Brussels 1000 Belgium", $hotel->address) ? "selected" : "" ?>>Rue Duquesnoy 5, Brussels 1000 Belgium</option>
                  <option value="33 Wilmington Ave, Rehoboth Beach, DE 19971-2218" <?= chosen("address", "33 Wilmington Ave, Rehoboth Beach, DE 19971-2218", $hotel->address) ? "selected" : "" ?>>33 Wilmington Ave, Rehoboth Beach, DE 19971-2218</option>
                  <option value="Av. Atlantica, 4240 Copacabana, Rio de Janeiro, State of Rio de Janeiro 22070-002 Brazil" <?= chosen("address", "Av. Atlantica, 4240 Copacabana, Rio de Janeiro, State of Rio de Janeiro 22070-002 Brazil", $hotel->address) ? "selected" : "" ?>>Av. Atlantica, 4240 Copacabana, Rio de Janeiro, State of Rio de Janeiro 22070-002 Brazil</option>
                  <option value="51 Bedford Street what3words Address: ///drift.every.atoms, London WC2R 0PZ England" <?= chosen("address", "51 Bedford Street what3words Address: ///drift.every.atoms, London WC2R 0PZ England", $hotel->address) ? "selected" : "" ?>>51 Bedford Street what3words Address: ///drift.every.atoms, London WC2R 0PZ England</option>
                  <option value="Meadfoot Road, Torquay TQ1 2JP England', '4', '+430 (791) 403-9253" <?= chosen("address", "Meadfoot Road, Torquay TQ1 2JP England', '4', '+430 (791) 403-9253", $hotel->address) ? "selected" : "" ?>>Meadfoot Road, Torquay TQ1 2JP England', '4', '+430 (791) 403-9253</option>
                  <option value="Rothenbaumchaussee 10, 20148 Hamburg Germany" <?= chosen("address", "Rothenbaumchaussee 10, 20148 Hamburg Germany", $hotel->address) ? "selected" : "" ?>>Rothenbaumchaussee 10, 20148 Hamburg Germany</option>
                  <option value="10 Palace Place what3words Address: ///fairly.trim.behind, London SW1E 5BW England" <?= chosen("address", "10 Palace Place what3words Address: ///fairly.trim.behind, London SW1E 5BW England", $hotel->address) ? "selected" : "" ?>>10 Palace Place what3words Address: ///fairly.trim.behind, London SW1E 5BW England</option>
                  <option value="914 Shimojiyonaha, Miyakojima 906-0305 Okinawa Prefecture" <?= chosen("address", "914 Shimojiyonaha, Miyakojima 906-0305 Okinawa Prefecture", $hotel->address) ? "selected" : "" ?>>914 Shimojiyonaha, Miyakojima 906-0305 Okinawa Prefecture</option>
                  <option value="Javakade 766, 1019 SH Amsterdam The Netherlands" <?= chosen("address", "Javakade 766, 1019 SH Amsterdam The Netherlands", $hotel->address) ? "selected" : "" ?>>Javakade 766, 1019 SH Amsterdam The Netherlands</option>
                  <option value="Andrassy ut 8., Budapest 1061 Hungary" <?= chosen("address", "Andrassy ut 8., Budapest 1061 Hungary", $hotel->address) ? "selected" : "" ?>>Andrassy ut 8., Budapest 1061 Hungary</option>
                  <option value="No. 99 Sidi Moussa, Bahia, Marrakech 40000 Morocco" <?= chosen("address", "No. 99 Sidi Moussa, Bahia, Marrakech 40000 Morocco", $hotel->address) ? "selected" : "" ?>>No. 99 Sidi Moussa, Bahia, Marrakech 40000 Morocco</option>
                  <option value="La Rambla, 109, 08001 Barcelona Spain" <?= chosen("address", "La Rambla, 109, 08001 Barcelona Spain", $hotel->address) ? "selected" : "" ?>>La Rambla, 109, 08001 Barcelona Spain</option>
                  <option value="655 Burrard Street, Vancouver, British Columbia V6C 2R7 Canada" <?= chosen("address", "655 Burrard Street, Vancouver, British Columbia V6C 2R7 Canada", $hotel->address) ? "selected" : "" ?>>655 Burrard Street, Vancouver, British Columbia V6C 2R7 Canada</option>
                  <option value="Grabovac 209, Grabovac, Plitvice Lakes National Park 47246 Croatia" <?= chosen("address", "Grabovac 209, Grabovac, Plitvice Lakes National Park 47246 Croatia", $hotel->address) ? "selected" : "" ?>>Grabovac 209, Grabovac, Plitvice Lakes National Park 47246 Croatia</option>
                  <option value="Corner of Ayala and Makati Avenues, Makati, Luzon 1226 Philippines" <?= chosen("address", "Corner of Ayala and Makati Avenues, Makati, Luzon 1226 Philippines", $hotel->address) ? "selected" : "" ?>>Corner of Ayala and Makati Avenues, Makati, Luzon 1226 Philippines</option>
                </select>
                <span class="error"><?= error("address") ?></span>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="venueDescription">Star Rating</label>
                <input placeholder="Star Rating" type="text" name="star_rating" id="star_rating" class="form-control" value="<?= old("star_rating", $hotel->star_rating) ?>" />
                <span class="error"><?= error("star_rating") ?></span>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="venueDescription">Phone Number</label>
                <input placeholder="Phone Number" type="text" name="phone_number" id="phone_number" class="form-control" value="<?= old("phone_number", $hotel->phone_number) ?>" />
                <span class="error"><?= error("phone_number") ?></span>
              </div>


              <div class="form-group">
                <label>Profile image:</label>
                <?php
                $image = Image::findById($hotel->image_id);
                if ($image != null) {
                ?>
                  <img src="<?= APP_URL . "/" . $image->filename ?>" width="150px" />
                <?php
                }
                ?>
                <input type="file" name="profile" id="profile" />
                <span class="error"><?= error("profile") ?></span>
              </div>

              <div class="form-group">
                <a class="btn btn-default" href="<?= APP_URL ?>/hotel-index.php">Cancel</a>
                <button type="submit" class="btn btn-primary">Store</button>
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