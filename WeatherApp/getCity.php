<!-- 
   Programmer	: Nawriz Ibrahim
   Project		: In-Class Task 10
   Date		   : 27-November-2022
   Discription	: In this task, we Create a webpage to get the weather of a city based on the name of the 
                 city entered in the input box using CURL to show the data from weather API.
 -->
<?php
   // Start the session
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Nawriz Weather WebApp</title>
   <link rel="stylesheet" href="style1.css">
</head>
<body>
   <?php
      // Declare some variables 
      $cityName = "";
      $found = false;  
      $errorMsg = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") 
      {
         // Grab the city name value entered by the user
         $cityName = $_POST['cityName'];

         // On clicking Get Weather button
         if(isset($_POST['submit']))
         {
            // We check if city name not blank nor has numbers
            if (empty($cityName) || ctype_space($cityName) || !preg_match("/^[a-zA-Z-' ]*$/", $cityName))
            {
               // Yes, store following error msg to be displayed to user
               $errorMsg = "Error - City name is required!";
            }
            else
            {
               // No, then grab the URL of the API that we want to use
               $url = "https://api.openweathermap.org/data/2.5/weather?q=$cityName&appid=54c4a1af4d1f613e13556adca1cc3d97";
      
               // Initialize a CURL session.
               $ch = curl_init();
            
               // Return Page contents.
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            
               // Grab URL and pass it to the variable.
               curl_setopt($ch, CURLOPT_URL, $url);
               
               // Execute it
               $result = curl_exec($ch);

               // Decode it into JSON
               $result =  json_decode($result, true);

               // Happy path?
               if($result['cod']!=200)
               {
                  //No, then display error
                  $errorMsg = "Error - " . $cityName . " is not found!";
               }
               else
               {
                  // Otherwise, we save valid city name as well as the result into session variables so we can use
                  // them later
                  $_SESSION["mycity"] = $cityName;
                  $_SESSION["returnedResult"] = $result;
                  
                  // Then, we redirect to new page to show the result
                  header("Location: showWeather.php");
               }
            }
         }
      }
   ?>
   <h1>Welcome to Nawriz Weather WebApp</h1>
   <div class="frame">
      <form action="getCity.php" method="POST">
         <br>&nbsp;
         <label for="cityName">Please enter a city name</label>
         <input type="text" name="cityName" id="cityName" value="<?php echo $cityName;?>" placeholder="City Name"> <br><br>
         <input type="submit" value="Get Weather" name="submit"><br><br>&nbsp;
         <span style="color:red;"><?php echo $errorMsg;?></span>
      </form>
   </div>
</body>
</html>