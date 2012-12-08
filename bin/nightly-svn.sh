#!/bin/sh
# Usage: ./nightly.sh [trunk|devel-threads]
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

# find out current revision and compose file name
rev=`svn info -r HEAD https://svn.roundcube.net/$svnroot $tempname | egrep -o 'Revision: [0-9]+' | egrep -o '[0-9]+'`
tempname=roundcubemail-${branch}-r${rev}-${datestr}

echo "Exporting /$svnroot @ revision $rev to $tempname..."
svn export -q https://svn.roundcube.net/$svnroot $tempname
echo "done."

echo "Preparing files for release..."
cd $tempname/
bin/jsshrink.sh
rm -rf bin/dumpschema.php bin/makedoc.sh tests compiler.jar
cd ..
echo "done."

echo "Creating archive file $tempname.tgz..."
tar -czf $tempname.tgz $tempname/
rm -rf $tempname
echo "done."

# move to final location
mv $tempname.tgz /var/www/nightly.roundcube.net/public/$branch/
