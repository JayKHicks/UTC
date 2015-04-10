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

function getCarousel($imageList, $url, $siteCode) {
    $imageArray = array();
    $imageArrayCnt = 0;
    if (!empty($imageList)) {
        $imageArray = explode(',', $imageList);
        $imageArrayCnt = count($imageArray);
    }

    $imageCarouselIndicators = '';
    $imageCarouselDivs = '';
    if ($imageArrayCnt > 2) {
        $imgCnt = 0;
        foreach((array) $imageArray as $imgFile) {
            if (strpos($imgFile, 'http:') === false) {
                $imgSrc = 'http://' . $url . '/images/' . $siteCode . '/' . $imgFile;
            } else {
                $imgSrc =  $imgFile;
            }

            if ($imgCnt == 0) {
                $imageCarouselIndicators .= '<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>';
                $imageCarouselDivs .= '<div class="item active"><img alt="slide '.$imgCnt.'" src="'.$imgSrc.'"></div>';
            } else {
                $imageCarouselIndicators .= '<li data-target="#carousel-example-generic" data-slide-to="'.$imgCnt.'"></li>';
                $imageCarouselDivs .= '<div class="item"><img alt="slide '.$imgCnt.'" src="'.$imgSrc.'"></div>';
            }
            $imgCnt++;
        }
    }

    $imageCarousel = <<<EOS
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    $imageCarouselIndicators
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    $imageCarouselDivs
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
EOS;

    if ($imageArrayCnt == 0) {
        $imageCarousel = '<img class="img-responsive" src="http://placehold.it/480x320&text=No+Image+available" alt="No Image Available">';
    } else if ($imageArrayCnt == 1) {
        $imgFile = $imageArray[0];
        if (strpos($imgFile, 'http:') === false) {
            $imgSrc = 'http://' . $url . '/images/' . $siteCode . '/' . $imgFile;
        } else {
            $imgSrc =  $imgFile;
        }

        $imageCarousel = '<img class="img-responsive" style="margin: 0 auto;" src="'.$imgSrc.'" alt="No Image Available">';
    }

    return $imageCarousel;
}

function cmpDays($a, $b) {
    if ($a['dayOfWeek'] == $b['dayOfWeek']) {
        return 0;
    }
    return ($a['dayOfWeek'] < $b['dayOfWeek']) ? -1 : 1;
}

function myTruncate($string, $limit, $break=" ", $pad="")
{
    $ret[0] = $string;

    if(strlen($string) > $limit) {
        if(false !== ($breakpoint = strpos($string, $break, $limit))) {
            if($breakpoint < strlen($string) - 1) {
                $ret[0] = substr($string, 0, $breakpoint).$pad;
                $ret[1] = substr($string, $breakpoint);
            }
        }
    }

    return $ret;
}

function averageArray($theArray) {
    if(count($theArray) > 5) {
        $minRent = min($theArray['rents']);
        $maxRent = max($theArray['rents']);
        $quarterRentSlice = array_slice($theArray['rents'], 2, 1);
        $threeQuarterRentSlice = array_slice($theArray['rents'], -2, 1);
        $quarterRent = $quarterRentSlice[0];
        $threeQuarterRent = $threeQuarterRentSlice[0];
        $halfRent = ceil(($quarterRent + $threeQuarterRent) / 2) . '.00';

        $retFilter['rents'] = array(
            $minRent => $minRent,
            $quarterRent => $quarterRent,
            $halfRent => $halfRent,
            $threeQuarterRent => $threeQuarterRent,
            $maxRent => $maxRent
        );

        return $retFilter;
    }
    return $theArray;
}

