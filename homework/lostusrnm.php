<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>Chi</title>
        <link rel="stylesheet" href="css/jquery-ui.min.css">
        <link rel="stylesheet" href="css/chi.css">

        <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/chi.js"></script>
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
                  function constructTable($data){
                    print("<table border='1'>\n");

                    // Constructs table header
                    $doHeader = true;
                    foreach ($data as $row) {
                        if($doHeader){
                            print("<tr>");
                            foreach ($row as $name => $value) {
                                print("<th>$name</th>\n");
                            }
                            print("</tr>\n");
                            $doHeader = false;
                        }
                        // Constructs table row
                        print("<tr>\n");
                        foreach ($row as $name => $value) {
                            print("<td>$value</td>\n");
                        }
                        print("</tr>\n"); 
                    }
                    print("</table>\n");
                }

                $firstName = filter_input(INPUT_POST, "firstName");
                $lastName = filter_input(INPUT_POST, "lastName");

                try{
                	if(empty($firstName) || empty($lastName)){
                		throw new Exception("Missing first or last name");
                	}

                	print("Your Username");

                	$con = new PDO("mysql:host=localhost;dbname=chi", "root", "root");
                	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                	$query = "SELECT username FROM users
                			  NATURAL JOIN profiles WHERE profiles.firstName = :firstName AND profiles.lastName = :lastName";

                	$ps = $con->prepare($query);

                	$ps->bindParam(':firstName', $firstName);
                	$ps->bindParam(':lastName', $lastName);
                	$ps->execute();
                	$data = $ps->fetchAll(PDO::FETCH_ASSOC);

                	if(count($data) > 0){
                		constructTable($data);
                	}
                	else{
                		print("<h3>No username linked to that name</h3>");
                	}
                }
                catch(PDOException $ex){
                	echo 'ERROR: '.$ex->getMessage();
                }
                catch(Exception $ex){
                	echo 'ERROR: '.$ex->getMessage();
                }
                ?>
            </main>
            <footer>
                <p>Site is (c) Chi Team 2015</p>    
            </footer>
    </body>
</html>