<?php

function impact($data){

return $data;


}

function severeImpact($data)
{

}


function currentlyInfected($obj)
{
     $currentlyInfected = $obj->reportedCases * 10;
  return $currentlyInfected;
}

function currentlyInfectedSevery($obj)
{
  $currentlyInfected =$obj->reportedCases * 50;
  return $currentlyInfected;
}

function infectionsByRequestedTimeImpact($obj)
{
  $days = 30;
  $d =$days/3;
  $currentlyInfected =currentlyInfected($obj);
  return $currentlyInfected *pow(2,$d);
}
function infectionsByRequestedTimeSavereImpact($obj)
{
  $days = 30;
  $d =$days/3;
  $currentlyInfected  =currentlyInfectedSevery($obj);
  return $currentlyInfected *pow(2,$d);
}

function infectionsByRequestedTimeSavereImpactByparcentage($obj)
{
  $par = 0.15;
   $urrentlyInfected = infectionsByRequestedTimeSavereImpact($obj);
  return $urrentlyInfected * $par ;

}

function avaiableBeds($obj)
{
  $totalHospitalBeds =$obj->totalHospitalBeds*0.35;

  return  $totalHospitalBeds;
}
function hospitalBedsByRequestedTimeSavere ($obj)
{
  $hospitalBedsByRequestedTime = avaiableBeds($obj)-infectionsByRequestedTimeSavereImpact($obj);
  return;
}
function casesForICUByRequestedTime($obj)
{
  $casesForICUByRequestedTime =infectionsByRequestedTimeSavereImpact($obj);
  return $casesForICUByRequestedTime *0.05;
}

function casesForVentilatorsByRequestedTime($obj)
{
  $casesForVentilatorsByRequestedTime=infectionsByRequestedTimeSavereImpact($obj);
  return $casesForVentilatorsByRequestedTime *0.02;
}
function dollarsInFlight($obj)
{

   $a= infectionsByRequestedTimeImpact($obj);
   $b= infectionsByRequestedTimeSavereImpact($obj);
   $infectionsByRequestedTime = $a+$b;
   $dollarsInFlight = $infectionsByRequestedTime * $obj->region->avgAge * 30;

  return  $dollarsInFlight;
}