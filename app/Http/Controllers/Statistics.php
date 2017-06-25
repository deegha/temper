<?php

namespace App\Http\Controllers;

/**
* This class is to handle the data related to user activation proccess  
*/
class Statistics extends Controller
{
	private $errors;

	public function index()
	{

		try
		{	
			$filename 	 = 'data/export.csv';
			$csv		 = array();
			$headers 	 = [];
			$sums		 = array();
			$total_users = 0; 

			$lines 		= file($filename, FILE_IGNORE_NEW_LINES);

			foreach ($lines as $key => $value)
			{
				if ($key == 0) 
				{
					$headers = explode(';', $value) ;
				}else{
					$data = explode(';', $value);
					foreach ($data as $k => $value) {
						$csv[$key][$headers[$k]] = $value;
					}
				}
			$total_users = $key;
    		}
    		foreach ($csv as $row) 
    		{
    			if( $this->in_array_r($row['created_at'], $sums) 
    			 	&& $this->in_array_r($row['onboarding_perentage'], $sums[$row['created_at']]) ) 
    			{ 
    			 	$sums[$row['created_at']][$row['onboarding_perentage']] += 1;
    			}else {
    			 	$sums[$row['created_at']][$row['onboarding_perentage']] = 1;
    			}
    		}

    		$response = $this->getResponse(200, $sums);
			return json_encode($response);
		}
		catch (\Exception $e)
		{
			$this->errors = 'Failed to reach data';
		    $response = $this->getResponse(500);
			return json_encode($response);
		}
	}

	private function getResponse ($status, $data=null) 
	{	

		$message = []; 

		switch ($status) 
		{
			case '200':
				$message['data'] = $data;
				$message['errors'] = null;
				$message['status'] = $status;
				return $message;

			case '500':
				$message['data'] = $data;
				$message['errors'] = $this->errors;
				$message['status'] = $status;
				return $message;
			
			default:
				$message['data'] = $data;
				$message['errors'] = null;
				$message['status'] = 401;
				return $message;
		}
	}

	private function in_array_r($item , $array)
	{
	    return preg_match('/"'.$item.'"/i' , json_encode($array));
	}
}
