#!/bin/bash

output=`mktemp`
data=`mktemp`
sudo iptables -L INPUT -n -v -x > $output

awk 'NR > 2 {
	if (match($8,"0.0.0.0/0"))
	{
		if (match($11,"dpt:"))
	{
		if ($1 > 0)
		{
	print $1";"$2","substr($11,5)"-"$4
		}
	}
		if (match($10,"limit:"))
		{
		if ($1 > 0)
		{
		print $1";"$2","substr($16,5)"-"$4
#		print $16
		}
		}
}
}' $output > $data
php host.php $data
sudo iptables -Z
rm -f $output
rm -f $data
