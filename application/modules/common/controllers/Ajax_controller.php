<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_controller extends CI_Controller {

	function __construct() {
		parent::__construct();
		is_ajax();
	}
	public function check_availability()
	{
		$accept="";
		$data=$this->input->post();
		$table=$data['table'];
		$column=$data['column'];
		$value=$data['value'];
		if(isset($data['accept'])){
			$accept=$data['accept'];
		}
		if($value!=$accept){
			$res=$this->custom->getSingleValue($table,$column,array($column=>$value,));
			if (is_null($res)) {
				$result=FALSE;	
			}
			else{
				$result=TRUE;
			}
			if ($result) {
				echo "TRUE";
			}
			else{
				echo "FALSE";
			}
		}
		else{
			echo "FALSE";
		}
	}
	public function upload_rules($file)
	{
		is_ajax();
		$file_name=$this->input->post('name');
		$file_upload_data=file_upload($file_name,$file,'competitions_rules');
		if($file_upload_data['status']){
			$msg= $data[$file]=$file_upload_data['upload_data']['file_name'];
		}
		else{
			$msg = $file_upload_data['error'];
		}
		echo $msg;
	}
	public function convertCurrency(){
		$where=array('profile_id'=>1);
		$to=$this->input->post('to');

		if($this->custom->checkAvailability('currency_master', array('currency_name'=>$to))){

			echo "This currency is already exist";

		}else{
			
			$from=$this->custom->getSingleValue('company_profile','default_currency',$where);
			$amount=1;
			// echo $from;
			// echo $amount;
			// echo $fto;
			$from = urlencode(strtoupper($from));
			$to = urlencode(strtoupper($to));
			$url = 'http://free.currencyconverterapi.com/api/v3/convert?q='.$from .'_'.$to.'&compact=ultra';
		    //$url  = "https://finance.google.com/finance/converter?a=$amount&from=$from&to=$to";

			$data = file_get_contents($url);
			$json = json_decode($data, true);

			echo json_encode($json[$from. '_' . $to]);

		}

	}	
	
	
}