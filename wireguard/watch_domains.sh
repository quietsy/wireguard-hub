#!/bin/bash
 
DIR_TO_WATCH="/config/unblock/domains.txt"
COMMAND="/config/domains.sh"
$COMMAND

trap "echo Exited!; exit;" SIGINT SIGTERM > /dev/null 2>&1
while [[ 1=1 ]]
do
    watch --chgexit -n 1 "ls --all -l --recursive --full-time ${DIR_TO_WATCH} | sha256sum" && ${COMMAND}
    sleep 1
done
