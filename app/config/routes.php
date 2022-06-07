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
