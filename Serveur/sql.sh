x=$1
y=$2
query="INSERT INTO \`position\` (\`id_pos\`, \`pos_x\`, \`pos_y\`, \`date/heure\`) VALUES (NULL, '$x', '$y', CURRENT_TIMESTAMP)"
# For Linux users :/opt/lampp/bin/mysql -h localhost -u max -pMaxime23@ -D sae24 -e "$query"
/Applications/mamp/Library/bin/mysql -h localhost -u max -pMaxime23@ -D sae24 -e "$query"
