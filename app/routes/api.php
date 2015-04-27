<?php
/**
 * Created by PhpStorm.
 * User: JHICKS
 * Date: 4/16/2015
 * Time: 11:07 AM
 */

$apiAuthenticate = function($app) {
    return function() use ($app) {
        if (!isset($_SESSION['user'])) {
            //error_log('user not logged in', 3, '/var/tmp/phperror.log'); //Write error log
            echo '{"error":{"text": "user not logged in"}}';
        }
    };
};

$app->get('/api/login', 'loginApi');
// urls
$app->get('/api/urls', 'getUrls');
$app->get('/api/urls/:id', 'getUrl');
$app->post('/api/urls', 'addUrl');
$app->put('/api/urls/:id', 'updateUrl');
$app->delete('/api/urls/:id', 'deleteUrl');
// all tracking codes
$app->get('/api/trackingCodes', 'getAllTrackingCodes');
// mediums
$app->get('/api/mediums', 'getMediums');
$app->get('/api/mediums/:id', 'getMedium');
$app->post('/api/mediums', 'addMedium');
$app->put('/api/mediums/:id', 'updateMedium');
$app->delete('/api/mediums/:id', 'deleteMedium');
// sources
$app->get('/api/sources', 'getSources');
$app->get('/api/sources/:id', 'getSource');
$app->post('/api/sources', 'addSource');
$app->put('/api/sources/:id', 'updateSource');
$app->delete('/api/sources/:id', 'deleteSource');
// campaigns
$app->get('/api/campaigns', 'getCampaigns');
$app->get('/api/campaigns/:id', 'getCampaign');
$app->post('/api/campaigns', 'addCampaign');
$app->put('/api/campaigns/:id', 'updateCampaign');
$app->delete('/api/campaigns/:id', 'deleteCampaign');
// terms
$app->get('/api/terms', 'getTerms');
$app->get('/api/terms/:id', 'getTerm');
$app->post('/api/terms', 'addTerm');
$app->put('/api/terms/:id', 'updateTerm');
$app->delete('/api/terms/:id', 'deleteTerm');
// contents
$app->get('/api/contents', 'getContents');
$app->get('/api/contents/:id', 'getContent');
$app->post('/api/contents', 'addContent');
$app->put('/api/contents/:id', 'updateContent');
$app->delete('/api/contents/:id', 'deleteContent');
// gpssources
$app->get('/api/gpsSources', 'getGpsSources');
$app->get('/api/gpsSources/:id', 'getGpsSource');
$app->post('/api/gpsSources', 'addGpsSource');
$app->put('/api/gpsSources/:id', 'updateGpsSource');
$app->delete('/api/gpsSources/:id', 'deleteGpsSource');
// baseurls
$app->get('/api/baseUrls', 'getBaseUrls');
$app->get('/api/baseUrls/:id', 'getBaseUrl');
$app->post('/api/baseUrls', 'addBaseUrl');
$app->put('/api/baseUrls/:id', 'updateBaseUrl');
$app->delete('/api/baseUrls/:id', 'deleteBaseUrl');

function loginApi(){
    $app = \Slim\Slim::getInstance();

    $email = $app->request()->post('inputEmail');
    $password = $app->request()->post('inputPassword');

    $errors = login($email, $password, $app);

    if (count($errors) > 0) {
        echo '{"error":{"text":"unable to Login"}}';
    }
}

