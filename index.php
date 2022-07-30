<?php

require_once "Profile.php";
require_once "Report.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");
$data = [];


$fn = $_REQUEST["fn"] ?? null;
$id = $_REQUEST["id"] ?? 0;
$first_name = $_REQUEST["first_name"] ?? null;
$last_name = $_REQUEST["last_name"] ?? null;
$dbo = $_REQUEST["dbo"] ?? null;
$gender = $_REQUEST["gender"] ?? null;
$email = $_REQUEST["email"] ?? null;
$fk_id = $_REQUEST["fk_id"] ?? 0;
$titleReport = $_REQUEST["titleReport"] ?? null;

$profile = new Profile;
$profile->setId($id);

$report = new Report;
$report->setFkId($fk_id);

if ($fn === "create" && $first_name !== null && $last_name !== null && $dbo !== null && $gender !== null && $email !== null){
		$profile->setFirstname($first_name);
		$profile->setLastname($last_name);
		$profile->setDbo($dbo);
		$profile->setGender($gender);
		$profile->setEmail($email);
		$data["profile"] = $profile->create();

}


if ($fn === "read"){
		$data["profile"] = $profile->read();
}


if ($fn === "update" && $first_name !== null && $last_name !== null && $dbo !== null && $gender !== null && $email !== null){
		$profile->setFirstname($first_name);
		$profile->setLastname($last_name);
		$profile->setDbo($dbo);
		$profile->setGender($gender);
		$profile->setEmail($email);
		$data["profile"] = $profile->update();

}


if ($fn === "delete" && $id > 0){
		$data["profile"] = $profile->delete();

}


if ($fn === "createReport" && $titleReport !== null && $fk_id !== null){
		$report->setReport($titleReport);
		$report->setFkId($fk_id);
		$data["report"] = $report->createReport();

}

if ($fn === "readReport"){
		$data["report"] = $report->readReport();
}

if ($fn === "geraPdf"){
	die($profile->geraPdf());
}

die(json_encode($data));
