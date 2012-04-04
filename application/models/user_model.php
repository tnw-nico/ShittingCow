<?php

class User_Model extends CI_Model {

	public function save_social_user($service, $service_id, $data) {

		$user = $this->db->get_where('users', array('service' => $service, 'serviceId' => $service_id), 1);

		$user = $user->result();

		if (count($user) != 0)
		{
			return false;
		}
		$save_data = array(
			'service' => $service,
			'serviceId' => $service_id,
			'data' => json_encode($data),
			'ip' => ip2long($_SERVER['REMOTE_ADDR']),
			'avatar' => $this->_get_avatar($service, $service_id,  $data),
			'screenname' =>$this->_get_screenname($service, $service_id, $data),
			'votedate' => date('Y-m-d H:i:s',time())
		);
		if ($this->db->insert('users', $save_data) === FALSE) {
			return false;
		} else {
			return $this->db->insert_id();
		}
	}

	public function _get_avatar($service, $service_id, $data) {
		switch($service)
		{
			case 'twitter':
				if (isset($data['user']->profile_image_url)) {
					return $data['user']->profile_image_url;
				}
				break;
			case 'facebook':
				return 'https://graph.facebook.com/' . $service_id . '/picture';
				break;
			default:
				return NULL;
		}
		return NULL;
	}

	public function _get_screenname($service, $service_id, $data) {

		switch($service)
		{
			case 'twitter':
				if (isset($data['user']->name)) {
					return $data['user']->name;
				}
				break;
			case 'facebook':
				if (isset($data->name)) {
					return $data->name;
				} else {
					return 'John Doe[]';
				}
				break;
			default:
				return NULL;
		}
		return NULL;
	}


}