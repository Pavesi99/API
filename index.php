<?php
        require 'vendor/autoload.php';
        use GuzzleHttp\Client;
        $baseUrl = "https://api.openweathermap.org";
        $appid = 'f74ba7edc460a2c9cde725dc93e87075';
        $id = '3468879';
        $client = new Client(array('base_uri' => $baseUrl));
        
        $response = $client->get('/data/2.5/weather', array(
            'query' => array('appid' => $appid, 'id' => $id)
        ));
        
print_r($response);
        ?>

