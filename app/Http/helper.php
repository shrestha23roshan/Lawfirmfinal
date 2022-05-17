<?php
/**
 * Determine if specified path is active path
 */
if(!function_exists('classActivePath')) {
    function classActivePath($path)
    {
        $parts = explode('/', \Request::path());
        if($parts[0] == $path || \Request::is($path)) {
            return 'class="active"';
        }

        return '';
    }
}