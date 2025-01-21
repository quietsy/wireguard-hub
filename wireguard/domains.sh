#!/bin/bash

DOMAINS=$(cat "/config/unblock/domains.txt")

for DOMAIN in $DOMAINS
do
    if [[ $DOMAIN =~ ^[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+$ ]]; then
        IPS=($DOMAIN)
    else
        IPS=$(nslookup $DOMAIN | grep -Eo "([0-9]{1,3}[\.]){3}[0-9]{1,3}" | grep -v "127.0.0.")
    fi
    

    for IP in $IPS
    do
        echo "Rerouting $DOMAIN $IP"
        ipset -exist add domains $IP
    done
done
