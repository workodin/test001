
date +%F%T


listmodif=`find -name "^." -type f -mmin 1`

echo $listmodif

if [ -z "$listmodif" ]
then
    listfile=`git status --porcelain | cut -c4-`

    git add -A 
    git commit -a -m "$listfile"
    git push origin master
fi

