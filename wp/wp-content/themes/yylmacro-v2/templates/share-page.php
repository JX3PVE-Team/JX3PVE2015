<?php
/**
 * Template Name: == 新版发宏 ==
 * @www.shadowsky.cn
 */

get_header(); ?>
<div id="main" class="share-main">

<!--头部-->
<div id="share-top" class="share">
<div id="share-top-content">
<div id="share-logo">YYLMACRO</div>
<div id="share-info"><a href="http://www.yylmacro.com/member.php?mod=register" title="注册">REGISTER</a> | <a href="http://www.yylmacro.com/wp-login.php" title="登录">LOGIN</a> ››</div>
<div id="share-sub"><a href="<?php bloginfo('url'); ?>/wp-admin/post-new.php" title="立刻发布你的超级宏！"> </a></div>
<div id="share-ac"><p>不论你是初学者，还是使用者，或是高玩，都欢迎你把自己的原创作品，<br />
或是修改自他人作品自用的作品和大家分享(注明来源)，共同进步。<br />
——我们相信，在互联网上，开源与开放才是终极奥义！<br />
每一个优秀的作品在官网 “觅宏” 都有它专属的页面，不用再到处各种论坛找宏<br />
将自己的宏发布到固定的页面，去网吧时不用再东寻西觅<br />
云端宏，随时知道作者宏的更新动态！一键更新！</p></div>
</div>
</div>
<!--示例-->
<div id="share-center"></div>
<!--手册-->
<div id="share-doc">
<div id="share-doc-content">

<div id="share-doc-button"><span id="share-text-doc">DOC</span><br /><span id="share-text-sub">发布手册</span></div>

<div id="share-doc-table">
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'content', 'page' ); ?>
<?php endwhile; // end of the loop. ?>
</div>
<div class="clear"></div>

</div>
</div>

</div>
<?php get_footer(); ?>