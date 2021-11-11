<?php

function seprateWords($str) {
    return preg_split(
        '/(^[^A-Z]+|[A-Z][^A-Z]+)/',
        $str,
        -1, /* no limit for replacement count */
        PREG_SPLIT_NO_EMPTY /*don't return empty elements*/
            | PREG_SPLIT_DELIM_CAPTURE /*don't strip anything from output array*/
    );
}