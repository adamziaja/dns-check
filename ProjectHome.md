Script for recursive check of DNS zone export (AXFR).

# install #

Debian/Ubuntu required packages:
```
$ sudo apt-get install php5-cli
```

```
$ wget http://netdns2.googlecode.com/files/Net_DNS2-1.3.1.tgz && tar -zxvf Net_DNS2-1.3.1.tgz && cd Net_DNS2-1.3.1/
$ git clone https://code.google.com/p/dns-check/ && mv dns-check/*.php .
```

# dns check #

```
$ php dc.php gov.ml
https://code.google.com/p/dns-check/
(C) 2013 Adam Ziaja <adam@adamziaja.com> http://adamziaja.com

217.64.97.50 (ciwara.sotelma.ml) AXFR gov.ml
::query() failed: every name server provided has failed: Operation now in progress

217.64.98.67 (askia.sotelma.ml) AXFR gov.ml
::query() failed: DNS request failed: The name server refuses to perform the specified operation for policy reasons.

196.1.95.1 (ns.ucad.sn) AXFR gov.ml
gov.ml. 172800 IN SOA dogon.sotelma.ml. hostmaster.gov.ml. 2013031800 1800 900 1728000 172800
gov.ml. 172800 IN NS ml.cctld.authdns.ripe.net.
gov.ml. 172800 IN NS dogon.sotelma.ml.
gov.ml. 172800 IN NS ciwara.sotelma.ml.
gov.ml. 172800 IN NS ns-ext.isc.org.
gov.ml. 172800 IN NS yeleen.nic.ml.
gov.ml. 172800 IN NS djamako.nic.ml.
actionhumanitaire.gov.ml. 172800 IN NS ns2.dat-tech.com.
actionhumanitaire.gov.ml. 172800 IN NS ns4.dat-tech.com.
adere-nord.gov.ml. 172800 IN NS ns1.ikatelnet.net.
adere-nord.gov.ml. 172800 IN NS ns3.ikatelnet.net.
ads.gov.ml. 172800 IN NS web.datatech.net.ml.
ads.gov.ml. 172800 IN NS keletigui.datatech.net.ml.
ageroute.gov.ml. 172800 IN NS mande.sotelma.ml.
agetic.gov.ml. 172800 IN NS djata.agetic.gov.ml.
djata.agetic.gov.ml. 172800 IN A 217.64.100.67
amap.gov.ml. 172800 IN NS ns1.oxadel.ml.
amap.gov.ml. 172800 IN NS ns2.oxadel.ml.
anict.gov.ml. 172800 IN NS web.datatech.net.ml.
anict.gov.ml. 172800 IN NS keletigui.datatech.net.ml.
anpe.gov.ml. 172800 IN NS ns1.oxadel.ml.
anpe.gov.ml. 172800 IN NS ns2.oxadel.ml.
[...]
gov.ml. 172800 IN SOA dogon.sotelma.ml. hostmaster.gov.ml. 2013031800 1800 900 1728000 172800

217.64.98.38 (217.64.98.38) AXFR gov.ml
::query() failed: every name server provided has failed: Connection refused

host actionhumanitaire.gov.ml not found

196.200.80.24 (ns1.ikatelnet.net) AXFR adere-nord.gov.ml
::query() failed: DNS request failed: The name server refuses to perform the specified operation for policy reasons.

196.200.80.4 (ns3.ikatelnet.net) AXFR adere-nord.gov.ml
::query() failed: DNS request failed: The name server refuses to perform the specified operation for policy reasons.

217.64.107.130 (keletigui.datatech.net.ml) AXFR ads.gov.ml
ads.gov.ml. 3600 IN SOA keletigui.datatech.net.ml. admin.datatech.net.ml. 2 3600 600 86400 3600
ads.gov.ml. 3600 IN NS keletigui.datatech.net.ml.
ads.gov.ml. 3600 IN MX 10 mail.ads.gov.ml.
mail.ads.gov.ml. 3600 IN CNAME mail.datatech.net.ml.
ads.gov.ml. 3600 IN SOA keletigui.datatech.net.ml. admin.datatech.net.ml. 2 3600 600 86400 3600

217.64.98.37 (mande.sotelma.ml) AXFR ageroute.gov.ml
ageroute.gov.ml. 86400 IN SOA ageroute.gov.ml. rname.invalid. 2011111701 86400 3600 604800 10800
ageroute.gov.ml. 86400 IN NS mande.sotelma.ml.
ageroute.gov.ml. 86400 IN A 196.200.84.90
ageroute.gov.ml. 86400 IN MX 10 svragr01.ageroute.gov.ml.
svragr01.ageroute.gov.ml. 86400 IN A 196.200.84.90
www.ageroute.gov.ml. 86400 IN A 196.200.84.90
ageroute.gov.ml. 86400 IN SOA ageroute.gov.ml. rname.invalid. 2011111701 86400 3600 604800 10800

217.64.100.67 (mail.agetic.gouv.ml) AXFR agetic.gov.ml
agetic.gov.ml. 86400 IN SOA djata.agetic.gov.ml. admin.agetic.gov.ml. 70 10800 900 604800 86400
agetic.gov.ml. 86400 IN NS djata.agetic.gov.ml.
agetic.gov.ml. 86400 IN A 217.64.100.67
agetic.gov.ml. 86400 IN TXT "v=spf1 a mx ptr"
agetic.gov.ml. 86400 IN MX 10 mail.agetic.gov.ml.
agetic.gov.ml. 86400 IN MX 20 tchiden.agetic.gov.ml.
agetic.gov.ml. 86400 IN MX 30 ns1.agetic.gov.ml.
cyberedu.agetic.gov.ml. 86400 IN A 217.64.100.68
djata.agetic.gov.ml. 86400 IN A 217.64.100.67
efestival.agetic.gov.ml. 86400 IN A 217.64.100.67
intrasotelma.agetic.gov.ml. 86400 IN A 217.64.100.101
[...]
agetic.gov.ml. 86400 IN SOA djata.agetic.gov.ml. admin.agetic.gov.ml. 70 10800 900 604800 86400

host amap.gov.ml not found

host anict.gov.ml not found

host anpe.gov.ml not found
[...]
```


