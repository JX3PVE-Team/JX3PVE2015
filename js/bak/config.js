require.config({
    baseUrl: 'http://www.jx3pve.com/js/',
    paths: {
        'jquery': ['http://libs.baidu.com/jquery/1.10.2/jquery.min','lib/jquery-1-10-2']
    }
});

define('jquery-private', ['jquery'], function (jq) {
    return jq.noConflict( true );
});