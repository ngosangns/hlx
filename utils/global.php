<?php
function getSubPath($path, $prePath)
{
    // get controller name
    $path = substr($path, strlen($prePath));
    // check empty path
    if (strlen($path) === 0) {
        $path = "/".$path;
    }
    return $path;
}

function getParams($path, $pattern)
{
    $partsPattern = explodePath($pattern);
    $partsPath = explodePath($path);
    $results = [];
    if (count($partsPattern) === count($partsPath)) {
        for ($i = 0; $i < count($partsPattern); $i++) {
            if ($partsPath[$i] !== $partsPattern[$i] && $partsPattern[$i] !== "*") {
                $results = [];
                break;
            }
            if ($partsPattern[$i] === "*") {
                $results[] = $partsPath[$i];
            }
        }
    }
    return $results;
}

function normalizePath(String $path)
{
    $parts = explodePath($path);
    $path = "/" . (count($parts) > 0 ? join("/", $parts) : "");
    return $path;
}

function explodePath(String $path)
{
    $parts = explode("/", $path);
    $results = [];
    foreach ($parts as $part) {
        if (strlen($part) > 0) {
            $results[] = $part;
        }
    }
    return $results;
}

function checkCharacterPath($path)
{
    $results = [];
    preg_match("/[^a-zA-Z0-9\/\_\.\-\@\(\)\%\+\=\,\[\]\{\}\*\$\#\s]/", $path, $result);
    return count($result) ? false : true;
}
