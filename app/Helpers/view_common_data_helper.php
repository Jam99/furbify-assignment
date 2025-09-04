<?php

/**
 * Returns common data array
 * @param array $data
 * @return array
 */
function view_common_data($data = []){
    helper("cookie_consent");
    $request = service("request");

    $default = [
        "title"             => "Furbify Assignment",
        "locale"            => $request->getLocale(),
        "path"              => $request->getUri()->getPath(),
        "custom_common_cfg" => config("CustomCommon"),
    ];

    return array_merge($default, $data);
}