<?php
class Pages extends AppController{
	public function __construct(){}

	public function index(){
		$this->view('pages/index');
	}
}