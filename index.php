<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Calendar Converter</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
.banner {
    width: 100%;
}
.banner p {
    width: 100%;
    max-height: 140px;
    z-index: 99999999999;
    position: fixed;
    bottom: 0;
}
.tabelaGrid td {
  border: 1px solid black;
  margin: 5px;
  padding: 5px;
}
table, th, td {
    vertical-align: top;
	border: 0px;
	margin: 1px;
	padding: 1px;
} 
</style>	
</head>
<body>
<?php   
			
    date_default_timezone_set("Etc/GMT-8");
	include 'funksioneKonvert.php';
	
	$data364 = new cal364Date();
	$dataJulian = new JulianDate();
	$dataGregorian = new GregorianDate();
	$dataHebrew = new HebrewDate();
	
	
    if(ISSET($_POST['GregConvert'])){
		
		$cal = "gregorian";
		
		$dataGregorian->Gdita = $_POST['Gdita'];;
		$dataGregorian->Gmuaji = $_POST['Gmuaji'];
		$dataGregorian->Gviti = $_POST['Gviti'];
		
		if ($_POST['gregBCAD']=="GBc")$dataGregorian->BCAD = -1;
		else $dataGregorian->BCAD = 1;
		
		if (checkdate($dataGregorian->Gmuaji, $dataGregorian->Gdita, $dataGregorian->Gviti)==false) 
		{
			$JulNo = 0;
		}
		else
		$JulNo = gregoriantojd($dataGregorian->Gmuaji, $dataGregorian->Gdita, $dataGregorian->BCAD*$dataGregorian->Gviti); 
				
		//PLOTESO KALENDARIN JULIAN
		if($JulNo == 0 &&($dataGregorian->Gmuaji == 11)&&($dataGregorian->Gdita == 24)&&($dataGregorian->BCAD==-1)&&($dataGregorian->Gviti == 4714))
			{
			$dataJulian->Jviti = 4713;
			$dataJulian->BCAD = -1;
			$dataJulian->Jmuaji = 1;
			$dataJulian->Jdita = 1;			
			}
			//perndryshe invalid
			
		else 
		{
			if ($JulNo > 0 )
			{
			$dataJulian = JulNoToJulian($JulNo);
			if ($dataJulian->Jviti < 0)
			{
				$dataJulian->BCAD = -1;
				$dataJulian->Jviti = (-1)*$dataJulian->Jviti;
			}
			else
				$dataJulian->BCAD = 1;
			}
			else
				$dataJulian->BCAD = 1;
		}
		//ploteso kalendarin hebraik

		$dataHebrewString = jdtojewish($JulNo);
		$ndare = explode('/', $dataHebrewString);
		$dataHebrew->Hviti = $ndare[2];
		$dataHebrew->Hmuaji = $ndare[0];
		$dataHebrew->Hdita = $ndare[1];	

		//ploteso kalendarin 364
		$data364 = JulNoTo364Calendar($JulNo);		
	}
	else if(ISSET($_POST['JulConvert'])){
		$cal = "julian";
				
		if (isset($_POST['Jdita'])) $dataJulian->Jdita= $_POST['Jdita'];
		if (isset($_POST['Jmuaji'])) $dataJulian->Jmuaji= $_POST['Jmuaji'];
		if (isset($_POST['Jviti'])) $dataJulian->Jviti= $_POST['Jviti'];
        
		if ($_POST['julBCAD']=="JBc") $dataJulian->BCAD = -1;
		else $dataJulian->BCAD = 1;
		
		//per BC viti behet negativ
		//echo $dataJulian->BCAD*$dataJulian->Jviti." <br>". $dataJulian->Jmuaji."<br>".$dataJulian->Jdita."</br>";
		$JulNo = JulianToJulNo($dataJulian->Jdita, $dataJulian->Jmuaji, $dataJulian->BCAD*$dataJulian->Jviti);	
		//$JulNo = juliantojd
		
		//echo "JulNo nga convert julian test ". $JulNo;
		
		//PLOTESO KALENDARIN GREGORIAN
		if ($JulNo == 0 && ($dataJulian->BCAD==-1)&&($dataJulian->Jviti == 4713) && ($dataJulian->Jmuaji == 1) &&	($dataJulian->Jdita == 1 ))
		{
			$dataGregorian->BCAD = -1;
			$dataGregorian->Gviti = 4714;
			$dataGregorian->Gmuaji = 11;
			$dataGregorian->Gdita = 24;
		}
		else
		{
		if ($JulNo > 0 )
		{
			$dataGregorian =  JulNoToGregorian($JulNo);
			if ($dataGregorian->Gviti < 0)
			{
			$dataGregorian->BCAD = -1;
			//ia heqim shenjen - per ta shfaqur ne textbox
			$dataGregorian->Gviti = (-1)*$dataGregorian->Gviti;
			}
			else
				$dataGregorian->BCAD = 1;
		}
		else
				$dataGregorian->BCAD = 1;
		}
		//ploteso kalendarin hebraik

		$dataHebrewString = jdtojewish($JulNo);
		$ndare = explode('/', $dataHebrewString);
		$dataHebrew->Hviti = $ndare[2];
		$dataHebrew->Hmuaji = $ndare[0];
		$dataHebrew->Hdita = $ndare[1];		
		
		//ploteso kalendarin 364
		$data364 = JulNoTo364Calendar($JulNo);
		
	}
	else if(ISSET($_POST['HebConvert'])){
		$cal = "hebrew";
		if (isset($_POST['Hdita'])) $dataHebrew->Hdita= $_POST['Hdita'];
		if (isset($_POST['Hmuaji'])) $dataHebrew->Hmuaji= $_POST['Hmuaji'];
		if (isset($_POST['Hviti'])) $dataHebrew->Hviti= $_POST['Hviti'];
		
		//echo $dataHebrew->Hdita, " ", $dataHebrew->Hmuaji, " ", $dataHebrew->Hviti;
		
		//gjej julian number
		$JulNo=jewishtojd($dataHebrew->Hmuaji,$dataHebrew->Hdita,$dataHebrew->Hviti);
		
		
		//PLOTESO KALENDARIN GREGORIAN
		
		$dataGregorian =  JulNoToGregorian($JulNo);
		
		if ($dataGregorian->Gviti < 0)
		{
			$dataGregorian->BCAD = -1;
			//ia heqim shenjen - per ta shfaqur ne textbox
			$dataGregorian->Gviti = (-1)*$dataGregorian->Gviti;
		}
		else
			$dataGregorian->BCAD = 1;
		
	
		//PLOTESO KALENDARIN JULIAN
		$dataJulian = JulNoToJulian($JulNo);
		
		if ($dataJulian->Jviti < 0)
		{
			$dataJulian->BCAD = -1;
			$dataJulian->Jviti = (-1)*$dataJulian->Jviti;
		}
		else
			$dataJulian->BCAD = 1;
		
		//ploteso kalendarin 364
		$data364 = JulNoTo364Calendar($JulNo);
	}
	else
		//eshte zgjedhur nje date ne kalendarin 364 dhe kerkohet te konvertohet ne kalendaret e tjere
		if(ISSET($_POST['Convert364'])){
		$cal = "cal364";
		if (isset($_POST['dita364'])) $data364->cal364dita= $_POST['dita364'];
		if (isset($_POST['muaji364'])) $data364->cal364muaji= $_POST['muaji364'];
		if (isset($_POST['viti364'])) $data364->cal364viti= $_POST['viti364'];
		if ($_POST['BCAD364']=="Bc364") 
			$data364->BCAD = -1;
		else 
			$data364->BCAD = 1;
		
		//echo $data364->cal364dita, " ", $data364->cal364muaji, " ", $data364->cal364viti;
		
		//gjej julian day number
		//function cal364toJulNo($DD,$MM,$YYYY,$BCAD)
		$JulNo=cal364toJulNo($data364->cal364dita, $data364->cal364muaji,$data364->cal364viti,$data364->BCAD);
		
		//PLOTESO KALENDARIN GREGORIAN
		
		$dataGregorian =  JulNoToGregorian($JulNo);
		
		if ($dataGregorian->Gviti < 0)
		{
			$dataGregorian->BCAD = -1;
			//ia heqim shenjen - per ta shfaqur ne textbox
			$dataGregorian->Gviti = (-1)*$dataGregorian->Gviti;
		}
		else
			$dataGregorian->BCAD = 1;
		
	
		//PLOTESO KALENDARIN JULIAN
		$dataJulian = JulNoToJulian($JulNo);
		
		if ($dataJulian->Jviti < 0)
		{
			$dataJulian->BCAD = -1;
			$dataJulian->Jviti = (-1)*$dataJulian->Jviti;
		}
		else
			$dataJulian->BCAD = 1;
		
		//ploteso kalendarin hebraik

		$dataHebrewString = jdtojewish($JulNo);
		$ndare = explode('/', $dataHebrewString);
		$dataHebrew->Hviti = $ndare[2];
		$dataHebrew->Hmuaji = $ndare[0];
		$dataHebrew->Hdita = $ndare[1];	
	}
	else
	{
		$cal = "gregorian";
		//caktohet data aktuale, rasti qe sapo hapet faqja
		$dataGregorian->Gdita = date("d");
		$dataGregorian->Gmuaji = date("m");
		$dataGregorian->Gviti = date("Y");
		$dataGregorian->BCAD = 1; //AD
		$dataJulian->BCAD = 1;
				
		$JulNo = gregoriantojd($dataGregorian->Gmuaji, $dataGregorian->Gdita, $dataGregorian->Gviti); 
		$dataJulian = JulNoToJulian($JulNo);
		if ($dataJulian->Jviti < 0)
		{
			$dataJulian->BCAD = -1;
			//per te mos printuar shenjen
			$dataJulian->Jviti = (-1)*$dataJulian->Jviti;
		}
		else
			$dataJulian->BCAD = 1;
		//konvert ne hebraik		
		$dataHebrewString = jdtojewish($JulNo);
		$ndare = explode('/', $dataHebrewString);
		$dataHebrew->Hmuaji = $ndare[0];
		$dataHebrew->Hdita = $ndare[1];
		$dataHebrew->Hviti = $ndare[2];
		
		//caktohet data ne kalendarin 364 per dite sot
		$data364 = JulNoTo364Calendar($JulNo);
		//echo "</br>julno: ". $JulNo;
	}	
