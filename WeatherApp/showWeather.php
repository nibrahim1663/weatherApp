<!-- 
   Discription	: In this file, we use the value stored in the session variables based on what we wanted to 
                  show on the weather app. For example, I have chosen the name of the city, country, temp,
                  visibility, min/max temp, wind speed, hummidity and even implemented some PHP functions to
                  grab the date for example.
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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="style2.css">
    </head>
    <body>
        <?php
            // Retrieve the values from sesssion variables
            $cityName = $_SESSION["mycity"];
            $result = $_SESSION["returnedResult"];
        ?>
        <div class="frame">
            <!-- Grab the temprature and round it to get it in Celius -->
            <h1><?php echo round($result['main']['temp']-273.15);?>°</h1>
            <!-- Grab the weather discription -->
            <h3><?php echo $result['weather'][0]['description'];?></h3>
            <!-- Grab the feels like temprature and round it to get it in Celius -->
            <h4>Feels like <?php echo round($result['main']['feels_like']-273.15);?>°</h4>
            <div class="moon">
                <div class="moon-crater1"></div>
            </div>
            <div class="front">
                    <div>
                        <div>
                            <!-- Grab the wind speed -->
                            <div class="info">Wind Speed <?php echo $result['wind']['speed'];?> km/h <br> <br>
                            <!-- Grab the hummidity in % -->
                            Humidity <?php echo round($result['main']['humidity']);?>%
                            </div>
                            <table class="preview">
                                <tbody>
                                    <tr>
                                        <!-- Grab the min temprature and round it to get it in Celius -->
                                        <td>Min Temp <?php echo round($result['main']['temp_min']-273.15);?>°</td>
                                    </tr>
                                    <tr>
                                        <!-- Grab the max temprature and round it to get it in Celius -->
                                        <td> Max Temp <?php echo round($result['main']['temp_max']-273.15);?>°</td>
                                    </tr>
                                    <tr>
                                        <!-- Grab the visibility in meters -->
                                        <td>Visibility <?php echo $result['visibility'];?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            <!-- Grab the city name as well as the country name -->
                <div class="cityName"><?php echo $result['name'] . ", " . $result['sys']['country']?><br>
                <!-- Get the current date -->
                <?php echo date('D, d-M-Y');?>
            </div>
        </div>
    </body>
</html>