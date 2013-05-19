!#/bin/bash

## removing old data

rm -rf ../../project_security
mkdir ../../project_security

## coping new data
cp -rf ais314hach/* ../../project_security/

## configure
chmod 777 -R ../project_security/*