?>
<?php

function showCurrentMonth364($JDC)
{
if($JDC <= 223858)
return;

global $nrDaysPerMonth;
$date = new cal364Date();
$date1 = new cal364Date();
$date=JulNoTo364Calendar($JDC);
//echo "</br> dite jave date: ".$date->cal364ditejave;

$numberOfDays = 0;
//gjendet sa dite ka muaji, variabel global
for ($i=0; $i<13; $i++)
	if($date->cal364muaji == $nrDaysPerMonth[$i][0])
		$numberOfDays = $nrDaysPerMonth[$i][1];

//gjej JDC te dates 1 te muajit
$JDC1 = (int)$JDC - ((int)$date->cal364dita -1);
$date1=JulNoTo364Calendar($JDC1);

//gjej diten e javes te dates 1 per te spostuar vende bosh ne kalendar

//kam diten e javes me emer, por me duhet numri perkates 0,1 ... 6
$dj364 = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
for($j= 0; $j<7; $j++)
	if ($dj364[$j] == $date1->cal364ditejave)
		$offset = $j;

$row_number = 1;
// time to draw the month header
echo "<table class = 'tabelaGrid' style='border: 1px solid; border-collapse: collapse; width:100%; table-layout: fixed;'>";
echo "<tr bgcolor = #DDEBF7 style = 'font-weight:bold;' align = 'center'><td>Mon</td><td>Tue</td><td>Wed</td><td>Thu</td><td>Fri</td><td bgcolor= #BDD7EE>Sat</td><td bgcolor= #BDD7EE>Sun</td></tr> <tr>";
// this will print the additional td record in case the month is not starting with the Sunday.
for($i = 1; $i <= (($offset+6)%7); $i++)
{
echo "<td ></td>";
}
//  this will print the number of days.
for($day = 1; $day <= $numberOfDays; $day++)
{
if( ($day + $offset-2) % 7 == 0 && $day != 1)
{
echo "</tr> <tr>";
$row_number++;
}
if ($date->cal364dita != $day)
{
	if ((($day + $offset-2) % 7 == 5) || (($day + $offset-2) % 7 == 6)||($date1->cal364dita==$day && $date1->cal364ditejave =="Sunday"))	
		echo "<td align = 'center' bgcolor = #BDD7EE>"; //fundjava
	else
		echo "<td align = 'center' bgcolor = #DDEBF7>"; //dite jave
	
	echo $day . "</td>";
}
else
	echo "<td align = 'center' bgcolor = #FFD966><b>" . $day . "</b></td>"; //data e zgjedhur
}
while( $day + ($offset + 6)%7 <= $row_number * 7)
{
echo "<td></td>";
$day++;
}
echo "</tr></table>";
}

