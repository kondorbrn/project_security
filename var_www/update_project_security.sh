#!/bin/sh

## downloading data
rm -rf temp_
mkdir temp_
cd temp_
wget --user-agent "firefox" https://github.com/kondorbrn/project_security/archive/master.zip

## unpacking
unzip master.zip
cd ..

chmod +x temp_/project_security-master/configure.sh
bash temp_/project_security-master/configure.sh 'temp_/project_security-master'

rm -rf temp_
