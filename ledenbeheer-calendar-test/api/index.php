<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json; charset=utf-8');

$events = json_decode(file_get_contents(__DIR__ . '/events.json'), true);
$uri = parse_url($_SERVER['REQUEST_URI']);

$routes = [
    '/calendar/events/[0-9]' => 'getCalendarEvent',
    '/calendar/events' => 'getCalendarEvents'
];

function pageNotFound () {
    http_response_code(404);
}

function getCalendarEvents() {
    global $events;

    exit(json_encode(array_map(function($event) {
        unset($event['description']);
        return $event;
    }, $events)));
}

function getCalendarEvent($uri) {
    global $events;

    $uri = explode('/', $uri);

    $id = array_pop($uri);
    
    foreach ($events as $event) {
        if ((int) $event['id'] === (int) $id) {
            exit(json_encode($event));
        }
    }

    return pageNotFound();
}

foreach ($routes as $route => $fn) {
    $r = str_replace('/', '\/', $route);
    if (preg_match('#' . $r . '#', $uri['path']) && is_callable($fn)) return call_user_func($fn, $uri['path']);
}

pageNotFound();