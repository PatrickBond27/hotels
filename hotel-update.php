<?php
require_once 'config.php';

try {
    // $request = new HttpRequest();

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
        "hotel_id" => "present|integer|min:1",
        "name" => "present|minlength:2|maxlength:64",
        "address" => "present|in:" . implode(',', $address),
        "star_rating" => "present|minlength:10|maxlength:10",
        "phone_number" => "present|minlength:4|maxlength:255",
        //2 or 3 digits then a -, then between 5 to 7 more numbers
        //"contact_phone" => "present|match:/\A[0-9]{2,3}[-][0-9]{5,7}\Z/",

    ];

    $request->validate($rules);
    if ($request->is_valid()) {
        $image = null;
        if (FileUpload::exists('profile')) {
            //If a file was uploded for profile,
            //create a FileUpload object
            $file = new FileUpload("profile");
            $filename = $file->get();
            //Create a new image object and save it.
            $image = new Image();
            $image->filename = $filename;

            // you must implement save() function in the Image.php class
            $image->save();
        }
        $hotel = Hotel::findById($request->input("hotel_id"));
        $hotel->name = $request->input("name");
        $hotel->address = $request->input("address");
        $hotel->star_rating = $request->input("star_rating");
        $hotel->phone_number = $request->input("phone_number");
        /*If not null, the user must have uploaded an image, so reset the image id to that of the one we've just uploaded.*/
        if ($image !== null) {
            $hotel->image_id = $image->id;
        }

        // you must implement the save() function in the Festival class
        $hotel->save();

        $request->session()->set("flash_message", "The hotel was successfully updated in the database");
        $request->session()->set("flash_message_class", "alert-info");
        /*Forget any data that's already been stored in the session.*/
        $request->session()->forget("flash_data");
        $request->session()->forget("flash_errors");

        $request->redirect("/hotel-index.php");
    } else {
        $hotel_id = $request->input("hotel_id");
        /*Get all session data from the form and store under the key 'flash_data'.*/
        $request->session()->set("flash_data", $request->all());
        /*Do the same for errors.*/
        $request->session()->set("flash_errors", $request->errors());

        $request->redirect("/hotel-edit.php?hotel_id=" . $hotel_id);
    }
} catch (Exception $ex) {
    //redirect to the create page...
    $request->session()->set("flash_message", $ex->getMessage());
    $request->session()->set("flash_message_class", "alert-warning");
    $request->session()->set("flash_data", $request->all());
    $request->session()->set("flash_errors", $request->errors());

    // not yet implemented
    $request->redirect("/hotel-create.php");
}
