#!/bin/bash
while true
do
    echo $(mosquitto_sub -h 192.168.102.136 -p 1883 -t iut/bate/E102/01 -C 1) > /opt/SAE24/JSON/temp1.json
    echo $(mosquitto_sub -h 192.168.102.136 -p 1883 -t iut/bate/E102/10 -C 1) > /opt/SAE24/JSON/temp2.json
    echo $(mosquitto_sub -h 192.168.102.136 -p 1883 -t iut/bate/E102/11 -C 1) > /opt/SAE24/JSON/temp3.json

    python3 /opt/SAE24/récupération.py

    sleep 118
done
