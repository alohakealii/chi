<!DOCTYPE html>
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

            <main>
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

                // $firstName = filter_input(INPUT_POST, "firstName");
                // $lastName = filter_input(INPUT_POST, "lastName");

                // try{
                // 	if(empty($firstName) || empty($lastName)){
                // 		throw new Exception("Missing first or last name");
                // 	}

                // 	print("Your Username");

                // 	$con = new PDO("mysql:host=localhost;dbname=chi", "root", "root");
                // 	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // 	$query = "SELECT username FROM users
                // 			  NATURAL JOIN profiles WHERE profiles.firstName = :firstName AND profiles.lastName = :lastName";

                // 	$ps = $con->prepare($query);

                // 	$ps->bindParam(':firstName', $firstName);
                // 	$ps->bindParam(':lastName', $lastName);
                // 	$ps->execute();
                // 	$data = $ps->fetchAll(PDO::FETCH_ASSOC);

                // 	if(count($data) > 0){
                // 		constructTable($data);
                // 	}
                // 	else{
                // 		print("<h3>No username linked to that name</h3>");
                // 	}
                // }
                // catch(PDOException $ex){
                // 	echo 'ERROR: '.$ex->getMessage();
                // }
                // catch(Exception $ex){
                // 	echo 'ERROR: '.$ex->getMessage();
                // }
                ?>
            </main>
            <footer>
                <p>Site is (c) Chi Team 2015</p>    
            </footer>
    </body>
</html>