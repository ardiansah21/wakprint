<?php

$_SESSION['progress'] = 0;

for ($i = 0; $i < 100; $i++) {
    session_start();
    $_SESSION['progress']++;
    session_write_close();
    sleep(1); // This is slowing script purposely!
}
