<?php
	require_once 'config/session.php';
	require_once 'config/datacon.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title> main </title>
	<script type="text/javascript" src="javascript/jquery.js"></script>
	<script type="text/javascript" src="javascript/slide.js"></script>
	<script type="text/javascript" src="javascript/index.js"></script>
	<script type="text/javascript" src="javascript/mosaic/js/mosaic.1.0.1.js"></script>
	<link rel="stylesheet" href="javascript/mosaic/css/mosaic.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="index.css" type="text/css" media="screen" />
	<script type="text/javascript">  
		jQuery(function($){
			
			$('.fade').mosaic({
				opacity		:	0.5
			});
	    
	    });
	    
	    function banner(id){
	    	$("#community_id").val(id);
	    	$("#bannerform").submit()
	    }
	</script>
			
	<style type="text/css">
		.details{ margin:15px 20px; }	
			h4{ font:300 16px 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height:160%; letter-spacing:0.15em; color:#fff; text-shadow:1px 1px 0 rgb(0,0,0); }
			p{ font:300 12px 'Lucida Grande', Tahoma, Verdana, sans-serif; color:#aaa; text-shadow:1px 1px 0 rgb(0,0,0);}
			a{ text-decoration:none; }
		
		/* Popup Layer */
		.layer {display:none; position:absolute;  top:0; left:0; width:100%; height:100%; z-index:10000;}
		.mosaic-block .bg {display:none; position:absolute; top:0; left:0; width:100%; height:100%; background:#000;  -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)"; filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=50); opacity:.5; }
		.layer_area {display:none; position:absolute; left:0; top:0; background:#000; padding:5px; border:4px solid #ddd; z-index:10000;}
		.layer_area img {width:300px; height:187px;}
	</style>
</head>
<body onload="">
<div class="layer_area" id="layer1"><a><img src="javascript/mosaic/img/progress.gif"><br/><h4></h4><p></p></a></div>
<?php	require_once("header/header.php");?>
<div id="wrapContent">
	<div id="adSlider">
		<div id="slideHolder">
			<div id="slideRunner">
				<a href=""><img id="slide-img-1" src="images/nature-photo.png" class="slide" alt="" /></a>
				<a href=""><img id="slide-img-2" src="images/nature-photo1.png" class="slide" alt="" /></a>
				<a href=""><img id="slide-img-3" src="images/nature-photo2.png" class="slide" alt="" /></a>
				<a href=""><img id="slide-img-4" src="images/nature-photo3.png" class="slide" alt="" /></a>
				<a href=""><img id="slide-img-5" src="images/nature-photo4.png" class="slide" alt="" /></a>
				<div id="slideControls">
					<p id="slide-client" class="text"><strong>post: </strong><span></span></p>
					<p id="slide-desc" class="text"></p>
					<p id="slide-nav"></p>
				</div>
			</div>
			<script type="text/javascript">
				if(!window.slider) 
					var slider={};
				slider.data=[{"id":"slide-img-1","client":"nature beauty","desc":"nature beauty photography"},
							{"id":"slide-img-2","client":"nature beauty","desc":"add your description here"},
							{"id":"slide-img-3","client":"nature beauty","desc":"add your description here"},
							{"id":"slide-img-4","client":"nature beauty","desc":"add your description here"},
							{"id":"slide-img-5","client":"nature beauty","desc":"add your description here"}];
			</script>
		</div>
	</div>
	<aside id="banner">
		<?php
			$query = "select community_id, community_Name, bannerPicture from Community where bannerPicture !=''";
			$result = mysql_query($query);
			$rownum = mysql_num_rows($result);
			for($i=0 ;$i<$rownum;$i++){
				$rowdata = mysql_fetch_row($result);
				echo "";
				echo "<a href='javascript:banner(".$rowdata[0].")'><img class='banner_img' src='".$rowdata[2]."' alt='".$rowdata[1]."' title='".$rowdata[1]."'/></a>";
			}
		?>
		<form enctype="multipart/form-data" action="../community/join.php" method="post" id="bannerform">
			<input id="community_id" name="community" type="hidden" value=""/>
		</form>
	</aside>
	<section id="categoryTab">
		<div class="categoryContent category1">문화</div>
		<div class="categoryContent category2">생활</div>
		<div class="categoryContent category3">사회</div>
		<div class="categoryContent category4">학술</div>
		<div class="categoryContent category5">스포츠</div>
		<div class="categoryContent category6">Hot Issue</div>
	</section>
	<section id="category">
		<div class="categoryBtn" id="categoryLeftBtn">
			◀
		</div>
		<div class="categoryBtn" id="categoryRightBtn">
			▶
		</div>
		<article class="cate" id="category1"> <!-- cate1 -->
			<?php
				$query = "select * from Polls where category = 'culture' order by start_date desc";
				$result = mysql_query($query);
				$i = 0;
				while( $poll = mysql_fetch_array($result) ){
					$path = substr($poll['img_path'],8);
					echo '<div class="mosaic-block fade">';
					echo  '<a id="'.$poll['poll_id'].'" href="dosurvey/pollView.php?id='.$poll['poll_id'].'" target="_blank" class="mosaic-overlay">';
					echo 	'<div class="details">';
					echo		'<h4>'.$poll['title'].'</h4>';
					echo		'<p>'.$poll['description'].'</p>';
					echo	'</div>';
					echo  '</a>';
					echo  '<div class="mosaic-backdrop"><img id="abcd" src="'.$path.'"/></div>';
					echo  '<div class="bg"></div>';
					echo '</div>';
					$i++;
					if ( $i == 8 ) break; 
				}
			?>
			<a class="listView" href="dosurvey/pollList.php?cate=culture">View All list</a>
		</article>
		<article class="cate" id="category2"> <!-- cate2 -->
			<?php
				$query = "select * from Polls where category = 'life' order by start_date desc";
				$result = mysql_query($query);
				$i = 0;
				while( $poll = mysql_fetch_array($result) ){
					$path = substr($poll['img_path'],8);
					echo '<div class="mosaic-block fade">';
					echo  '<a id="'.$poll['poll_id'].'" href="dosurvey/pollView.php?id='.$poll['poll_id'].'" target="_blank" class="mosaic-overlay">';
					echo 	'<div class="details">';
					echo		'<h4>'.$poll['title'].'</h4>';
					echo		'<p>'.$poll['description'].'</p>';
					echo	'</div>';
					echo  '</a>';
					echo  '<div class="mosaic-backdrop"><img id="abcd" src="'.$path.'"/></div>';
					echo  '<div class="bg"></div>';
					echo '</div>';
					$i++;
					if ( $i == 8 ) break; 
				}
			?>
			<a class="listView" href="dosurvey/pollList.php?cate=life">View All list</a>
		</article>
		<article class="cate" id="category3"> <!-- cate3 -->
			<?php
				$query = "select * from Polls where category = 'society' order by start_date desc";
				$result = mysql_query($query);
				$i = 0;
				while( $poll = mysql_fetch_array($result) ){
					$path = substr($poll['img_path'],8);
					echo '<div class="mosaic-block fade">';
					echo  '<a id="'.$poll['poll_id'].'" href="dosurvey/pollView.php?id='.$poll['poll_id'].'" target="_blank" class="mosaic-overlay">';
					echo 	'<div class="details">';
					echo		'<h4>'.$poll['title'].'</h4>';
					echo		'<p>'.$poll['description'].'</p>';
					echo	'</div>';
					echo  '</a>';
					echo  '<div class="mosaic-backdrop"><img id="abcd" src="'.$path.'"/></div>';
					echo  '<div class="bg"></div>';
					echo '</div>';
					$i++;
					if ( $i == 8 ) break; 
				}
			?>
			<a class="listView" href="dosurvey/pollList.php?cate=society">View All list</a>
		</article>
		<article class="cate" id="category4"> <!-- cate4 -->
			<?php
				$query = "select * from Polls where category = 'study' order by start_date desc";
				$result = mysql_query($query);
				$i = 0;
				while( $poll = mysql_fetch_array($result) ){
					$path = substr($poll['img_path'],8);
					echo '<div class="mosaic-block fade">';
					echo  '<a id="'.$poll['poll_id'].'" href="dosurvey/pollView.php?id='.$poll['poll_id'].'" target="_blank" class="mosaic-overlay">';
					echo 	'<div class="details">';
					echo		'<h4>'.$poll['title'].'</h4>';
					echo		'<p>'.$poll['description'].'</p>';
					echo	'</div>';
					echo  '</a>';
					echo  '<div class="mosaic-backdrop"><img id="abcd" src="'.$path.'"/></div>';
					echo  '<div class="bg"></div>';
					echo '</div>';
					$i++;
					if ( $i == 8 ) break; 
				}
			?>
			<a class="listView" href="dosurvey/pollList.php?cate=study">View All list</a>
		</article>
		<article class="cate" id="category5"> <!-- cate5 -->
			<?php
				$query = "select * from Polls where category = 'sports' order by start_date desc";
				$result = mysql_query($query);
				$i = 0;
				while( $poll = mysql_fetch_array($result) ){
					$path = substr($poll['img_path'],8);
					echo '<div class="mosaic-block fade">';
					echo  '<a id="'.$poll['poll_id'].'" href="dosurvey/pollView.php?id='.$poll['poll_id'].'" target="_blank" class="mosaic-overlay">';
					echo 	'<div class="details">';
					echo		'<h4>'.$poll['title'].'</h4>';
					echo		'<p>'.$poll['description'].'</p>';
					echo	'</div>';
					echo  '</a>';
					echo  '<div class="mosaic-backdrop"><img id="abcd" src="'.$path.'"/></div>';
					echo  '<div class="bg"></div>';
					echo '</div>';
					$i++;
					if ( $i == 8 ) break; 
				}
			?>
			<a class="listView" href="dosurvey/pollList.php?cate=sports">View All list</a>
		</article>
		<article class="cate" id="category6"> <!-- cate6 -->
			<?php
				$query = "select * from Polls where category = 'hotissue' order by start_date desc";
				$result = mysql_query($query);
				$i = 0;
				while( $poll = mysql_fetch_array($result) ){
					$path = substr($poll['img_path'],8);
					echo '<div class="mosaic-block fade">';
					echo  '<a id="'.$poll['poll_id'].'" href="dosurvey/pollView.php?id='.$poll['poll_id'].'" target="_blank" class="mosaic-overlay">';
					echo 	'<div class="details">';
					echo		'<h4>'.$poll['title'].'</h4>';
					echo		'<p>'.$poll['description'].'</p>';
					echo	'</div>';
					echo  '</a>';
					echo  '<div class="mosaic-backdrop"><img id="abcd" src="'.$path.'"/></div>';
					echo  '<div class="bg"></div>';
					echo '</div>';
					$i++;
					if ( $i == 8 ) break; 
				}
			?>
			<a class="listView" href="dosurvey/pollList.php?cate=hotissue">View All list</a>
		</article>
		<section id="footer">
			<img src="/images/footer.png"/>
		</section>	
	</section>		
</div>	

</body>
</html>