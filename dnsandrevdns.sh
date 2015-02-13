#!/bin/bash
echo $1
php dc.php $1
for ip in $(host -t A $1 | awk '{print $4}');do echo $ip;php rdc.php $1;done