function showCurrentMonth($JDC)
{
global $dataGregorian;

if($JDC < 0)
{
	echo "Invalid date";
	return;	
}
if($JDC == 0 && $dataGregorian->Gviti == 4714 && $dataGregorian->Gmuaji==11 && $dataGregorian->Gdita==24 && $dataGregorian->BCAD==-1)
{
	$date["day"] = 24;	
}
else
{
	if($JDC > 0)
		$date = cal_from_jd($JDC, CAL_GREGORIAN);
	else
	{
		echo " ";
		return;
	}
}
// time to draw the month header
//echo "<table class = 'tabelaGrid' style='border-collapse: collapse; width:100%; table-layout: fixed;'><br/>";
echo "<table class = 'tabelaGrid' style='border-collapse: collapse; width:100%; table-layout: fixed;'>";

echo "<tr bgcolor = #E2EFDA style = 'font-weight:bold;'><td align = 'center'>Mon</td><td align = 'center'>Tue</td><td align = 'center'>Wed</td><td align = 'center'>Thu</td><td align = 'center'>Fri</td><td align = 'center' bgcolor = #C6E0B4>Sat</td><td align = 'center' bgcolor = #C6E0B4>Sun</td></tr> <tr>";

if ($JDC >=0 && $JDC<7)
{
//echo "<td ></td><td ></td><td ></td><td ></td><td ></td><td ></td>";
for($i = 24; $i <= 30; $i++)	
{ 	//if($i == 24 && $date["day"] != 24)  // vetem data 24 merret si 0, datat e tjera jane 25-30
	//{
	//	echo "<td align = 'center' bgcolor = #C6E0B4>24</td></tr><tr>";//fundjava
	//	continue;
	//}
		
	if (($i == 30 || $i == 29) && $date["day"] != $i) //  dite jave  = 6 i bie dite e shtune
	{
		echo "<td align = 'center' bgcolor = #C6E0B4>30</td>"; //fundjava
		continue;
	}
	if($date["day"] == $i)
		echo "<td align = 'center' bgcolor = #FFD966><b>". $i . "</b></td>"; //data e zgjedhur	
	else
		echo "<td align = 'center' bgcolor = #E2EFDA>". $i . "</td>"; //dite jave
	
	//echo $i . "</td>";
}
echo "</tr></table>";
return;	
}

$numberOfDays =cal_days_in_month(CAL_GREGORIAN,$date["month"], $date["year"]);
//gjej JDC te dates 1 te muajit
$JDC1 = $JDC - $date["day"]+1;

$date1=cal_from_jd($JDC1, CAL_GREGORIAN);
//gjej diten e javes te dates 1 per te spostuar vende bosh ne kalendar


$offset = $date1["dow"];

$row_number = 1;
// this will print the additional td record in case the month is not starting with the Sunday.
for($i = 1; $i <= (($offset+6)%7); $i++)
{
echo "<td ></td>";
}
//  this will print the number of days.
for($day = 1; $day <= $numberOfDays; $day++)
{
if( ($day + $offset -2) % 7 == 0 && $day != 1)
{
echo "</tr> <tr>";
$row_number++;
}
//echo $dataGregorian->Gdita;

if ($date["day"] != $day)
{
	if ((($day + $offset-2) % 7 == 5) || (($day + $offset-2) % 7 == 6)||($date1["day"]==$day && $date1["dow"]==0))	
		echo "<td align = 'center' bgcolor = #C6E0B4>"; //fundjava
	else
		echo "<td align = 'center' bgcolor = #E2EFDA>"; //dite jave
	
	echo $day . "</td>";
}
else
	echo "<td align = 'center' bgcolor = #FFD966><b>" . $day . "</b></td>"; //data e zgjedhur

}
while( ($day + ($offset + 6)%7) <= $row_number * 7)
{
echo "<td></td>";
$day++;
}
echo "</tr></table>";
}

