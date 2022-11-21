   <?php
   
global $julNo;
global $matrix364Calendar;
global $nrDaysPerMonth;

//konstante
define("SDN_OFFSET1", "32083");
define("DAYS_PER_5_MONTHS", "153");
define("DAYS_PER_4_YEARS", "1461");
define("SDN_OFFSET2", "32045");
define("DAYS_PER_400_YEARS", "146097");

//kalendari 364
// var qe duhen ne funksionet JulNoTo364Calendar dhe cal364ToJulNo
define("CONST1", "223858.0");
define("CONST2", "223937.0");
define("CONST3", "4115.0");
define("CONST4", "4.0");

class cal364Date {
    public $cal364dita;
    public $cal364muaji;
	public $cal364viti;
	public $cal364ditejave;
	public $BCAD;
}

class GregorianDate {
    public $Gdita;
    public $Gmuaji;
	public $Gviti;
	public $BCAD;
}

class JulianDate {
    public $Jdita;
    public $Jmuaji;
	public $Jviti;
	public $BCAD;
}

class HebrewDate {
    public $Hdita;
    public $Hmuaji;
	public $Hviti;
}

$nrDaysPerMonth = [ array('Tishri',30), 
array('C.W. - Tishri 31',8),
array('Heshvan',30),
array('Kislev',30),
array('Tevet',29),
array('Shevat',30),
array('Adar',30),
array('Nisan',30),
array('Iyyar',29),
array('Sivan',30),
array('Tammuz',29),
array('Av',30),
array('Elul',29)];