---


```
$ php dns.php cisco.com > cisco.com.txt
$ grep " IN " cisco.com.txt  | wc -l
3610308
```

i.a.
```
wwwin-tools1-admin.cisco.com. 86400 IN A 72.163.44.27
wwwin-tools1-admin-nat.cisco.com. 86400 IN A 72.163.44.12
supportwiki-admin.cisco.com. 86400 IN A 207.97.212.128
cvf-vpn-gwy1-global.cisco.com. 86400 IN A 64.102.251.105
bxb22-vpn-cluster-1.cisco.com. 86400 IN A 198.135.0.165
printer-lwr05-02-500-cx.cisco.com. 86400 IN A 64.100.94.8
printer-lasvegas-64-101-99-14.cisco.com. 86400 IN A 64.101.99.14
```

@ 2013-09-14 16:45 CEST reported to security@cisco.com, no answer

# dns-check for revDNS #

```
$ php rdc.php beyondsecurity.com
https://code.google.com/p/dns-check/
(C) 2013 Adam Ziaja <adam@adamziaja.com> http://adamziaja.com

4.202.207.67.in-addr.arpa

202.207.67.in-addr.arpa

208.166.60.196 (ns1.svwh.net) AXFR 202.207.67.in-addr.arpa
202.207.67.in-addr.arpa. 86400 IN SOA arrakis.202.207.67.svwh.net. admin1.ns1.svwh.net. 2013020601 10800 3600 604800 86400
[...]
202.207.67.in-addr.arpa. 86400 IN SOA arrakis.202.207.67.svwh.net. admin1.ns1.svwh.net. 2013020601 10800 3600 604800 86400

98.158.21.29 (ns2.svwh.net) AXFR 202.207.67.in-addr.arpa
::query() failed: every name server provided has failed: Operation now in progress

208.166.60.197 (ns3.svwh.net) AXFR 202.207.67.in-addr.arpa
202.207.67.in-addr.arpa. 86400 IN SOA arrakis.202.207.67.svwh.net. admin1.ns1.svwh.net. 2013020601 10800 3600 604800 86400
[...]
202.207.67.in-addr.arpa. 86400 IN SOA arrakis.202.207.67.svwh.net. admin1.ns1.svwh.net. 2013020601 10800 3600 604800 86400

4.202.207.67.in-addr.arpa. 86400 IN PTR secure.beyondsecurity.com.
5.202.207.67.in-addr.arpa. 86400 IN PTR netenrich.beyondsecurity.com.
7.202.207.67.in-addr.arpa. 86400 IN PTR lss3.beyondsecurity.com.
9.202.207.67.in-addr.arpa. 86400 IN PTR wssa.beyondsecurity.com.
4.202.207.67.in-addr.arpa. 86400 IN PTR secure.beyondsecurity.com.
5.202.207.67.in-addr.arpa. 86400 IN PTR netenrich.beyondsecurity.com.
7.202.207.67.in-addr.arpa. 86400 IN PTR lss3.beyondsecurity.com.
9.202.207.67.in-addr.arpa. 86400 IN PTR wssa.beyondsecurity.com
```

@ 2012-12-22 14:35 CEST reported to Beyond Security, no fix