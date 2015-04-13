<?php
//session_cache_limiter(false);
//session_start();

define("DS", DIRECTORY_SEPARATOR);
//define("ROOT_PATH", realpath(dirname(__DIR__)) . DS);
define('ROOT_PATH' , __DIR__.'/../');
define('VENDOR_PATH', ROOT_PATH . 'vendor'. DS);
define('APP_PATH' , ROOT_PATH . 'app'. DS);
define('MODULE_PATH', ROOT_PATH . 'app'.DS.'modules'. DS);
define('PUBLIC_PATH', ROOT_PATH .'public'. DS);

require VENDOR_PATH.'autoload.php';

$config = array(
    'path.root' => ROOT_PATH,
    'path.public' => PUBLIC_PATH,
    'path.app' => APP_PATH,
    'path.module' => MODULE_PATH
);

foreach (glob(APP_PATH.'config/*.php') as $configFile) {
    require $configFile;
}

/** Merge cookies config to slim config */
if(isset($config['cookies'])){
    foreach($config['cookies'] as $configKey => $configVal){
        $config['slim']['cookies.'.$configKey] = $configVal;
    }
}

$logger = new \Flynsarmy\SlimMonolog\Log\MonologWriter(array(
    'handlers' => array(
        new \Monolog\Handler\StreamHandler(APP_PATH.'logs/'.date('Y-m-d').'.log'),
    ),
));

$config['slim']['log.writer'] = $logger;

$app = new \Slim\Slim($config['slim']);

$log = $app->getLog();

//$app->view->setTemplatesDirectory(APP_PATH."views");

$app->hook('slim.before.dispatch', function() use ($app) {
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
    $app->view()->setData('user', $user);
    $app->view()->setData("lang", $app->lang);
});

$app->get('/', function () use ($app,$log) {
    $data = array();
    $app->render('home.php', $data);
})->name('home');

$app->get('/login', function () use ($app) {
    $app->render('login.php');
})->name('login');

$app->post('/login', function () use ($app) {
    $email = $app->request()->post('inputEmail');
    $password = $app->request()->post('inputPassword');
    $error = array();

    if (empty($email) || empty($password)) {
        $error = "Username (or) Password is invalid";
    } else {
        include(APP_PATH.'config/user.php');

        if (isset($userSay[$email])) {
            if ($userSay[$email]['password'] == $password) {
                $_SESSION['user']=$email;
                $app->redirectTo('home');
            } else {
                $error = "Username or (Password) is invalid";
            }
        } else {
            $error = "(Username) or Password is invalid";
        }
    }

    if ($error != '') {
        $app->flash('errors', $error);
        $app->render('login.php', array('error' => $error));
    }
});

$app->get('/logout', function () use ($app) {
    if(session_destroy()) {
        $app->redirectTo('login');
    }
})->name('logout');

$app->run();