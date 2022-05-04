<?php

require_once "Person.php";
require_once "Enterprise.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");
$data = [];


$fn = $_REQUEST["fn"] ?? null;
$id = $_REQUEST["id"] ?? 0;
$nome = $_REQUEST["nome"] ?? null;
$sobrenome = $_REQUEST["sobrenome"] ?? null;
$dtnascimento = $_REQUEST["dtnascimento"] ?? null;
$telefone = $_REQUEST["telefone"] ?? null;
$celular = $_REQUEST["celular"] ?? null;
$email = $_REQUEST["email"] ?? null;
$fk_id = $_REQUEST["fk_id"] ?? 0;
$nomeEmp = $_REQUEST["nomeEmp"] ?? null;

$person = new Person;
$person->setId($id);

$enterprise = new Enterprise;
$enterprise->setFkId($fk_id);

if ($fn === "create" && $nome !== null && $sobrenome !== null && $dtnascimento !== null && $telefone !== null && $celular !== null && $email !== null){
		$person->setNome($nome);
		$person->setSobrenome($sobrenome);
		$person->setDtnascimento($dtnascimento);
		$person->setTelefone($telefone);
		$person->setCelular($celular);
		$person->setEmail($email);
		$data["person"] = $person->create();

}


if ($fn === "read"){
		$data["person"] = $person->read();
}


if ($fn === "update" && $nome !== null && $sobrenome !== null && $dtnascimento !== null && $telefone !== null && $celular !== null && $email !== null){
		$person->setNome($nome);
		$person->setSobrenome($sobrenome);
		$person->setDtnascimento($dtnascimento);
		$person->setTelefone($telefone);
		$person->setCelular($celular);
		$person->setEmail($email);
		$data["person"] = $person->update();

}


if ($fn === "delete" && $id > 0){
		$data["person"] = $person->delete();

}


if ($fn === "createEmp" && $nomeEmp !== null && $fk_id !== null){
		$enterprise->setNomeEmp($nomeEmp);
		$enterprise->setFkId($fk_id);
		$data["enterprise"] = $enterprise->createEmp();

}

if ($fn === "readEmp"){
		$data["enterprise"] = $enterprise->readEmp();
}



die(json_encode($data));
