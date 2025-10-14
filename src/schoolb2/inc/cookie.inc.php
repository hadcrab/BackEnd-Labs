<?
$visitCounter = 0;
$lastVisit = "";
if (isset($_COOKIE['visitCounter'])) {
    $visitCounter = (int)$_COOKIE['visitCounter'];
}
$visitCounter++;
if (isset($_COOKIE['lastVisit'])) {
    $lastVisit = date('d.m.Y H:i:s', $_COOKIE['lastVisit']);
}
if (!isset($_COOKIE['lastVisit']) || date('d-m-Y', $_COOKIE['lastVisit']) != date('d-m-Y')) {
    $visitCounter++;
    setcookie('visitCounter', $visitCounter, time() + 86400);
    setcookie('lastVisit', time(), time() + 86400);
}
