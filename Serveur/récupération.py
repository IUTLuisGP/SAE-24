#Part 2 of the code corresponding to the calculation of the position

import json
import numpy as np
import math 
import random
import time
import subprocess

nb_colonnes=16
nb_lignes=16

def Table_Capteur(posx, posy):
    Amp_Capteur=np.zeros((nb_colonnes,nb_lignes))
    for i in range(nb_colonnes):
      for j in range(nb_lignes):
        diviseur = (i - posx)*(i - posx)+(j - posy)*(j - posy)
        if diviseur == 0 :
             Amp_Capteur[i,j]=1
        else:
          Amp_Capteur[i,j]=1/(math.sqrt(diviseur))      
    return Amp_Capteur

def Table_Conversion(matrice_capteur, amp):
    Conv_Capteur=np.zeros((nb_colonnes,nb_lignes))
    for i in range(nb_colonnes):
        for j in range(nb_lignes):
            if matrice_capteur[i,j] - amp < 0.0001 and matrice_capteur[i,j] - amp > -0.0001 :
              Conv_Capteur[i,j]=1
            else:
                Conv_Capteur[i,j]=0
    return Conv_Capteur

def Compare(matrice_c1, matrice_c2, matrice_c3):
    for i in range(nb_colonnes):
      for j in range(nb_lignes):
        if matrice_c1[i,j] == matrice_c2[i,j] and  matrice_c1[i,j] == matrice_c3[i,j] and  matrice_c1[i,j] == 1 :
          position_x=i
          position_y=j
    return position_x, position_y




with open('/Application/SAE24/JSON/temp1.json') as file:
	data = json.load(file)
Ampli1=data['ampli']

with open('/Application/SAE24/JSON/temp2.json') as file:
	data = json.load(file)
Ampli2=data['ampli']
with open('/Application/SAE24/JSON/temp3.json') as file:
	data = json.load(file)
Ampli3=data['ampli']

#Correspond aux valeurs reçu par mosquitto
Capteur1=int(Ampli1)/10**8
Capteur2=int(Ampli2)/10**8
Capteur3=int(Ampli3)/10**8

Capteur_1_Ampli=Table_Capteur(0, 0)
Capteur_2_Ampli=Table_Capteur(0, nb_lignes-1)
Capteur_3_Ampli=Table_Capteur(nb_colonnes-1, nb_lignes-1)


Capteur_1_conv=Table_Conversion(Capteur_1_Ampli,Capteur1)
Capteur_2_conv=Table_Conversion(Capteur_2_Ampli,Capteur2)
Capteur_3_conv=Table_Conversion(Capteur_3_Ampli,Capteur3)


Position_finale=Compare(Capteur_1_conv,Capteur_2_conv,Capteur_3_conv)

print(Position_finale)
subprocess.call('/opt/SAE24/sql.sh Position_finale[0] Position_finale[1]', shell=True)