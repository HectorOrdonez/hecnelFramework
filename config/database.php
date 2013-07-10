<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 13:46
 */

// Base path of the website.
if (_PRODUCTION === TRUE) {
    define ('DB_TYPE','mysql');
    define ('DB_HOST','localhost');
    define ('DB_NAME','furgoweb');
    define ('DB_USER','root');
    define ('DB_PASS','1234');
} else {
    define ('DB_TYPE','mysql');
    define ('DB_HOST','localhost');
    define ('DB_NAME','furgoweb');
    define ('DB_USER','root');
    define ('DB_PASS','1234');
}