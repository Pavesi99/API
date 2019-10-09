<?php
        require 'vendor/autoload.php';
        use GuzzleHttp\Client;
        use GuzzleHttp\Exception\ClientException;
        $baseUrl = "http://api.openweathermap.org";
        $appid = 'f74ba7edc460a2c9cde725dc93e87075';
        $id = '3468879';
        
        
        //REcupera a validade do arquivo
        $dataCriacao = file_get_contents('cache/validade_tempo.txt');
        //300 = 5min
    if(time()  - $dataCriacao >= 300) {
        try{
        $client = new Client(array('base_uri' => $baseUrl));
        
        $response = $client->get('/data/2.5/weather', array(
            'query' => array('appid' => $appid, 'id' => $id)
        ));
        
        $tempo = json_decode($response->getBody());
        $dadosSerializados = serialize($tempo);
        file_put_contents('cache/dados_tempo.txt', $dadosSerializados);
        file_put_contents('cache/validade_tempo.txt',time()); 
          
        } catch (ClientException $e)
        {
            echo "ERRO: ", $e;
        }
    } else {
   $dadosSerializados = file_get_contents('cache/dados_tempo.txt');
   $tempo = unserialize($dadosSerializados);
   
    }
    
      $celsus = $tempo->main->temp-273;
             echo  "Celsus: ",$celsus;
            echo '</br>';
            echo  "Pressão: ",$tempo->main->pressure;
            echo '</br>';
            echo "Humidade: " ,$tempo->main->humidity;
            echo '</br>';
            echo $tempo->main->temp_min-273;
            echo '</br>';
            echo $tempo->main->temp_max-273;
            
        ?>

