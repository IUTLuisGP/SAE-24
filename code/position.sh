#!/bin/bash
pos=("$1" "$2")
nbrpos=5

for ((i=1;i<=$nbrpos;i++))
do
    tabx=("1" "0" "0" "1")
    if [ ${pos[0]} -eq 0 ]
    then
        temp_x=$(($RANDOM% 2 + 2))
    elif [ ${pos[0]} -eq 15 ]
    then
        temp_x=$(($RANDOM% 3))
    else
        temp_x=$(($RANDOM% 4))
    fi

    if [ $temp_x -eq 0 ]
    then
        newposx=$(expr ${pos[0]} - ${tabx[$temp_x]})
        echo "-X"
        pos=("$newposx" "${pos[1]}")
        echo "${pos[@]}"
    else
        if [ $temp_x -eq 1 ] || [ $temp_x -eq 2 ]
        then
            if [ ${pos[1]} -eq 0 ]
            then
                temp_y=1
            elif [ ${pos[1]} -eq 15 ]
            then
                temp_y=0
            else
                temp_y=$(($RANDOM% 2))
            fi
            if [ $temp_y -eq 1 ]
            then
                newposy=$(expr ${pos[1]} + 1)
                pos=("${pos[0]}" "$newposy")
                echo "+Y"
                echo "${pos[@]}"
            else
                newposy=$(expr ${pos[1]} - 1)
                pos=("${pos[0]}" "$newposy")
                echo "-Y"
                echo "${pos[@]}"
            fi
        else
            newposx=$(expr ${pos[0]} + ${tabx[$temp_x]})
            echo "+X"
            pos=("$newposx" "${pos[1]}")
            echo "${pos[@]}"
        fi
    fi
    #$date=$(date +"%Y-%m-%d")
    #$heure=$(date +%T)
    #query="INSERT INTO \`horaire\`(\`id_horaire\`, \`date\`, \`heure\`) VALUES (Null,'$date', '$heure')"
    #/opt/lampp/bin/mysql -h localhost -u root -p -D bd_saé24 -e "$query"

    #query="SELECT \`id_horaire\` FROM \`horaire\` WHERE date='$date' AND hours='$hours'"
    #idmesu=$(/opt/lampp/bin/mysql -h localhost -u root -p -D bd_saé24 -e "$query") #Return "idcapt <number>"
    #idmesu=$(echo ${idmesu} | sed 's/.\{6\}//') #delete the first 6 caracters to transform the variable to a number

    #query="INSERT INTO \`données\` (\`id_données\`, \`données-capteur(x)\`, \`données-capteur(y)\`, \`id_horaire\`) VALUES ( NULL, ${pos[0]}, ${pos[1]}, $idmesu);"
    #/opt/lampp/bin/mysql -h localhost -u root -p -D bd_saé24 -e "$query"
done