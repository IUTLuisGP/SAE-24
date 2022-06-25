# Import of libraries #
import numpy as np
import math 
import random
import time
import subprocess

# Definitions of the size of the sensor area #
nb_colonnes=16
nb_lignes=16

# The Random function will generate consistent positions based on the old positions #

def Random(ancien_x,ancien_y):
  range= [-1, 0, 0, 1] # There is as much chance that x will change or not
  if ancien_x == 0 : # If the value generated is out of range
    temp_x=(random.randint(0,1))
  elif ancien_x == nb_colonnes-1 : # If the value generated is out of range
    temp_x=(random.randint(-1,0))
  else :
    temp_x=random.choice(range)
  
  if ancien_y == 0 :# If the value generated is out of range
    if temp_x==0 :
      temp_y=1
    else :
      temp_y=0
  elif ancien_y == nb_lignes-1 :# If the value generated is out of range
    if temp_x==0 :
      temp_y=-1
    else :
      temp_y=0
  else : # If x does not change y must change to simulate the move
    if temp_x==0:
      range= [-1, 1]
      temp_y=random.choice(range)
    else :
      temp_y=0 
  # Increment of new values #
  nouveau_x = ancien_x + temp_x
  nouveau_y = ancien_y + temp_y

  # Return the new values #
  return nouveau_x, nouveau_y

# The amplitude function will generate the amplitude in each cell of a matrice and return only those for the sensors
def Amplitude(posx, posy):
  Amplitude=np.zeros((nb_colonnes,nb_lignes)) #Return a new array of given shape and type, filled with zeros (in this case an array of 16x16)
  for i in range(nb_colonnes):
    for j in range(nb_lignes):
      diviseur = (i - posx)*(i - posx)+(j - posy)*(j - posy) #This variable avoid to divide by 0
      if diviseur == 0 :  
           Amplitude[i,j]=1    
      else:
        Amplitude[i,j]=1/(math.sqrt(diviseur)) #formula for the Amplitude 
  C1 = Amplitude[0][0] #Amplitude of the 1st sensor
  C2 = Amplitude[0][nb_colonnes-1] #Amplitude of the 2nd sensor
  C3 = (Amplitude[nb_lignes-1][nb_colonnes-1]) #Amplitude of the 3rd sensor

  return C1, C2, C3

#Switch values from decimal to nibary
def binary(Capteur):

  Capteur = bin(round(Capteur*10**8)) #Multiplying by 10**8 # Allow to have less errors 
  return Capteur


j=0
Position_finale=np.array([nb_colonnes-1,nb_lignes/2]) #Initial Position for the object

while j<1:
  
  Position= Random(Position_finale[0],Position_finale[1])
    
  Ampli= Amplitude(Position[0],Position[1])
  
  Capteur1=binary(Ampli[0])
  Capteur2=binary(Ampli[1])
  Capteur3=binary(Ampli[2])
  
  print(Capteur1, Capteur2, Capteur3)
  subprocess.call(['/opt/SAE24/pub.sh', Capteur1, Capteur2, Capteur3]) #Call a bash program by giving him 3 arguments
  
  Position_finale=Position
  time.sleep(120) #Wait 2 minutes