function getUrls() {
    $app = \Slim\Slim::getInstance();
    $sc = $app->request->get('sc');

    $sql = "SELECT * FROM url";
    $params = array();

    if (!empty($sc)) {
        $sql = " Where site_code=:sc";
        $params['sc'] = $sc;
    }

    $sql .= " ORDER BY url_id DESC";
    try {
        $db = new \UCT\Database();

        $stmt = $db->prepare($sql);
        $params = is_array($params) ? $params : array($params);
        $stmt->execute($params);

        $urls = $stmt->fetchObject();

        $db = null;
        echo '{"urls": ' . json_encode($urls) . '}';
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getUrl($id) {
    $sql = "SELECT * FROM url WHERE url_id=:id";
    try {
        $db = new \UCT\Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $urls = $stmt->fetchObject();
        $db = null;
        echo json_encode($urls);
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function addUrl() {
    $request = Slim::getInstance()->request();
    $url = json_decode($request->getBody());
    $sql = "INSERT INTO url (creator, createDate, version, baseUrl, fk_campaignID, fk_mediumID, fk_channelID, content, term, gpsExtension) VALUES (:creator, :createDate, :version, :baseUrl, :fk_campaignID, :fk_mediumID, :fk_channelID, :content, :term, :gpsExtension)";
    try {
        $db = new \UCT\Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("creator", $url->creator);
        $stmt->bindParam("createDate", $url->createDate);
        $stmt->bindParam("version", $url->version);
        $stmt->bindParam("baseUrl", $url->baseUrl);
        $stmt->bindParam("fk_campaignID", $url->fk_campaignID);
        $stmt->bindParam("fk_mediumID", $url->fk_mediumID);
        $stmt->bindParam("fk_channelID", $url->fk_channelID);
        $stmt->bindParam("content", $url->content);
        $stmt->bindParam("term", $url->term);
        $stmt->bindParam("gpsExtension", $url->gpsExtension);
        $stmt->execute();
        $url->id = $db->lastInsertId();
        $db = null;
        echo json_encode($url);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function updateUrl($id) {
    $request = Slim::getInstance()->request();
    $url = json_decode($request->getBody());
    //$sql = "INSERT INTO url (creator, createDate, version, baseUrl, fk_campaignID, fk_mediumID, fk_channelID, content, term, gpsExtension) VALUES (:creator, :createDate, :version, :baseUrl, :fk_campaignID, :fk_mediumID, :fk_channelID, :content, :term, :gpsExtension)";
    $sql = "UPDATE url SET name=:name, grapes=:grapes, country=:country, region=:region, year=:year, description=:description WHERE url_id=:url_id";
    try {
        $db = new \UCT\Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("creator", $url->creator);
        $stmt->bindParam("createDate", $url->createDate);
        $stmt->bindParam("version", $url->version);
        $stmt->bindParam("baseUrl", $url->baseUrl);
        $stmt->bindParam("fk_campaignID", $url->fk_campaignID);
        $stmt->bindParam("fk_mediumID", $url->fk_mediumID);
        $stmt->bindParam("fk_channelID", $url->fk_channelID);
        $stmt->bindParam("content", $url->content);
        $stmt->bindParam("term", $url->term);
        $stmt->bindParam("gpsExtension", $url->gpsExtension);
        $stmt->bindParam("url_id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($url);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function deleteUrl($id) {
    $sql = "DELETE FROM url WHERE url_id=:id";
    try {
        $db = new \UCT\Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getAllTrackingCodes() {
    echo '['.getMediums().','.getSources().','.getCampaigns().','.getTerms().','.getContents().','.getGpsSources().']';
}

function getMediums() {
    $sql = "SELECT * FROM medium ORDER BY medium_id DESC";
    try {
        $db = new \UCT\Database();
        $stmt = $db->query($sql);
        //$stmt = $db->prepare($sql);
        //$stmt->bindParam("id", $id);
        //$stmt->execute();
        $urls = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"mediums": ' . json_encode($urls) . '}';
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getMedium($id) {
    $sql = "SELECT * FROM medium WHERE medium_id=:id";
    try {
        $db = new \UCT\Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $urls = $stmt->fetchObject();
        $db = null;
        echo json_encode($urls);
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function addMedium() {
    $request = Slim::getInstance()->request();
    $url = json_decode($request->getBody());
    $sql = "INSERT INTO medium (creator, createDate, version, baseUrl, fk_campaignID, fk_mediumID, fk_channelID, content, term, gpsExtension) VALUES (:creator, :createDate, :version, :baseUrl, :fk_campaignID, :fk_mediumID, :fk_channelID, :content, :term, :gpsExtension)";
    try {
        $db = new \UCT\Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("creator", $url->creator);
        $stmt->bindParam("createDate", $url->createDate);
        $stmt->bindParam("version", $url->version);
        $stmt->bindParam("baseUrl", $url->baseUrl);
        $stmt->bindParam("fk_campaignID", $url->fk_campaignID);
        $stmt->bindParam("fk_mediumID", $url->fk_mediumID);
        $stmt->bindParam("fk_channelID", $url->fk_channelID);
        $stmt->bindParam("content", $url->content);
        $stmt->bindParam("term", $url->term);
        $stmt->bindParam("gpsExtension", $url->gpsExtension);
        $stmt->execute();
        $url->id = $db->lastInsertId();
        $db = null;
        echo json_encode($url);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function updateMedium($id) {
    $request = Slim::getInstance()->request();
    $url = json_decode($request->getBody());
    //$sql = "INSERT INTO url (creator, createDate, version, baseUrl, fk_campaignID, fk_mediumID, fk_channelID, content, term, gpsExtension) VALUES (:creator, :createDate, :version, :baseUrl, :fk_campaignID, :fk_mediumID, :fk_channelID, :content, :term, :gpsExtension)";
    $sql = "UPDATE medium SET name=:name, grapes=:grapes, country=:country, region=:region, year=:year, description=:description WHERE url_id=:url_id";
    try {
        $db = new \UCT\Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("creator", $url->creator);
        $stmt->bindParam("createDate", $url->createDate);
        $stmt->bindParam("version", $url->version);
        $stmt->bindParam("baseUrl", $url->baseUrl);
        $stmt->bindParam("fk_campaignID", $url->fk_campaignID);
        $stmt->bindParam("fk_mediumID", $url->fk_mediumID);
        $stmt->bindParam("fk_channelID", $url->fk_channelID);
        $stmt->bindParam("content", $url->content);
        $stmt->bindParam("term", $url->term);
        $stmt->bindParam("gpsExtension", $url->gpsExtension);
        $stmt->bindParam("url_id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($url);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function deleteMedium($id) {
    $sql = "DELETE FROM medium WHERE medium_id=:id";
    try {
        $db = new \UCT\Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getSources() {
    $sql = "SELECT * FROM source ORDER BY source_id DESC";
    try {
        $db = new \UCT\Database();
        $stmt = $db->query($sql);
        $urls = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"sources": ' . json_encode($urls) . '}';
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getSource($id) {
    $sql = "SELECT * FROM source WHERE url_id=:id";
    try {
        $db = new \UCT\Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $urls = $stmt->fetchObject();
        $db = null;
        echo json_encode($urls);
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function addSource() {
    $request = Slim::getInstance()->request();
    $url = json_decode($request->getBody());
    $sql = "INSERT INTO source (creator, createDate, version, baseUrl, fk_campaignID, fk_mediumID, fk_channelID, content, term, gpsExtension) VA//LUES (:creator, :createDate, :version, :baseUrl, :fk_campaignID, :fk_mediumID, :fk_channelID, :content, :term, :gpsExtension)";
    try {
        $db = new \UCT\Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("creator", $url->creator);
        $stmt->bindParam("createDate", $url->createDate);
        $stmt->bindParam("version", $url->version);
        $stmt->bindParam("baseUrl", $url->baseUrl);
        $stmt->bindParam("fk_campaignID", $url->fk_campaignID);
        $stmt->bindParam("fk_mediumID", $url->fk_mediumID);
        $stmt->bindParam("fk_channelID", $url->fk_channelID);
        $stmt->bindParam("content", $url->content);
        $stmt->bindParam("term", $url->term);
        $stmt->bindParam("gpsExtension", $url->gpsExtension);
        $stmt->execute();
        $url->id = $db->lastInsertId();
        $db = null;
        echo json_encode($url);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function updateSource($id) {
    $request = Slim::getInstance()->request();
    $url = json_decode($request->getBody());
    //$sql = "INSERT INTO url (creator, createDate, version, baseUrl, fk_campaignID, fk_mediumID, fk_channelID, content, term, gpsExtension) VALUES (:creator, :createDate, :version, :baseUrl, :fk_campaignID, :fk_mediumID, :fk_channelID, :content, :term, :gpsExtension)";
    $sql = "UPDATE source SET name=:name, grapes=:grapes, country=:country, region=:region, year=:year, description=:description WHERE url_id=:url_id";
    try {
        $db = new \UCT\Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("creator", $url->creator);
        $stmt->bindParam("createDate", $url->createDate);
        $stmt->bindParam("version", $url->version);
        $stmt->bindParam("baseUrl", $url->baseUrl);
        $stmt->bindParam("fk_campaignID", $url->fk_campaignID);
        $stmt->bindParam("fk_mediumID", $url->fk_mediumID);
        $stmt->bindParam("fk_channelID", $url->fk_channelID);
        $stmt->bindParam("content", $url->content);
        $stmt->bindParam("term", $url->term);
        $stmt->bindParam("gpsExtension", $url->gpsExtension);
        $stmt->bindParam("url_id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($url);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function deleteSource($id) {
    $sql = "DELETE FROM source WHERE source_id=:id";
    try {
        $db = new \UCT\Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getCampaigns() {
    $sql = "SELECT * FROM campaign ORDER BY campaign_id DESC";
    try {
        $db = new \UCT\Database();
        $stmt = $db->query($sql);
        $urls = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"campaigns": ' . json_encode($urls) . '}';
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getCampaign($id) {
    $sql = "SELECT * FROM campaign WHERE campaignID=:id";
    try {
        $db = new \UCT\Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $urls = $stmt->fetchObject();
        $db = null;
        echo json_encode($urls);
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function addCampaign() {
    $request = Slim::getInstance()->request();
    $url = json_decode($request->getBody());
    $sql = "INSERT INTO campaign (creator, createDate, version, baseUrl, fk_campaignID, fk_mediumID, fk_channelID, content, term, gpsExtension) VA//LUES (:creator, :createDate, :version, :baseUrl, :fk_campaignID, :fk_mediumID, :fk_channelID, :content, :term, :gpsExtension)";
    try {
        $db = new \UCT\Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("creator", $url->creator);
        $stmt->bindParam("createDate", $url->createDate);
        $stmt->bindParam("version", $url->version);
        $stmt->bindParam("baseUrl", $url->baseUrl);
        $stmt->bindParam("fk_campaignID", $url->fk_campaignID);
        $stmt->bindParam("fk_mediumID", $url->fk_mediumID);
        $stmt->bindParam("fk_channelID", $url->fk_channelID);
        $stmt->bindParam("content", $url->content);
        $stmt->bindParam("term", $url->term);
        $stmt->bindParam("gpsExtension", $url->gpsExtension);
        $stmt->execute();
        $url->id = $db->lastInsertId();
        $db = null;
        echo json_encode($url);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function updateCampaign($id) {
    $request = Slim::getInstance()->request();
    $url = json_decode($request->getBody());
    //$sql = "INSERT INTO url (creator, createDate, version, baseUrl, fk_campaignID, fk_mediumID, fk_channelID, content, term, gpsExtension) VALUES (:creator, :createDate, :version, :baseUrl, :fk_campaignID, :fk_mediumID, :fk_channelID, :content, :term, :gpsExtension)";
    $sql = "UPDATE campaign SET name=:name, grapes=:grapes, country=:country, region=:region, year=:year, description=:description WHERE url_id=:url_id";
    try {
        $db = new \UCT\Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("creator", $url->creator);
        $stmt->bindParam("createDate", $url->createDate);
        $stmt->bindParam("version", $url->version);
        $stmt->bindParam("baseUrl", $url->baseUrl);
        $stmt->bindParam("fk_campaignID", $url->fk_campaignID);
        $stmt->bindParam("fk_mediumID", $url->fk_mediumID);
        $stmt->bindParam("fk_channelID", $url->fk_channelID);
        $stmt->bindParam("content", $url->content);
        $stmt->bindParam("term", $url->term);
        $stmt->bindParam("gpsExtension", $url->gpsExtension);
        $stmt->bindParam("url_id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($url);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function deleteCampaign($id) {
    $sql = "DELETE FROM campaign WHERE campaignID=:id";
    try {
        $db = new \UCT\Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/*******/

function getTerms() {
    $sql = "SELECT * FROM term ORDER BY term_id DESC";
    try {
        $db = new \UCT\Database();
        $stmt = $db->query($sql);
        $urls = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"terms": ' . json_encode($urls) . '}';
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getTerm($id) {
    // no code
}

function addTerm() {
    // no code
}

function updateTerm($id) {
    // no code
}

function deleteTerm($id) {
    // no code
}

function getContents() {
    $sql = "SELECT * FROM content ORDER BY content_id DESC";
    try {
        $db = new \UCT\Database();
        $stmt = $db->query($sql);
        $urls = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"contents": ' . json_encode($urls) . '}';
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getContent($id) {
    // no code
}

function addContent() {
    // no code
}

function updateContent($id) {
    // no code
}

function deleteContent($id) {
    // no code
}

function getGpsSources() {
    $sql = "SELECT * FROM gps_source ORDER BY gps_source_id DESC";
    try {
        $db = new \UCT\Database();
        $stmt = $db->query($sql);
        $urls = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"gpsSources": ' . json_encode($urls) . '}';
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getGpsSource($id) {
    // no code
}

function addGpsSource() {
    // no code
}

function updateGpsSource($id) {
    // no code
}

function deleteGpsSource($id) {
    // no code
}

function getBaseUrls() {
    $sql = "SELECT * FROM base_url ORDER BY base_url_id DESC";
    try {
        $db = new \UCT\Database();
        $stmt = $db->query($sql);
        $urls = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"baseUrls": ' . json_encode($urls) . '}';
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getBaseUrl($id) {
    // no code
}

function addBaseUrl() {
    // no code
}

function updateBaseUrl($id) {
    // no code
}

function deleteBaseUrl($id) {
    // no code
}