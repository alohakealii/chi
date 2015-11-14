<?php
class Lostname
{
    private $username;

    public function getUsername() {return $this->username;}
}

function createTableRow(Lostname $l){
    print "        <tr>\n";
    print "            <td>" . $l->getUsername()     . "</td>\n";
    print "        </tr>\n";
}

$firstName = filter_input(INPUT_POST, "firstName");
$lastName  = filter_input(INPUT_POST, "lastName");

try{
    $con = new PDO("mysql:host=localhost;dbname=chi", "root", "root");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query =   "SELECT username 
                FROM users
                NATURAL JOIN profiles";

    $data = $con->query($query);
    $data->setFetchMode(PDO::FETCH_CLASS, "Lostname");

    print "    <table border='1'>\n";

    $result = $con->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);

    print "            <tr>\n";
    foreach ($row as $field => $value) {
            print "                <th>$field</th>\n";
    }
    print "            </tr>\n";


    if ((strlen($firstName) > 0) && (strlen($lastName) > 0)){

        $query =   "SELECT username 
                    FROM users
                    NATURAL JOIN profiles 
                    WHERE profiles.firstName = :firstName 
                    AND profiles.lastName = :lastName";

        $ps = $con->prepare($query);
        $ps->bindParam(':firstName', $firstName);
        $ps->bindParam(':lastName', $lastName);
    }
    else{
        $ps = $con->prepare($query);
    }

    $ps->execute();
    $ps->setFetchMode(PDO::FETCH_CLASS, "Lostname");

    while($lost = $ps->fetch()){
        print "        <tr>\n";
        createTableRow($lost);
        print "        </tr>\n";
    }
    print "    </table>\n";
}
catch(PDOException $ex) {
    echo 'ERROR: '.$ex->getMessage();
};

print '    <p><button onclick="preparedBack()" id="backBtn">Back</button></p>'
?>