function showCurrentMonthJulian($JDC)
{
global $dataJulian;
if($JDC < 0)
{
	echo "Invalid date";
	return;	
}
if($JDC == 0 && $dataJulian->Jviti == 4713 && $dataJulian->Jmuaji==1 && $dataJulian->Jdita==1 && $dataJulian->BCAD==-1)
{
	$date["day"] = 1;	
}
else
	if ($JDC == 0) 
		return;


$date=cal_from_jd($JDC, CAL_JULIAN);

// time to draw the month header
echo "<table class = 'tabelaGrid' style='border: 1px solid; border-collapse: collapse;  width:100%; table-layout: fixed;'>";
echo "<tr bgcolor = #F2F2F2 style = 'font-weight:bold;' align = 'center'><td>Mon</td><td>Tue</td><td>Wed</td><td>Thu</td><td>Fri</td><td bgcolor = #D9D9D9>Sat</td><td bgcolor = #D9D9D9>Sun</td></tr> <tr>";

if($JDC < 31)
{
	$numberOfDays = 31;
	$JDC1 = 0;
}
else
{
$numberOfDays =cal_days_in_month(CAL_JULIAN,$date["month"], $date["year"]);
//gjej JDC te dates 1 te muajit
$JDC1 = $JDC - $date["day"]+1;
}

$date1=cal_from_jd($JDC1, CAL_JULIAN);
//gjej diten e javes te dates 1 per te spostuar vende bosh ne kalendar

$offset = $date1["dow"];
//$offsetTest = ($offset + 6)%7;
$row_number = 1;
// this will print the additional td record in case the month is not starting with the Sunday.
for($i = 1; $i <= (($offset+6)%7); $i++)
echo "<td ></td>";

if ($date["day"] == 0) $date["day"]++; // kur julian number =0 ka $date["day"] = 0 dhe duhet 1
//  this will print the number of days.
for($day = 1; $day <= $numberOfDays; $day++)
{
if( ($day + $offset-2) % 7 == 0 && $day != 1)
{
echo "</tr> <tr>";
$row_number++;
}

if ($date["day"] != $day)
{
	if ((($day + $offset-2) % 7 == 5) || (($day + $offset-2) % 7 == 6)||($date1["day"]==$day && $date1["dow"]==0))	
		echo "<td align = 'center' bgcolor = #D9D9D9>"; //fundjave
	else
		echo "<td align = 'center' bgcolor = #F2F2F2>"; //dite jave
	
	echo $day . "</td>";
}
else
	echo "<td align = 'center' bgcolor = #FFD966><b>" . $day . "</b></td>"; //dita e zgjedhur
}

while( $day + ($offset + 6)%7 <= $row_number * 7)
{
echo "<td></td>";
$day++;
}
echo "</tr></table>";

}

