<?php
require_once 'config.php';

try {
    

    // Array of locations, this is used for the location validation rule - see line 18
    $address = [
        "2864 S Pacific Ave, Cannon Beach, OR 97110-3153",  "Rue Duquesnoy 5, Brussels 1000 Belgium",
        "33 Wilmington Ave, Rehoboth Beach, DE 19971-2218", "Av. Atlantica, 4240 Copacabana, Rio de Janeiro, State of Rio de Janeiro 22070-002 Brazil",
        "51 Bedford Street what3words Address: ///drift.every.atoms, London WC2R 0PZ England", "Meadfoot Road, Torquay TQ1 2JP England", 
        "Rothenbaumchaussee 10, 20148 Hamburg Germany", "10 Palace Place what3words Address: ///fairly.trim.behind, London SW1E 5BW England",
        "914 Shimojiyonaha, Miyakojima 906-0305 Okinawa Prefecture", "Javakade 766, 1019 SH Amsterdam The Netherlands",
        "Andrassy ut 8., Budapest 1061 Hungary", "No. 99 Sidi Moussa, Bahia, Marrakech 40000 Morocco", 
        "La Rambla, 109, 08001 Barcelona Spain", "655 Burrard Street, Vancouver, British Columbia V6C 2R7 Canada",
        "Grabovac 209, Grabovac, Plitvice Lakes National Park 47246 Croatia", "Corner of Ayala and Makati Avenues, Makati, Luzon 1226 Philippines"
    ];

    $rules = [
        "name" => "present|minlength:2|maxlength:64",
        "address" => "present|in:" . implode(',', $address),
        "star_rating" => "present|minlength:10|maxlength:10",
        "phone_number" => "present|minlength:4|maxlength:255",
        //2 or 3 digits then a -, then between 5 to 7 more numbers
        //"contact_phone" => "present|match:/\A[0-9]{2,3}[-][0-9]{5,7}\Z/",

    ];

    $request->validate($rules);
    if ($request->is_valid()) {
        //Pass the name of the file upload button as a parameter
        $file = new FileUpload("profile");
        //Get our new FileUpload object, which is stored in a temporary folder on our web server
        $filename = $file->get();
        //Create an image object and store the file path in that object.
        $image = new Image();
        /*Save the pathname for where the image is stored in the database*/
        $image->filename = $filename;
        $image->save();

        // !!Check .... If your Image is saved to the Database, but your 'Festival' has not, you know code is correct to at least this point ...

        // Create an empty $festival object
        $hotel = new Hotel();

        // festival-create.php passed title, description, location etc... in it's request object
        // not get title, description, location etc from the request object and assign these values to the appropriate attributes in the $festival object. 
        $hotel->name = $request->input("name");
        $hotel->address = $request->input("address");
        $hotel->star_rating = $request->input("star_rating");
        $hotel->phone_number = $request->input("phone_number");

        // When the Image was saved to the database ($image->save() above) and ID was created for that image. 
        // Now get that id from the $image, and assign it to $festival->image_id so it can be saved as in the festival table as a foreign key. 
        $hotel->image_id = $image->id;
        
        // save() is a function in the Festival class, you will have written part of it - to update an existing festival
        // now you will add more code to the save() function so it can create a new festival or update an existing festival.  
        $hotel->save();


        $request->session()->set("flash_message", "The hotel was successfully added to the database");
        //Class that changes the appearance of the Bootstrap message.
        $request->session()->set("flash_message_class", "alert-info");
        $request->session()->forget("flash_data");
        $request->session()->forget("flash_errors");
        // redirect back to the home page - festival-index.php
        $request->redirect("/hotel-index.php");
    } else {
        //Get all session data from the form and store under the key 'flash_data'.
        $request->session()->set("flash_data", $request->all());
        $request->session()->set("flash_errors", $request->errors());

        //Redirect the user to the create page.
        $request->redirect("/hotel-create.php");
    }
} catch (Exception $ex) {
    /*Get all data and errors again and redirect.*/
    $request->session()->set("flash_message", $ex->getMessage());
    $request->session()->set("flash_message_class", "alert-warning");
    $request->session()->set("flash_data", $request->all());
    $request->session()->set("flash_errors", $request->errors());
    $request->redirect("/hotel-create.php");
}