$matrix364Calendar = [ array('bosh',0,'bosh'),
array('Thursday',5,'C.W. - Tishri 31'),
array('Friday',6,'C.W. - Tishri 31'),
array('Saturday',7,'C.W. - Tishri 31'),
array('Sunday',8,'C.W. - Tishri 31'),
array('Monday',1,'Heshvan'),
array('Tuesday',2,'Heshvan'),
array('Wednesday',3,'Heshvan'),
array('Thursday',4,'Heshvan'),
array('Friday',5,'Heshvan'),
array('Saturday',6,'Heshvan'),
array('Sunday',7,'Heshvan'),
array('Monday',8,'Heshvan'),
array('Tuesday',9,'Heshvan'),
array('Wednesday',10,'Heshvan'),
array('Thursday',11,'Heshvan'),
array('Friday',12,'Heshvan'),
array('Saturday',13,'Heshvan'),
array('Sunday',14,'Heshvan'),
array('Monday',15,'Heshvan'),
array('Tuesday',16,'Heshvan'),
array('Wednesday',17,'Heshvan'),
array('Thursday',18,'Heshvan'),
array('Friday',19,'Heshvan'),
array('Saturday',20,'Heshvan'),
array('Sunday',21,'Heshvan'),
array('Monday',22,'Heshvan'),
array('Tuesday',23,'Heshvan'),
array('Wednesday',24,'Heshvan'),
array('Thursday',25,'Heshvan'),
array('Friday',26,'Heshvan'),
array('Saturday',27,'Heshvan'),
array('Sunday',28,'Heshvan'),
array('Monday',29,'Heshvan'),
array('Tuesday',30,'Heshvan'),
array('Wednesday',1,'Kislev'),
array('Thursday',2,'Kislev'),
array('Friday',3,'Kislev'),
array('Saturday',4,'Kislev'),
array('Sunday',5,'Kislev'),
array('Monday',6,'Kislev'),
array('Tuesday',7,'Kislev'),
array('Wednesday',8,'Kislev'),
array('Thursday',9,'Kislev'),
array('Friday',10,'Kislev'),
array('Saturday',11,'Kislev'),
array('Sunday',12,'Kislev'),
array('Monday',13,'Kislev'),
array('Tuesday',14,'Kislev'),
array('Wednesday',15,'Kislev'),
array('Thursday',16,'Kislev'),
array('Friday',17,'Kislev'),
array('Saturday',18,'Kislev'),
array('Sunday',19,'Kislev'),
array('Monday',20,'Kislev'),
array('Tuesday',21,'Kislev'),
array('Wednesday',22,'Kislev'),
array('Thursday',23,'Kislev'),
array('Friday',24,'Kislev'),
array('Saturday',25,'Kislev'),
array('Sunday',26,'Kislev'),
array('Monday',27,'Kislev'),
array('Tuesday',28,'Kislev'),
array('Wednesday',29,'Kislev'),
array('Thursday',30,'Kislev'),
array('Friday',1,'Tevet'),
array('Saturday',2,'Tevet'),
array('Sunday',3,'Tevet'),
array('Monday',4,'Tevet'),
array('Tuesday',5,'Tevet'),
array('Wednesday',6,'Tevet'),
array('Thursday',7,'Tevet'),
array('Friday',8,'Tevet'),
array('Saturday',9,'Tevet'),
array('Sunday',10,'Tevet'),
array('Monday',11,'Tevet'),
array('Tuesday',12,'Tevet'),
array('Wednesday',13,'Tevet'),
array('Thursday',14,'Tevet'),
array('Friday',15,'Tevet'),
array('Saturday',16,'Tevet'),
array('Sunday',17,'Tevet'),
array('Monday',18,'Tevet'),
array('Tuesday',19,'Tevet'),
array('Wednesday',20,'Tevet'),
array('Thursday',21,'Tevet'),
array('Friday',22,'Tevet'),
array('Saturday',23,'Tevet'),
array('Sunday',24,'Tevet'),
array('Monday',25,'Tevet'),
array('Tuesday',26,'Tevet'),
array('Wednesday',27,'Tevet'),
array('Thursday',28,'Tevet'),
array('Friday',29,'Tevet'),
array('Saturday',1,'Shevat'),
array('Sunday',2,'Shevat'),
array('Monday',3,'Shevat'),
array('Tuesday',4,'Shevat'),
array('Wednesday',5,'Shevat'),
array('Thursday',6,'Shevat'),
array('Friday',7,'Shevat'),
array('Saturday',8,'Shevat'),
array('Sunday',9,'Shevat'),
array('Monday',10,'Shevat'),
array('Tuesday',11,'Shevat'),
array('Wednesday',12,'Shevat'),
array('Thursday',13,'Shevat'),
array('Friday',14,'Shevat'),
array('Saturday',15,'Shevat'),
array('Sunday',16,'Shevat'),
array('Monday',17,'Shevat'),
array('Tuesday',18,'Shevat'),
array('Wednesday',19,'Shevat'),
array('Thursday',20,'Shevat'),
array('Friday',21,'Shevat'),
array('Saturday',22,'Shevat'),
array('Sunday',23,'Shevat'),
array('Monday',24,'Shevat'),
array('Tuesday',25,'Shevat'),
array('Wednesday',26,'Shevat'),
array('Thursday',27,'Shevat'),
array('Friday',28,'Shevat'),
array('Saturday',29,'Shevat'),
array('Sunday',30,'Shevat'),
array('Monday',1,'Adar'),
array('Tuesday',2,'Adar'),
array('Wednesday',3,'Adar'),
array('Thursday',4,'Adar'),
array('Friday',5,'Adar'),
array('Saturday',6,'Adar'),
array('Sunday',7,'Adar'),
array('Monday',8,'Adar'),
array('Tuesday',9,'Adar'),
array('Wednesday',10,'Adar'),
array('Thursday',11,'Adar'),
array('Friday',12,'Adar'),
array('Saturday',13,'Adar'),
array('Sunday',14,'Adar'),
array('Monday',15,'Adar'),
array('Tuesday',16,'Adar'),
array('Wednesday',17,'Adar'),
array('Thursday',18,'Adar'),
array('Friday',19,'Adar'),
array('Saturday',20,'Adar'),
array('Sunday',21,'Adar'),
array('Monday',22,'Adar'),
array('Tuesday',23,'Adar'),
array('Wednesday',24,'Adar'),
array('Thursday',25,'Adar'),
array('Friday',26,'Adar'),
array('Saturday',27,'Adar'),
array('Sunday',28,'Adar'),
array('Monday',29,'Adar'),
array('Tuesday',30,'Adar'),
array('Wednesday',1,'Nisan'),
array('Thursday',2,'Nisan'),
array('Friday',3,'Nisan'),
array('Saturday',4,'Nisan'),
array('Sunday',5,'Nisan'),
array('Monday',6,'Nisan'),
array('Tuesday',7,'Nisan'),
array('Wednesday',8,'Nisan'),
array('Thursday',9,'Nisan'),
array('Friday',10,'Nisan'),
array('Saturday',11,'Nisan'),
array('Sunday',12,'Nisan'),
array('Monday',13,'Nisan'),
array('Tuesday',14,'Nisan'),
array('Wednesday',15,'Nisan'),
array('Thursday',16,'Nisan'),
array('Friday',17,'Nisan'),
array('Saturday',18,'Nisan'),
array('Sunday',19,'Nisan'),
array('Monday',20,'Nisan'),
array('Tuesday',21,'Nisan'),
array('Wednesday',22,'Nisan'),
array('Thursday',23,'Nisan'),
array('Friday',24,'Nisan'),
array('Saturday',25,'Nisan'),
array('Sunday',26,'Nisan'),
array('Monday',27,'Nisan'),
array('Tuesday',28,'Nisan'),
array('Wednesday',29,'Nisan'),
array('Thursday',30,'Nisan'),
array('Friday',1,'Iyyar'),
array('Saturday',2,'Iyyar'),
array('Sunday',3,'Iyyar'),
array('Monday',4,'Iyyar'),
array('Tuesday',5,'Iyyar'),
array('Wednesday',6,'Iyyar'),
array('Thursday',7,'Iyyar'),
array('Friday',8,'Iyyar'),
array('Saturday',9,'Iyyar'),
array('Sunday',10,'Iyyar'),
array('Monday',11,'Iyyar'),
array('Tuesday',12,'Iyyar'),
array('Wednesday',13,'Iyyar'),
array('Thursday',14,'Iyyar'),
array('Friday',15,'Iyyar'),
array('Saturday',16,'Iyyar'),
array('Sunday',17,'Iyyar'),
array('Monday',18,'Iyyar'),
array('Tuesday',19,'Iyyar'),
array('Wednesday',20,'Iyyar'),
array('Thursday',21,'Iyyar'),
array('Friday',22,'Iyyar'),
array('Saturday',23,'Iyyar'),
array('Sunday',24,'Iyyar'),
array('Monday',25,'Iyyar'),
array('Tuesday',26,'Iyyar'),
array('Wednesday',27,'Iyyar'),
array('Thursday',28,'Iyyar'),
array('Friday',29,'Iyyar'),
array('Saturday',1,'Sivan'),
array('Sunday',2,'Sivan'),
array('Monday',3,'Sivan'),
array('Tuesday',4,'Sivan'),
array('Wednesday',5,'Sivan'),
array('Thursday',6,'Sivan'),
array('Friday',7,'Sivan'),
array('Saturday',8,'Sivan'),
array('Sunday',9,'Sivan'),
array('Monday',10,'Sivan'),
array('Tuesday',11,'Sivan'),
array('Wednesday',12,'Sivan'),
array('Thursday',13,'Sivan'),
array('Friday',14,'Sivan'),
array('Saturday',15,'Sivan'),
array('Sunday',16,'Sivan'),
array('Monday',17,'Sivan'),
array('Tuesday',18,'Sivan'),
array('Wednesday',19,'Sivan'),
array('Thursday',20,'Sivan'),
array('Friday',21,'Sivan'),
array('Saturday',22,'Sivan'),
array('Sunday',23,'Sivan'),
array('Monday',24,'Sivan'),
array('Tuesday',25,'Sivan'),
array('Wednesday',26,'Sivan'),
array('Thursday',27,'Sivan'),
array('Friday',28,'Sivan'),
array('Saturday',29,'Sivan'),
array('Sunday',30,'Sivan'),
array('Monday',1,'Tammuz'),
array('Tuesday',2,'Tammuz'),
array('Wednesday',3,'Tammuz'),
array('Thursday',4,'Tammuz'),
array('Friday',5,'Tammuz'),
array('Saturday',6,'Tammuz'),
array('Sunday',7,'Tammuz'),
array('Monday',8,'Tammuz'),
array('Tuesday',9,'Tammuz'),
array('Wednesday',10,'Tammuz'),
array('Thursday',11,'Tammuz'),
array('Friday',12,'Tammuz'),
array('Saturday',13,'Tammuz'),
array('Sunday',14,'Tammuz'),
array('Monday',15,'Tammuz'),
array('Tuesday',16,'Tammuz'),
array('Wednesday',17,'Tammuz'),
array('Thursday',18,'Tammuz'),
array('Friday',19,'Tammuz'),
array('Saturday',20,'Tammuz'),
array('Sunday',21,'Tammuz'),
array('Monday',22,'Tammuz'),
array('Tuesday',23,'Tammuz'),
array('Wednesday',24,'Tammuz'),
array('Thursday',25,'Tammuz'),
array('Friday',26,'Tammuz'),
array('Saturday',27,'Tammuz'),
array('Sunday',28,'Tammuz'),
array('Monday',29,'Tammuz'),
array('Tuesday',1,'Av'),
array('Wednesday',2,'Av'),
array('Thursday',3,'Av'),
array('Friday',4,'Av'),
array('Saturday',5,'Av'),
array('Sunday',6,'Av'),
array('Monday',7,'Av'),
array('Tuesday',8,'Av'),
array('Wednesday',9,'Av'),
array('Thursday',10,'Av'),
array('Friday',11,'Av'),
array('Saturday',12,'Av'),
array('Sunday',13,'Av'),
array('Monday',14,'Av'),
array('Tuesday',15,'Av'),
array('Wednesday',16,'Av'),
array('Thursday',17,'Av'),
array('Friday',18,'Av'),
array('Saturday',19,'Av'),
array('Sunday',20,'Av'),
array('Monday',21,'Av'),
array('Tuesday',22,'Av'),
array('Wednesday',23,'Av'),
array('Thursday',24,'Av'),
array('Friday',25,'Av'),
array('Saturday',26,'Av'),
array('Sunday',27,'Av'),
array('Monday',28,'Av'),
array('Tuesday',29,'Av'),
array('Wednesday',30,'Av'),
array('Thursday',1,'Elul'),
array('Friday',2,'Elul'),
array('Saturday',3,'Elul'),
array('Sunday',4,'Elul'),
array('Monday',5,'Elul'),
array('Tuesday',6,'Elul'),
array('Wednesday',7,'Elul'),
array('Thursday',8,'Elul'),
array('Friday',9,'Elul'),
array('Saturday',10,'Elul'),
array('Sunday',11,'Elul'),
array('Monday',12,'Elul'),
array('Tuesday',13,'Elul'),
array('Wednesday',14,'Elul'),
array('Thursday',15,'Elul'),
array('Friday',16,'Elul'),
array('Saturday',17,'Elul'),
array('Sunday',18,'Elul'),
array('Monday',19,'Elul'),
array('Tuesday',20,'Elul'),
array('Wednesday',21,'Elul'),
array('Thursday',22,'Elul'),
array('Friday',23,'Elul'),
array('Saturday',24,'Elul'),
array('Sunday',25,'Elul'),
array('Monday',26,'Elul'),
array('Tuesday',27,'Elul'),
array('Wednesday',28,'Elul'),
array('Thursday',29,'Elul'),
array('Friday',1,'Tishri'),
array('Saturday',2,'Tishri'),
array('Sunday',3,'Tishri'),
array('Monday',4,'Tishri'),
array('Tuesday',5,'Tishri'),
array('Wednesday',6,'Tishri'),
array('Thursday',7,'Tishri'),
array('Friday',8,'Tishri'),
array('Saturday',9,'Tishri'),
array('Sunday',10,'Tishri'),
array('Monday',11,'Tishri'),
array('Tuesday',12,'Tishri'),
array('Wednesday',13,'Tishri'),
array('Thursday',14,'Tishri'),
array('Friday',15,'Tishri'),
array('Saturday',16,'Tishri'),
array('Sunday',17,'Tishri'),
array('Monday',18,'Tishri'),
array('Tuesday',19,'Tishri'),
array('Wednesday',20,'Tishri'),
array('Thursday',21,'Tishri'),
array('Friday',22,'Tishri'),
array('Saturday',23,'Tishri'),
array('Sunday',24,'Tishri'),
array('Monday',25,'Tishri'),
array('Tuesday',26,'Tishri'),
array('Wednesday',27,'Tishri'),
array('Thursday',28,'Tishri'),
array('Friday',29,'Tishri'),
array('Saturday',30,'Tishri'),
array('Sunday',1,'C.W. - Tishri 31'),
array('Monday',2,'C.W. - Tishri 31'),
array('Tuesday',3,'C.W. - Tishri 31'),
array('Wednesday',4,'C.W. - Tishri 31')
];


