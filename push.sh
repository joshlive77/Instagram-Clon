#!/usr/include/bash/

# script echo en bash pash para hacer commits en git

DIA=`date +"%d/%m/%Y"`;
HORA=`date +"%H:%M"`;
git status;
git diff -v;
echo Git Secure ? y/n:;
read confirmation;
if [ $confirmation = "y" ];
    then 
    git add .;
    echo commit message?;
    IFS= read -r -p "message? " message
    git commit -m "editado por: Josh Zulett el: $DIA a horas: $HORA" -m "$message";
    echo Branch ? y/n;
    read confirmation;
    if [ $confirmation = "y" ];
        then
        read branch;
        git push origin $branch;
    else
        git push origin master;
    fi
else
    echo no GiT to do;
fi
echo All is GiT;