	<?php

class Report {

	private $titleReport;
	private $fk_id;


	public function setReport(string $titleReport) :void
	{
		$this->titleReport = $titleReport;
	}

	public function getReport() :string
	{
		return $this->titleReport;
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


	public function createReport() :array
	{
			$con = $this->connection();
			$stmt = $con->prepare("INSERT INTO report VALUES (:_fk_id, :_titleReport)");
			$stmt->bindValue(":_fk_id", $this->getFkId(), \PDO::PARAM_INT);
			$stmt->bindValue(":_titleReport", $this->getReport(), \PDO::PARAM_STR);
			if ($stmt->execute()) {
					return $this->readReport();
			}
			return [];
			
	}

	public function readReport() :array
	{
			$con = $this->connection();
			if ($this->getFkId() === 0){
					$stmt = $con->prepare("SELECT * FROM report INNER JOIN profile on report.fk_id = profile.id;");
					if ($stmt->execute()) {
					return $stmt->fetchAll(\PDO::FETCH_ASSOC);
					}
			} else if ($this->getFkId() !== 0) {
					$stmt = $con->prepare("SELECT * FROM report INNER JOIN profile on report.fk_id = profile.id WHERE fk_id = :_fk_id");
					$stmt->bindValue(":_fk_id", $this->getFkId(), \PDO::PARAM_INT);
					if ($stmt->execute()) {
					return $stmt->fetchAll(\PDO::FETCH_ASSOC);
					}
			}
			return [];
			
	}


}