function getRummageList($rummages, $siteDomain, $place, $position, &$filter) {
    $dayArray = Array(1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday');
    $dayAbrvArray = Array(1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat', 7 => 'Sun');
    $rummageList = '';

    foreach($rummages as $k=>$v) {
        if ($siteDomain == $v['domain']) {
            $server = $_SERVER['SERVER_NAME'];
            $port = $_SERVER['SERVER_PORT'];
            if (isset($_SERVER['CONTEXT_PREFIX'])) {
                $server .= $_SERVER['CONTEXT_PREFIX'];
            }
        } else {
            $port = '';
            $server = 'classifieds.' . $v['domain'];
        }

        $url = rtrim($server, "/");

        if (!empty($port)) {
            $url= $url.':'.$port;
        }

        $images = '';
        if (!empty($v['images'])) {
            $imageArray = explode(',', $v['images']);
            if (!empty($imageArray)) {
                $imgCnt = 0;
                foreach ($imageArray as $imgFile) {
                    $imgCnt++;
                    if (strpos($imgFile, 'http:') === false) {
                        $imgSrc = '/images/' . $v['siteCode'] . '/' . $imgFile;
                    } else {
                        $imgSrc =  $imgFile;
                    }

                    $images .= '<a class="fancybox" href="'. $imgSrc . '" rel="ligthbox ' . $v['id'] . '_group" title="Picture"';
                    if ($imgCnt > 1) {$images .= ' style="display: none;"';}
                    $images .= ' >';
                    $images .= '<img src="'.$imgSrc.'" class="img-responsive" />';
                    $images .= '</a>';
                }
            }
        }

        $filter['city'][strtoupper(trim($v['city']))] = true;
        $filter['sites'][$v['siteCode']] = strtoupper($v['siteName']);
        if (! empty($v['rent'])) {
            $filter['rents'][$v['rent']] = $v['rent'];
        }
        $filter['bdrooms'][$v['bdrooms']] = $v['bdrooms'];
        $filter['bthrooms'][$v['bthrooms']] = $v['bthrooms'];

        $daysOpen = '';
        if (! empty($v['days'])) {
            usort($v['days'], 'cmpDays');
            foreach($v['days'] as $dayVal) {
                $daysOpen .= '&nbsp;<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="'.$dayVal['startTime'].'-'.$dayVal['endTime'].'">'.$dayAbrvArray[$dayVal['dayOfWeek']].'</button>';
                $filter['days'][$dayVal['dayOfWeek']] = $dayArray[$dayVal['dayOfWeek']];
            }
        }

        $rummageList .= '<div class="row" style="margin-top: 0px; padding-bottom: 5px; background-color: #F9F9F9;">';

        $dataInfo = '<div class=".small" style="padding-bottom:10px; color:#0052f4; padding-left: 5px;"><a href="./" target="_blank">' . $v['siteName'] . '</a>';
        if (empty($position))
            $dataInfo .= '&nbsp;|&nbsp;<a href="./map.php?place=' . urlencode($v['placement']) . '&posit=' . urlencode($v['position']) . '" target="_blank">' . $v['position'] . '</a>';
        if (!empty($v['moreInfo'])) {
            $dataInfo .= '&nbsp;|&nbsp;<a href="' . $v['moreInfo'] . '" style="color:#0052f4;" title="More Information" target="_blank"><span class="glyphicon glyphicon-info-sign"></span>More Info</a>';
        }

        if (!empty($dataInfo)) {
            $rummageList .= '<div class="col-md-12" style="margin-top: 5px;">'.$dataInfo.'</div></div>';
        }

        if (!empty($images)) {
            $rummageList .= '<div class="col-md-3">';
            $rummageList .= $images;
            $rummageList .= '</div>';
            $rummageList .= '<div class="dcd-adText col-md-9" dcd-id="'.$k.'">';
        } else {
            $rummageList .= '<div class="dcd-adText col-md-12" dcd-id="'.$k.'">';
        }

        if (!empty($v["street"])) {
            $rummageList .= '<h4>' . $v["street"];
        }
        if (!empty($v["email"])) {
            $rummageList .='<a class="btn btn-small" type="button" href="mailto:'.$v["email"].'?subject='. str_replace("&","%26",substr($v["adText"], 0, 80)) .'"><span class="glyphicon glyphicon glyphicon-envelope" aria-hidden="true"></span></a>';
        }
        if (!empty($v["street"])) {
            $rummageList .= '</h4>';
        }

        if (! (empty($v['rent'])&&empty($v['bdrooms'])&&empty($v['bthrooms']))) {
            $detList = '';
            if (! empty($v['bdrooms'])) {
                $detList .= $v['bdrooms'] . '&nbsp;Beds';
            }
            if (! empty($v['bthrooms'])) {
                if (! empty($detList)) {
                    $detList .= '<li style="list-style: none">|</li>';
                }
                $detList .= $v['bthrooms'] . '&nbsp;Baths';
            }
            if (! empty($v['rent'])) {
                if (! empty($detList)) {
                    $detList .= '<li style="list-style: none">|</li>';
                }
                $detList .= '$'.$v['rent'];
            }
            if (! empty($detList)) {
                $rummageList .= '<ul class="list-inline list-unstyled">'.$detList.'</ul>';
            }
        }

        $newTextArray = myTruncate($v["adText"], 200);

        if (isset($newTextArray[1])) {
            $rummageList .= '<p>' . $newTextArray[0] . '<span class="truncated">' . $newTextArray[1] . '</span></p>';
        } else {
            $rummageList .= '<p>' . $newTextArray[0] . '</p>';
        }

        $rummageList .= '</div>';

        $rummageList .= '<div class="col-md-12" style="margin-top: 5px;">';

        if (isset($mapArray[$k])) {
            $rummageList .= '<button title="Add to Route" type="button" class="add btn btn-default btn-sm" onclick="visit(this,\''.$k.'\');" id="'.$k.'">';
            $rummageList .= '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>&nbsp;&nbsp;&nbsp;';
        }

        $rummageList .= '<div class="btn-group btn-group-xs" role="group" aria-label="...">';
        $rummageList .= '<a href="http://twitter.com/home?status=' . str_replace("&","%26",substr($v["adText"], 0, 120)) . '" target="_blank" class="btn btn-twitter btn-xs"><i class="fa fa-twitter"></i></a>';
        $rummageList .= '<a href="https://www.facebook.com/sharer/sharer.php?u=http://' . $url . '/item.php?id=' . $k . '" target="_blank" class="btn btn-facebook btn-xs"><i class="fa fa-facebook"></i></a>';
        $rummageList .= '<a href="https://plusone.google.com/_/+1/confirm?hl=en&url=http://' . $url . '/item.php?id=' . $k . '" target="_blank" class="btn btn-google-plus btn-xs"><i class="fa fa-google-plus"></i></a>';
        $rummageList .= '<a href="mailto:?subject='. str_replace("&","%26",substr($v["adText"], 0, 80)) .'&body='. str_replace("&","%26",substr($v["adText"], 0, 120)) .'%0D%0A%0D%0A http://' . $url . '/map.php?place='.urlencode($place).'%26posit='.urlencode($position).'%26ad=' . $k .'" target="_top" id="'.$k.'-gs-mail"class="btn btn-instagram btn-xs"><i class="fa fa-envelope"></i></a>';
        $rummageList .= '</div>';

        if (! empty($v['rent']) || ! empty($v['proptype'])) {
            $rummageList .= '<a class="btn btn-primary pull-right btn-sm" href="listingItem.php?id='.$k.'">View Listing <span class="glyphicon glyphicon-chevron-right"></span></a>';
        }

        if (! empty($daysOpen)) {
            $rummageList .= '<div class="pull-right"><strong><small>Days: </small></strong><div class="btn-group btn-group-xs" role="group" aria-label="days">'.$daysOpen.'</div></div>';
        }

        $rummageList .= '</div></div><hr>';
    }

    return $rummageList;
}

function getMapDisplay($place, $position) {
    $mapDisplay = <<<EOS
<div id="map-options">
    <ul id="map-resize">
        <li><strong>Map Size:</strong></li>
        <li><a href="#" data-size="small">Small</a></li>
        <li><a href="#" data-size="medium">Medium</a></li>
        <li><a href="#" data-size="large">Large</a></li>
    </ul>
    <div class="clear"></div>
</div>
<div id="map">
    <div id="dcd-map-container"></div>
</div>
<br />
<div>
    <div class="panel panel-default" id="panel2">
	    <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapse1" class="collapsed">Map Route</a>
            </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse">
            <div class="panel-body">
            <form action="route.php" method="post" onsubmit="mapRoute();" class="form-horizontal" role="form">
                <input type="hidden" name="place" value="$place" />
                <input type="hidden" name="posit" value="$position" />
                <input type="hidden" id="locations" name="locations" value="" />
                <h5><strong>Please enter a starting address and select up to 8 places to visit, then click on 'Map Route'.</strong></h5>
                <div id="map-it">
                    <div class="form-group">
                        <label for="Address" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" name="address" class="form-control" id="Address" placeholder="Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="City" class="col-sm-2 control-label">City</label>
                        <div class="col-sm-10">
                            <input type="text" name="city" class="form-control" id="City" placeholder="City">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Zip" class="col-sm-2 control-label">Zip</label>
                        <div class="col-sm-10">
                            <input type="text" name="zip" class="form-control" id="Zip" placeholder="Zip">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox-inline">
                                <label>
                                    <input type="checkbox" value="true" name="avoidHighways"> Avoid Highways
                                </label>
                            </div>
                            <div class="checkbox-inline">
                                <label>
                                    <input type="checkbox" value="true" name="avoidTolls"> Avoid Tolls
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" id="dcd-route" class="btn btn-default">Map Route</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<p><strong>Click or Tap on any entry to find on the map.</strong></p>
EOS;

    return $mapDisplay;
}

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
    $log->info('Landing Page(FORWARDED_FOR: '.@$_SERVER['HTTP_X_FORWARDED_FOR'].', REMOTE_ADDR: '.@$_SERVER['REMOTE_ADDR'].', HTTP_HOST: '.@$_SERVER['HTTP_HOST'].', SERVER_NAME: '.@$_SERVER['SERVER_NAME'].')');

    $data['dcdApp'] = new DCD\DcdApp();
    $data['ads'] = new DCD\Ads();
    $data['nav'] = new DCD\Navigation();

    $place = $app->request->get('place');
    $position = $app->request->get('posit');

    $data['place'] = $place;
    $data['position'] = $position;

    $busName = $data['dcdApp']->getSite()->BusName;
    $siteName = $data['dcdApp']->getSite()->SiteName;
    $siteUrl = $data['dcdApp']->getSite()->SiteUrl;

    $data['metadata'] = '<title>'.$busName.' - Classifieds Landing Page</title>
        <meta name="description" content="Classifieds Landing page for '.$busName.'" />
        <meta itemprop="name" content="Classifieds Landing page">
        <meta itemprop="description" content="Classifieds Landing page for '.$busName.'">';

    $data['mainContent'] = <<<EOS
<h1>$busName Classifieds</h1>
<h2>Introducing our new online system</h2>

<p>Now it’s easier than ever to place an ad and find what you’re looking for—24 hours a day, seven days a week.</p>
<p>In just a few clicks, you can place your ads online, in print or both. And with improved ad displays, your ad is sure to get noticed!</p>
<p>From vehicles to pets to garage sales to services, we provide the most effective ways to sell to potential local
buyers through our leading mobile, online and print solutions.</p>
<p><a class="button" href="http://$siteName.gannettclassifieds.com"><button type="button" class="btn btn-primary btn-lg" style="width:100%;">Place an Ad</button></a></p>
<p><a class="button" href="http://$siteName.com/classifiedshelp" target="_blank"><button type="button" class="btn btn-primary btn-lg" style="width:100%;">Classifieds Help</button></a></p>
<h1>Featured Partner Classified Services</h1>
<div class="row">
    <div class="col-md-4">
        <h4>Cars</h4>
        <a href="$siteUrl/cars"><img alt="Cars.com" src="img/partners/130-cars.gif"></a>
        <p><a class="button" href="$siteUrl/cars"><button type="button" class="btn btn-primary btn-lg" style="width:100%;">View Autos</button></a></p>
    </div>
    <div class="col-md-4">
        <h4>Jobs</h4>
        <a href="$siteUrl/jobs"><img alt="micareerbuilder.com" src="img/partners/130-careerbuilder.gif"></a>
        <p><a class="button" href="$siteUrl/jobs"><button type="button" class="btn btn-primary btn-lg" style="width:100%;">View Jobs</button></a></p>
    </div>
    <div class="col-md-4">
        <h4>Homes</h4>
        <a href="$siteUrl/homes"><img alt="homefinder.com" src="img/partners/130-homefinder.gif" ></a>
        <p><a class="button" href="$siteUrl/homes"><button type="button" class="btn btn-primary btn-lg" style="width:100%;">View Homes</button></a></p>
    </div>

</div>
EOS;

    $app->render('master.php', $data);
})->name('landing');

