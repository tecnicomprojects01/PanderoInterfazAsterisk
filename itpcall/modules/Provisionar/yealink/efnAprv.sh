#/bin/bash
pr="1"
se="1"
echo "Digite numero de Anexo inicial"
read nanxi
echo "Digite Numero de Username Inicial"
read nanxf
echo "Contraseña"
read anxc
while read line
do
ev=`sed -n $pr,${se}p lista`
pr=$(( $pr + 1 ))
se=$(( $se + 1 ))
echo $ev
	for (( i=0; i<(${#ev}); i++))
	do
	ev=${ev/:/}
	done
echo $ev
cp plantilla.cfg $ev.cfg
sed -i 's/AuthName =/AuthName = '$nanxi'/g' $ev.cfg
sed -i 's/UserName =/UserName = '$nanxf'/g' $ev.cfg
sed -i 's/password =/password = '$anxc'/g' $ev.cfg
nanxi=$(( $nanxi + 1 ))
nanxf=$(( $nanxf + 1 ))
done < lista
