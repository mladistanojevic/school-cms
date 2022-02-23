<?php
session_start();
require_once '../app/config/config.php';
require_once '../app/helpers/general_helpers.php';
require_once '../app/helpers/session_helpers.php';


require_once '../app/libraries/Core.php';
require_once '../app/libraries/Controller.php';
require_once '../app/libraries/Database.php';

$init = new Core();
