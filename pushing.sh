#!/usr/include/bash/

echo PUSHING;
echo quieres hacer un backup de alguna DB y/n:;
read confirmation;
if [ $confirmation = "y" ]; 
    then 
    echo INTRODUCE EL NOMBRE DE LA BASE DE DATOS:
    read db_name;
    # if [ -f "${db_name}_bp.sql" ]; then
    if [ -f "C:/wamp64/www/PHP/DataBases/Backup/${db_name}_bp.sql" ]; 
        then
        rm c:/wamp64/www/PHP/DataBases/backup/${db_name}_bp.sql;
    fi
    cd c:/wamp64/bin/mysql/mysql5.7.24/bin;
    # ./mysqldump -u admin -padmin ${db_name} > C:/wamp64/www/PHP/DataBases/Backup/${db_name}_bp.sql;
    #  con esta linea nos aseguramos que en la importacion se cree la base de datos y con drop
    # se elminaria la base de datos actual --add-drop-database --databases
    ./mysqldump --add-drop-database --databases -u admin -padmin ${db_name} > C:/wamp64/www/PHP/DataBases/Backup/${db_name}_bp.sql
    cd C:/wamp64/www/PHP/;
else 
    echo solo haremos un push;
fi
echo pushing stuffs;
DIA=`date +"%d/%m/%Y"`;
HORA=`date +"%H:%M"`;
git status;
git add .
git commit -m "editado por: josh zulett el: $DIA a horas: $HORA";
git push origin master;
git status;

echo *********BESITO, BESITO CHAU CHAU*********