# This is a bash based version of uptime.php. It is self-contained and requires no HTTPD, PHP, etc...
# It will automatically install nc if necessary for operation.
# Recommended that this is installed in a screen.
# Created By: Justin Johnston (BlueVM Communications LLC) 9/19/2013
#!/bin/bash

net_device="eth0"

if [ ! -f /usr/bin/nc ]
then
	yum -y install nc
fi

if nc -w 3 localhost 8000 <<< ” &> /dev/null
then
	exit 1
fi

iptables -F
while [ true ]
do
	
	uptime=$(uptime | awk '{ split($5,a,"[:.,]"); print (a[2] + a[1]*60 + $3 * 3600) }')
        total_memory=$(grep MemTotal /proc/meminfo | awk '{print $2}')
        free_memory=$(grep MemFree /proc/meminfo | awk '{print $2}')
        disk_total=$(df | grep '/vz$' | awk '{ print $2 + $3 }')
        disk_free=$(df | grep '/vz$' | awk '{ print $3 }')
        load_average=$(cat /proc/loadavg | awk '{ print $1 }')
        rx_bandwidth=$(cat /sys/class/net/$net_device/statistics/rx_bytes)
        tx_bandwidth=$(cat /sys/class/net/$net_device/statistics/tx_bytes)
     
    echo -e "{\"uptime\":$uptime,\"total_memory\":$total_memory,\"free_memory\":$free_memory,\"disk_total\":$disk_total,\"disk_free\":$disk_free,\"load_average\":$load_average,\"rx_bandwidth\":$rx_bandwidth,\"tx_bandwidth\":$tx_bandwidth}" | nc -l 8000
done
