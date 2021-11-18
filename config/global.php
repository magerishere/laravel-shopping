<?php

return [
    'isOwnKey' => 'user_id',
    'imagesBasePath' => public_path('storage\\images\\'),
    'stringDefaultLength' => 255,
    'userNameLength' => 20,
    'emailLength' => 40,
    'titleLength' => 60,
    'catNameLength' => 80,
    'imageLength' => 21,
    'imageSize' => 1024, // 1 Mg
    'contentLength' => 5000, // just use for request validate
    'commentLength' => 500,
    'commentReplyLength' => 500,
    'viewsCount' => 0, // default views 
    'orderByColumn' => 'created_at',
    'phoneLength' => 12, // 021 55667788 
];