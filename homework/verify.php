
<?php

try {
    $con = new PDO("mysql:host=localhost;dbname=chi", "root", "root");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // declare variables from form
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    if (isset($_POST['ageControl'])) { $ageControl = $_POST['ageControl']; }

    // build query based on selected parameters
    $parameterCount = 0;
    $query = "SELECT * FROM profiles WHERE";
    if ((strlen($firstName) > 0)) {
        $query .= " firstName='$firstName'";
        $parameterCount++;
    }

    if ((strlen($lastName) > 0)) {
        if ($parameterCount > 0) { $query .= " AND"; }
        $query .= " lastName='$lastName'";
        $parameterCount++;
    }

    if ((strlen($age) > 0) && (isset($ageControl))) {
        if ($parameterCount > 0) { $query .= " AND"; }
        $query .= " age $ageControl $age";
        $parameterCount++;
    }

    if ((strlen($gender) > 0)) {
        if ($parameterCount > 0) { $query .= " AND"; }
        if ($gender == "both") {
            $query .= " (gender='male' or gender='female')"; }
        else { 
            $query .= " gender='$gender'";
            $parameterCount++;
        }
        
    }

    // if no parameters selected, return all
    if ($parameterCount == 0) { $query = "SELECT * FROM profiles"; }

    // for debugging purposes
    // echo $query;

    $data = $con -> query($query);
    $data -> setFetchMode(PDO::FETCH_ASSOC);
    $rowCount = $data -> rowCount();

    $doHeader = true;    
    if ($rowCount == 0) {
        echo "no matching results";
    } else {
        $table = "<table border='1'><tr>";
        // for loop to create headers
        foreach ($data as $row) {
            if ($doHeader) {
                foreach ($row as $header => $value) {
                    $table .= "<th>$header</th>";
                }
                $table .= "</tr>";
                $doHeader = false;
            }

            // for loop to populate rows with results
            foreach ($row as $name => $value) {
                $table .= "<td>$value</td>";
            }
            $table .= "</tr>";
        }
        $table .= "</table>";
    
        echo $table;
    }
} catch (PDOException $ex) {
    echo 'ERROR: '.$ex->getMessage();
}

print '    <p><button onclick="regBack()" id="backBtn">Back</button></p>'
?>