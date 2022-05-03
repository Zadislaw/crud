<?php

class Person {

	private $id;
	private $nome;
	private $sobrenome;
	private $dtnascimento;
	private $telefone;
	private $celular;
	private $email;



	public function setId(int $id) :void
	{
		$this->id = $id;
	}

	public function getId() :int
	{
		return $this->id;
	}


	public function setNome(string $nome) :void
	{
		$this->nome = $nome;
	}

	public function getNome() :string
	{
		return $this->nome;
	}


	public function setSobrenome(string $sobrenome) :void
	{
		$this->sobrenome = $sobrenome;
	}

	public function getSobrenome() :string
	{
		return $this->sobrenome;
	}


	public function setDtnascimento(string $dtnascimento) :void
	{
		$this->dtnascimento = $dtnascimento;
	}

	public function getDtnascimento() :string
	{
		return $this->dtnascimento;
	}


	public function setTelefone(string $telefone) :void
	{
		$this->telefone = $telefone;
	}

	public function getTelefone() :string
	{
		return $this->telefone;
	}


	public function setCelular(string $celular) :void
	{
		$this->celular = $celular;
	}

	public function getCelular() :string
	{
		return $this->celular;
	}


	public function setEmail(string $email) :void
	{
		$this->email = $email;
	}

	public function getEmail() :string
	{
		return $this->email;
	}




	private function connection() :\PDO
	{
		return new \PDO("mysql:host=localhost;dbname=db_crud", "root", "");
	}


	public function create() :array
	{
			$con = $this->connection();
			$stmt = $con->prepare("INSERT INTO person VALUES (NULL, :_nome, :_sobrenome, :_dtnascimento, :_telefone, :_celular, :_email)");
			$stmt->bindValue(":_nome", $this->getNome(), \PDO::PARAM_STR);
			$stmt->bindValue(":_sobrenome", $this->getSobrenome(), \PDO::PARAM_STR);
			$stmt->bindValue(":_dtnascimento", $this->getDtnascimento(), \PDO::PARAM_STR);
			$stmt->bindValue(":_telefone", $this->getTelefone(), \PDO::PARAM_STR);
			$stmt->bindValue(":_celular", $this->getCelular(), \PDO::PARAM_STR);
			$stmt->bindValue(":_email", $this->getEmail(), \PDO::PARAM_STR);
			if ($stmt->execute()) {
					$this->setId($con->lastInsertId());
					return $this->read();
			}
			return [];
			
	}



	public function read() :array
	{
			$con = $this->connection();
			if ($this->getId() === 0){
					$stmt = $con->prepare("SELECT * FROM person ORDER BY id DESC");
					if ($stmt->execute()) {
					return $stmt->fetchAll(\PDO::FETCH_ASSOC);
					}
			} else if ($this->getId() > 0) {
					$stmt = $con->prepare("SELECT * FROM person WHERE id = :_id");
					$stmt->bindValue(":_id", $this->getId(), \PDO::PARAM_INT);
					if ($stmt->execute()) {
					return $stmt->fetchAll(\PDO::FETCH_ASSOC);
					}
			}
			return [];
			
	}


	public function update() :array
	{
			$con = $this->connection();
			$stmt = $con->prepare("UPDATE person SET nome = :_nome,  sobrenome = :_sobrenome,  dtnascimento = :_dtnascimento,  telefone = :_telefone,  celular = :_celular,  email = :_email WHERE id = :_id");
			$stmt->bindValue(":_nome", $this->getNome(), \PDO::PARAM_STR);
			$stmt->bindValue(":_sobrenome", $this->getSobrenome(), \PDO::PARAM_STR);
			$stmt->bindValue(":_dtnascimento", $this->getDtnascimento(), \PDO::PARAM_STR);
			$stmt->bindValue(":_telefone", $this->getTelefone(), \PDO::PARAM_STR);
			$stmt->bindValue(":_celular", $this->getCelular(), \PDO::PARAM_STR);
			$stmt->bindValue(":_email", $this->getEmail(), \PDO::PARAM_STR);
			$stmt->bindValue(":_id", $this->getId(), \PDO::PARAM_INT);
			if ($stmt->execute()) {
					return $this->read();
			}
			return [];
			
	}


	

	public function delete() :array
	{
			$person = $this->read();
			$con = $this->connection();
			$stmt = $con->prepare("DELETE FROM person WHERE id = :_id");
			$stmt->bindValue(":_id", $this->getId(), \PDO::PARAM_INT);
			if ($stmt->execute()) {
					return $person;
			}
			return [];
			
	}



}