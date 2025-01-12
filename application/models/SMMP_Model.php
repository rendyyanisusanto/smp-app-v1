<?php
/**
 * Name:    Ion Auth Model
 * Author:  Ben Edmunds
 *           ben.edmunds@gmail.com
 * @benedmunds
 *
 * Added Awesomeness: Phil Sturgeon
 *
 * Created:  10.01.2009
 *
 * Description:  Modified auth system based on redux_auth with extensive customization. This is basically what Redux Auth 2 should be.
 * Original Author name has been kept but that does not mean that the method has not been modified.
 *
 * Requirements: PHP5 or above
 *
 * @package    CodeIgniter-Ion-Auth
 * @author     Ben Edmunds
 * @link       http://github.com/benedmunds/CodeIgniter-Ion-Auth
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Ion Auth Model
 * @property Bcrypt $bcrypt The Bcrypt library
 * @property Ion_auth $ion_auth The Ion_auth library
 */
class SMMP_Model extends CI_Model
{
	
	public function get_profil_website()
	{
		return $this->db->get('profil_website')->row_array();
	}

	public function save($tabel, $data)
	{
		return $this->db->insert($tabel, $data);
	}

	public function get_where($tabel, $where)
	{
		return $this->db->get_where($tabel, $where);
	}

	public function get_query($query)
	{
		return $this->db->query($query);
	}

	public function set_update($tabel, $data, $where)
	{
		foreach ($where as $key => $value) {
			$this->db->where($key, $value);
		}
		return $this->db->update($tabel, $data);
	}
}