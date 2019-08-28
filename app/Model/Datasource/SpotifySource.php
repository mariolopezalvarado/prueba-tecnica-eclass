<?php

class SpotifySource extends DataSource{
   var $description = 'Spotify DataSource';
   var $data;
   var $token;
   public function __construct($config=null){
      parent::__construct($config);
      $this->connected = $this->connect();
      return $config;
   }
   public  function __destruct(){
      $this->connected = $this->close();
      parent::__destruct();
   }
   public function connect(){
      $client_id = 'e2b4b030f2ab401b982fa69659de20e3'; 
      $client_secret = 'b3a689d9715244b0b9af437f4457c039'; 

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,'https://accounts.spotify.com/api/token' );
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials'); 
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic  '.base64_encode($client_id.':'.$client_secret))); 

      $this->token = json_decode(curl_exec($ch))->access_token;

      curl_close($ch);
      
         return true;



   }

   public function findAll($words){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,'https://api.spotify.com/v1/search?q='.$words.'&type=artist%2Calbum%2Ctrack&limit=50' );
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$this->token));

      $this->data = curl_exec($ch);

      curl_close($ch);
      return $this->data;
   }
}