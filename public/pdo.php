<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-06-01
 * Time: 23:22
 */

try {
    $dbh = new PDO('mysql:host=sqld.duapp.com;port=4050;dbname=OrqnHSSNAWDCkZLZuTuO', '71a6a54e33f9bbf6117a939c2c676e7c', '24caf698d4153f15169b4933e2a48a9e');
    foreach($dbh->query('SELECT * from `site_configs`') as $row) {
        print_r($row);
    }
    print "query ok!";
} catch (Exception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}