<!-- <!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>Chi</title>
        <link rel="stylesheet" href="chi.css">
    </head>

    <body>
    	<header>
            <p>Team Chi</p>
        </header>
        <nav>
                <ul>
                <li><a href="http://cs.sjsu.edu/~mak/CS174/index.html">Course Page</a></li>
                <li><a href="http://cs.sjsu.edu/~mak/CS174/assignments/2/Assignment2.pdf">Assignment 2</a></li>
                <li><a href="https://www.google.com/?gws_rd=ssl">Google</a></li>
                <li><a href="http://www.w3schools.com/">w3schools</a></li>
                </ul>
            </nav>
            <sidebar>
                <p><a href="index.html">Home</a></p>
                <p><a href="#">My Profile</a></p>
                <p><a href="#">Check In</a></p>
                <p><a href="#">Locations</a></p>
                <p><a href="#">Search</a></p>
                <p><a href="#">User Directory</a></p>
                <p><a href="#">Site map</a></p>
            </sidebar>

            <main> -->
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


                //   function constructTable($data){
                //     print("<table border='1'>\n");

                //     // Constructs table header
                //     $doHeader = true;
                //     foreach ($data as $row) {
                //         if($doHeader){
                //             print("<tr>");
                //             foreach ($row as $name => $value) {
                //                 print("<th>$name</th>\n");
                //             }
                //             print("</tr>\n");
                //             $doHeader = false;
                //         }
                //         // Constructs table row
                //         print("<tr>\n");
                //         foreach ($row as $name => $value) {
                //             print("<td>$value</td>\n");
                //         }
                //         print("</tr>\n"); 
                //     }
                //     print("</table>\n");
                // }

                // $age = filter_input(INPUT_POST, "age");
                // $startTime = filter_input(INPUT_POST, "startTime");

                // try{
                // 	if(empty($age) || empty($startTime)){
                // 		throw new Exception("Missing age and or time");
                // 	}

                // 	print("Users younger than ".$age." and available after ".$startTime);

                // 	$con = new PDO("mysql:host=localhost;dbname=chi", "root", "root");
                // 	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // 	$query = "SELECT firstName, lastName, day, startTime, endTime FROM availabilities
                // 			  NATURAL JOIN profiles WHERE profiles.age < :age AND availabilities.startTime >= :startTime";

                // 	$ps = $con->prepare($query);

                // 	$ps->bindParam(':age', $age);
                // 	$ps->bindParam(':startTime', $startTime);
                // 	$ps->execute();
                // 	$data = $ps->fetchAll(PDO::FETCH_ASSOC);

                // 	if(count($data) > 0){
                // 		constructTable($data);
                // 	}
                // 	else{
                // 		print("<h3>No one below that age is available after that time</h3>");
                // 	}
                // }
                // catch(PDOException $ex){
                // 	echo 'ERROR: '.$ex->getMessage();
                // }
                // catch(Exception $ex){
                // 	echo 'ERROR: '.$ex->getMessage();
                // }
                ?>
            <!-- </main>
            <footer>
                <p>Site is (c) Chi Team 2015</p>    
            </footer>
    </body>
</html> -->