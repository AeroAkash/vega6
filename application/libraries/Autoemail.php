<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require_once (APPPATH.'plugins/mandrill/src/Mandrill.php');

class Autoemail {
	private $ci;
    public function __construct(){
        $this->ci =& get_instance();
    }
	
	public function sendEmail($user_about,$query_content,$intrests,$contact_no,$cus_email,$cus_name){
		$to_email	='md@osculant.in';
		// $to_name	=$_post['name'];
		$content	="New Query|osculant";
		$bccemail	="mohit.osculant@gmail.com";
		$ccemail	="amit.osculant@gmail.com";	
		$subject	="Hello <b>Osculant</b>,<br>We have got a new query of <b>".$cus_name."</b>, please do contact as soon as possible.This customer is intreseted for ".$intrests." contact information of customer-:<br><br><b>	name=></b>'".$cus_name."'<br><b>Email=></b>".$cus_email."<br><b>contact no.=></b>".$contact_no.");?><br><b>Query =>".$query_content."";
        $this->sendEmailcontent($content,$subject,$to_email,$bccemail,$ccemail);
		
	}
    
	public function sendEmailcontent($subject,$content,$to_email,$bccemail,$ccemail){
      	
      		$smtphost 	='mail.osculant.in';
		$smtpport 	='587';
		$wemail 		='info@osculant.in';
		$wpass 		='whatanidea$irji';
		
		if($smtphost!='' && $smtpport!='' && $wemail!='' && $wpass!=''){
            
			// $userdata=array(
			// 	'name'=>$to_name,
			// 	'email'=>$to_email,
			// 	'subject'=>$subject,
			// 	'parent'=>$parent,
			// 	'userid'=>$userid,
			// );
			
			// $this->ci->db->insert('email_entry',$userdata);
			$config['protocol']		= 'smtp';
			$config['smtp_host']	= $smtphost;
			$config['smtp_port'] 	= $smtpport;
			// $config['smtp_crypto'] = 'ssl';
			$config['smtp_user'] 	=$wemail; // change it to yours
			$config['smtp_pass'] 	= $wpass; // change it to yours
			$config['mailtype'] 	= 'html';
			$config['charset']	= 'utf-8';
			//$config['wordwrap'] = TRUE;
			$this->ci->load->library('email');
			$this->ci->email->initialize($config);
			$this->ci->email->set_newline("\r\n");
			$this->ci->email->from($config['smtp_user'],'mohit','mohit.osculant.in');
			$this->ci->email->to($to_email);
			$this->ci->email->cc($ccemail);
			$this->ci->email->bcc($bccemail);
            		$this->ci->email->message($content); 
            		$this->ci->email->subject($subject);    
            
			
            if($data = $this->ci->email->send(FALSE)){
		//$this->ci->email-> print_debugger([$include = array('subject', 'body')]);
                echo "Mail sent...";   
            }elseif($data = $this->ci->email->send(FALSE)){
		#if($data = $this->ci->email->send(TRUE)){
		//$this->ci->email->print_debugger([$include = array( 'subject', 'body')]);
            	echo "NOT send".$data;
		//	print_r($include);
		//$this->ci->email->print_debugger([$include = array( 'subject', 'body')]);
            	// $this->sendEmailcontent($subject,$content,$to_email,$bccemail,$ccemail);
            }else{
		echo "we Missed it ";
		//$this->ci->email->send();
		}
			} //= $this->ci->email->send(FALSE))
		}
	}  
 ?>
