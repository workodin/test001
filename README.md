# ionos.fr 

Hébergement Web avec promo à 1euro/mois la première année

## php.ini


    https://www.ionos.fr/assistance/hebergement/utiliser-php-pour-un-projet-web/quels-parametres-php-puis-je-modifier/


    memory_limit = 268435456;
    post_max_size = 67108864;
    safe_mode = off;
    upload_max_filesize = 67108864;
    # protection
    disable_functions = exec,system,passthru,shell_exec,popen,escapeshellcmd,proc_open,proc_nice,ini_restore;


    Et aussi ajouter une instruction ini_set sur open_basedir


## créer une page webhook pour github

    Ajouter dans les paramétrages github pour le repository à synchroniser
    l'URL vers la page PHP de webhook qui va télécharger la dernière version du projet à chaque push


## vscode


    screencast mode
    pour afficher les touches spéciales

    extensions
    liveshare
    intelephense
    gitlens
    markdown...

## git 

    en une seule ligne de commande

    git add -A; git commit -a -m "..."; git push


    extension 
    git add commit push

    Ctl+alt+p

## git-autopush.sh

```bash

# git-autopush.sh
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

```

## WinSCP et Synchro entre dossiers

    Ctl+U pour lancer la synchro entre dossiers


## Mobile First et Media Queries


    https://getbootstrap.com/docs/4.1/layout/overview/

