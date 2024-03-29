<?php

return [
    'isOwnKey' => 'user_id',
    'imagesBasePath' => public_path('storage\\images\\'),
    'imagesFullPath' => 'http://127.0.0.1:8000/storage/images/',
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
    'phoneLength' => 12, // 021-55667788 
    'cityLength' => 40,
    'incorrectLoginCredentials' => 'ایمیل یا رمزعبور اشتباه است',
    // default lengths
    'stringDefaultLength' => 255,
    'integerDefaultLength' => 11,
]; 