<?php
class Users_actions extends CI_model
{
    function email_exists($data)
    {
            if (isset($data)) {
                    $this->db->where('email', $data);
                    $this->db->where('email !=', '');
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
		$query="SELECT `id_user` FROM `contact` WHERE `sponsor`=".(int)$id;
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

		if(count($exeQuery))
		{
			$user_info = $exeQuery;
           
			//tipul de user			
            $table=	$user_info['tip']==1? 'contact':'firma';
			$child= $user_info['tip']==1? 'id_user':'id_firma';
			
			//informatii suplimentare
			$query="SELECT * FROM `".$table."`
					WHERE `".$child."`=".$user_info['id'];	
            $user_info=$this->db->query($query)->row_array();
            //echo "<pre>";
            //var_dump( $user_info);die();
			//$user_info->params = $exeQuery;	
			$this->session->set_userdata(array("user" => $exeQuery));	
          
			return true;
		}
			
	return false;		
	}
}
?>