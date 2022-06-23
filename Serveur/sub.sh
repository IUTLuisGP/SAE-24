#!/bin/bash

echo $(mosquitto_sub -h 10.0.0.22 -p 1883 -t iut/bate/E102/01 -C 1) > /Applications/SAE24/JSON/temp1.json
echo $(mosquitto_sub -h 10.0.0.22 -p 1883 -t iut/bate/E102/10 -C 1) > /Applications/SAE24/JSON/temp2.json
echo $(mosquitto_sub -h 10.0.0.22 -p 1883 -t iut/bate/E102/11 -C 1) > /Applications/SAE24/JSON/temp3.json


