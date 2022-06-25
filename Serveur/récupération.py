#Part 2 of the code corresponding to the calculation of the position

#Import of libraries
import json
import numpy as np
import math 
import random
import time
import subprocess

#Definitions of the size of the sensor area
nb_colonnes=16
nb_lignes=16


#Create a matrice of Amplitude for a sensor
def Table_Capteur(posx, posy):
    Amp_Capteur=np.zeros((nb_colonnes,nb_lignes)) #Initialisation of the matrice filled with 0
    for i in range(nb_colonnes):
      for j in range(nb_lignes):
        diviseur = (i - posx)*(i - posx)+(j - posy)*(j - posy) #This variable avoid to divide by 0
        if diviseur == 0 :
             Amp_Capteur[i,j]=1
        else:
          Amp_Capteur[i,j]=1/(math.sqrt(diviseur)) #formula for the Amplitude      
    return Amp_Capteur

#Compare the amplitude of the sensor and the matrice we just made to fill the possible cells with a 1, else a 0
def Table_Conversion(matrice_capteur, amp):
    Conv_Capteur=np.zeros((nb_colonnes,nb_lignes)) #Initialisation of the matrice filled with 0
    for i in range(nb_colonnes):
        for j in range(nb_lignes):
            if matrice_capteur[i,j] - amp < 0.0001 and matrice_capteur[i,j] - amp > -0.0001 : #For each cell, searching for a value close to the one we input
              Conv_Capteur[i,j]=1
            else:
                Conv_Capteur[i,j]=0
    return Conv_Capteur

#Compare 3 matrice to find a cell where every matrice=1
def Compare(matrice_c1, matrice_c2, matrice_c3):
    for i in range(nb_colonnes):
      for j in range(nb_lignes):
        if matrice_c1[i,j] == matrice_c2[i,j] and  matrice_c1[i,j] == matrice_c3[i,j] and  matrice_c1[i,j] == 1 : #Comparison of each cell
          position_x=i #Final position in x
          position_y=j #Final position in y
    return position_x, position_y



# Retrieves the amplitude data in binary and puts them in variables #
with open('/opt/SAE24/JSON/temp1.json') as file:
	data = json.load(file)
Ampli1=data['ampli']

with open('/opt/SAE24/JSON/temp2.json') as file:
	data = json.load(file)
Ampli2=data['ampli']
with open('/opt/SAE24/JSON/temp3.json') as file:
	data = json.load(file)
Ampli3=data['ampli']

# Function to convert binary data into decimal data #
def binary_to_decimal(binary):
    if "0b" in binary:
        binary = binary.replace("0b", "")
    total = 0
    for i, bit in enumerate(binary[::-1]): #Allow to count each caracter
        total += int(bit) * 2**i #If the caracter =1, we multiply it considering the position it is at
    return total

#Putting back the value we retrieved in decimal
Capteur1=binary_to_decimal(Ampli1)/10**8
Capteur2=binary_to_decimal(Ampli2)/10**8
Capteur3=binary_to_decimal(Ampli3)/10**8

#Setting the matrice of amplitude for each sensor
Capteur_1_Ampli=Table_Capteur(0, 0)
Capteur_2_Ampli=Table_Capteur(0, nb_lignes-1)
Capteur_3_Ampli=Table_Capteur(nb_colonnes-1, nb_lignes-1)

#Find the possible value for each matrice compared to the amplitude
Capteur_1_conv=Table_Conversion(Capteur_1_Ampli,Capteur1)
Capteur_2_conv=Table_Conversion(Capteur_2_Ampli,Capteur2)
Capteur_3_conv=Table_Conversion(Capteur_3_Ampli,Capteur3)


Position_finale=Compare(Capteur_1_conv,Capteur_2_conv,Capteur_3_conv)

posx=Position_finale[0]
posy=Position_finale[1]

print(Position_finale)
subprocess.call(['/opt/SAE24/sql.sh', str(posx), str(posy)]) #Send the position to a bash program
