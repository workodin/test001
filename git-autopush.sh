
# usage
# watch -n5 ./git-autopush.sh
date +"%F %T"

# cherche les fichiers modifiés dans la dernière minute
listmodif=`find -not -path "*/.git/*" -type f -mmin 1`
echo $listmodif

# aucun fichier modifié depuis une minute
if [ -z "$listmodif" ]
then
    listfile=`git status --porcelain | cut -c4-`

    if  [ -n "$listfile" ]
    then
        git add -A 
        git commit -a -m "$listfile"
        git push origin master
    fi
fi

