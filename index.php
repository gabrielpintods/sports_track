<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
define ("__ROOT__",__DIR__);

// Configuration
require_once (__ROOT__.'/config.php');

// ApplicationController
require_once (CONTROLLERS_DIR.'/ApplicationController.php');

// Add routes here
ApplicationController::getInstance()->addRoute('user_add', CONTROLLERS_DIR.'/AddUserController.php');
ApplicationController::getInstance()->addRoute('connect',CONTROLLERS_DIR.'/ConnectUserController.php');
ApplicationController::getInstance()->addRoute('upload',CONTROLLERS_DIR.'/UploadActivityController.php');
ApplicationController::getInstance()->addRoute('activities',CONTROLLERS_DIR.'/ListActivityController.php');
ApplicationController::getInstance()->addRoute('disconnect',CONTROLLERS_DIR.'/DisconnectUserController.php');
ApplicationController::getInstance()->addRoute('main',CONTROLLERS_DIR.'/MainUserConnectController.php');
ApplicationController::getInstance()->addRoute('user',CONTROLLERS_DIR.'/UserInfo.php');
ApplicationController::getInstance()->addRoute('apropos',CONTROLLERS_DIR.'/Apropos.php');

// Process the request
ApplicationController::getInstance()->process();

