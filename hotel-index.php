<?php require_once 'config.php'; 

// We don't have a login yet so I have this commented out.
// if (!$request->is_logged_in()) {
//   $request->redirect("/login-form.php");
// }
?>
<?php
try {
    // You will learn more about sessions later
    $request->session()->forget("flash_data");
    $request->session()->forget("flash_errors");

    // Call the findAll() function in classes/Festival.php
    // This function returns an array $festivals[] which is retrieved from the database
    $hotels = Hotel::findAll();
}
// If there were any exceptions thrown in the above try block they will be caught here and put into the session data.
catch (Exception $ex){
    $request->session()->set("flash_message", $ex->getMessage());
     $request->session()->set("flash_message_class", "alert-warning");
    $hotels = [];
    
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hotel Index</title>

    <link href="<?= APP_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= APP_URL ?>/assets/css/template.css" rel="stylesheet">
      
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    
      
    <link rel="stylesheet" type="text/css" href="assets/css/myStyle.css">
  </head>
  <body>
   
      <?php require 'include/navbar.php'; ?>
      <?php require "include/flash.php"; ?>
      
    <div class="container-fluid">
      <main role="main">

        <div class="row">
            <div class="col table-responsive">
            <h1>Hotels
                 <!-- The add button will call festivals-create.php, the create will be implemented at a later stage -->
                 <a class="btn button float-right" href="<?= APP_URL ?>/hotel-create.php">Add</a>
                </h1>
                <form method="get">
                  <!-- I changed the table with my attributes -->
              <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Star Rating</th>
                    <th>Phone Number</th>
                    <th>Image</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <!-- Loop through the following for every item in the $festivals[] array, display title, description, location etc. to the screen -->
                  <?php foreach ($hotels as $hotel) { ?>
                    <tr>
                      <!-- a radio button will display for each festival, the user can choose one festival then choose the View button below -->
                      <td><input type="radio" name="hotel_id" value="<?= $hotel->id ?>" /> </td>
                      <td><?= $hotel->name ?></td>
                      <td><?= substr($hotel->address, 0, 30) ?></td>
                      <td><?= $hotel->star_rating ?></td>
                      <td><?= $hotel->phone_number ?></td>
                        <td>
                        <?php
                            // We have the image_id for the festival, now call findById(image_id) in the class Image.php
                            // Image:: findById($image_id) will go to the database to get the image filename from the Image table 
                            $image = Image::findById($hotel->image_id);
                            if ($image !== null){
                                ?>
                                <img src="<?= APP_URL . "/" . $image->filename ?>" width="50px" alt="image" />
                        <?php
                            }
                            ?>
                        </td>                
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
                <!-- View, Edit and Delete buttons link to the appropriate php file. In this version you will implement festival-view.php -->
                <!-- I changed the View button from festival-view to hotel-view -->
                <button class="btn button btn-festival" formaction="<?= APP_URL ?>/hotel-view.php">View</button>
                <button class="btn button btn-festival" formaction="<?= APP_URL ?>/hotel-edit.php">Edit</button>
                <button class="btn button btn-festival btn-festival-delete" formaction="<?= APP_URL ?>/hotel-delete.php">Delete</button>
                </form>
            </div>
          </div>
      </main>
    </div>
      
   <?php require 'include/footer.php'; ?>
      
    <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= APP_URL ?>/assets/js/festival.js"></script>
  </body>
</html>