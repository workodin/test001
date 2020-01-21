
date +"%F %T"

# cherche les fichiers modifiés dans la dernière minute
listmodif=`find -not -path "*/.git/*" -type f -mmin 1`
echo $listmodif

if [ -n "$listmodif" ]
then
    listfile=`git status --porcelain | cut -c4-`

    if  [ -n "$listfile" ]
    then
        git add -A 
        git commit -a -m "$listfile"
        git push origin master
    fi
fi

