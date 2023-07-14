<?php
function totalAccounts()
{
    require 'assets/config.php';
    $stmt = $DB->prepare("SELECT * FROM account");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->num_rows;
    } else {
        return 0;
    }
}


function totalOnline()
{
    require 'assets/config.php';
    $stmt = $DB->prepare("SELECT * FROM account WHERE online = 1");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->num_rows;
    } else {
        return 0;
    }
}


function totalBan()
{
    require 'assets/config.php';
    $stmt = $DB->prepare("SELECT * FROM account_banned WHERE active = 1");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->num_rows;
    } else {
        return 0;
    }
}

function uptime()
{
    require 'assets/config.php';
    $stmt = $DB->prepare("SELECT starttime, maxplayers FROM uptime WHERE realmid = '1' ORDER BY starttime DESC LIMIT 1");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $uptimetime = time() - $row['starttime'];
        $uptime =  format_uptime($uptimetime);
        return $uptime;
    } else {
        return 0;
    }
}

function format_uptime($seconds) {
      $secs  = intval($seconds % 60);
      $mins  = intval($seconds / 60 % 60);
      $hours = intval($seconds / 3600 % 24);
      $days  = intval($seconds / 86400);

      $uptimeString='';

      if ($days) {
         $uptimeString .= $days;
         $uptimeString .= ((1 === $days) ? ' Tag' : ' Tage');
      }
      if ($hours) {
         $uptimeString .= ((0 < $days) ? ', ' : '').$hours;
         $uptimeString .= ((1 === $hours) ? ' Std' : ' Std');
      }
      if ($mins) {
         $uptimeString .= ((0 < $days || 0 < $hours) ? ', ' : '').$mins;
         $uptimeString .= ((1 === $mins) ? ' min' : ' min');
      }
      if ($secs) {
         $uptimeString .= ((0 < $days || 0 < $hours || 0 < $mins) ? ', ' : '').$secs;
         $uptimeString .= ((1 === $secs) ? ' s' : ' s');
      }
      return $uptimeString;
}
?>
