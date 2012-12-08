#!/bin/sh
# Usage: ./nightly.sh
# set -x

datestr=`date +%Y%m%d`
branch=$1

if [ -z $branch ]; then
  branch="trunk"
fi

if [ $branch = "trunk" ]; then
  svnroot="trunk/roundcubemail"
else
  if [ $branch = "devel-threads" ]; then
    svnroot="branches/$branch"
  else
    echo "Unknown branch"
    exit
  fi
fi

# download zip file from github
tempname=roundcubemail-${branch}-${datestr}.zip
wget "https://github.com/roundcube/roundcubemail/zipball/master" -O /var/www/nightly.roundcube.net/public/$branch/$tempname
