<?php
  $apiKey = "8a1a3cc956c204ebbbd40834bdd9dc38";
  $citycode = "2147714";
  $apikey = "http://api.openweathermap.org/data/2.5/weather?id=" . $citycode . "&lang=en&units=metric&APPID=" . $apiKey;


  $ch = curl_init();

  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $apikey);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_VERBOSE, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $response = curl_exec($ch);

  curl_close($ch);
  $data = json_decode($response);
  $currentTime = time();

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap styles - unminified -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <title>PHP Weather forecase using OpenWeatherMap API</title>
  </head>

  <body class="bg-light">
    <main role="main" class="container bg-white rounded shadow-sm col-xs-12 col-md-6 col-xs-offset-0 col-md-offset-2 mt-md-3 mt-xs-0">
      <div class="row p-3 border-bottom">
        <div class="col">
          <h1 class="h3"><?php echo $data->name; ?> <?php echo $data->sys->country; ?> weather</h1>
        </div>
      </div>

      <section aria-live="assertive" aria-atomic="true">
        <div class="row border-bottom pt-3">
          <div class="col-xs-12 col-md-8 offset-xs-0 offset-md-2">

            <div class="row">
              <div class="col-12">
                <h2><small><?php echo date("l jS F, Y",$currentTime); ?></small></h2>
              </div>

              <div class="col-xs-12 col-sm-6">
                <figure>
                  <img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" class="img-fluid col-12" alt="" role="presentation" />
                </figure>
              </div>

              <div class="col-xs-12 col-sm-5">
                <ul class="small pt-3">
                  <li>Min temp: <?php echo $data->main->temp_min; ?>&deg;C</li>
                  <li>Max temp: <?php echo $data->main->temp_max; ?>&deg;C</li>
                  <li>Humidity: <?php echo $data->main->humidity; ?> %</li>
                  <li>Wind speed: <?php echo $data->wind->speed; ?> km/h</li>
                  <li>Conditions: <?php echo ucwords($data->weather[0]->description); ?></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>

      <aside aria-atomic="true" aria-live="assertive" class="pt-3 pb-3">
      </aside>
      <div>
        <?php
          print_r($data);
          foreach($data['list'] as $day => $value) {
            echo $day . " " . $value[main][temp] . " " . $value[humidity] . " <br />" ;
          }
        ?>
      </div>

    </main>

    <!-- jQuery first, then Bootstrap JS minified -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
