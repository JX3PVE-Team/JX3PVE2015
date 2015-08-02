<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 * 文章内容
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

?>
<div class="box yylmacro">
	<div class="main">
		<!-- 居中内容wrap -->
		<div class="wp">

			<!-- 内容区 -->
				<div class="primary">
					<!--#文章头部-->
					<div class="yyl-header">
					
			            <!--宏LOGO-->
			            <div class="yyl-logo">
							<img src="http://static.jx3pve.com/icon/<?php the_field('yylmacro_yourslogo'); ?>.jpg" width="48px" height="48px" alt="<?php the_author(); ?>の宏" />		
						</div>
			         	
			         	<!-- 标题 -->
						<?php if ( is_single() ) : ?>
							<div class="yyl-title"><?php the_title(); ?></div>
						<?php else : ?>
							<div class="yyl-title">
								<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
							</div>
						<?php endif; // is_single() ?>

						<!-- 标签 -->
			            <div class="yyl-meta">

				            <!--云端ID-->
				            <span class="meta-cloudid">
				            	<span class="meta-label">云端ID</span>
				            	<span class="cloudid" id="cloudid"><?php the_ID(); ?></span>
				            </span>
							
							 <!--更新日期-->
							<span class="meta-author">作&nbsp;&nbsp;者</span><?php the_author_posts_link(); ?>
							
				            <!--更新日期-->
							<span class="meta-update">最近更新</span><?php the_modified_time('Ymd'); ?>

							<!--插件版本支持-->
							<span class="meta-version">代码类型</span><?php the_field('yylmacro_yylversion'); ?>
					
							<!--本周云端下载-->
							<span class="meta-users">本周热度</span><span id="ajaxuse">loading...</span>
							
							<!--作者专栏-->
							<span class="meta-space"><a href="<?php the_field('authorsky'); ?>" target="_blank">作者专栏</a></span>

							<!--分享传播-->
								<div class="bdsharebuttonbox" id="bdshare" >
								<a href="#" class="bds_more" data-cmd="more"></a>
								<a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
								<a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
								</div>
								<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
								
						</div>
					</div>

					<!--#文章内容 -->
					<div class="yyl-content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<!--#文章内容-->
						<div class="entry-content">
							
							<!-- BANNER1 -->
				            <div class="banner macrobar-1 macrobar">
				            	<script type="text/javascript" src="http://www.jx3pve.com/api.php?mod=js&bid=988"></script>
				            </div>
							
				            <!--重要说明-->
				            <div class="yyl-yoursac">
				            	<div class="yyl-editor">
					            	<?php edit_post_link(
										__( '修改此宏' ), '<span class="edit-link">', '
										| <a href="http://www.jx3pve.com/wp-admin/post-new.php" target="_blank" title="发布新宏">发布新宏</a> 
										| <a href="http://www.jx3pve.com/wp-admin/edit.php" target="_blank" title="我的作品">我的作品</a> 
										| <a href="http://www.jx3pve.com/home.php?mod=spacecp&ac=profile&op=password" target="_blank" title="">修改密码</a> 
										| <a href="http://www.jx3pve.com/home.php?mod=spacecp&ac=jx3" target="_blank" title="个人中心">个人中心</a>
										| <a href="http://www.jx3pve.com/home.php?mod=spacecp&ac=plugin&id=cloudid:cloudid" target="_blank" title="云端ID修改申请">云端ID修改</a>
										| <a href="http://www.jx3pve.com/forum.php?mod=group&action=create" class="redtips" target="_blank" title="创建作者专栏">创建专栏</a>
										</span>
										'
										);?>
								</div>
								<?php the_field('yylmacro_yoursac'); ?>
							</div>

				            <div class="yyl-content-before dashblock" id="yyl-content-before">
								<!--推荐奇穴-->
								<div id="yyl-qixue">
									<h1 class="yyl_tit"><span>奇穴点法</span><a href="###" class="yyl_close_js">- 收起</a></h1>
									<div class="yyl_view"><?php the_field('yylmacro_yoursqixue'); ?></div>
								</div>

								<!--秘籍搭配-->
								<div id="yyl-miji">
									<h1 class="yyl_tit"><span>秘籍搭配</span><a href="###" class="yyl_close_js">- 收起</a></h1>
									<div class="yyl_view"><?php the_field('yylmacro_yoursmiji'); ?></div>
								</div>

								<!--急速阈值-->
								<div id="yyl-jisu">
									<h1 class="yyl_tit"><span>急速阈值</span><a href="###" class="yyl_close_js">- 收起</a></h1>
									<div class="yyl_view"><?php the_field('yylmacro_yoursjisu'); ?></div>
								</div>
				            </div>

							<!-- BANNER2 -->
					        <div class="banner macrobar-2 macrobar">
								<script type="text/javascript" src="http://www.jx3pve.com/api.php?mod=js&bid=989"></script>
							</div>
							
							<!-- 复制按钮 -->
							<div id="yyl-content-title">
								<span>&lt;一定要点这复制宏代码&gt;</span>
							</div>

							<!-- 宏内容 -->
							<div id="yyl_content_ajax" style="display:none;"></div>
							<div id="yyl-content-center">
								<ol><li>载入中 loading ...</li></ol>			
				            </div>
							<div style="display:none;" id="code"></div>

							<!-- BANNER3 -->
							<div class="banner macrobar-3 macrobar">
								<script type="text/javascript" src="http://www.jx3pve.com/api.php?mod=js&bid=990"></script>
							</div>

						</div>
						
						<!--#补充资料-->	
						<div class="entry-meta yyl-content-after dashblock" id="yyl-content-after">

							<!--配装建议-->
							<div id="yyl-peizhuang">
								<h1 class="yyl_tit"><span>配装建议</span><a href="###" class="yyl_close_js">- 收起</a></h1>
								<div class="yyl_view"><?php the_field('yylmacro_peizhuang'); ?></div>
							</div>
	
							<!--定制补丁-->
							<div id="yyl-buding">
								<h1 class="yyl_tit"><span>定制补丁</span><a href="###" class="yyl_close_js">- 收起</a></h1>
								<div class="yyl_view"><?php the_field('yylmacro_addinfo'); ?></div>
							</div>

							<!--辅助插件-->
							<div id="yyl-addons">
								<h1 class="yyl_tit"><span>辅助插件</span><a href="###" class="yyl_close_js">- 收起</a></h1>
								<div class="yyl_view"><?php the_field('yylmacro_addons'); ?></div>
							</div>

							<!--更新日志-->
							<div id="yyl-logs">
								<h1 class="yyl_tit"><span>更新日志</span><a href="###" class="yyl_close_js">- 收起</a></h1>
								<div class="yyl_view"><?php the_field('yylmacro_addlogs'); ?></div>
							</div>

							<!--历史版本-->
							<div id="yyl-oldversions">
								<h1 class="yyl_tit"><span>历史版本</span><a href="###" class="yyl_close_js">- 收起</a></h1>
								<div class="yyl_view"><?php the_field('yylmacro_youroldversion'); ?></div>
							</div>

						</div>

						<!--#其他杂项-->
			            <div class="entry-misc dashblock">

							<div class="misc-meta">
								<!--所属分类-->
								分类：<?php the_category((' '), '、'); ?><br />

								<!--宏标签-->	
								标签：<?php the_tags((' '), '、'); ?><br />

								<!--云端标识-->
								标识：<?php the_permalink(); ?>
							</div>

							<!--其他作品-->
							<div class="misc-otherposts">
								<span><?php the_author_posts_link(); ?>的全部作品：</span><br />
								<?php   
									global $wpdb;     
									$author_id = get_post($id)->post_author;   
									$sql =  "SELECT * FROM $wpdb->posts WHERE post_status IN ('publish','static') AND post_author = '$author_id' AND post_type ='post'LIMIT 8" ; //查询作者文章数量   
									$posts= $wpdb->get_results($sql);   
										foreach ($posts as $post) {   
									echo'<li><a href="';the_permalink();echo '" rel="twipsy" title="';the_title();echo '">'. mb_strimwidth(get_the_title(), 0,80,"...").'</a></li>';   
									}   
									?>  
							</div>

			            </div>

					</div>

					<!-- #文章评论 -->
					<div class="yyl-comment">
						<div class="banner macrobar-3 macrobar">
							<script type="text/javascript" src="http://www.jx3pve.com/api.php?mod=js&bid=990"></script>
						</div>

						<div class="content">
							<script type="text/javascript">
								(function(){
								var url = "http://widget.weibo.com/distribution/comments.php?width=auto&url=auto&border=1&fontsize=12&skin=2&appkey=2467237468&iframskin=2&dpc=1";
								url = url.replace("url=auto", "url=" + document.URL); 
								document.write('<iframe id="WBCommentFrame" src="' + url + '" scrolling="no" frameborder="0" style="auto"></iframe>');
								})();
								</script>
								<script src="http://tjs.sjs.sinajs.cn/open/widget/js/widget/comment.js" type="text/javascript" charset="utf-8"></script>
								<script type="text/javascript">
								window.WBComment.init({
								    "id": "WBCommentFrame"
								});
							</script>
						</div>
					</div>
				</div>

			<!-- 侧边区 -->
				<div class="sidebar">
					<div class="section">
						<script type="text/javascript" src="http://www.jx3pve.com/api.php?mod=js&bid=815"></script>
					</div>
					
					<div class="section">
						<script type="text/javascript" src="http://www.jx3pve.com/api.php?mod=js&bid=816"></script>
					</div>

					<div class="section">
						<script type="text/javascript" src="http://www.jx3pve.com/api.php?mod=js&bid=817"></script>
					</div>
				</div>

		</div><!-- wp -->
	</div><!-- main -->
</div><!-- #box -->
<?php get_footer(); ?>	
		
		