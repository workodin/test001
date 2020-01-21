
date +%F%T

listfile=`git status --porcelain | cut -c4-`

for f in "$listfile"
do
    echo $f
done

listmodif=`find -name "^." -type f -mmin 1`

echo $listmodif

if [ -z "$listmodif" ]
then
    git add -A 
    git commit -a -m "$listfile"
    git push origin master
fi

