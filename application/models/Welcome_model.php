<?php
  
  class Welcome_model extends CI_Model
  {
    public function sign_in(){
      $input = $this->input->post();

      $result = $this->db->where("email" , $input['email'])->where('password' , $input['password'])->get('all_user')->result_array()[0];
      return $result;
    }

    public function sign_up(){
      $input = $this->input->post();

      $data = [
        'name'    =>$input['name'],
        'email'   =>$input['email'],
        'password'=>$input['password']
      ];

      $result = $this->db->where('email' , $input['email'])->get('all_user')->result_array();

      if(empty($result)){
        $this->db->insert('all_user',$data);
        $last_id = $this->db->insert_id();

        if(!empty($last_id)){
          echo json_encode([
            'status' => true,
            'message' => 'User Detail Are Successfully Store'
          ]);
        }
        else{
          echo json_encode([
            'status' => false,
          ]);
        }
      }
      else{
        echo json_encode([
          'status' => false,
          'message' => 'This Email Are Already Register'
        ]);
      }

    }
  }
?>