<?php

$this->addRoute('index', 'Index', 'index');
$this->addRoute('', 'Index', 'index');
$this->addRoute('calendar', 'Calendar', 'calendarShow');
$this->addRoute('calendar/([0-9]{1,2})', 'Calendar', 'calendarShow');
$this->addRoute('day', 'Day', 'dayShow');