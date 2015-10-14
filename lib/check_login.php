<?php

function checkLogin() {
    session_start();
    if (empty($_SESSION)) {
        return false;
    }

    if (!isset($_SESSION['login'])) {
        return false;
    }

    if ($_SESSION['login']) {
        return true;
    } else {
        return false;
    }
}
