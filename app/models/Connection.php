<?php
namespace models;
class Connection{
	/**
	 * @id
	 * @column("name"=>"id","nullable"=>false,"dbType"=>"int(11)")
	*/
	private $id;

	/**
	 * @column("name"=>"dateCo","nullable"=>false,"dbType"=>"datetime")
	*/
	private $dateCo;

	/**
	 * @column("name"=>"url","nullable"=>false,"dbType"=>"varchar(255)")
	*/
	private $url;

	/**
	 * @manyToOne
	 * @joinColumn("className"=>"models\\User","name"=>"idUser","nullable"=>false)
	*/
	private $user;

	 public function getId(){
		return $this->id;
	}

	 public function setId($id){
		$this->id=$id;
	}

	 public function getDateCo(){
		return $this->dateCo;
	}

	 public function setDateCo($dateCo){
		$this->dateCo=$dateCo;
	}

	 public function getUrl(){
		return $this->url;
	}

	 public function setUrl($url){
		$this->url=$url;
	}

	 public function getUser(){
		return $this->user;
	}

	 public function setUser($user){
		$this->user=$user;
	}

	 public function __toString(){
		return $this->url;
	}

}