<?php
class Users_actions extends CI_model
{
    function email_exists($data)
    {
            if (isset($data)) {
                    $this->db->where('email', $data);
            }
			$query = $this->db->get("user");
            return $query->num_rows();
	}

	function get_user_details_by_email($email)
	{
		return $this->db->select('nume', FALSE)->where('email',$email)->get('user')->row_array();
	}
	
	function update_password_by_email($email) {
		//generare parola random
		$password_to_send=rand(100000,9999999);
		$password=md5($password_to_send);
		$this->db->where('email', $email);
		$this->db->update("user", array("password" => $password));
		return $password_to_send;
	}

    public function checkChilds($id)
	{
		$query="SELECT `id_user` FROM `contact` WHERE `id_user`=".(int)$id;
		$childs=$this->db->query($query)->result();
		
		
		$childs_array=(array)$childs;
		if(empty($childs_array))
			return false;
	
		if(count($childs)<2) return $id;
		else
		{
			foreach($childs as $child)
			{
				$query="SELECT `id_user` FROM `contact` WHERE `sponsor`=".$child->id_user;
				$nephews=$this->db->query($query)->result();

				if(count($nephews)<2) return $child->id_user;				
			}
		
		}
	
	return $id;
	}
	
	public function getEarnedOffered($user,$frunza)
	{
		$rez = $this->db->select('IFNULL(SUM(cs.suma),0) as suma ', FALSE)
						   ->join("tickets tk","cs.ticket=tk.ticket", "LEFT")
						   ->where('tk.status',2)
						   ->where('cs.id_user',$user)
						   ->where('cs.id_user_from',$frunza)
						   ->get('castiguri cs')->row_array();
		
		return $rez['suma'];
	}
	//castigul user-ului curent
	public function getTotalReceived($user)
	{
		
		$rez = $this->db->select('IFNULL(SUM(tk.valoare),0) as suma ', FALSE)
		->where('tk.status',2)
		->where('tk.id_user',$user)
		->get('tickets tk')->row_array();
		$suma = $rez["suma"];
		$network = array();
		$network=$this->getNetwork($user,$network);
		$total=0.00; 
		foreach($network as $key=>$level)
		{
			//if($suma<500) break;
			//else if($suma<2100 && $key>3) break;
			//else if($suma<4900 && $key>7) break;
			
			foreach($level as $leaf)
			{
				$CastigOferit=$this->getEarnedOffered($user,$leaf->id); 
				$total+=$CastigOferit;
			}
		}
	
		return number_format($total,2);
	}	
    
    //scoate copii userului
	public function getUserParents($id,&$network)
	{
		if(!isset($id) || (int)$id==0) return false;
	
		$query="SELECT us.`id`,ct.`sponsor`
				FROM `contact` ct
				LEFT JOIN `user` us ON ct.`sponsor`=us.`id`
				WHERE ct.`id_user`=".$id;
		$parents=$this->db->query($query)->result();
	
		
		foreach($parents as $parent)
		{
			if($parent->sponsor!=0)
			{
				if(count($network)<10)
				{
					
					
					$network[]=$parent->id;
					$this->getUserParents($parent->id,$network);
				}
			}
		}
    }
    
    //get the email contact wanted by admin
	public function getContactEmail()
	{
		$query=$this->db->query("SELECT `email` FROM `administrator` WHERE `id`=1")->row_array();
		
        return $query['email'];	
    }

    //check the data sent by user when try to log in
	public function getLogApprove($data)
	{
		$email=$data['email'];
	
		$query="SELECT * FROM `user` us
				WHERE `username`='".stripslashes($email)."' AND `password`='".md5($data['password'])."' AND `status`=1";		
		$exeQuery=$this->db->query($query)->row_array();
		
		
		$query="SELECT * FROM `administrator`
				WHERE `email`='".stripslashes($email)."' AND `password`='".md5($data['password'])."' ";		
		$exeQueryAdmin=$this->db->query($query)->row_array();
		if(isset($exeQuery) && count($exeQuery))
		{
			$user_info = $exeQuery;
           
			//tipul de user			
            $table=	$user_info['tip']==1? 'contact':'firma';
			$child= $user_info['tip']==1? 'id_user':'id_firma';
			
			//informatii suplimentare
			$query="SELECT * FROM `".$table."`
					WHERE `".$child."`=".$user_info['id'];	
            $user_info=$this->db->query($query)->row_array();
			$this->session->set_userdata(array("user" => $exeQuery));	
          
			return true;
		}elseif(count($exeQueryAdmin))
		{
			$exeQueryAdmin['tip'] = 3;
			$this->session->set_userdata(array("user" => $exeQueryAdmin));	
			return true;
		}

			
	return false;		
	}

