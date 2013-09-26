#!/usr/bin/php -q
<?php
echo "https://code.google.com/p/dns-check/\n";
echo "(C) 2013 Adam Ziaja <adam@adamziaja.com> http://adamziaja.com\n";
require_once('Net/DNS2.php'); // http://code.google.com/p/netdns2/
$domain = $argv[1];
foreach (gethostbynamel($domain) as $ip) {
    $arpa = implode('.', array_reverse(explode('.', $ip))) . '.in-addr.arpa';
    do {
        $dns_arpa = dns_get_record($arpa, DNS_NS);
        echo "\n\033[1;33m$arpa\033[0m\n";
        $arpa_ns = $arpa;
        $dns_arpa_array = explode('.', $arpa);
        array_shift($dns_arpa_array);
        $arpa = implode('.', $dns_arpa_array);
    } while (!count($dns_arpa) || count($arpa) == 2);
    if (count($dns_arpa)) {
        $dns_records = dns_get_record($arpa_ns, DNS_NS);
        if (!count($dns_records)) {
            echo "\n\033[1;33mhost $arpa_ns not found\033[0m\n";
        }
        $dns_servers = array();
        foreach ($dns_records as $dns_record) {
            foreach (gethostbynamel($dns_record['target']) as $ip) {
                array_push($dns_servers, $ip);
            }
        }
        $domain_list = array();
        foreach ($dns_servers as $dns_server) {
            echo "\n\033[1;32m" . $dns_server . ' (' . gethostbyaddr($dns_server) . ") AXFR $arpa_ns\033[0m\n";
            $result = NULL;
            $r = new Net_DNS2_Resolver(array('nameservers' => array($dns_server)));
            try {
                $result = $r->query($arpa_ns, 'AXFR');
            } catch (Net_DNS2_Exception $e) {
                echo "\033[1;31m::query() failed: ", $e->getMessage(), "\033[0m\n";
            }
            if ($result) {
                foreach ($result->answer as $rr) {
                    if (preg_match("/$domain/i", $rr)) {
                        $rr = "\033[1;35m$rr\033[0m";
                        echo "$rr\n";
                        array_push($domain_list, $rr);
                    } else {
                        echo "$rr\n";
                    }
                }
            }
        }
        if ($domain_list) {
            echo "\n";
        }
        foreach ($domain_list as $domain_record) {
            echo "$domain_record\n";
        }
    } else {
        echo "\033[1;31m$arpa\033[0m\n";
    }
}
?>
