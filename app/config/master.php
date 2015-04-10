<?php
date_default_timezone_set('America/New_York');

//logging
$logging_level = 7;
$logging_dir = "./logs/";
$json_dir = './data/';
$module_dir = './modules';

// listings per page
define("LISTINGS_PER_PAGE", "10");
//db vars
define("DB_HOST", "localhost");
define("DB_PORT", "3306");
define("DB_USER", "classifieds");
define("DB_PASS", "ClassDB13!");
define("DB_NAME", "classifieds");
//feed tables
define("TBL_LISTING", "listing");
define("TBL_PLACEMENT", "placements");
define("TBL_POSITION", "positions");
//logging
define("LOGGING_LEVEL", 7);
define("LOGGING_DIR", "C:\Users\jhicks\GIT\DCD\logs");
//version
define("DCD_VERSION", "20.0");
//base URL
//define("BASE_URL", "/DCD/");

// key performance indicators  (kpi)
// metrics

$stacks = array(
    'SMG' => array(
        'Log file monitoring' => array(
            'MOC ssh' => array(
                'module' => 'ssh',
                'params' => array (
                    'server' => 'moc-lx7915',
                    'port' => '21',
                    'user_name' => 'SMGMONSvc',
                    'user_pass' => 'F@u1i8VfeOjS'
                ),
                'callBacks' => array(
                    'ingestion' => array(
                        'call' => 'processCheck',
                        'params' => array(
                            'processName' => 'python',
                            'grep' => 'smgi-run.py',
                            'countonly' => 1,
                            'ofString' => '4'
                        )
                    ),
                    'Xmlteam Last File Download' => array(
                        'call' => 'FileLastOccurrence',
                        'params' => array(
                            'filename' => '/opt/gannett/aime/smgi/src/smgi/data/logs/smgi.log',
                            'tail' => '70000',
                            'find' => 'Downloading file: http://api\.mmajunkie\.com',
                            'parse' => '/\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2},\d{3}/'
                        )
                    ),
                    'Xmlteam Last DataBase Insert' => array(
                        'call' => 'FileLastOccurrence',
                        'params' => array(
                            'filename' => '/opt/gannett/aime/smgi/src/smgi/data/logs/smgi.log',
                            'tail' => '70000',
                            'find' => 'xmlteam API insert response.*\"ReferenceNo\": \"200\"',
                            'parse' => '/\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2},\d{3}/'
                        )
                    ),
                    'MMAJunkie Last File Download' => array(
                        'call' => 'FileLastOccurrence',
                        'params' => array(
                            'filename' => '/opt/gannett/aime/smgi/src/smgi/data/logs/smgi.log',
                            'tail' => '70000',
                            'find' => 'Downloading file: http://api\.mmajunkie\.com',
                            'parse' => '/\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2},\d{3}/'
                        )
                    ),
                    'MMAJunkie Last DataBase Insert' => array(
                        'call' => 'FileLastOccurrence',
                        'params' => array(
                            'filename' => '/opt/gannett/aime/smgi/src/smgi/data/logs/smgi.log',
                            'tail' => '200000',
                            'find' => 'mmajunkie API insert response.*\"ReferenceNo\": \"200\"',
                            'parse' => '/\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2},\d{3}/'
                        )
                    ),
                    'DataFactory Last File Download' => array(
                        'call' => 'FileLastOccurrence',
                        'params' => array(
                            'filename' => '/opt/gannett/aime/smgi/src/smgi/data/logs/smgi.log',
                            'tail' => '70000',
                            'find' => 'Downloading file: http://usatoday\.datafactory\.la',
                            'parse' => '/\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2},\d{3}/'
                        )
                    ),
                    'DataFactory Last DataBase Insert' => array(
                        'call' => 'FileLastOccurrence',
                        'params' => array(
                            'filename' => '/opt/gannett/aime/smgi/src/smgi/data/logs/smgi.log',
                            'tail' => '70000',
                            'find' => 'datafactory API insert response.*\"ReferenceNo\": \"200\"',
                            'parse' => '/\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2},\d{3}/'
                        )
                    ),
                    'XmlTeam last access' => array(
                        'call' => 'fileCat',
                        'params' => array('filename' => '/opt/gannett/aime/smgi/src/smgi/data/last_access.xmlteam')
                    ),
                    'MMAJunkie last access' => array(
                        'call' => 'fileCat',
                        'params' => array('filename' => '/opt/gannett/aime/smgi/src/smgi/data/last_access.mmajunkie')
                    ),
                    'DataFactory last access' => array(
                        'call' => 'fileCat',
                        'params' => array('filename' => '/opt/gannett/aime/smgi/src/smgi/data/last_access.datafactory')
                    ),
                )
            )
        ),
        'DB Last Update' => array(
            'rest' => array(
                'module' => 'http',
                'params' => array(
                    'protocol' => 'http://',
                    'resource_name' => 'relaunch-sports-dev.usatoday.com',
                    'port' => '50624',
                    'base_file_path' => 'SportsTools/MetaData.svc',
                    'user_name' => '',
                    'user_pass' => '',
                ),
                'callBacks' => array(
                    'Last Updated' => array(
                        'call' => 'getData',
                        'params' => array('urls' => array(
                            'Last Update' => 'aimeasset.gmti.gbahn.net/SportsTools/MetaData.svc/lastupdate'
                        ),
                            'parse' => 'json'
                        )
                    )
                )
            )
        ),
        'Web Farm servers' => array(
            'rest' => array(
                'module' => 'http',
                'params' => array(
                    'protocol' => 'http://',
                    'resource_name' => '10.189.7.232',
                    'port' => '80',
                    'base_file_path' => '',
                    'user_name' => '',
                    'user_pass' => '',
                ),
                'callBacks' => array(
                    'MOC SportsFeeds' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            '(frontend)' => '10.189.7.232/SportsFeeds/version-info.html',
                            '(node1)' => '10.189.28.129/SportsFeeds/version-info.html',
                            '(node2)'=>'10.189.28.130/SportsFeeds/version-info.html',
                            '(node3)'=>'10.189.28.131/SportsFeeds/version-info.html',
                            '(node4)'=>'10.189.28.132/SportsFeeds/version-info.html'
                        ))
                    ),
                    'MOC SportsHub' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            '(frontend)' => '10.189.7.233/SportsHub/version-info.html',
                            '(node1)' => '10.189.28.141/SportsHub/version-info.html',
                            '(node2)'=>'10.189.28.142/SportsHub/version-info.html',
                            '(node3)'=>'10.189.28.143/SportsHub/version-info.html',
                            '(node4)'=>'10.189.28.144/SportsHub/version-info.html'
                        ))
                    ),
                    'MOC SportsJameson' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            '(frontend)' => '10.189.7.233/SportsHub/version-info.html',
                            '(node1)' => '10.189.28.141/SportsHub/version-info.html',
                            '(node2)'=>'10.189.28.142/SportsHub/version-info.html',
                            '(node3)'=>'10.189.28.143/SportsHub/version-info.html',
                            '(node4)'=>'10.189.28.144/SportsHub/version-info.html'
                        ))
                    ),
                    'MOC SportsNative' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            '(frontend)' => '10.189.7.233/SportsHub/version-info.html',
                            '(node1)' => '10.189.28.141/SportsHub/version-info.html',
                            '(node2)'=>'10.189.28.142/SportsHub/version-info.html',
                            '(node3)'=>'10.189.28.143/SportsHub/version-info.html',
                            '(node4)'=>'10.189.28.144/SportsHub/version-info.html'
                        ))
                    ),
                    'PHX SportsFeed' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            '(frontend)' => '10.189.7.232/SportsFeeds/version-info.html',
                            '(node1)' => '10.189.28.129/SportsFeeds/version-info.html',
                            '(node2)'=>'10.189.28.130/SportsFeeds/version-info.html',
                            '(node3)'=>'10.189.28.131/SportsFeeds/version-info.html',
                            '(node4)'=>'10.189.28.132/SportsFeeds/version-info.html'
                        ))
                    ),
                    'PHX SportsHub' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            '(frontend)' => '10.189.7.233/SportsHub/version-info.html',
                            '(node1)' => '10.189.28.141/SportsHub/version-info.html',
                            '(node2)'=>'10.189.28.142/SportsHub/version-info.html',
                            '(node3)'=>'10.189.28.143/SportsHub/version-info.html',
                            '(node4)'=>'10.189.28.144/SportsHub/version-info.html'
                        ))
                    ),
                    'PHX SportsJameson' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            '(frontend)' => '10.189.7.233/SportsHub/version-info.html',
                            '(node1)' => '10.189.28.141/SportsHub/version-info.html',
                            '(node2)'=>'10.189.28.142/SportsHub/version-info.html',
                            '(node3)'=>'10.189.28.143/SportsHub/version-info.html',
                            '(node4)'=>'10.189.28.144/SportsHub/version-info.html'
                        ))
                    ),
                    'PHX SportsNative' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            '(frontend)' => '10.189.7.233/SportsHub/version-info.html',
                            '(node1)' => '10.189.28.141/SportsHub/version-info.html',
                            '(node2)'=>'10.189.28.142/SportsHub/version-info.html',
                            '(node3)'=>'10.189.28.143/SportsHub/version-info.html',
                            '(node4)'=>'10.189.28.144/SportsHub/version-info.html'
                        ))
                    )
                )
            )
        ),
        'API endpoints' => array(
            'http' => array(
                'module' => 'http',
                'params' => array(
                    'protocol' => 'http://',
                    'resource_name' => '159.54.247.139',
                    'port' => '80',
                    'base_file_path' => '',
                    'user_name' => '',
                    'user_pass' => '',
                ),
                'callBacks' => array(
                    'MOC SportsFeeds' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Metadata' => '10.189.7.232/SportsFeeds/Metadata.svc/leagues',
                            'version' => '10.189.7.232/SportsFeeds/version-info.html'
                        ))
                    ),
                    'MOC SportsHub' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Metadata' => '10.189.7.233/SportsHub/Metadata.svc/leagues',
                            'version' => '10.189.7.233/SportsHub/version-info.html'
                        ))
                    ),
                    'MOC SportsJameson' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Metadata' => '10.189.7.234/SportsJameson/Metadata.svc/leagues',
                            'version' => '10.189.7.234/SportsJameson/version-info.html'
                        ))
                    ),
                    'MOC SportsNative' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Metadata' => '10.189.7.235/SportsNative/Metadata.svc/leagues',
                            'version' => '10.189.7.235/SportsNative/version-info.html'
                        ))
                    ),
                    'PHX SportsFeeds' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Metadata' => '10.186.7.115/SportsFeeds/Metadata.svc/leagues',
                            'version' => '10.186.7.115/SportsFeeds/version-info.html'
                        ))
                    ),
                    'PHX SportsHub' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Metadata' => '10.186.7.116/SportsHub/Metadata.svc/leagues',
                            'version' => '10.186.7.116/SportsHub/version-info.html'
                        ))
                    ),
                    'PHX SportsJameson' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Metadata' => '10.186.7.117/SportsJameson/Metadata.svc/leagues',
                            'version' => '10.186.7.117/SportsJameson/version-info.html'
                        ))
                    ),
                    'PHX SportsNative' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Metadata' => '10.186.7.118/SportsNative/Metadata.svc/leagues',
                            'version' => '10.186.7.118/SportsNative/version-info.html'
                        ))
                    )
                )
            )
        ),
        'Varnish API' => array(
            'http' => array(
                'module' => 'http',
                'params' => array(
                    'protocol' => 'http://',
                    'resource_name' => '159.54.247.139',
                    'port' => '80',
                    'base_file_path' => '',
                    'user_name' => '',
                    'user_pass' => '',
                ),
                'callBacks' => array(
                    'MOC SportsFeed' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Metadata' => '159.54.247.139/SportsFeeds/Metadata.svc/leagues',
                            'version' => '159.54.247.139/SportsFeeds/version-info.html'
                        ))
                    ),
                    'MOC SportsHub' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Metadata' => '159.54.247.139/SportsHub/Metadata.svc/leagues',
                            'version' => '159.54.247.139/SportsHub/version-info.html'
                        ))
                    ),
                    'MOC SportsJameson' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Metadata' => '159.54.247.139/SportsJameson/Metadata.svc/leagues',
                            'version' => '159.54.247.139/SportsJameson/version-info.html'
                        ))
                    ),
                    'MOC SportsNative' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Metadata' => '159.54.247.139/SportsNative/Metadata.svc/leagues',
                            'version' => '159.54.247.139/SportsNative/version-info.html'
                        ))
                    ),
                    'PHX SportsFeeds' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Metadata' => '209.97.55.120/SportsFeeds/Metadata.svc/leagues',
                            'version' => '209.97.55.120/SportsFeeds/version-info.html'
                        ))
                    ),
                    'PHX SportsHub' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Metadata' => '209.97.55.120/SportsHub/Metadata.svc/leagues',
                            'version' => '209.97.55.120/SportsHub/version-info.html'
                        ))
                    ),
                    'PHX SportsJameson' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Metadata' => '209.97.55.120/SportsJameson/Metadata.svc/leagues',
                            'version' => '209.97.55.120/SportsJameson/version-info.html'
                        ))
                    ),
                    'PHX SportsNative' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Metadata' => '209.97.55.120/SportsNative/Metadata.svc/leagues',
                            'version' => '209.97.55.120/SportsNative/version-info.html'
                        ))
                    )
                )
            )
        ),
        'Mashery API' => array(
            'http' => array(
                'module' => 'http',
                'params' => array(
                    'protocol' => 'http://',
                    'resource_name' => '159.54.247.139',
                    'port' => '80',
                    'base_file_path' => '',
                    'user_name' => '',
                    'user_pass' => '',
                ),
                'callBacks' => array(
                    'SportsFeed' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Feeds' => 'api.usatoday.com/internal/SportsFeeds/Feeds.svc/help?api_key=2zcm72jnqexbnputx3xat756'
                        ))
                    ),
                    'SportsHub' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Ticker' => 'api.usatoday.com/internal/SportsHub/Ticker.svc/help?api_key=4xes84qpvxqtj8q7nkvaxdet'
                        ))
                    ),
                    'SportsJameson' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Scores' => 'api.usatoday.com/internal/SportsJameson/Scores.svc/help?api_key=vajexd6knaux657926npntba'
                        ))
                    ),
                    'SportsNative' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Scores' => 'api.usatoday.com/internal/SportsNative/Scores.svc/help?api_key=f3ku4mspfm9ec47qmgbjuyp7'
                        ))
                    )
                )
            )
        ),

        'Akamai API' => array(
            'http' => array(
                'module' => 'http',
                'params' => array(
                    'protocol' => 'http://',
                    'resource_name' => '159.54.247.139',
                    'port' => '80',
                    'base_file_path' => '',
                    'user_name' => '',
                    'user_pass' => '',
                ),
                'callBacks' => array(
                    'SportsFeed' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Feeds' => 'api.gannett-cdn.com/internal/SportsFeeds/Feeds.svc/help?api_key=2zcm72jnqexbnputx3xat756'
                        ))
                    ),
                    'SportsHub' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Ticker' => 'api.gannett-cdn.com/internal/SportsHub/Ticker.svc/help?api_key=4xes84qpvxqtj8q7nkvaxdet'
                        ))
                    ),
                    'SportsJameson' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Scores' => 'api.gannett-cdn.com/internal/SportsJameson/Scores.svc/help?api_key=vajexd6knaux657926npntba'
                        ))
                    ),
                    'SportsNative' => array(
                        'call' => 'checkUrl',
                        'params' => array('urls' => array(
                            'Scores' => 'api.gannett-cdn.com/internal/SportsNative/Scores.svc/help?api_key=f3ku4mspfm9ec47qmgbjuyp7'
                        ))
                    )
                )
            )
        )
    )
);
