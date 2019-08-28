<?php
class Spotify extends AppModel {

	var $useTable = false;

	public $validate = array(
		'words' => array(
			'minLength' => array(
	            'rule' => array('minLength', 3),
	            'message' => 'Tu busqueda debe contener más de 3 letras',
	         ),
	        'slug' => array(
	            'rule' => 'custom',
	            'message' => 'Al parecer hay caracteres inválidos'
        	)
        )
	);

	public function custom($check) {
        $value = array_values($check);
        $value = $value[0];

        return preg_match('|^[0-9a-zA-Z%]*$|', $value);
    }

   	public function spotyfyFindAll($words){
    	$this->setDataSource('spotify');
      	$spotify = $this->getDataSource();
      	return $spotify->findAll($words);
   	}
   	
}