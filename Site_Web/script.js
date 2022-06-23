/*const mysql = require('mysql');

const db = mysql.createConnection({
  host: "localhost",
  user: "user",
  password: "lmmmll",
  database : "sae24"
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connecté à la base de données MySQL!");
  con.query("SELECT eleves.id as 'eleve_id', eleves.nom as 'eleve_nom', eleves.cours_id, cours.nom as 'cours_nom', cours.date as 'cours_date' FROM eleves JOIN cours on eleves.cours_id = cours.id", function (err, result) {
      if (err) throw err;
      console.log(result);
   });
});*/

const divgrille = document.querySelector("#grille");

var tableau = [
  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0],
  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0],
  [0, 0, 0, 0, 0, 0, 0, 0, 2, 2, 2, 0, 0, 0, 0, 0],
  [0, 0, 0, 0, 0, 0, 0, 0, 2, 3, 2, 0, 0, 0, 0, 0],
  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
  
];

afficherGrille();

function afficherGrille(){
  var txt ="";

  for (var i=0; i < tableau.length; i++) {
    txt += "<div>";
    for (var j=0; j < tableau[i].length; j++) {
      if (tableau[i][j] === 0) {
        txt += "<button class='rien'></button>";//Pas passé
      } 
      if (tableau[i][j] === 1) {
        txt += "<button class='now'></button>";//Présent
      }
      if (tableau[i][j] === 2) {
        txt += "<button class='passage'></button>";//Déja passé
      }
      if (tableau[i][j] === 3) {
        txt += "<button class='multipassage'></button>";//Passage multiple
      }
    }
    txt += "</div>";
  }
  divgrille.innerHTML = txt;
}
