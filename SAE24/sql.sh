#!/bin/bash

x=$1
y=$2
query="INSERT INTO \`position\` (\`id_pos\`, \`pos_x\`, \`pos_y\`, \`date/heure\`) VALUES (NULL, '$x', '$y', CURRENT_TIMESTAMP)"
/opt/lampp/bin/mysql -h localhost -u max -pMaxime23@ -D sae24 -e "$query"

