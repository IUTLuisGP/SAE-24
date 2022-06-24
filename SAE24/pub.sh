#!/bin/bash

ampli1=$1
ampli2=$2
ampli3=$3

mosquitto_pub -h localhost -p 1883 -t iut/bate/E102/01 -m "{\"ampli\":\"$ampli1\"}"
sleep 1
mosquitto_pub -h localhost -p 1883 -t iut/bate/E102/10 -m "{\"ampli\":\"$ampli2\"}"
sleep 1
mosquitto_pub -h localhost -p 1883 -t iut/bate/E102/11 -m "{\"ampli\":\"$ampli3\"}"

