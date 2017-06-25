<?php

namespace App\Http\Controllers;

/**
* This class is to handle the data related to user activation proccess  
*/
class Dashboard extends Controller 
{
	public function index (){
		return 	view('chart');
	}
}