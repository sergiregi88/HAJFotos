<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo_art_model extends MY_Model {

	public function __construct() {
            parent::__construct();

            $this->setTable("photos_art");
        }

}

/* End of file albums_model.php */
/* Location: ./application/models/albums_model.php */