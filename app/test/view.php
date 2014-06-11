<?php
require_once('../lib/Config.php');
require_once('../lib/Database.php');

$dbh = Database::getConnection();
$sth = $dbh->prepare('SELECT * FROM stripe_response ORDER BY id DESC');
$sth->execute();
$res = $sth->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
  <head>
    <title>Stripe Charge Responses</title>
    <style type="text/css">
* {
  font-size: 14px;
}
tr.even {
  background-color: #c0c0c0;
}
tr.odd {
  background-color: #fff;
}
.stripe-responses {
  border: 1px solid red;
  border-collapse: separate;
  border-spacing: 0 0;
}
.stripe-responses th {
  background-color: #000;
  color: #fff;
  font-size: 17px;
  font-weight: bold;
}
.stripe-responses th,
.stripe-responses td {
  padding: 0.5em;
  margin: 0;
}
.stripe-responses td.json textarea {
  height: 5em;
  width: 30em;
}
    </style>
  </head>
  <body>
    <table class="stripe-responses">
<?php
$idx = 0;
foreach ($res as $r) {
    $idx++;
    if ($idx == 1) {
        echo '<thead>'."\n";
        foreach (array_keys($r) as $key) {
            echo '<th>'.$key.'</th>'."\n";
        }
        echo '</thead>'."\n".
             '<tbody>'."\n";
    }
    echo '<tr class="'.($idx % 2 ? 'even' : 'odd').'">'."\n";
    foreach ($r as $key => $value) {
        if ($key == 'json') {
            echo '<td class="'.$key.'"><textarea>'.$value.'</textarea></td>'."\n";
        } else {
            echo '<td class="'.$key.'">'.$value.'</td>'."\n";
        }
    }
    echo "</tr>\n";
}
?>
      </tbody>
    </table>
  </body>
</html>
