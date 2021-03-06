@extends('app')

@section('title')
<title>寻觅's 博客|博客首页|web开发|PHP开发|golang</title>
@stop

@section('content')
<style>
.content-wrap { background: rgba(217, 238, 214, 0.78);}
.navbar{ margin-bottom:0;}
/* 鼠标选中颜色 */
::-moz-selection{background:#cc8e9b; color:#FCF;}
::selection {background: #cc8e9b; color:#FCF;}
.content-wrap .main-content article,.content-wrap .main-content .little-label{ background:#fff;border:1px solid #ccc; margin-top:20px; padding:10px; border-radius:10px; opacity:0.7; } 
.content-wrap .main-content article .post-content{ margin:10px auto; }
.content-wrap .main-content article .post-permalink{ margin-bottom:10px; }
/* 返回顶部 */
#back-to-top{ position: fixed;z-index: 99; left: 50%; bottom: 60px; width: 40px; height: 48px;border-radius:5px; margin-left: 510px;margin-right:30px;background:url(//icon.zol-img.com.cn/mainpage/20150210/index-icon-20150505.png)no-repeat;background-position:50% -386px;background-color:#fafafa;text-indent:-9999em;font:0/0 arial;overflow:hidden;}
#back-to-top:hover{ background-color:#6393E2; }
</style>
<script>
	//  1. Sidebar Position
	var sidebar_left = false; // Set true or flase for positioning sidebar on left

	//  2. Recent Post count
	var recent_post_count = 3;
</script>

<script>
	var _hmt = _hmt || [];
</script>
<style type="text/css">
	.container  .post-content pre code .hljs-variable{
		color:#f92672;
	}
	.container .post-content pre{
		font-size:12px;
		background:#f7f7f7;
	}
</style>
	<!-- start navigation -->
@include('articles.nav')


<!-- end navigation -->
	<!-- start site's main content area -->
	<section class="content-wrap">
		<div class="container">
			<div class="row">
				<main class="col-md-8 main-content">
					@foreach($articles['data'] as $row)
						<article id=52 class="post tag-laravel-5-1 tag-artisan">
                        	<div class="post-head">
                        		<h1 class="post-title">
                        			<a href="{{url('articles',$row['id'])}}">{{$row['title']}}</a>
                        		</h1>
                        		<div class="post-meta">
                        			<span class="author">作者：<a href="//weibo.com/u/1889337694">suhy</a></span>
                        			&bull;
                        			<time class="post-date" datetime="{{ $row['publish_date'] }}"
                        				title="{{ $row['publish_date'] }}">{{ $row['publish_date'] }}</time>
									@foreach($row['tagInfo'] as $tag)
									    <a href="/articles/tag/{{$tag['id']}}" class="label label-info">{{$tag['tag_name']}}</a>
									@endforeach
                        		</div>
                        	</div>
                        	<div class="post-content">
                        		{!! mb_substr(strip_tags($row['content']['content']),0,200,'utf-8') !!}
                        	</div>
                        	<div class="post-permalink">
                        		<a href="{{url('articles',$row['id'])}}" class="btn btn-default">阅读全文</a>
								@if(\Auth::user())
									<a href="{{url('articles/edit', ['id'=>$row['id']])}}" class="btn btn-info">编辑</a>
								@endif

							</div>
                        	<footer class="post-footer clearfix">
                        		<div class="pull-left tag-list">
                        			 <span class='glyphicon glyphicon-eye-open' style="padding-left:10px;"><span style="padding-left:3px;">共有{{ $row['pv']  }}人浏览</span></span>
                        		</div>
                        		<div class="pull-right share"></div>
                        	</footer>
                        </article>
					@endforeach

					<nav class="pagination" role="navigation">
                        <ul class="pagination">
                            {!! $articles['pageHtml'] !!}
                        </ul>
					</nav>

				</main>

				<aside class="col-md-4 sidebar">
	<!-- start widget -->
	<!-- end widget -->

	<!-- start tag cloud widget -->
	<div class="widget">
		<h4 class="title">最近文章</h4>
		<ul style="list-style:none;padding:0px;font-size:14px;">
			@if($latestArticles)
				@foreach($latestArticles as $k=>$article)
					<li><a href="/articles/{{$article->id}}" class="list-group-item" style="border:none;">{{$article->title}}</a></li>
				@endforeach
			@endif
		</ul>
	</div>
	<!-- end tag cloud widget -->

	<!-- start tag cloud widget -->
		<div class="widget little-label">
    		<h4 class="title">标签云</h4>
    		<div class="content tag-cloud">
				@foreach($tags as $k=>$tag)
				<a href="/articles/tag/{{$tag->id}}" class="label label-info">{{$tag->tag_name}}</a>
				@endforeach
    		</div>
    	</div>
		<!--  end tag cloud widget -->

		<div class="widget little-label">
    		<h4 class="title">友情链接</h4>
    		<div class="content tag-cloud">
    			<a href="https://github.com/suhanyujie" class="label label-primary">我的github</a>
				<a href="//blog.52fhy.com/" class="label label-primary">飞鸿影</a>
				<a href="https://github.com/52fhy/" class="label label-primary">飞鸿影的github</a>
				<a href="//www.cnblogs.com/52fhy/" class="label label-primary">飞鸿影的cnblog</a>
				<a href="//www.cnblogs.com/ishenghuo/" class="label label-primary">我的cnblog</a>
				<a href="http://www.ruanwenwu.cn/" class="label label-primary">文武's blog</a>
                <a href="https://blog.sylingd.com" class="label label-primary">泷涯零点</a>
                <a href="http://www.xtgxiso.com/" class="label label-primary">张素杰博客</a>
				<a href="http://yshblog.com/" class="label label-primary">杨仕航的博客</a>
				<a href="http://www.seepre.com/" class="label label-primary">发军的博客</a>
				<a href="https://baijunyao.com/" class="label label-primary">白俊遥博客</a>
				<a href="https://www.0php.net/" class="label label-info">一只贱熊猫的博客</a>
				<a href="http://vonng.com/blog/" class="label label-info">go-[vonng的博客]</a>
				<a href="https://tonybai.com/articles/" class="label label-info">go-[Tony Bai]</a>
				<a href="https://jimmysong.io/" class="label label-info">cloud-[Kubernetes]</a>
				<a href="https://lvtao.net/" class="label label-info">后端-[吕滔博客]</a>
				<a href="https://jiajunhuang.com/" class="label label-info">后端-[Jiajun的编程随想]</a>
				<a href="https://blog.ti-node.com/" class="label label-info">php-[可能是东半球第二程序员]</a>
				<a href="https://toxmc.github.io/swoole-cs.github.io/" class="label label-info">php-[swoole速查表]</a>
				<a href="http://www.blogdaren.com/" class="label label-info">php-[BlogDaren]</a>
				<a href="http://blog.phpzendo.com/" class="label label-info">php-[phpZendo]</a>
				<a href="http://blog.91mylover.top/" class="label label-info">php-[黑-白]</a>
				<a href="http://vipleechen.xyz/" class="label label-info">java-[LeeChen博客]</a>
				<a href="http://www.iocoder.cn/" class="label label-info">[纯源码解析博客]</a>
				<a href="https://colobu.com/archives/" class="label label-info">go-[鸟窝]</a>
				<a href="https://c.isme.pub/" class="label label-info">go-[Casstiel博客]</a>
				<a href="https://draveness.me/" class="label label-info" title="面向信仰编程">go-[Draveness's Blog]</a>
				<a href="http://blog.yurunsoft.com/" class="label label-info">php-[宇润的博客]</a>
				<a href="https://blog.it2048.cn/" class="label label-info">php-[我是大熊]</a>
				<a href="https://www.ctolib.com/" class="label label-info">综合-[码库CTOLib.COM]</a>
				<a href="https://os.phil-opp.com/" class="label label-info">Rust-[Writing an OS in Rust]</a>
				<a href="http://tinylab.org/projects/" class="label label-info">linux-[泰晓科技-官博]</a>
				<a href="http://www.dnsou.com/" class="label label-info">综合-[等你搜-教程搜索]</a>
				<a href="https://blog.csdn.net/wizardforcel" class="label label-info">机器学习-[飞龙csdn博客]</a>
				<a href="http://www.php20.cn/" class="label label-info">PHP-[仙士可博客]</a>
				<a href="https://www.codemore.top/" class="label label-info">综合-[代码拾遗]</a>
				<a href="http://songtianyi.info/" class="label label-info">综合-[songtianyi's blog]</a>
				<a href="https://www.javaboy.org/" class="label label-info">Java-[javaboy's blog]</a>
				<a href="https://huanghantao.github.io" class="label label-info">PHP-[一颗西瓜籽]</a>
				<a href="https://ltoddy.github.io" class="label label-info">后端-[ltoddy-多语言]</a>
    		</div>
    	</div>
		
	<!-- start widget -->
	<div class="widget">
		<h4 class="title">联系我</h4>
		<p style="margin-top:10px;"><span style="color:red;">Email</span> : suhanyujie@qq.com</p>
	</div>
	<!-- end widget -->
</aside>
			</div>
		</div>
	</section>
<!-- 回到顶部 -->
<a href="javascript:void(0);" id="back-to-top" target="_self"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span></a>

<script type="text/javascript">
$(window).scroll(function(){
    var sT=$(this).scrollTop();
    if(sT >= 900) {
        $('#back-to-top').show();
    }
    if(sT < 900){
        $('#back-to-top').hide();
    }
});
$('#back-to-top').click(function(){
	$(window).scrollTop(0);
});

</script>
@stop

@section('footer')
	@include('articles.footer')
@stop
