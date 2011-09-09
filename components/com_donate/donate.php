<?php
defined('KOOWA') or die;

error_reporting(E_ALL);
ini_set('display_errors', '1'); // TODO remove

KLoader::load('site::com.donate.mappings');
echo KFactory::get('site::com.donate.dispatcher')->dispatch();