<?php

Api::Route('/hello', 'api@hello');

/*
Api::Route('/hello', 'api@hello', function($request) {
    // killer('401');
    return $request;
});
*/