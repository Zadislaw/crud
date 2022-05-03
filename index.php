<?php

require_once "Person.php";

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

$person = new Person;
$person->setId($id);

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




die(json_encode($data));