function showCurrentMonthJewish($JDC)
{
if($JDC < 347998)
return;
 
$date=cal_from_jd($JDC, CAL_JEWISH);

$numberOfDays =cal_days_in_month(CAL_JEWISH,$date["month"], $date["year"]);

//gjej JDC te dates 1 te muajit
$JDC1 = $JDC - $date["day"]+1;

$date1=cal_from_jd($JDC1, CAL_JEWISH);
//gjej diten e javes te dates 1 per te spostuar vende bosh ne kalendar

$offset = $date1["dow"];
//$offsetTest = ($offset + 6)%7;
$row_number = 1;
// time to draw the month header
echo "<table class = 'tabelaGrid' style='border: 1px solid; border-collapse: collapse; width:100%; table-layout: fixed;'>";
echo "<tr bgcolor = #FCE4D6 align = 'center' style = 'font-weight:bold;'><td>Mon</td><td>Tue</td><td>Wed</td><td>Thu</td><td>Fri</td><td bgcolor =#F8CBAD>Sat</td><td bgcolor =#F8CBAD>Sun</td></tr> <tr>";
// this will print the additional td record in case the month is not starting with the Sunday.
for($i = 1; $i <= (($offset+6)%7); $i++)
{
echo "<td ></td>";
}
//  this will print the number of days.
for($day = 1; $day <= $numberOfDays; $day++)
{
if( ($day + $offset-2) % 7 == 0 && $day != 1)
{
echo "</tr> <tr>";
$row_number++;
}
if ($date["day"] != $day)
{
	if ((($day + $offset-2) % 7 == 5) || (($day + $offset-2) % 7 == 6)||($date1["day"]==$day && $date1["dow"]==0))	
		echo "<td align = 'center' bgcolor = #F8CBAD>"; //fundjava
	else
		echo "<td align = 'center' bgcolor = #FCE4D6>"; //dite jave
	
	echo $day . "</td>";
}
else
	echo "<td align = 'center' bgcolor = #FFD966><b>" . $day . "</b></td>";
}
while( $day + ($offset + 6)%7 <= $row_number * 7)
{
echo "<td></td>";
$day++;
}
echo "</tr></table>";
}
?>
<div align = "center">

	<h2>The SACRED Calendar  in paralel with Julian, Hebrew and Gregorian Calendar</h3>
	<p>This application is used to convert dates from 4 different Calendars:
	i) The Sacred Calendar, ii) The Gregorian Calendar, iii) The Julian Calendar, iv) The Hebrew calendar (currently in use)
	</br>After entering a date on one of the calendars, press "Convert" to convert the entered date into the three other Calendars.
	The application generates the Julian Day Number as well.
	</p>
    </div>
	
<div style = "text-align: center; background-color: #70AD47; color:white; font-weight: bold; font-size: 120%;">
Gregorian Current Date: <?php
if ($JulNo == 0 && $dataGregorian->Gviti == 4714&&$dataGregorian->Gmuaji==11&& $dataGregorian->Gdita==24 && $dataGregorian->BCAD==-1) 
	echo "24 November, 4714 BC";
else{
	if ($JulNo > 0){
		$date=cal_from_jd($JulNo, CAL_GREGORIAN);
		//print_r($date);
		echo $date["day"]. " ".$date["monthname"]. ", ".abs($date["year"]);
		if ($dataGregorian->BCAD == 1) echo " AD"; else echo " BC";
	}else
		echo " ";
}?>
</div>

<div  style = "background-color: #E2EFDA; text-align: center; color:black; font-weight: bold; font-size: 120%;">
</br>
Day of the week: <?php 
if ($JulNo == 0 && $dataGregorian->Gviti == 4714&&$dataGregorian->Gmuaji==11&& $dataGregorian->Gdita==24 && $dataGregorian->BCAD==-1) 
	echo "Monday";
else
	if (isset($date)) echo $date["dayname"];?> <br/>
