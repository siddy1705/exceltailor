<?php

require_once './config/config.php';

$db = getDbInstance();

$data['full_name'] = 'na';
$data['user_name'] = 'nayy';
$data['password'] = 'na';
$data['type'] = 'sid';

$last_id = $db->insert ('et_users', $data);
    if($last_id) {
      echo "success"; die;
    }