#!/usr/bin/php -q
<?php
echo "https://github.com/adamziaja/dns-check\n";
echo "(C) 2013 Adam Ziaja <adam@adamziaja.com> http://adamziaja.com\n";
require_once('Net/DNS2.php'); // http://code.google.com/p/netdns2/
$domain = $argv[1];
$todo = check_dns($domain);
function check_dns($domain) {
    $todo = array();
    $dns_records = dns_get_record($domain, DNS_NS);
    if (!count($dns_records)) {
        echo "\n\033[1;33mhost $domain not found\033[0m\n";
    }
    $dns_servers = array();
    foreach ($dns_records as $dns_record) {
        foreach (gethostbynamel($dns_record['target']) as $ip) { // Round-robin DNS
            array_push($dns_servers, $ip);
        }
    }
    foreach ($dns_servers as $dns_server) {
        echo "\n\033[1;32m" . $dns_server . ' (' . gethostbyaddr($dns_server) . ") AXFR $domain\033[0m\n";
        $result = NULL;
        $r = new Net_DNS2_Resolver(array('nameservers' => array($dns_server)));
        try {
            $result = $r->query($domain, 'AXFR');
        } catch (Net_DNS2_Exception $e) {
            echo "\033[1;31m::query() failed: ", $e->getMessage(), "\033[0m\n";
        }
        if ($result) {
            foreach ($result->answer as $rr) {
                if (preg_match('/ IN NS /i', $rr) && !preg_match("/^$domain/i", $rr)) {
                    echo "\033[1;35m$rr\033[0m\n";
                    $ns = rtrim(reset(explode(' ', $rr)), '.');
                    array_push($todo, $ns);
                } else {
                    echo "$rr\n";
                }
            }
        }
    }
    $todo = array_unique($todo);
    return $todo;
}
foreach ($todo as $domain_axfr) {
    check_dns($domain_axfr);
}
?> 
