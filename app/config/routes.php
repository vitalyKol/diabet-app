<?php

$this->addRoute('index', 'Index', 'index');
$this->addRoute('', 'Index', 'index');
$this->addRoute('calendar', 'Calendar', 'calendarShow');
$this->addRoute('calendar/([0-9]{1,2})', 'Calendar', 'calendarShow');
$this->addRoute('day', 'Day', 'dayShow');
$this->addRoute('day/([0-9]{4}-[0-9]{2}-[0-9]{2})', 'Day', 'dayShow');
$this->addRoute('day/addSugarRecord', 'Day', 'addSugarRecord');
$this->addRoute('day/delete', 'Day', 'deleteSugarRecord');
$this->addRoute('day/edit/([0-9]{1,9})', 'Day', 'showSugarRecord');
$this->addRoute('day/update', 'Day', 'updateSugarRecord');
$this->addRoute('login', 'Auth', 'index');
$this->addRoute('logout', 'Auth', 'logout');
$this->addRoute('loginCheck', 'Auth', 'login');
$this->addRoute('profile', 'Auth', 'profileShow');
$this->addRoute('register', 'Auth', 'register');
$this->addRoute('changePassword', 'Auth', 'showChangePasswordPage');
