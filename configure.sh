#!/bin/bash

## removing old data
rm -rf project_security
mkdir  project_security

## coping new data
FILE1=$(echo "$(pwd)/$1/ais314hach/*");

cp -rf $FILE1 project_security

## configure
chmod 777 -R project_security/*

#copy config file if exists
if [ -f config.php ]; then
	cp -rf config.php project_security/config.php
else
	cp project_security/config.php config.php
fi