function cal364toJulNo($DD,$MM,$YYYY,$BCAD)
{
global $matrix364Calendar;
//$DD = 15;
//$MM = 'Iyyar';
//$YYYY = 30;
//$BCAD = 'AD';

//i eshte CD, dita e vitit ne kalendar
for($i=0; $i<365; $i++){
	if($matrix364Calendar[$i][1] == $DD && $matrix364Calendar[$i][2] == $MM)
	{
		$ditejave = $matrix364Calendar[$i][0];
		$CD = $i;
	}
}

If(!isset($CD))
	return -1; //kthen julian number 0, format date i pavlefshem

if($BCAD == 1)	//AD
	$A =  $YYYY;
else
	$A =  -1 * $YYYY;

if ($A>0)
	$B = CONST3-1;
else
	$B = CONST3;

//echo "</br> A: ".$A;
//echo "</br> B: ".$B;

if($CD > 331.5)	
	$C = 1;
else
	$C = 0;	

if ($CD < 75.5)
	$D = 1;
else
	$D = 0;

$E = $C + $D;

if($E == 0)	
	$F = $B - 1;
else
	$F = $B;

if($CD > 359.5)
	$G = 1;
else
	$G = 0;

if($A == -4115)
	$H = 1;
else
	$H = 0;

$I = $G * $H;

if($I == 0)
	$J = $F;
else
	$J = $F - 1;
$K = $J + $A;


$jn = $K * 364 + $CD + CONST1 + CONST4;

return $jn;
}
	
