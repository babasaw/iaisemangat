<?php

if(!function_exists('ci_instance')) {
    function ci_instance() {
        return get_instance();
    }
}

if(!function_exists('getOutput')) {
    function getOutput($response, $header) {
        ci_instance()->output
        ->set_status_header($header)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($response, JSON_PRETTY_PRINT))
        ->_display();
        exit;
    }
    }
