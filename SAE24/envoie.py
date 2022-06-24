import numpy as np
import math 
import random
import time
import subprocess

nb_colonnes=16
nb_lignes=16

def Random(ancien_x,ancien_y):
  range= [-1, 0, 0, 1]
  if ancien_x == 0 :
    temp_x=(random.randint(0,1))
  elif ancien_x == nb_colonnes-1 :
    temp_x=(random.randint(-1,0))
  else :
    temp_x=random.choice(range)
  
  if ancien_y == 0 :
    if temp_x==0 :
      temp_y=1
    else :
      temp_y=0
  elif ancien_y == nb_lignes-1 :
    if temp_x==0 :
      temp_y=-1
    else :
      temp_y=0
  else :
    if temp_x==0:
      range= [-1, 1]
      temp_y=random.choice(range)
    else :
      temp_y=0
  nouveau_x = ancien_x + temp_x
  nouveau_y = ancien_y + temp_y
  return nouveau_x, nouveau_y


def Amplitude(posx, posy):
  Amplitude=np.zeros((nb_colonnes,nb_lignes))
  for i in range(nb_colonnes):
    for j in range(nb_lignes):
      diviseur = (i - posx)*(i - posx)+(j - posy)*(j - posy)
      if diviseur == 0 :  
           Amplitude[i,j]=1    
      else:
        Amplitude[i,j]=1/(math.sqrt(diviseur))     
  C1 = Amplitude[0][0]
  C2 = Amplitude[0][nb_colonnes-1]
  C3 = (Amplitude[nb_lignes-1][nb_colonnes-1])

  return C1, C2, C3

def binary(Capteur):

  Capteur = bin(round(Capteur*10**8))
  return Capteur

j=0
Position_finale=np.array([nb_colonnes-1,nb_lignes/2])

while j<1:
  
  Position= Random(Position_finale[0],Position_finale[1])
    
  Ampli= Amplitude(Position[0],Position[1])
  
  Capteur1=binary(Ampli[0])
  Capteur2=binary(Ampli[1])
  Capteur3=binary(Ampli[2])
  
  print(Capteur1, Capteur2, Capteur3)
  subprocess.call(['/opt/SAE24/pub.sh', Capteur1, Capteur2, Capteur3])
  
  Position_finale=Position
  time.sleep(120)