$app->get('/map.php', function () use ($app) {
    $params = '';
    foreach($app->request->params() as $key => $val) {
        if ($params != '') {$params .= '&';}
        $params .= $key.'='.urlencode($val);
    }
    $app->redirect('map?'.$params);
});

$app->get('/map', function () use ($app,$log) {
    $log->info('Map Page(FORWARDED_FOR: '.@$_SERVER['HTTP_X_FORWARDED_FOR'].', REMOTE_ADDR: '.@$_SERVER['REMOTE_ADDR'].', HTTP_HOST: '.@$_SERVER['HTTP_HOST'].', SERVER_NAME: '.@$_SERVER['SERVER_NAME'].')');

    $data['dcdApp'] = new \DCD\DcdApp();
    $data['ads'] = new \DCD\Ads();
    $data['nav'] = new \DCD\Navigation();

    $busName = $data['dcdApp']->getSite()->BusName;
    $domain = $data['dcdApp']->getSite()->Domain;

    $place = $app->request->get('place');
    $position = $app->request->get('posit');
    $city = $app->request->get('city');
    $paper = $app->request->get('paper');
    $day = $app->request->get('day');
    $bdRooms = $app->request->get('bdRooms');
    $bthRooms = $app->request->get('bthRooms');
    $minRent = $app->request->get('minRent');
    $maxRent = $app->request->get('maxRent');

    $data['place'] = $place;
    $data['position'] = $position;

    $listOfRummages = $data['dcdApp']->getRummages($place,$position,'','',$city,$paper,$day,$bdRooms,$bthRooms,$minRent,$maxRent);

    $mapPoints = json_encode($listOfRummages['map']);
    $filterArray = array();

    $rummageList = getRummageList($listOfRummages['list'], $domain, $place, $position, $filterArray);

    $filterLine = '';

    $data['metadata'] = '<title>'.$busName.' - Classifieds Listings</title>
        <meta name="description" content="category listing page for '.$busName.'" />
        <meta itemprop="name" content="category listing page">
        <meta itemprop="description" content="category listing page for '.$busName.'">';

    $mapDisplay = '';

    if (count($listOfRummages['map'])) {
        $mapDisplay = getMapDisplay($place,$position);
        $data['googleApiScript'] = <<<EOS
	<link rel="stylesheet" href="css/rummage.css">
    <!-- Google Maps API V3 -->
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <!-- Google Maps API V3 -->
    <script type="text/javascript">
        //setup global namespace
        var DCDMAPGLOBAL = {};
        DCDMAPGLOBAL.points = $mapPoints;
    </script>
EOS;
    }
    $data['masterBottom'] = '<link type="text/css" rel="stylesheet" href="3rdParty/fancybox/source/jquery.fancybox.css" media="screen">
        <script type="text/javascript" src="3rdParty/fancybox/source/jquery.fancybox.pack.js"></script>
        <script src="js/rummage.js"></script>';

    $data['mainContent'] = <<<EOS
<ol class="breadcrumb">
    <li><a href="./">Home</a></li>
    <li class="active">$position</li>
</ol>
    $filterLine
    $mapDisplay
    $rummageList
EOS;

    $app->render('master.php', $data);
})->name('map');