function JulNoTo364Calendar($julNo)
{
global $matrix364Calendar;

$cal364Dt = new cal364Date();
if ($julNo < 0)
	return $cal364Dt;

$A = $julNo - CONST1;
$B = $A / 364;
$C = $B - floor($B);

$CD0 =	round(($C * 364 - CONST4), PHP_ROUND_HALF_UP);
If ($CD0 > 0) $CD1=$CD0; else $CD1 = 0;
If ($CD0 == 0) $CD2=364; else $CD2 = 0;
If ($CD0 == -1) $CD3=363; else $CD3 = 0;
If ($CD0 == -2) $CD4=362; else $CD4 = 0;
If ($CD0 == -3) $CD5=361; else $CD5 = 0;
If ($CD0 == -4) $CD6=360; else $CD6 = 0;

$CD =$CD1+$CD2+$CD3+$CD4+$CD5+$CD6;


//$CD = round($C * 364 - CONST4, 0, PHP_ROUND_HALF_UP);
//echo $julNo;
//echo "</br> CD: ". $CD;
//echo "</br> data: ". $matrix364Calendar[$CD][1];
//Using the MATRIX of the 364-day Calendar, find the "DAY", "DATE" and "MONTH" in the 364 CALENDAR	
	
$cal364Dt->cal364dita = $matrix364Calendar[$CD][1];
$cal364Dt->cal364muaji = $matrix364Calendar[$CD][2];
$cal364Dt->cal364ditejave = $matrix364Calendar[$CD][0];


$D = ($julNo - CONST2)/364;
$E = ceil($D);
$F = $E - CONST3;


if($F>0) 
	$cal364Dt->cal364viti = $F+1; 
else 
	$cal364Dt->cal364viti = $F*(-1);

$cal364Dt->cal364viti = abs($cal364Dt->cal364viti);

if($F>0) 
	$cal364Dt->BCAD = 1; 
else 
	$cal364Dt->BCAD= -1;
//echo "</br> bcad: ".$cal364Dt->BCAD;

return $cal364Dt;
}

