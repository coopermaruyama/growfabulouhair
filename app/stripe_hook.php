<?php
/**
 * @author Philip Snyder <philip.r.snyder@gmail.com>
 */


// read in the JSON that was posted to this script
$body = @file_get_contents('php://input');
// if its not empty...
if (!empty($body)) {
    // convert from JSON
    $data = json_decode($body);
    // we only catch and record "charge.succeeded" responses right now.
    if ($data->object == "charge.succeeded") {
        require_once('./lib/Config.php');
        require_once('./lib/Database.php');
        $dbh = Database::getConnection();
        $sth = $dbh->prepare('INSERT INTO stripe_response (order_id, first_name, last_name, email, total, json) '.
                             'VALUES (:order_id, :first_name, :last_name, :email, :total, :json)');
        $params = array(
            ':order_id'   => $data->metadata->order_id,
            ':first_name' => $data->metadata->first_name,
            ':last_name'  => $data->metadata->last_name,
            ':email'      => $data->metadata->email,
            ':total'      => $data->metadata->total,
            ':json'       => $body,
        );
        $rs = $sth->execute($params);
        // if this failed for some reason, let's log the whole thing to our error log for later review
        if (!$rs) {
            error_log('Failed inserting record into stripe_response, body: '.$body);
            error_log('dbh->errorInfo(): '.print_r($dbh->errorInfo(), true));
        }
    } else {
        error_log('stripe_hook did not receive a charge.succeeded response, ignoring');
    }
} else {
    error_log('stripe_hook did not receive any body content');
}