//listingItem
$app->get('/listingItem.php', function () use ($app) {
    $params = '';
    foreach($app->request->params() as $key => $val) {
        if ($params != '') {$params .= '&';}
        $params .= $key.'='.urlencode($val);
    }
    $app->redirect('listingItem?'.$params);
});

$app->get('/listingItem', function () use ($app,$log) {
    $log->info('Item Page(ID: '.urldecode($_REQUEST['id']).', FORWARDED_FOR: '.@$_SERVER['HTTP_X_FORWARDED_FOR'].', REMOTE_ADDR: '.@$_SERVER['REMOTE_ADDR'].', HTTP_HOST: '.@$_SERVER['HTTP_HOST'].', SERVER_NAME: '.@$_SERVER['SERVER_NAME'].')');

    $id = $app->request->get('id');

    $data['dcdApp'] = new \DCD\DcdApp();
    $data['ads'] = new \DCD\Ads();
    $data['nav'] = new \DCD\Navigation();

    $server = $_SERVER['SERVER_NAME'];
    $port = $_SERVER['SERVER_PORT'];
    if (isset($_SERVER['CONTEXT_PREFIX'])) {
        $server .= $_SERVER['CONTEXT_PREFIX'];
    }

    $url = rtrim($server, "/");

    if (!empty($port)) {
        $url= $url.':'.$port;
    }

    $busName = $data['dcdApp']->getSite()->BusName;
    $listings = $data['dcdApp']->getSingleListing($id);

    $placement = $listings['Placement'];
    $position = $listings['Position'];
    $siteCode = $listings['SiteCode'];
    $street = $listings['Street'];
    $city = $listings['City'];
    $state = $listings['State'];
    $zip = $listings['Zip'];
    $adText = $listings['AdText'];
    $lat = $listings['Lat'];
    $lon = $listings['Long'];
    $email = $listings['Email'];
    $propType = $listings['PropType'];
    $parking = $listings['Parking'];
    $deposit = $listings['Deposit'];
    $bedRooms = $listings['BedRooms'];
    $bathRooms = $listings['BathRooms'];
    $rent = $listings['Rent'];
    $phone = $listings['Phone'];
    $neighborhood = $listings['Neighborhood'];
    $squareFeet = $listings['SquareFeet'];
    $amenities = json_decode($listings['Amenities']);
    $recs = json_decode($listings['ExerciseRec']);
    $feats = json_decode($listings['CommFeat']);

    $data['position'] = $position;

    $featsList = '';
    if (!empty($feats)) {
        $featsList = '<ul>';
        foreach($feats as $rectx) {
            $featsList .= '<li>'.$rectx.'</li>';
        }
        $featsList .= '</ul>';
    }

    $recsList = '';
    if (!empty($recs)) {
        $recsList = '<ul>';
        foreach($recs as $rectx) {
            $recsList .= '<li>'.$rectx.'</li>';
        }
        $recsList .= '</ul>';
    }

    $amenitiesList = '';
    if (!empty($amenities)) {
        $amenitiesList = '<h3>Amenities</h3><ul>';
        foreach($amenities as $amen) {
            $amenitiesList .= '<li>'.$amen.'</li>';
        }
        $amenitiesList .= '</ul>';
    }

    $petsList = '';
    if (!empty($pets)) {
        $petsList .= '<ul><li>'.$pets.'</li></ul>';
    }

    $detList = '';
    if (! empty($bedRooms) && ($bedRooms != 'null')) {
        $detList .= '<span class="label label-default">Bedrooms</span>&nbsp;'.$bedRooms;
    }
    if (! empty($bathRooms) && ($bathRooms != 'null')) {
        if (! empty($detList)) {
            $detList .= '<li style="list-style: none">&nbsp;|&nbsp;</li>';
        }
        $detList .= '<span class="label label-default">Bathsrooms</span>&nbsp;'.$bathRooms;
    }
    if (! empty($squareFeet) && ($squareFeet != 'null')) {
        if (! empty($detList)) {
            $detList .= '<li style="list-style: none">&nbsp;|&nbsp;</li>';
        }
        $detList .= '<span class="label label-default">SqFt</span>&nbsp;'.$squareFeet;
    }
    if (! empty($propType) && ($propType != 'null')) {
        if (! empty($detList)) {
            $detList .= '<li style="list-style: none">&nbsp;|&nbsp;</li>';
        }
        $detList .= '<span class="label label-default">Type</span>&nbsp;'.$propType;
    }
    if (! empty($rent) && ($rent != 'null')) {
        if (! empty($detList)) {
            $detList .= '<li style="list-style: none">&nbsp;|&nbsp;</li>';
        }
        $detList .= '<span class="label label-default">Rent</span>&nbsp;'.'$'.$rent;
    }
    if (! empty($deposit) && ($deposit != 'null')) {
        if (! empty($detList)) {
            $detList .= '<li style="list-style: none">&nbsp;|&nbsp;</li>';
        }
        $detList .= '<span class="label label-default">Deposit</span>&nbsp;'.$deposit;
    }

    $cleanAdText = strip_tags($adText);
    $parkingList = '';
    if (!empty($parking)) {
        $parkingList .= '<ul><li>'.$parking.'</li></ul>';
    }

    $emailGlyph = $emailTextOnly = '';
    if (!empty($email)) {
        $emailGlyph ='<a class="btn btn-small" type="button" href="mailto:'.$email.'?subject='. str_replace("&","%26",substr($cleanAdText, 0, 80)) .'"><span class="glyphicon glyphicon glyphicon-envelope" aria-hidden="true"></span></a>';
        $emailTextOnly ='<a class="btn btn-small" type="button" href="mailto:'.$email.'?subject='. str_replace("&","%26",substr($cleanAdText, 0, 80)) .'">'.$email.'</a>';
    }

    $neighborhoodShow = '';
    if (!empty($neighborhood)) {
        $neighborhoodShow = "($neighborhood)";
    }

    $imageCarousel = getCarousel($listings['Images'], $url, $siteCode);

    $urlEncodedPlacement = urlencode($placement);
    $urlEncodedPosition = urlencode($position);

    $data['metadata'] = '<title>'.$busName.' - Classifieds Listings</title>
        <meta name="description" content="category listing page for '.$busName.'" />
        <meta itemprop="name" content="category listing page">
        <meta itemprop="description" content="category listing page for '.$busName.'">';

    $data['mainContent'] = <<<EOS
<ol class="breadcrumb">
    <li><a href="./">Home</a></li>
    <li><a href="map.php?place=$urlEncodedPlacement&posit=$urlEncodedPosition">$position</a></li>
    <li class="active">listing - ($id)</li>
</ol>
<!-- Portfolio Item Heading -->
        <div class="row" style="margin-top: 0px;">
            <div class="col-lg-12">
                <h1 class="page-header">$street
                    <small>$neighborhoodShow</small>
                    <small>$emailGlyph</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-8">
                $imageCarousel
                <br />
                <i class="fa fa-map-marker fa-2x"></i>&nbsp;&nbsp;$street, $city, $state $zip&nbsp;<a id="gotomap" href="#">(view Map)</a>
            </div>

            <div class="col-md-4">
                <h3>Description</h3>
                <p>$cleanAdText</p>
                $amenitiesList
            </div>

        </div>

        <div class="panel panel-default" style="margin-top: 20px">
            <div class="panel-body">
                <ul class="list-inline list-unstyled">
                    $detList
                </ul>
            </div>
        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Additional Features</h3>
            </div>
            <div class="col-sm-3 col-xs-6">
                <h4><i class="fa fa-car"></i>&nbsp;Parking</h4>
                    $parkingList
            </div>
            <div class="col-sm-3 col-xs-6">
                <h4><i class="fa fa-paw"></i>&nbsp;Pets</h4>
                    $petsList
            </div>
            <div class="col-sm-3 col-xs-6">
                <h4><i class="fa fa-futbol-o"></i>&nbsp;Recreation</h4>
                    $recsList
            </div>
            <div class="col-sm-3 col-xs-6">
                <h4><i class="fa fa-building-o"></i>&nbsp;Features</h4>
                    $featsList
            </div>
        </div>

        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Contact</h3>
            </div>
            <div class="col-sm-6 col-xs-12">
                <strong>Phone:</strong>&nbsp;<a href="tel:$phone">$phone</a>
            </div>
            <div class="col-sm-6 col-xs-12">
                <strong>Email:</strong>&nbsp; $emailTextOnly
            </div>
        </div>

        <div class"row">
            <div class="col-lg-12" id="map">
                <h3 class="page-header">Area Map</h3>
            </div>
            <br />
            <div id="dcd-map-container"></div>
        </div>

        <hr />
EOS;

    $mapPoints = '{
    "APTSTEST": {
        "street": "'.$street .'",
        "city": "'.$city .'",
        "state": "'.$state .'",
        "zip": "'.$zip .'",
        "lat": "'.$lat .'",
        "lon": "'.$lon .'"
    }}';

    $data['googleApiScript'] = <<<EOS
	<link rel="stylesheet" href="css/rummage.css">
    <!-- Google Maps API V3 -->
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <!-- Google Maps API V3 -->
    <script type="text/javascript">
        //setup global namespace
        var DCDMAPGLOBAL = {};
        DCDMAPGLOBAL.points = $mapPoints;
    </script>
EOS;

    $data['masterBottom'] = '<link type="text/css" rel="stylesheet" href="3rdParty/fancybox/source/jquery.fancybox.css" media="screen">
<script type="text/javascript" src="3rdParty/fancybox/source/jquery.fancybox.pack.js"></script>
<script src="js/rummage.js"></script>';

    $app->render('master.php', $data);
})->name('listingItem');

$app->run();