<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['email_user'] = "loyalty@loyalty-club.com";
$config['email_password'] = "Tqmb5.l(Oo0z";
$config['nrOfTicketsToGenerate'] = 100;
$config['currency'] = "kr";
$config['personalShoppingMaxValue'] = 4900;
$config['graphTicketsLevel1MaxValue'] = 500;
$config['graphTicketsLevel2MaxValue'] = 2100;
$config['graphTicketsLevel3MaxValue'] = $config['personalShoppingMaxValue'];
//mail config
$config['loyaltyclub_casa_mail']['protocol'] = 'smtp';
$config['loyaltyclub_casa_mail']['smtp_user'] = 'smtpuser@loyalty-club.com';
$config['loyaltyclub_casa_mail']['smtp_pass'] = 'sL(2(f6Khyc,';
$config['loyaltyclub_casa_mail']['smtp_host'] = 'mail.loyalty-club.com';
$config['loyaltyclub_casa_mail']['smtp_port'] = '26';
$config['loyaltyclub_casa_mail']['charset'] = 'utf-8';
$config['loyaltyclub_casa_mail']['mailtype'] = 'html';

$config['versionJS'] = 1.2;
$config['versionCSS'] = 1.2;
 

?>