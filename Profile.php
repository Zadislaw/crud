<?php
define('FPDF_FONTPATH', 'font/');
require('./fpdf/fpdf.php');

class Profile {

	private $id;
	private $first_name;
	private $last_name;
	private $dbo;
	private $gender;
	private $email;



	public function setId(int $id) :void
	{
		$this->id = $id;
	}

	public function getId() :int
	{
		return $this->id;
	}


	public function setFirstname(string $first_name) :void
	{
		$this->first_name = $first_name;
	}

	public function getFirstname() :string
	{
		return $this->first_name;
	}


	public function setLastname(string $last_name) :void
	{
		$this->last_name = $last_name;
	}

	public function getLastname() :string
	{
		return $this->last_name;
	}


	public function setDbo(string $dbo) :void
	{
		$this->dbo = $dbo;
	}

	public function getDbo() :string
	{
		return $this->dbo;
	}


	public function setGender(string $gender) :void
	{
		$this->gender = $gender;
	}

	public function getGender() :string
	{
		return $this->gender;
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
			$stmt = $con->prepare("INSERT INTO Profile VALUES (NULL, :_nome, :_sobrenome, :_dtnascimento, :_telefone, :_email)");
			$stmt->bindValue(":_nome", $this->getFirstname(), \PDO::PARAM_STR);
			$stmt->bindValue(":_sobrenome", $this->getLastname(), \PDO::PARAM_STR);
			$stmt->bindValue(":_dtnascimento", $this->getDbo(), \PDO::PARAM_STR);
			$stmt->bindValue(":_telefone", $this->getGender(), \PDO::PARAM_STR);
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
					$stmt = $con->prepare("SELECT * FROM Profile ORDER BY id DESC");
					if ($stmt->execute()) {
					return $stmt->fetchAll(\PDO::FETCH_ASSOC);
					}
			} else if ($this->getId() > 0) {
					$stmt = $con->prepare("SELECT * FROM Profile WHERE id = :_id");
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
			$stmt = $con->prepare("UPDATE Profile SET first_name = :_nome,  last_name = :_sobrenome,  dbo = :_dtnascimento,  gender = :_telefone,  email = :_email WHERE id = :_id");
			$stmt->bindValue(":_nome", $this->getFirstname(), \PDO::PARAM_STR);
			$stmt->bindValue(":_sobrenome", $this->getLastname(), \PDO::PARAM_STR);
			$stmt->bindValue(":_dtnascimento", $this->getDbo(), \PDO::PARAM_STR);
			$stmt->bindValue(":_telefone", $this->getGender(), \PDO::PARAM_STR);
			$stmt->bindValue(":_email", $this->getEmail(), \PDO::PARAM_STR);
			$stmt->bindValue(":_id", $this->getId(), \PDO::PARAM_INT);
			if ($stmt->execute()) {
					return $this->read();
			}
			return [];
			
	}


	

	public function delete() :array
	{
			$Profile = $this->read();
			$con = $this->connection();
			$stmt = $con->prepare("DELETE FROM Profile WHERE id = :_id");
			$stmt->bindValue(":_id", $this->getId(), \PDO::PARAM_INT);
			if ($stmt->execute()) {
					return $Profile;
			}
			return [];
			
	}



	public function geraPdf()
	{
		$con = $this->connection();
		$stmt = $con->prepare("SELECT * FROM profile, report");
		if ($stmt->execute()) {
			$resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			}
		
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(140,10,('Report'),0,0,"C");
		$pdf->ln(15); // espaçamento entra linhas de 15 mm
		
		
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(70, 7,'Id',1,0,"C");
		$pdf->Cell(70, 7,'First Name',1,0,"C");
		$pdf->Cell(70, 7,'Last Name',1,0,"C");
		$pdf->Cell(70, 7,'Date of Birth',1,0,"C");
		$pdf->Cell(70, 7,'Gender',1,0,"C");
		$pdf->Cell(70, 7,'Email',1,0,"C");
		$pdf->Cell(70, 7,'Report Id',1,0,"C");
		$pdf->Cell(70, 7,'Title',1,0,"C");
		$pdf->Cell(70, 7,'Description',1,0,"C");
		$pdf->ln(); //nenhum espaçamentos entre linhas
		
		
		while ($stmt->fetchAll(\PDO::FETCH_ASSOC)) {
		
			$pdf->Cell(70, 7, $resultado['id'],1,0,"C");
			$pdf->Cell(70, 7, $resultado['first_name'],1,0,"C");
			$pdf->Cell(70, 7, $resultado['last_name'],1,0,"C");
			$pdf->Cell(70, 7, $resultado['dbo'],1,0,"C");
			$pdf->Cell(70, 7, $resultado['gender'],1,0,"C");
			$pdf->Cell(70, 7, $resultado['email'],1,0,"C");
			$pdf->Cell(70, 7, $resultado['fk_id'],1,0,"C");
			$pdf->Cell(70, 7, $resultado['title'],1,0,"C");
			$pdf->Cell(70, 7, $resultado['description'],1,0,"C");
			$pdf->Ln();
			
		}
		return $pdf->Output();
			
	}


}