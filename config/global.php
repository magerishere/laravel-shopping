<?php

return [
    'isOwnKey' => 'user_id',
    'imagesBasePath' => public_path('storage\\images\\'),
    'defaultLength' => 255,
    'userNameLength' => 20,
    'emailLength' => 40,
    'titleLength' => 60,
    'catNameLength' => 60,
    'imageLength' => 21,
    'imageSize' => 1024, // 1 Mg
    'contentLength' => 2000, // just use for request validate
    'commentLength' => 500,
    'commentReplyLength' => 500,
    'viewsCount' => 0, // default views 
    'orderByColumn' => 'created_at'
];