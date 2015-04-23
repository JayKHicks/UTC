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

$app->get('/api/login', 'login');
// urls
$app->get('/api/urls', 'getUrls');
$app->get('/api/urls/:id', 'getUrl');
$app->post('/api/urls', 'addUrl');
$app->put('/api/urls/:id', 'updateUrl');
$app->delete('/api/urls/:id', 'deleteUrl');
// mediums
$app->get('/api/mediums', 'getMediums');
$app->get('/api/mediums/:id', 'getMedium');
$app->post('/api/mediums', 'addMedium');
$app->put('/api/mediums/:id', 'updateMedium');
$app->delete('/api/mediums/:id', 'deleteMedium');
// sources
$app->get('/api/source', 'getSources');
$app->get('/api/source/:id', 'getSource');
$app->post('/api/source', 'addSource');
$app->put('/api/source/:id', 'updateSource');
$app->delete('/api/source/:id', 'deleteSource');
// campaigns
$app->get('/api/campaign', 'getCampaigns');
$app->get('/api/campaign/:id', 'getCampaign');
$app->post('/api/campaign', 'addCampaign');
$app->put('/api/campaign/:id', 'updateCampaign');
$app->delete('/api/campaign/:id', 'deleteCampaign');
// terms
$app->get('/api/term', 'getTerms');
$app->get('/api/term/:id', 'getTerm');
$app->post('/api/term', 'addTerm');
$app->put('/api/term/:id', 'updateTerm');
$app->delete('/api/term/:id', 'deleteTerm');
// contents
$app->get('/api/content', 'getContents');
$app->get('/api/content/:id', 'getContent');
$app->post('/api/content', 'addContent');
$app->put('/api/content/:id', 'updateContent');
$app->delete('/api/content/:id', 'deleteContent');
// gpssources
$app->get('/api/gpsSource', 'getGpsSources');
$app->get('/api/gpsSource/:id', 'getGpsSource');
$app->post('/api/gpsSource', 'addGpsSource');
$app->put('/api/gpsSource/:id', 'updateGpsSource');
$app->delete('/api/gpsSource/:id', 'deleteGpsSource');
// baseurls
$app->get('/api/baseUrl', 'getBaseUrls');
$app->get('/api/baseUrl/:id', 'getBaseUrl');
$app->post('/api/baseUrl', 'addBaseUrl');
$app->put('/api/baseUrl/:id', 'updateBaseUrl');
$app->delete('/api/baseUrl/:id', 'deleteBaseUrl');

function login() {

}

function getUrls() {
    $sql = "SELECT * FROM url ORDER BY urlID DESC";
    try {
        $db = new \UCT\Database();
        $stmt = $db->query($sql);
        $urls = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"urls": ' . json_encode($urls) . '}';
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getUrl($id) {
    $sql = "SELECT * FROM url WHERE urlID=:id";
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
    $sql = "UPDATE url SET name=:name, grapes=:grapes, country=:country, region=:region, year=:year, description=:description WHERE urlID=:urlID";
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
        $stmt->bindParam("urlID", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($url);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function deleteUrl($id) {
    $sql = "DELETE FROM url WHERE urlID=:id";
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

function getMediums() {
    $sql = "SELECT * FROM url ORDER BY urlID DESC";
    try {
        $db = new \UCT\Database();
        $stmt = $db->query($sql);
        $urls = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"urls": ' . json_encode($urls) . '}';
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getMedium($id) {
    $sql = "SELECT * FROM url WHERE urlID=:id";
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
    $sql = "INSERT INTO url (creator, createDate, version, baseUrl, fk_campaignID, fk_mediumID, fk_channelID, content, term, gpsExtension) VA//LUES (:creator, :createDate, :version, :baseUrl, :fk_campaignID, :fk_mediumID, :fk_channelID, :content, :term, :gpsExtension)";
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
    $sql = "UPDATE url SET name=:name, grapes=:grapes, country=:country, region=:region, year=:year, description=:description WHERE urlID=:urlID";
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
        $stmt->bindParam("urlID", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($url);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function deleteMedium($id) {
    $sql = "DELETE FROM url WHERE urlID=:id";
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

function getChannels() {
    $sql = "SELECT * FROM url ORDER BY urlID DESC";
    try {
        $db = new \UCT\Database();
        $stmt = $db->query($sql);
        $urls = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"urls": ' . json_encode($urls) . '}';
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getChannel($id) {
    $sql = "SELECT * FROM url WHERE urlID=:id";
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

function addChannel() {
    $request = Slim::getInstance()->request();
    $url = json_decode($request->getBody());
    $sql = "INSERT INTO url (creator, createDate, version, baseUrl, fk_campaignID, fk_mediumID, fk_channelID, content, term, gpsExtension) VA//LUES (:creator, :createDate, :version, :baseUrl, :fk_campaignID, :fk_mediumID, :fk_channelID, :content, :term, :gpsExtension)";
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

function updateChannel($id) {
    $request = Slim::getInstance()->request();
    $url = json_decode($request->getBody());
    //$sql = "INSERT INTO url (creator, createDate, version, baseUrl, fk_campaignID, fk_mediumID, fk_channelID, content, term, gpsExtension) VALUES (:creator, :createDate, :version, :baseUrl, :fk_campaignID, :fk_mediumID, :fk_channelID, :content, :term, :gpsExtension)";
    $sql = "UPDATE url SET name=:name, grapes=:grapes, country=:country, region=:region, year=:year, description=:description WHERE urlID=:urlID";
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
        $stmt->bindParam("urlID", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($url);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function deleteChannel($id) {
    $sql = "DELETE FROM url WHERE urlID=:id";
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
    $sql = "SELECT * FROM campaign ORDER BY campaignID DESC";
    try {
        $db = new \UCT\Database();
        $stmt = $db->query($sql);
        $urls = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"urls": ' . json_encode($urls) . '}';
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
    $sql = "UPDATE campaign SET name=:name, grapes=:grapes, country=:country, region=:region, year=:year, description=:description WHERE urlID=:urlID";
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
        $stmt->bindParam("urlID", $id);
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