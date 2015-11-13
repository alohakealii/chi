<?php
class Person{
    private $firstName;
    private $lastName;
    private $day;
    private $startTime;
    private $endTime;

    public function getFirst() {return $this->firstName;}
    public function getLast() {return $this->lastName;}
    public function getDay() {return $this->day;}
    public function getStart() {return $this->startTime;}
    public function getEnd() {return $this->endTime;}
}

function createTableRow(Person $p){
    print "         <tr>\n";
    print "             <td>" . $p->getFirst()   . "</td>\n";
    print "             <td>" . $p->getLast()    . "</td>\n";
    print "             <td>" . $p->getDay()     . "</td>\n";
    print "             <td>" . $p->getStart()   . "</td>\n";
    print "             <td>" . $p->getEnd()     . "</td>\n";
    print "         </tr>\n";
}

$age = filter_input(INPUT_POST, "age");
$startTime = filter_input(INPUT_POST, "startTime");

try{
    $con = new PDO("mysql:host=localhost;dbname=chi", "root", "root");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query =    "SELECT firstName, lastName, day, startTime, endTime 
                 FROM availabilities
                 NATURAL JOIN profiles";

    $data = $con->query($query);
    $data->setFetchMode(PDO::FETCH_CLASS, "Person");

    print("Users younger than ".$age." and available after ".$startTime);
    print "    <table border='1'>\n";

    $result = $con->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);

    print "            <tr>\n";
    foreach ($row as $field => $value) {
            print "                <th>$field</th>\n";
    }
    print "            </tr>\n";


    if (!empty($age) && !empty($startTime)){

        $query =    "SELECT firstName, lastName, day, startTime, endTime 
                     FROM availabilities
                     NATURAL JOIN profiles 
                     WHERE profiles.age < :age 
                     AND availabilities.startTime >= :startTime";

        $ps = $con->prepare($query);
        $ps->bindParam(':age', $age);
        $ps->bindParam(':startTime', $startTime);
    }
    else{
        $ps = $con->prepare($query);
    }

    $ps->execute();
    $ps->setFetchMode(PDO::FETCH_CLASS, "Person");

    while($person = $ps->fetch()){
        print "        <tr>\n";
        createTableRow($person);
        print "        </tr>\n";
    }
    print "    </table>\n";
}
catch(PDOException $ex) {
    echo 'ERROR: '.$ex->getMessage();
} 
?>