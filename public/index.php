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

$app->add(new \Slim\Middleware\SessionCookie(array('secret' => 'myappsecret')));

$log = $app->getLog();

$authenticate = function($app) {
    return function() use ($app) {
                if (!isset($_SESSION['user'])) {
                    $_SESSION['urlRedirect'] = $app->request()->getPathInfo();
                    $app->flash('error', 'Login required');
                    $app->redirect('login');
                }
    };
};

//$app->view->setTemplatesDirectory(APP_PATH."views");

$app->hook('slim.before.dispatch', function() use ($app) {
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
    $app->view()->setData('user', $user);
});

$app->get('/', $authenticate($app), function () use ($app,$log) {
    $data = array();
    $app->render('home.php', $data);
})->name('home');

$app->get("/login", function () use ($app) {
    $flash = $app->view()->getData('flash');
    $error = '';
    if (isset($flash['error'])) {
        $error = $flash['error'];
    }
    $urlRedirect = '/';
    if ($app->request()->get('r') && $app->request()->get('r') != '/logout' && $app->request()->get('r') != '/login') {
        $_SESSION['urlRedirect'] = $app->request()->get('r');
    }
    if (isset($_SESSION['urlRedirect'])) {
        $urlRedirect = $_SESSION['urlRedirect'];
    }
    $email_value = $email_error = $password_error = '';
    if (isset($flash['email'])) {
        $email_value = $flash['email'];
    }
    if (isset($flash['errors']['email'])) {
        $email_error = $flash['errors']['email'];
    }
    if (isset($flash['errors']['password'])) {
        $password_error = $flash['errors']['password'];
    }
    $app->render('login.php', array('error' => $error, 'email_value' => $email_value, 'email_error' => $email_error, 'password_error' => $password_error, 'urlRedirect' => $urlRedirect));
})->name('login');

$app->post('/login', function () use ($app) {
    $email = $app->request()->post('inputEmail');
    $password = $app->request()->post('inputPassword');

    $errors = array();

    if (empty($email) || empty($password)) {
        $errors['email'] = "Username (or) Password is invalid";
    } else {
        include(APP_PATH.'config/user.php');

        if (isset($userSay[$email])) {
            if ($userSay[$email]['password'] == $password) {
                $_SESSION['user']=$email;

                if (isset($_SESSION['urlRedirect'])) {
                    $tmp = $_SESSION['urlRedirect'];
                    unset($_SESSION['urlRedirect']);
                    $app->redirect($tmp);
                }

                $app->redirectTo('home');
            } else {
                $errors['password'] = "Username or (Password) is invalid";
            }
        } else {
            $errors['email'] = "(Username) or Password is invalid";
        }
    }

    if (count($errors) > 0) {
        $app->flash('errors', $errors);
        $app->redirect('/login');
    }
});

$app->get('/logout', function () use ($app) {
    if(session_destroy()) {
        $app->redirectTo('login');
    }
})->name('logout');

$app->run();