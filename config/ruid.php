<?php

return [
    'prefix' => !env('SKIP_RUID_PREFIX') ? env('RUID_PREFIX', env('APP_ENV')) : '',
];
