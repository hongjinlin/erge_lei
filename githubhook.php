<?php
$str = file_get_contents('php://input');

// GitHub Webhook Secret.
// Keep it the same with the 'Secret' field on your Webhooks / Manage webhook page of your respostory.
$secret = "A*VS5N6./U*2";

// Headers deliveried from GitHub
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];
if ($signature) {
  $hash = "sha1=" . hash_hmac('sha1', $str, $secret);
  if (strcmp($signature, $hash) === 0) {
      echo shell_exec("cd /data/htdocs/kanjia_dev/ && git pull");
      exit();
  }
}
http_response_code(403);
