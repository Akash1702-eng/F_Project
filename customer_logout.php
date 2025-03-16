<?php
// Delete all cookies
if (isset($_SERVER['HTTP_COOKIE'])) 
{
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach ($cookies as $cookie) 
    {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time() - 3600, '/'); 
        setcookie($name, '', time() - 3600, '/', '', false, true); 
    }
}

// Redirect to another page
header("Location: index.php"); 
exit;
?>