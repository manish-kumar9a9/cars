<?php

require __DIR__ . '/../vendor/autoload.php';

$password 			= "mykeyisthis";
//$base64Encrypted 	= "AgGXutvFqW9RqQuokYLjehbfM7F+8OO/2sD8g3auA+oNCQFoarRmc59qcKJve7FHyH9MkyJWZ4Cj6CegDU+UbtpXKR0ND6UlfwaZncRUNkw53jy09cgUkHRJI0gCfOsS4rXmRdiaqUt+ukkkaYfAJJk/o3HBvqK/OI4qttyo+kdiLbiAop5QQwWReG2LMQ08v9TAiiOQgFWhd1dc+qFEN7Cv";
//$base64Encrypted 	= "AwEbTYD/hmi86/Hdqk3+Lp846EyQTTQPg9VRHXNxguQ6po1NPjsdbZ5QhGVr5rAo007i/SmRdjTY91Tr5qHAofZ6wfxnkBZPrJtSZ1gazVZ/XNeEwpsC6UCaLPNTh3z+Jb0pW42GFzoA8PgZedCKcabtoaEbOXJv7DT45F/n/jdaraU4AU886oXFWSPy2o/JS+xEIVRz+uNeddZk1+7onkXg";
$base64Encrypted 	= "AwHi5OKTNqt1ohOOFSMw7qKqgHCL/AleLh6irgvUyt8eVmMdjkXCSezh3iG7wlNX7du4Pza/7mD3DCdWbhrmwWk7LAp5bHp8T2+GywFFAIoP9SHblaPI/Gt+d9p/hOckjYwD2Y+dmUGY0AS6bAyPHFKPvyTj1H4ocjpqsdNV+1Qn8stw+6wzDtsf5ZDCSDgAj5tUAI975tn6AlvfUQcTkgB0";
$cryptor 			= new \RNCryptor\Decryptor();
$plaintext 			= $cryptor->decrypt($base64Encrypted, $password);

echo "Base64 Encrypted:\n$base64Encrypted\n\n". PHP_EOL. PHP_EOL;
echo "Plaintext:\n$plaintext\n\n";
