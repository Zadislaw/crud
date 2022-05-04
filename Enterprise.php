<?php

class Enterprise {

	private $nomeEmp;
	private $fk_id;


	public function setNomeEmp(string $nomeEmp) :void
	{
		$this->nomeEmp = $nomeEmp;
	}

	public function getNomeEmp() :string
	{
		return $this->nomeEmp;
	}


	public function setFkId(int $fk_id) :void
	{
		$this->fk_id = $fk_id;
	}

	public function getFkId() :int
	{
		return $this->fk_id;
	}



	private function connection() :\PDO
	{
		return new \PDO("mysql:host=localhost;dbname=db_crud", "root", "");
	}


	public function createEmp() :array
	{
			$con = $this->connection();
			$stmt = $con->prepare("INSERT INTO enterprise VALUES (:_nomeEmp, :_fk_id)");
			$stmt->bindValue(":_nomeEmp", $this->getNomeEmp(), \PDO::PARAM_STR);
			$stmt->bindValue(":_fk_id", $this->getFkId(), \PDO::PARAM_INT);
			if ($stmt->execute()) {
					return $this->readEmp();
			}
			return [];
			
	}

	public function readEmp() :array
	{
			$con = $this->connection();
			if ($this->getFkId() === 0){
					$stmt = $con->prepare("SELECT * FROM enterprise INNER JOIN person on enterprise.fk_id = person.id;");
					if ($stmt->execute()) {
					return $stmt->fetchAll(\PDO::FETCH_ASSOC);
					}
			} else if ($this->getFkId() !== 0) {
					$stmt = $con->prepare("SELECT * FROM enterprise INNER JOIN person on enterprise.fk_id = person.id WHERE fk_id = :_fk_id");
					$stmt->bindValue(":_fk_id", $this->getFkId(), \PDO::PARAM_INT);
					if ($stmt->execute()) {
					return $stmt->fetchAll(\PDO::FETCH_ASSOC);
					}
			}
			return [];
			
	}


}