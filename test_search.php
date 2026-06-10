<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

try {
    $request = \Illuminate\Http\Request::create('/', 'GET');
    $response = $kernel->handle($request);
    echo "Status Code: " . $response->getStatusCode() . "\n";
    if ($response->getStatusCode() !== 200) {
        if ($response->exception) {
            echo "Exception: " . $response->exception->getMessage() . "\n";
            echo "Line: " . $response->exception->getLine() . "\n";
            echo "File: " . $response->exception->getFile() . "\n";
        }
    }
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "File: " . $e->getFile() . "\n";
}
