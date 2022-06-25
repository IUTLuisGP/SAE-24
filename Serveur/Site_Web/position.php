<!DOCTYPE html>
<html lang="fr">
 <head>
	 <!-- Title of the web page -->
  <title>SAE 24</title>
	 
	 <!-- Definition of the metadata of the website -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
  <meta http-equiv= "X-UA-Compatible" content= "IE=edge" />
  <meta name="author" content="G2" />
  <meta name="description" content="SAE24" />
  <meta name="keywords" content="HTML, CSS" />
  <link rel="stylesheet" type="text/css" href="CSS/style.css" />
 </head>
    <header>
	    <!-- Navigation bar -->
      <nav>
            <ul>
              <a href="index.html"><img src="Images/logo.png" alt="Images/logo.png"/></a>
              <li><p> PROJET INTÉGRATIF </p> </li>
              <li><a href="mentions_legales.html"> Mentions légales </a> </li>
              <li><a href="gantt.html"> Planning </a></li> 
              <li> <a href="position.php"> Position </a></li>
              <li><a href="problèmes.html">Problèmes rencontrés </a></li>
                </ul>
      </nav>
    </header>
  <!-- Beginning of the web page's body -->
    <body>
        <br>
        <h1> Position </h1>
        <h2>Historique des positions</h2>
        <table>
            <th>x</th>
            <th>y</th>
            <th>Date et Heure</th>
            <?php
                include("./mysql.php"); # Connection to the database
                $query = "SELECT * FROM position order by `date/heure` DESC"; # Query that selects all data sorted by date from the most recent to the oldestquery that selects all data sorted by date from the most recent to the oldest
                $result = mysqli_query($id_bd, $query); # Send the SQL query
                $nb_data = mysqli_num_rows($result); # nb_data is a variable that counts the number of rows that the query gives
                
                for ($i=0; $i<$nb_data; $i++){# For i from 0 to the number of rows in the query
                    $row = mysqli_fetch_assoc($result); # Associates the result of the query to an array
                    $x= $row["pos_x"];
                    $y = $row["pos_y"];
                    $date = $row["date/heure"];
                    echo "<tr><td>".$x."</td>";# Puts in a table the value x
                    echo "<td>".$y."</td>";# Puts in a table the value y
                    echo "<td>".$date."</td></tr>";# Puts in a table the date and the hours
                }
            ?>
        </table>
        <h2>Positions en temps réel</h2>
        <div class="grille">
            <?php
                # Initialization of the matrix #
                $tableau=array(
                    array(10,0,0,0,0,0,0,0,0,0,0,0,0,0,0,10), # 10 represents the coordinate of a sensor
                    array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
                    array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
                    array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
                    array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
                    array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
                    array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
                    array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
                    array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
                    array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
                    array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
                    array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
                    array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
                    array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
                    array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
                    array(10,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)
                );
                
                $query = "SELECT * FROM position order by `date/heure`"; #Query that selects all data sorted by date from the most recent to the oldestquery that selects all data sorted by date from the oldest to the most recent
                $result = mysqli_query($id_bd, $query); # Send the SQL query
                $nb_data = mysqli_num_rows($result); # nb_data is a variable that counts the number of rows that the query gives
                
                for ($i=0; $i<$nb_data; $i++){# For i from 0 to the number of rows in the query
                    $row = mysqli_fetch_assoc($result); # Associates the result of the query to an array
                    $x= $row["pos_x"];
                    $y = $row["pos_y"];
                    $date = $row["date/heure"];
                    
                    if($i==$nb_data-1){ # If it's the last data, it's the most recent so it's the current location of the object
                        $tableau[$y][$x] = 1;
                    } else {
                        if($i==0){# If i =0 then it is the first data and thus the starting point
                            $tableau[$y][$x] = 4;
                        }
                        if($tableau[$y][$x]==2 or $tableau[$y][$x]==3){# If the data has already been marked as a waypoint and is returned
                            $tableau[$y][$x] = 3;
                        }
                        else { # Otherwise we mark the data as a waypoint
                            $tableau[$y][$x] = 2;
                        }
                    }
                }
                # Loop that displays the array with the different types of boxes #
                for($i=0;$i<16;$i++){
                    for($j=0;$j<16;$j++){
                        if($tableau[$i][$j]===0){
                            echo "<button class='rien'></button>";
                        }
                        if($tableau[$i][$j]===1){
                            echo "<button class='now'></button>";
                        }
                        if($tableau[$i][$j]===2){
                            echo "<button class='passage'></button>";
                        }
                        if($tableau[$i][$j]===3){
                            echo "<button class='multipassage'></button>";
                        }
                        if($tableau[$i][$j]===4){
                            echo "<button class='depart'></button>";
                        }
                        if($tableau[$i][$j]===10){
                            echo "<button class='capteur'></button>";
                        }
                    }
                    echo "<br />";
                }
            ?>
        </div>
		<!-- Website's footer -->
        <footer>
         <ul>
    				<li>
              <a href="https://jigsaw.w3.org/css-validator/#validate_by_input">
                  <img style="border:0;width:88px;height:31px"
                      src="http://jigsaw.w3.org/css-validator/images/vcss"
                      alt="CSS Validé!" /></a>
    				</li>
    				<li>
    					<a href="https://validator.w3.org/#validate_by_input">
    						<img style="border:0;width:88px;height:31px"
    							src="https://www.w3.org/Icons/valid-html401.png"
    							alt="HTML Validé!" /></a>
    				</li>
          <li> IUT R&T </li>
			</ul>
		</footer>
	</body>
</html>
