<?php

    if (! function_exists('site_url'))
    {

        function site_url($name = '')
        {

            if (!is_null($name)) return SITE_URL;
            else return SITE_URL . $name;

        }

    }

?>