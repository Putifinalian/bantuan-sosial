<?php
// require_once realpath(__DIR__ . '/../../../helpers/middleware.php');
require_once realpath(__DIR__ . '/../../../helpers/create_id.php');
class User_model extends CI_Model
{
    function login_user($username,$password)
    {
        $query = $this->db->get_where('users', array('username'=>$username));
        
        if($query->num_rows() > 0) {
            $data_user = $query->row();
            $password = MD5($password);
            $this->db->where("username='$username'");
            $this->db->where("password='$password'");
            $result = $this->db->get('users')->result();

            if(!empty($result)) {
                $this->session->set_userdata('id_users', $data_user->id_users);
                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('name', $data_user->name);
                $this->session->set_userdata('tipe_user', $data_user->tipe_user);
                $this->session->set_userdata('is_login', true);
                
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function register($name, $username, $password, $role)
    {

        $query = $this->db->get_where('users', array('username'=>$username));
        if($query->num_rows() > 0) {
            return [
                "status" => false,
                "msg" => "USERNAME UDAH ADA"
             ];
        }
        $id_users = CreateId::init($this->db, "USR", "users");
        $data = array(
            'id_users' => $id_users,
            'name' => $name,
            'username' => $username,
            'password' => MD5($password),
            'tipe_user' => $role,
        );

        $this->db->insert('users', $data);
        $this->session->set_userdata('id_users', $id_users);
        $this->session->set_userdata('username', $username);
        $this->session->set_userdata('name', $name);
        $this->session->set_userdata('tipe_user', $role);
        $this->session->set_userdata('is_login', true);
        return [
           "status" => true,
           "msg" => ""
        ];
    }
}
?>