function JulNoToJulian($JulNo)
{
  $JulDate = new JulianDate();
  
    if ($JulNo < 0) {
		return $JulDate;
    }
    $temp = (int)($JulNo + SDN_OFFSET1) * 4 - 1;

	if ($JulNo == 0) {
		$JulDate->Jviti = 4713;
		$JulDate->Jmuaji = 1;
		$JulDate->Jdita = 1;
		$JulDate->BCAD = -1;
		return $JulDate;
	}

    // Calculate the year and day of year (1 <= dayOfYear <= 366). */
    $JulDate->Jviti = (int)($temp / DAYS_PER_4_YEARS);
	
	
    $JdayOfYear = (int)(($temp % DAYS_PER_4_YEARS) / 4 + 1);

    /* Calculate the month and day of month. */
    $temp = $JdayOfYear * 5 - 3;
    $JulDate->Jmuaji = (int)($temp / DAYS_PER_5_MONTHS);
	
    $JulDate->Jdita = (int)(($temp % DAYS_PER_5_MONTHS) / 5 + 1);

    /* Convert to the normal beginning of the year. */
    if ($JulDate->Jmuaji < 10) {
	$JulDate->Jmuaji += 3;
    } else {
	$JulDate->Jviti += 1;
	$JulDate->Jmuaji -= 9;
    }

    /* Adjust to the B.C./A.D. type numbering. */
    $JulDate->Jviti -= 4800;
    if ($JulDate->Jviti <= 0) 
	{ $JulDate->Jviti--;
	  $JulDate->BCAD = -1;
	}
	else
		$JulDate->BCAD = 1;
	return $JulDate;
}

