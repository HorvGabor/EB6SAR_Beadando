<?php 
function getConnection() {
	$connection = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME.';',DB_USER, DB_PASS);
	$connection->exec("SET NAMES '".DB_CHARSET."'");
	return $connection;
}

function db_connect() {
	$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	return $con;
}

function getRecord($queryString, $queryParams = []) {
	$connection = getConnection();
	$statement = $connection->prepare($queryString);
	$success = $statement->execute($queryParams);
	$result = $success ? $statement->fetch(PDO::FETCH_ASSOC) : [];
	$statement->closeCursor();
	$connection = null;
	return $result;
}

function getList($queryString, $queryParams = []) {
	$connection = getConnection();
	$statement = $connection->prepare($queryString);
	$success = $statement->execute($queryParams);
	$result = $success ? $statement->fetchAll(PDO::FETCH_ASSOC) : [];
	$statement->closeCursor();
	$connection = null;
	return $result;
}

function executeDML($queryString, $queryParams = []) {
	$connection = getConnection();
	$statement = $connection->prepare($queryString);
	$success = $statement->execute($queryParams);
	$statement->closeCursor();
	$connection = null;
	return $success;
}

function getField($queryString, $queryParams = []) {
	$connection = getConnection();
	$statement = $connection->prepare($queryString);
	$success = $statement->execute($queryParams);
	$result = $success ? $statement->fetch()[0]: [];
	$statement->closeCursor();
	$connection = null;
	return $result;
}

function url($page = 'home', $params = []) {
    $url = DOMAIN . "?P={$page}";
    if (is_array($params)) {
        foreach ($params as $key => $value) {
            $url .= "&$key=$value";
        }
    }
    return $url;
}

function get_game_by_id($id)
{
    global $db;

    $sql = $db->prepare("SELECT * FROM games WHERE id = ?");
    $sql->bind_param('i', $id);
    $sql->execute();

    $result = $sql->get_result();
    $sql->close();

    if ($result->num_rows != 1) {
        return null;
    }

    return $result->fetch_assoc();
}

function asset($asset) {
    return DOMAIN . $asset;
}
?>