
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

try{
    // Connect to the database.
    $con = new PDO("mysql:host=localhost;dbname=chi", "root", "root");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query =   "SELECT firstName, lastName, day, startTime, endTime 
                FROM availabilities NATURAL JOIN profiles";

    // Fetch the matching database table rows.
    $data = $con->query($query);
    $data->setFetchMode(PDO::FETCH_CLASS, "Person");

    // We're going to construct an HTML table.
    print "     <table border='1'>\n";

    // Fetch the database field names.
    $result = $con->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);

    // Construct the header row of the HTML table.
    print "            <tr>\n";
    foreach ($row as $field => $value) {
        print "                <th>$field</th>\n";
    }
    print "            </tr>\n";

    // Prepare query
    $ps = $con->prepare($query);

    // Fetch the matching database table rows.
    $ps->execute();
    $ps->setFetchMode(PDO::FETCH_CLASS, "Person");

    // Construct the HTML table row by row.
    while ($person = $ps->fetch()) {
        print "        <tr>\n";
        createTableRow($person);
        print "        </tr>\n";
    }
     print "    </table>\n";

    }
    catch(PDOException $ex){
        echo 'ERROR: ' . $ex->getMessage();
    }

print '    <p><button type="button" onclick="preparedBack()" id="backBtn">Back</button></p>'
?>
