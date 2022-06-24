<!DOCTYPE html>
<html lang="fr">
 <head>
  <title>SAE 24</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
  <meta http-equiv= "X-UA-Compatible" content= "IE=edge" />
  <meta name="author" content="G2" />
  <meta name="description" content="SAE24" />
  <meta name="keywords" content="HTML, CSS" />
  <link rel="stylesheet" type="text/css" href="CSS/style.css" />
 </head>
    <header>
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
  
    <body>
        <br>
        <h1> Position </h1>
        <h2>Historique des positions</h2>
        <table>
            <th>x</th>
            <th>y</th>
            <th>Date et Heure</th>
            <?php
                include("./mysql.php");
                $query = "SELECT * FROM position order by `date/heure` DESC";
                $result = mysqli_query($id_bd, $query);
                $nb_data = mysqli_num_rows($result);
                
                for ($i=0; $i<$nb_data; $i++){
                    $row = mysqli_fetch_assoc($result);
                    $x= $row["pos_x"];
                    $y = $row["pos_y"];
                    $date = $row["date/heure"];
                    echo "<tr><td>".$x."</td>";
                    echo "<td>".$y."</td>";
                    echo "<td>".$date."</td></tr>";
                }
            ?>
        </table>
        <h2>Positions en temps réel</h2>
        <div class="grille">
            <?php
                $tableau=array(
                    array(10,0,0,0,0,0,0,0,0,0,0,0,0,0,0,10),
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
                
                $query = "SELECT * FROM position order by `date/heure`";
                $result = mysqli_query($id_bd, $query);
                $nb_data = mysqli_num_rows($result);
                
                for ($i=0; $i<$nb_data; $i++){
                    $row = mysqli_fetch_assoc($result);
                    $x= $row["pos_x"];
                    $y = $row["pos_y"];
                    $date = $row["date/heure"];
                    
                    if($i==$nb_data-1){
                        $tableau[$y][$x] = 1;
                    } else {
                        if($i==1){
                            $tableau[$y][$x] = 4;
                        }
                        if($tableau[$y][$x]==2 or $tableau[$y][$x]==3){
                            $tableau[$y][$x] = 3;
                        }
                        else {
                            $tableau[$y][$x] = 2;
                        }
                    }
                }

                for($i=0;$i<16;$i++){
                    for($j=0;$j<16;$j++){
                        if($tableau[$i][$j]===0){
                            echo "<button class='rien'></button>";
                        }
                        if($tableau[$i][$j]===1){
                            echo "<button class='now'></button>";
                        }
                        if($tableau[$i][$j]===2){
                            $query = "SELECT `date/heure` FROM position WHERE pos_x = '".$j."' AND pos_y = '".$i."'";
                            $result = mysqli_query($id_bd, $query);
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