function JulianToJulNo($inputDay, $inputMonth, $inputYear)
{	//FORMAT DATE I PAVLEFSHEM
	if (checkdate($inputMonth, $inputDay, abs($inputYear))==false) 
	{
		$JulNo = 0;
		return $JulNo;
	}
	
    /* check for invalid dates */
    if ($inputYear == 0 || $inputYear < -4713 ||
	$inputMonth <= 0 || $inputMonth > 12 ||
	$inputDay <= 0 || $inputDay > 31)
    {
	$JulNo = 0;
	return $JulNo;
    }

    /* check for dates before SDN 1 (Jan 2, 4713 B.C.) */
    if ($inputYear == -4713) {
	if ($inputMonth == 1 && $inputDay == 1) {
	   $JulNo = 0;
	   return $JulNo;
	}
    }

    /* Make year always a positive number. */
    if ($inputYear < 0) {
	$year = $inputYear + 4801;
    } else {
	$year = $inputYear + 4800;
    }

    /* Adjust the start of the year. */
    if ($inputMonth > 2) {
	$month = $inputMonth - 3;
    } else {
	$month = $inputMonth + 9;
	$year--;
    }

    return( (int)(($year * DAYS_PER_4_YEARS) / 4)
	    + (int)(($month * DAYS_PER_5_MONTHS + 2) / 5)
	    + $inputDay - SDN_OFFSET1 );
}

function JulNoToGregorian($julNo)
{
	$GregDate = new GregorianDate();

    if ($julNo < 0) {
	//$GregDate->Gdita = 0;
	//$GregDate->Gmuaji = 0;
	//$GregDate->Gviti = 0;
	//$GregDate->BCAD = 1;
	return $GregDate;
    }

    $temp = ($julNo + SDN_OFFSET2) * 4 - 1;

    /* Calculate the century (year/100). */
    $century = (int)($temp / DAYS_PER_400_YEARS);

    /* Calculate the year and day of year (1 <= dayOfYear <= 366). */
    $temp = (int)((int)($temp % DAYS_PER_400_YEARS) / 4) * 4 + 3;
    $year = ($century * 100) + (int)($temp / DAYS_PER_4_YEARS);
    $dayOfYear = (int)((int)((int)($temp % DAYS_PER_4_YEARS)) / 4) + 1;

    /* Calculate the month and day of month. */
    $temp = $dayOfYear * 5 - 3;
    $month = (int)($temp / DAYS_PER_5_MONTHS);
    $day = (int)((int)((int)($temp % DAYS_PER_5_MONTHS)) / 5 )+ 1;

    /* Convert to the normal beginning of the year. */
    if ($month < 10) {
	$month += 3;
    } else {
	$year += 1;
	$month -= 9;
    }

    /* Adjust to the B.C./A.D. type numbering. */
    $year -= 4800;
    if ($year <= 0) { $year--; $GregDate->BCAD = -1;}

    $GregDate->Gdita = $day;
	$GregDate->Gmuaji = $month;
	$GregDate->Gviti = $year;
    return $GregDate;
}

