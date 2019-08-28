<?php

//namespace App\Controller;

App::uses('AppController', 'Controller');
App::uses('Spotify', 'Model');


class SpotifyController extends AppController{ 
	public $theme = 'AdminLTE';

    public function index(){

	}

	public function search(){
		$this->autoRender = false;
		//var_dump($this->request);exit;
		$this->Spotify->set($this->request->query);

		if($this->Spotify->validates()) {
			return $this->Spotify->spotyfyFindAll($this->request->query['words']);
		}else{
			return json_encode($this->Spotify->validationErrors);
		}
	}
}