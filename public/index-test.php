<?php
// Test simple - contourne Laravel
echo "<h1>Application Laravel</h1>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Server Time: " . date('Y-m-d H:i:s') . "<br>";
echo "Database Connection: " . (extension_loaded('pdo_mysql') ? 'OK' : 'MISSING') . "<br>";
echo "<a href='/'>Retour à Laravel</a>";