Julian Day Number (JD#): <?php if (isset($JulNo) && $JulNo >= 0) echo $JulNo ?>
</br></br>
</div>

<table>
<tr style="color:white; font-weight:bold; text-align:center;">
<td width = "25%" bgcolor =#4472C4>
The SACRED Calendar
</td>
<td width = "25%" bgcolor = #70AD47>
The GREGORIAN Calendar
</td>
<td width = "25%" bgcolor = #808080>
The JULIAN calendar
</td>
<td width = "25%" bgcolor = #C65911>
The HEBREW Calendar
</td>
</tr>

<tr>
<td>
<table bgcolor = #DDEBF7 width = "100%">
<form method="post" action = "" id = "364form">
<tr>
<td> <input type="number" min="1" max="31" size="2" name="dita364" value=<?php if($JulNo >= 223857) echo $data364->cal364dita; ?>></td>
<td> <select name="muaji364" selected="<?php if($JulNo >= 223857) echo $data364->cal364muaji; else " "; ?>">
    			<option class="fonti" value="Tishri" 
				<?=$data364->cal364muaji == "Tishri" ? ' selected="selected"' : '';?> >Tishri</option>
    			<option class="fonti" value="C.W. - Tishri 31"
				<?=$data364->cal364muaji == "C.W. - Tishri 31" ? ' selected="selected"' : '';?> >C.W. - T.31</option>
    			<option class="fonti" value="Heshvan"
				<?=$data364->cal364muaji == "Heshvan" ? ' selected="selected"' : '';?> >Heshvan</option>
    			<option class="fonti" value="Kislev"
				<?=$data364->cal364muaji == "Kislev" ? ' selected="selected"' : '';?> >Kislev</option>
    			<option class="fonti" value="Tevet"
				<?=$data364->cal364muaji == "Tevet" ? ' selected="selected"' : '';?> >Tevet</option>
    			<option class="fonti" value="Shevat"
				<?=$data364->cal364muaji == "Shevat" ? ' selected="selected"' : '';?> >Shevat</option>
    			<option class="fonti" value="Adar"
				<?=$data364->cal364muaji == "Adar" ? ' selected="selected"' : '';?> >Adar</option>
    			<option class="fonti" value="Nisan"
				<?=$data364->cal364muaji == "Nisan" ? ' selected="selected"' : '';?> >Nisan</option>
    			<option class="fonti" value="Iyyar"
				<?=$data364->cal364muaji == "Iyyar" ? ' selected="selected"' : '';?> >Iyyar</option>
    			<option class="fonti" value="Sivan"
				<?=$data364->cal364muaji == "Sivan" ? ' selected="selected"' : '';?> >Sivan</option>
    			<option class="fonti" value="Tammuz"
				<?=$data364->cal364muaji == "Tammuz" ? ' selected="selected"' : '';?> >Tammuz</option>
    			<option class="fonti" value="Av"
				<?=$data364->cal364muaji == "Av" ? ' selected="selected"' : '';?> >Av</option>
				<option class="fonti" value="Elul"
				<?=$data364->cal364muaji == "Elul" ? ' selected="selected"' : '';?> >Elul</option>
				
    		</select> </td>
<td><input type="number" name="viti364" min="1" max="10000" size="5" value= <?php if($JulNo >= 223857) echo $data364->cal364viti; else " "; ?> > </td>
<td>
    		<input type="radio" name="BCAD364" value="Bc364" id = "Bc364" 
			<?php if ($data364->BCAD == -1) echo 'checked'; ?> 
			 <label for = "BCAD" style="color:black">BC</label></td>
<td> 		
    		<input type="radio" name="BCAD364" value="Ad364" id = "Ad364"
			<?php if ($data364->BCAD == 1) echo 'checked'; ?>
			<label for = "BCAD364" style="color:black">AD</label>
</td>
<td><input type="submit" name="Convert364" value = "Convert"> </td>
</tr>
</form>
</table>
</td>

<td>
<table bgcolor = "#E2EFDA" width = "100%">
<form method = "post" action = "" id = "gregForm">
<tr>
 
<td> <input type="number" min="1" max="31" size="2" name="Gdita" value=<?php echo $dataGregorian->Gdita; ?>></td>
<td> <select name="Gmuaji" selected="<?php echo $dataGregorian->Gmuaji; ?>">
    			<option class="fonti" value="1" 
				<?=$dataGregorian->Gmuaji == "1" ? ' selected="selected"' : '';?> >January</option>
    			<option class="fonti" value="2"
				<?=$dataGregorian->Gmuaji == "2" ? ' selected="selected"' : '';?> >February</option>
    			<option class="fonti" value="3"
				<?=$dataGregorian->Gmuaji == "3" ? ' selected="selected"' : '';?> >March</option>
    			<option class="fonti" value="4"
				<?=$dataGregorian->Gmuaji == "4" ? ' selected="selected"' : '';?> >April</option>
    			<option class="fonti" value="5"
				<?=$dataGregorian->Gmuaji == "5" ? ' selected="selected"' : '';?> >May</option>
    			<option class="fonti" value="6"
				<?=$dataGregorian->Gmuaji == "6" ? ' selected="selected"' : '';?> >June</option>
    			<option class="fonti" value="7"
				<?=$dataGregorian->Gmuaji == "7" ? ' selected="selected"' : '';?> >July</option>
    			<option class="fonti" value="8"
				<?=$dataGregorian->Gmuaji == "8" ? ' selected="selected"' : '';?> >August</option>
    			<option class="fonti" value="9"
				<?=$dataGregorian->Gmuaji == "9" ? ' selected="selected"' : '';?> >September</option>
    			<option class="fonti" value="10"
				<?=$dataGregorian->Gmuaji == "10" ? ' selected="selected"' : '';?> >October</option>
    			<option class="fonti" value="11"
				<?=$dataGregorian->Gmuaji == "11" ? ' selected="selected"' : '';?> >November</option>
    			<option class="fonti" value="12"
				<?=$dataGregorian->Gmuaji == "12" ? ' selected="selected"' : '';?> >December</option>
    		</select> </td>
<td><input type="number" name="Gviti" min="1" max="10000" value= <?php echo $dataGregorian->Gviti; ?> size="5"> </td>
<td>
    		<input type="radio" name="gregBCAD" value="GBc" id = "GBc" 
			<?php if ($dataGregorian->BCAD == -1) echo 'checked'; ?> 
			 <label for = "gregBCAD" style="color:black">BC</label></td>
<td> 		
    		<input type="radio" name="gregBCAD" value="GAd" id = "GAd"
			<?php if ($dataGregorian->BCAD == 1) echo 'checked'; ?>
			<label for = "gregBCAD" style="color:black">AD</label>
</td>
<td><input type="submit" name="GregConvert" value = "Convert"> </td>
</tr>

</form>
</table>
</td>

<td>
<table bgcolor = "#F2F2F2" width = "100%">
<form method = "post" action = "" id = "julForm">
<tr>
<td> <input type="number" min="1" max="31" size="2" name="Jdita" value=<?php echo $dataJulian->Jdita; ?> > </td>
<td><select name="Jmuaji" selected="<?php echo $dataJulian->Jmuaji; ?>">
    			<option class="fonti" value="1"
				<?=$dataJulian->Jmuaji == "1" ? ' selected="selected"' : '';?> >January</option>
    			<option class="fonti" value="2"
				<?=$dataJulian->Jmuaji == "2" ? ' selected="selected"' : '';?>>February</option>
    			<option class="fonti" value="3"
				<?=$dataJulian->Jmuaji == "3" ? ' selected="selected"' : '';?>>March</option>
    			<option class="fonti" value="4"
				<?=$dataJulian->Jmuaji == "4" ? ' selected="selected"' : '';?>>April</option>
    			<option class="fonti" value="5"
				<?=$dataJulian->Jmuaji == "5" ? ' selected="selected"' : '';?>>May</option>
    			<option class="fonti" value="6"
				<?=$dataJulian->Jmuaji == "6" ? ' selected="selected"' : '';?>>June</option>
    			<option class="fonti" value="7"
				<?=$dataJulian->Jmuaji == "7" ? ' selected="selected"' : '';?>>July</option>
    			<option class="fonti" value="8"
				<?=$dataJulian->Jmuaji == "8" ? ' selected="selected"' : '';?>>August</option>
    			<option class="fonti" value="9"
				<?=$dataJulian->Jmuaji == "9" ? ' selected="selected"' : '';?>>September</option>
    			<option class="fonti" value="10"
				<?=$dataJulian->Jmuaji == "10" ? ' selected="selected"' : '';?>>October</option>
    			<option class="fonti" value="11"
				<?=$dataJulian->Jmuaji == "11" ? ' selected="selected"' : '';?>>November</option>
    			<option class="fonti" value="12"
				<?=$dataJulian->Jmuaji == "12" ? ' selected="selected"' : '';?>>December</option>
    		</select> </td>
<td> <input type="number" min="1" max="10000" size = "5" name="Jviti" value=<?php echo $dataJulian->Jviti; ?> ></td>
<td> 
    		<input type="radio" name="julBCAD" value="JBc" id = "JBc" 
			<?php if ($dataJulian->BCAD == -1) echo 'checked'; ?>
			<label for= "julBCAD" style="color:black">BC </label>			
</td>
<td>
			<input type="radio" name="julBCAD" value="JAd" id = "JAd"
			<?php if ($dataJulian->BCAD == 1) echo 'checked'; ?>
			<label for="julBCAD" style="color:black">AD	</label> 
</td>
<td> <input type="submit" name="JulConvert" value = "Convert">
</td>
</form>
</tr>
</table>
</td>

<td>
<table bgcolor = "#FFE4C4" width = "100%">
<form method = "post" action="" id = "hebForm">
<tr>
<td> <input type="number" size = "2" min="1" max="31" name="Hdita" value=<?php if($JulNo >= 347998) echo $dataHebrew->Hdita; else echo " "; ?> ></td>
<td> <select name="Hmuaji" selected="<?php if($JulNo >= 347998) echo $dataHebrew->Hmuaji; else echo " "; ?>">
    			<option class="fonti" value="1"
				<?=$dataHebrew->Hmuaji == "1" ? ' selected="selected"' : '';?>>Tishri</option>
    			<option class="fonti" value="2"
				<?=$dataHebrew->Hmuaji == "2" ? ' selected="selected"' : '';?>>Heshvan</option>
    			<option class="fonti" value="3"
				<?=$dataHebrew->Hmuaji == "3" ? ' selected="selected"' : '';?>>Kislev</option>
    			<option class="fonti" value="4"
				<?=$dataHebrew->Hmuaji == "4" ? ' selected="selected"' : '';?>>Tevet</option>
    			<option class="fonti" value="5"
				<?=$dataHebrew->Hmuaji == "5" ? ' selected="selected"' : '';?>>Shevat</option>
    			<option class="fonti" value="6"
				<?=$dataHebrew->Hmuaji == "6" ? ' selected="selected"' : '';?>>Adar I</option>
    			<option class="fonti" value="7"
				<?=$dataHebrew->Hmuaji == "7" ? ' selected="selected"' : '';?>>Adar II</option>
    			<option class="fonti" value="8"
				<?=$dataHebrew->Hmuaji == "8" ? ' selected="selected"' : '';?>>Nisan</option>
    			<option class="fonti" value="9"
				<?=$dataHebrew->Hmuaji == "9" ? ' selected="selected"' : '';?>>Iyyar</option>
    			<option class="fonti" value="10"
				<?=$dataHebrew->Hmuaji == "10" ? ' selected="selected"' : '';?>>Sivan</option>
    			<option class="fonti" value="11"
				<?=$dataHebrew->Hmuaji == "11" ? ' selected="selected"' : '';?>>Tammuz</option>
    			<option class="fonti" value="12"
				<?=$dataHebrew->Hmuaji == "12" ? ' selected="selected"' : '';?>>Av</option>
    			<option class="fonti" value="13"
				<?=$dataHebrew->Hmuaji == "13" ? ' selected="selected"' : '';?>>Elul</option>
								
    		</select></td>
<td><input type="number" min="1" max="10000" name="Hviti" size="5" value=<?php if($JulNo >= 347998) echo $dataHebrew->Hviti; ?> > </td>
<td> </td>
<td></td>
<td> <input type="submit" name="HebConvert" value = "Convert"></td>

</form></tr>
</table>
</td>

</tr>
<tr style="color:black">
<td bgcolor = "#DDEBF7">The Sacred Calendar is the calendar of the Old Testament, consisting with 364-days. As this calendar has full 52 weeks, the beginning of the year, Tishri 1-st, is always a "FRIDAY". The last day of the Calendar is Thursday, Elul 29-th. Between the first month of Tishri and the second month of Heshvan, 8 additional days are inserted named as "Creation Week - Tishri31".
<a href="moreInfo.html"  target="_blank"> [more information]</a>
</td>
<td bgcolor = "#E2EFDA"> This is the calendar accepted world wide for commercial use. It was introduced in 1582 by Pope Gregory XIII to correct inaccuracies in the Julian calendar's placement of leap years, but many countries did not accept it until years later.
<a href="moreInfo.html#greg"  target="_blank"> [more information]</a>
</td>
<td bgcolor = "#F2F2F2">This calendar is the predecessor of the Gregorian calendar. Julius Caesar created it in 46 B.C. as a modified form of the old Roman republican calendar which was based on lunar cycles. The new Julian calendar set fixed lengths for the months, abandoning the lunar cycle. It also specified that there would be exactly 12 months per year and 365.25 days per year with every 4th year being a leap year.
<a href="moreInfo.html#jul"  target="_blank"> [more information]</a>
			</td>
<td bgcolor = "#FCE4D6">This is the calendar used by the Jewish religion. The Hebrew calendar is based on lunar as well as solar cycles. A month always starts on or near a new moon and has either 29 or 30 days (a lunar cycle is about 29 1/2 days). Twelve of these alternating 29-30 day months gives a year of 354 days, which is about 11 1/4 days short of a solar year.
<a href="moreInfo.html#heb"  target="_blank">[more information]</a> 
			</td>
</tr>

<tr style="color:white; font-weight:bold;">
<td width = "25%" bgcolor = "#4472C4" align = "center">
<?php 
if($JulNo <= 223857)
	echo "Out of range.";
else
	if($JulNo == 223858)
		echo "The Beginning";
else
{
echo $data364->cal364dita." ".$data364->cal364muaji.", ".$data364->cal364viti; 
if ($dataGregorian->BCAD == 1) echo " AD"; else echo " BC";
}
?>
</td>
<td width = "25%" bgcolor = #70AD47 align = "center">
<?php 
$str = $dataGregorian->Gviti."-".$dataGregorian->Gmuaji."-".$dataGregorian->Gdita;
if($JulNo > 0||($str == "4714-11-24" && $dataGregorian->BCAD == -1))
{	
echo $dataGregorian->Gdita." ".date('F', strtotime($str)).", ".$dataGregorian->Gviti; 
if ($dataGregorian->BCAD == 1) echo " AD"; else echo " BC";
}
else
	echo "Invalid Date";
?>
</td>
<td width = "25%" bgcolor = #808080 align = "center">
<?php 
if($JulNo == 0 && 
(($dataGregorian->Gviti == 4714&&$dataGregorian->Gmuaji==11&& $dataGregorian->Gdita==24 && $dataGregorian->BCAD==-1) ||
(($dataJulian->Jviti == 4713&&$dataJulian->Jmuaji==1&& $dataJulian->Jdita==1 && $dataJulian->BCAD==-1))
)){
	echo "1 January, 4713 BC"; 
}
else
{
if($JulNo > 0 )
{
$d=cal_from_jd($JulNo, CAL_JULIAN);
echo $dataJulian->Jdita." ".$d["monthname"].", ".$dataJulian->Jviti; 
if ($dataJulian->BCAD == 1) echo " AD"; else echo " BC";
}
else
	echo "Invalid Date";
}
?>

</td>
<td width = "25%" bgcolor = #C65911 align = "center">
<?php 
if($JulNo < 347998)
echo "Out of range.";
else{
$d=cal_from_jd($JulNo, CAL_JEWISH);
echo $dataHebrew->Hdita." ".$d["monthname"].", ".$dataHebrew->Hviti; }?>
</td>
</tr>
<tr height = "100%" style = "vertical-align:top">
	    <td width = "25%" height = "100%" border = "1">
		<?php showCurrentMonth364($JulNo); ?>
		</td>
		<td width = "25%" vertical-align= "top" >
		<?php showCurrentMonth($JulNo); ?>
		</td>
		<td width = "25%" vertical-align= "top">
		<?php showCurrentMonthJulian($JulNo); ?>
		</td>
		<td width = "25%" vertical-align= "top">
		<?php showCurrentMonthJewish($JulNo); ?>
		</td>
</tr>
</table>	
<div class="banner" align = "center">
<p><i>All Rights Reserved: Dritan Profka, Jim Liles, 2022.</br> Contact: dprofka@yahoo.com </i>
</br> Related links: <a href="https://www.thesacredcalendar.com" target=”_blank”>The Sacred Calendar</a> 
</p>
</div>
</body>
</html>