<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cover_model extends MY_Model {

	public function __construct() {
            parent::__construct();

            $this->setTable("cover");
        }

}

/* End of file albums_model.php */
/* Location: ./application/models/albums_model.php */