	function getUserSettings($settingName,$userId) {
		return $this->db->select(array('settings_id','settings_name','settings_value'))->where('settings_name',$settingName)->where('settings_user_id',$userId)->get('user_settings')->row_array();	
	}

	function updateUserSettings($settingName,$settingValue,$userId) {
		$this->db->where('settings_user_id', $userId);
		$this->db->where('settings_name', $settingName);
		$this->db->update('user_settings', array("settings_value" =>$settingValue));
	}

	function insertUserSettings($data) {
		$this->db->insert('user_settings', $data);
	}

	//scoate copii userului
	public function getUserChilds($id=null,$nivel=1,&$network)
	{
	
		if(!isset($id) || (int)$id==0) return false;
		$childs = $this->db->select('us.id ,us.nume ,us.localitate ', FALSE)
						   ->join("user us","ct.id_user =us.id", "LEFT")
						   ->where('ct.sponsor', $id)
						   ->group_by('us.id')
						   ->get('contact ct')->result();
		
		if($nivel<=10)
		{
			foreach($childs as $child)
			{
				$network[$nivel][]=$child;
				
				if($this->counts($child->id)>0)
				{			
					$nivel++;
					$this->getUserChilds($child->id,$nivel,$network);
					$nivel--;
				}			
			}
		}
	}

	//get the array from **getUserChilds** function and return
	function getNetwork($id) 
	{
		$network=array();
		$this->getUserChilds($id,1,$network);
		return $network;
	}

	//count subcategories
	public function counts($id)
	{
	   $rows = $this->db->select('COUNT(*) AS cnt', FALSE)
						   ->join("user us","ct.id_user =us.id", "LEFT")
						   ->where('ct.sponsor', $id)
						   ->where('us.status', 1)
						   ->get('contact ct')->row_array();
	   return $rows['cnt'];
	}

	//scoate castigul oferit de fiecare copil al user-ului
	public function getOfferedGain($user,$child)
	{
		$row = $this->db->select('IFNULL(SUM(cs.suma),0) as suma', FALSE)
		->join("tickets tk","cs.ticket = tk.ticket", "LEFT")
		->where('tk.status', 2)
		->where('cs.id_user', $user)
		->where('cs.id_user_from', $child)
		->get('castiguri cs')->row_array();
		
		return $row['suma'];
	}

	//get total tickets value that user bought
	public function getUserTicketsValue($user)
	{
		
		$row = $this->db->select('IFNULL(SUM(tk.valoare),0) as suma', FALSE)
		->where('tk.id_user', $user)
		->where('tk.status', 2)
		->get('tickets tk')->row_array();
		
		return $row['suma'];
	}

	function updateUserDetails($data,$userId) {
		$this->db->where('id', $userId);
		$this->db->update('user', $data);
	}

	function updateUserContactDetails($data,$userId) {
		$this->db->where('id_user', $userId);
		$this->db->update('contact', $data);
	}
	
	function getUserDetails($userId) {
		return $this->db->select('ct.id as contact_id,ct.sponsor,ct.sex,ct.data_nasterii,ct.iban,ct.banca, us.*', FALSE)
						   ->join("user us","ct.id_user =us.id", "LEFT")
						   ->where('us.id', $userId)
						   ->get('contact ct')->row_array();
	}

	function checkOldPassword($password,$userId) {
		return $this->db->select('count(*) as nr', FALSE)
						   ->where('password', md5($password))
						   ->where('id',$userId)
						   ->get('user')->row_array();
	}

	function checkEmail($email) {
		return $this->db->select('count(*) as nr', FALSE)
						   ->where('email', $email)
						   ->get('user')->row_array();
	}

	function checkEmailToken($token) {
		return $this->db->select('*', FALSE)
						   ->where('tokenChangeEmail', $token)
						   ->get('user')->row_array();
	}

	function insertUserSectionAccess($data)
	{
		$this->db->insert('users_sections_access', $data);
	}

	function checkUserSectionAccess($data)
	{
		return $this->db->select('*', FALSE)
						   ->where('user_section_access_class_name', $data['user_section_access_class_name'])
						   ->where('user_section_access_method_name', $data['user_section_access_method_name'])
						   ->where('user_section_access_user_type', $data['user_section_access_user_type'])
						   ->where('user_section_access_allowed', 1)


						   
						   ->get('users_sections_access')->row_array();
	}

}
?>