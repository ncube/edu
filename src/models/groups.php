<?php
$u = $GLOBALS['url_array'];
$u = isset($u[2]) ? $u[2]: 'posts';
$base_url = ($u === 'index.php') ? 'index' : $u;
$data['groups_nav_active'][$base_url] = ' active';