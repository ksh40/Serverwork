<?php // opening php tag
echo "Hello world<br>";

//valid name
$first_name = "Jane";
//$_firstname;
//invalid : $1name

$age = 15;
$height = 5.5;
$have_registered = false;
$unit = NULL;

//check data type - var_dump()
echo var_dump($first_name);
echo "<br>";
echo var_dump($age);
echo "<br>";
echo var_dump($height);
echo "<br>";
echo var_dump($have_registered);
echo "<br>";
echo var_dump($unit);

//arrays
$students = array("John", "Janet", "Joy");
$marks = array(25, 50, 78);

//accessing elements in indexed arrays: array[index]
echo $students[1];
echo $marks[2];

//associative arrays: named keys usd to acces the values/elements in the array
$marks_of_students = array("John"=>25, "Janet"=>50, "Joy"=>78);

//accessing element in associative array[namedkey]
echo $marks_of_students["Janet"];

//adding strings/concerntration(.)
$fullname = "John"."Mark";
echo $fullname;
$my_age = 14;
if($my_age<18){
    echo"<p>Cannot vote</p>";
}elseif ($my_age>18){
    echo "<p>Can vote</p>";
}else{
    echo"<p>First time voter</p>";
}
$day_of_week = 2;

//switch case
switch($day_of_week){
    case 1:
        echo "Monday";
        break;
    case 2:
        echo "Tuesday";
        break;
    case 3:
        echo "Not Monday or Tuesday";
        break;
}
//for loop
for($i=0; $i<4; $i++){
    echo "<button>Button $i</button>";
}
//while loop
$j = 1;
while ($j<= 5){
    echo "<br>Statement $j";
    $j = $j + 2;
}
foreach($students as $student_name){
    echo $student_name."<br>";
}
foreach($marks_of_students as $students => $marks){
    echo "$student scored $marks <br>";
}

//functions
function helloFunction(){
    echo "<h2>Hello Function</h2>";
}
helloFunction();
function getDivision($num1, $num2){
    return $num1/$num2;
}
$my_division = getDivision(100, 25);
echo $my_division;

//built-in function
//date() function
echo "<br>";
echo date("d/m/y");

//isset()
$x = null;
if(isset($x)){
    echo "variable is set";
}else {
    echo "Variable not set";
}


# closing php tag ?> 