<!DOCTYPE html>
<html>
	
	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
		<title>test PAge</title>
		
<!-- 		<script  type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script> -->
		<script  type="text/javascript" src="../bbs/js/test.js"></script>
		<script  type="text/javascript" src="../bbs/js/content.js"></script>
		<script  type="text/javascript" src="../bbs/js/article.js"></script>
		
		<link type="text/css" rel="stylesheet" href="../bbs/style.css"/>
		<link type="text/css" rel="stylesheet" href="../bbs/articles.css"/>
		
		<?php
			require_once('../bbs/db/db_connect.php');
			$startNo=0;
			
			if(isset($_GET['start'])){
				if($_GET['start']<0){
					$startNo = 0;
				}else{
					$startNo = $_GET['start'];
				}	
			}else{
				$startNo = 0;
			}
			
			
			
			$readConNumber=0;
			
			$sql = 'select count(*) from UserWriteToCommunity where depth2=0 and community_id='.$_SESSION['community'];
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			$totalArticle = $row[0]-1;
			
			$isPre = FALSE;
			$isnext = FALSE;
			
			if($totalArticle <5){
				$isPre = FALSE;
				$isNext = FALSE;
			}else{
				$totalPage = (int)($totalArticle/4);
				$currentPage = (int)($startNo/4);
				if($currentPage>0){
					$isPre = TRUE;
				}	 
				if($totalPage<>$currentPage){
					$isNext = TRUE;
				}
			}
			
			function getContentNumber()
			{
				mysql_db_query("commit");
				$sqls = 'select depth1 from UserWriteToCommunity where community_id='.$_SESSION['community']. ' and depth2=0 order by depth1 desc';
				$results = mysql_query($sqls);
				mysql_db_query("commit");
				$number = 0;
				while($rows = mysql_fetch_array($results)){
					if($rows['depth1'] > $number){
						$number = $rows['depth1'];
					}
				};
				$number = $number+1;
			    return $number;
			}
			
				$sqls = 'select profilePicture from Member where email = "'.$current_user.'"';
				$results = mysql_query($sqls);
				$rows = mysql_fetch_array($results);
				$user_img = '../'.substr($rows[0],8,strlen($rows[0])) ;
				
		?>
		
		<script type="text/javascript">
			
			$(document).ready(function () {
				$('#imgPreview').css('display','none');
		  maxLength = $("#content_value").attr("maxlength");
		     
		  $("#remain").text( maxLength + " remaining");
        $("#content_value").bind("keyup change", function(){checkMaxLength('content_value',  maxLength); } );
 
 		$(window).resize(function() {
  			if($('#imgPreview').css('display') == 'block'){
  				image_preview_resize();
  			}
		});

 		
    });
		</script>
		
	<!-- 
		<?php
		include_once('../bbs/db/db_connect.php');
		include_once('../bbs/db/BigJobSeperate.php');
		include_once('../bbs/db/BoardNReply.php');
		include_once('../bbs/db/CategoryJob.php');
		include_once('../bbs/db/Community.php');
		include_once('../bbs/db/CommunityJoinList.php');
		include_once('../bbs/db/CommunityOption.php');
		include_once('../bbs/db/EnGrant.php');
		include_once('../bbs/db/InterestList.php');
		include_once('../bbs/db/InterestRoundry.php');
		include_once('../bbs/db/Local.php');
		include_once('../bbs/db/Member.php');
		include_once('../bbs/db/Message.php');
		include_once('../bbs/db/Nation.php');
		include_once('../bbs/db/PrivateClassfied.php');
		include_once('../bbs/db/Recommand.php');
		include_once('../bbs/db/SurveyField.php');
		include_once('../bbs/db/SurveyInfomation.php');
		include_once('../bbs/db/SurveyQuestion.php');
		include_once('../bbs/db/TypeExpr.php');
		include_once('../bbs/db/UnGrant.php');
		include_once('../bbs/db/UserAnswer.php');
		
	
	
	
	
	
//	echo "connect";

?>  -->


<?php

	function getContent($start){
		$sql = 'select community_id, UserWriteToCommunity.email, depth1, depth2, content, writeTime, recommand, guilty, photoPath, Member.profilePicture '; 
			$sql .= 'from UserWriteToCommunity left outer join Member on UserWriteToCommunity.email = Member.email ';
			$sql .= 'where community_id='.$_SESSION['community']. ' and depth2=0 order by depth1 desc limit '.$startNo .', 4';
			$result = mysql_query($sql);
			$lastConNumber=0;
			//echo $sql;
		//	$json = array();
			while($row = mysql_fetch_array($result)){
				$start+=1;
				$row_arr['id'] = $row['community_id'];
				$row_arr['email'] = $row['email'];
				$row_arr['depth'] = $row['depth1'];
				$row_arr['content'] = $row['content'];
				$row_arr['time'] = $row['writeTime'];
				$row_arr['recommand'] = $row['recommand'];
				$row_arr['photo'] = $row['photoPath'];
				$row_arr['user_photo'] = $row['profilePicture'];
				if($row_arr['depth'] > $lastConNumber){
					$lastConNumber = $row_arr['depth'];
				}
				$month=array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
				
				//$row_arr['year'] = new Date();
				$row_arr['year']= date('Y', strtotime($row_arr['time']));
				$row_arr['month']= date('F', strtotime($row_arr['time']));
				$row_arr['date']= date('d', strtotime($row_arr['time']));
				$row_arr['clock']=date('h:i A', strtotime($row_arr['time']));
				//setTime($row_arr['time']).getFullYear();
				
				$profilePic = "../../" . substr($row_arr['user_photo'],9,strlen($row_arr['user_photo']));
				
				
				
				//array_push($json,$row_arr);
				//echo $row_arr['id'];
				$divs = '';
				$divs = '<div class="articles '.$row_arr['depth'].'_arti" id="tmp_height" >';
				$divs .= '<div class="fir">';
				$divs .= '<div class="article_fabicon"><img src="'.$profilePic.'" alt="photo" width="100px" height="60px"></div>';
				$divs .= '<div class="article_id">'.$row_arr['email'].'</div>';
				$divs .= '<div class="article_message"></div>';
				$divs .= '<span><a onClick="removeElements(this);"><div  class="article_exit">Delete</div></a><span>';
				$divs .= '</div>';
				$divs .= '<div class="sec">';
				$divs .= '<div class="article_calendar">';
				$divs .= '<div class="cal_month">'.$row_arr['month'].'</div>';
				$divs .= '<div class="cal_day">'.$row_arr['date'].'</div>';
				$divs .= '<div class="cal_year">'.$row_arr['year'].'</div>';
				$divs .= '</div>';
				$divs .= '<div class="article_contents">'.$row_arr['content'].'</div>';
				$divs .= '</div>';
				$divs .= '<div class="thir">';
				$divs .= '<div class="article_date">'.$row_arr['clock'].'</div>';
				$divs .= '<span><a onClick="test(this);"><div class="article_recommand">'.$row_arr['recommand'].'</div></a></span>';
				$divs .= '</div>';
				
				$divs .= '<div class="reply">';
				$totalHegiht = 0;
				//$divs1= '';
				
				$sql = 'select community_id, UserWriteToCommunity.email, depth1, depth2, content, writeTime, recommand, guilty, photoPath, Member.profilePicture '; 
				$sql .= 'from UserWriteToCommunity left outer join Member on UserWriteToCommunity.email = Member.email ';
				$sql .= 'where community_id='.$_SESSION['community'].' and depth1='.$row_arr['depth'].' and depth2<>0  order by depth2';
			
				//$divs .= $sql;
				$reply_result = mysql_query($sql);
				while($reply_row = mysql_fetch_array($reply_result)){
					$height = (70 + ((int)(strlen($reply_row['content'])/72)*45));
					$totalHegiht += $height; 
					$writeTime = date('Y-m-d H:i', strtotime($reply_row['writeTime']));
					$profilePic = "../../" . substr($reply_row['profilePicture'],9,strlen($reply_row['profilePicture']));
					
									
					$divs .= '<div class="child'.$reply_row['depth2'].'" style="background-color:#A0EFAF; width:700px;height:'.$height.'px;border:1px solid #000000;" >';
		 			$divs .= '<div class="article_reply_picture"><img src="'.$profilePic.'" alt="img"></div>';
		 			$divs .= '<div class="article_reply_box"><div class="article_reply_id">'.$reply_row['email'].'<a onClick="doGuilty(this,'.$reply_row['community_id'].')"><img class="guilty_img" src="../bbs/images/guilty.png" alt="legal"></a>';
		 			$divs .= '<div class="guiltyTimes"></div>';
		 			$divs .= '<div class="reply_write_time">'.$writeTime.'</div></div>';
		 			$divs .= '<div class="article_reply_value">'.$reply_row['content'].'</div></div>';
		 			$divs .= '</div>'; 
				}	
				
				$divs .= '</div>';
				$divs .= '<div class="article_reply_textarea">';
				$divs .= '<div class="reply_picture"><img src = "../bbs/images/pic.png" width="100px" height="70px"></div>';
				$divs .= '<div class="reply_send" onClick="sendReply(this);">send</div>';
				// $divs .= '<div class="reply_send" onClick="sendReply(this,';
				// $divs .= $_SESSION['community'];
				// $divs .= ', \'';
				// $divs .= $current_user;
				// $divs .= '\', ';
				// $divs .= '\''.$profilePic.'\');">send</div>';
				$divs .= '<textarea  onKeyUp="detectEnter(event.keyCode, this);" name="reply_text" class="reply_value" cols="60" rows="1"></textarea>';
				$divs .= '</div>';
				$divs .= '</div>';
				
				echo $divs;
				
				$script = '<script type="text/javascript">';
				$script .= '$("#tmp_height").height("'.(320+$totalHegiht).'px");';
				$script .= '$("#tmp_height").removeAttr("id");';
				$script .= '</script>';
				
				echo $script;
				
				
				}
				return $start;
				
	}



?>

		
	</head>
	
	<body>
		
		
		<div id="imgPreview">
			<div id="previewExit"><img src="../bbs/images/close.png" alt='close'></div>
			
			<div id="article_img_thumbnail"><img id='previewImage' src=''  alt='img_Preview'></div>
			
			
		</div>
		
		<?php
			$sql = 'select create_id from Community where community_id = '.$_SESSION['community'];
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			$community_owner = $row[0];
			if($current_user == $community_owner){
				$admin = '<div id="admin"><a href="./community.php?admin=';
				$admin .= $_SESSION['community'].'">관리자페이지 가기</a></div>';
				echo $admin;		
			}
		
		?>
		<script type="text/javascript">
			var currentTime = new Date();
			var aOrP;
			var year = currentTime.getFullYear();
			var months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
			var month = months[currentTime.getMonth()];
			var day = currentTime.getDate();
			var hours = currentTime.getHours();
			var minutes = currentTime.getMinutes();
			
			var com_id = '<?php echo $_SESSION['community']; ?>';
			var mail = '<?php echo $current_user; ?>';
			var lastConNumber = <?php echo getContentNumber(); ?>;
			
			// alert('comid = ' +com_id);
			
			if(hours < 10){
				hours = '0'+hours;
			}
			
			if(minutes < 10){
				minutes = '0'+minutes;
			}
			
			if(hours >12){
				aOrP = 'PM';
			}else{
				aOrP = 'AM';
			}
				
		</script>
		
		<!-- <div>
			
				
			<input type="radio" name="pic_info" value="one" checked="checked" />First_Pic
			<input type="radio" name="pic_info" value="two" />Second_Pic
			<input type="radio" name="pic_info" value="three" />Third_Pic
			<input type="radio" name="pic_info" value="four" />Fourth_Pic
		
		</div> -->
		<div id="article">
			
			<div class="fir">
				<div id="fabicon">
					<?php
					$sql = 'select profilePicture from Member where email = "'.$current_user.'"'; 
					$result = mysql_query($sql);
					$row = mysql_fetch_array($result);
					$profilePic = "../../" . substr($row[0],9,strlen($row[0]));
					$userPic =$profilePic; 
					echo '<img id="picture" alt="user_picture" src="'.$profilePic.'"/>';
					?>
				</div>
				<div id="id">
					
					
					
				</div>
			<!--	<div id="message">
					
					message
					
			</div> -->
				<div id="exit">
					
					새로쓰기
					
				</div>
			</div>
			
			<div class="sec">
				<div id="calendar">
					<div class="cal_month">
						<script type="text/javascript">
							document.write(month);
						</script>
						<!-- <?php
							$nowTime = date("M"); 
							echo $nowTime;
						?> -->
					</div>
					<div class="cal_day">
						<script type="text/javascript">
							document.write(day);
						</script>
						<!-- <?php
							$nowTime = date("j"); 
							echo $nowTime;
						?> -->
					</div>
					<div class="cal_year">
						<script type="text/javascript">
							document.write(year);
						</script>
						<!-- <?php
							$nowTime = date("Y"); 
							echo $nowTime;
						?> -->
					</div>
					
				</div>
				<div id="content">
					
					<form name='cont' action='post'>
						
						<textarea name='text' maxlength='140' id='content_value' cols='70' rows='5'  style='overflow:hidden;background-color:transparent;scrollbar-face-color:#ffffff;
						border:0;filter:chroma(color=ffffff);  resize: none;'></textarea>
						
					</form>
						
					
					
					
				</div>	
				
				
			</div>
			<div class="thir">
				
				
			
				
				
			<div id="remain" style="width:100px;height:50px;float:left;"> </div>
			<!--	<div id="recommand">recommand</div>-->
				<div id="write">글쓰기</div>
				
			</div>
			<!-- <div class="four">
				<div id="imgbox" ondrop="dropIt(event)" ondragover="return false" ondragenter="return false">
				
					Drop Image
				
				</div>
			</div> -->
			
		</div>
		
		<div id="article_content">
			
			
			<?php
		$readConNumber =	getContent($readConNumber);
			
			
			$sql = 'select community_id, UserWriteToCommunity.email, depth1, depth2, content, writeTime, recommand, guilty, photoPath, Member.profilePicture '; 
			$sql .= 'from UserWriteToCommunity left outer join Member on UserWriteToCommunity.email = Member.email ';
			$sql .= 'where community_id='.$_SESSION['community']. ' and depth2=0 order by depth1 desc limit ' . $startNo . ', 4';
			$result = mysql_query($sql);
			$lastConNumber=0;
			$readConNumber=0;
		//	$json = array();
			while($row = mysql_fetch_array($result)){
				$readConNumber+=1;
				$row_arr['id'] = $row['community_id'];
				$row_arr['email'] = $row['email'];
				$row_arr['depth'] = $row['depth1'];
				$row_arr['content'] = $row['content'];
				$row_arr['time'] = $row['writeTime'];
				$row_arr['recommand'] = $row['recommand'];
				$row_arr['photo'] = $row['photoPath'];
				$row_arr['user_photo'] = $row['profilePicture'];
				if($row_arr['depth'] > $lastConNumber){
					$lastConNumber = $row_arr['depth'];
				}
				$month=array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
				
				//$row_arr['year'] = new Date();
				$row_arr['year']= date('Y', strtotime($row_arr['time']));
				$row_arr['month']= date('F', strtotime($row_arr['time']));
				$row_arr['date']= date('d', strtotime($row_arr['time']));
				$row_arr['clock']=date('h:i A', strtotime($row_arr['time']));
				//setTime($row_arr['time']).getFullYear();
				
				$profilePic = "../../" . substr($row_arr['user_photo'],9,strlen($row_arr['user_photo']));
				
				
				
				//array_push($json,$row_arr);
				//echo $row_arr['id'];
				$divs = '';
				$divs = '<div class="articles '.$row_arr['depth'].'_arti" id="tmp_height" >';
				$divs .= '<div class="fir">';
				$divs .= '<div class="article_fabicon"><img src="'.$profilePic.'" alt="photo" width="100px" height="60px"></div>';
				$divs .= '<div class="article_id">'.$row_arr['email'].'</div>';
				$divs .= '<div class="article_message"></div>';
				$divs .= '<span><a onClick="removeElements(this);"><div  class="article_exit">글삭제</div></a><span>';
				$divs .= '</div>';
				$divs .= '<div class="sec">';
				$divs .= '<div class="article_calendar">';
				$divs .= '<div class="cal_month">'.$row_arr['month'].'</div>';
				$divs .= '<div class="cal_day">'.$row_arr['date'].'</div>';
				$divs .= '<div class="cal_year">'.$row_arr['year'].'</div>';
				$divs .= '</div>';
				$divs .= '<div class="article_contents">'.$row_arr['content'].'</div>';
				$divs .= '</div>';
				$divs .= '<div class="thir">';
				$divs .= '<div class="article_date">'.$row_arr['clock'].'</div>';
				$divs .= '<span><a onClick="test(this);"><div class="article_recommand">'.$row_arr['recommand'].'</div></a></span>';
				$divs .= '</div>';
				
				$divs .= '<div class="reply">';
				$totalHegiht = 0;
				//$divs1= '';
				
				$sql = 'select community_id, UserWriteToCommunity.email, depth1, depth2, content, writeTime, recommand, guilty, photoPath, Member.profilePicture '; 
				$sql .= 'from UserWriteToCommunity left outer join Member on UserWriteToCommunity.email = Member.email ';
				$sql .= 'where community_id='.$_SESSION['community'].' and depth1='.$row_arr['depth'].' and depth2<>0  order by depth2';
			
				//$divs .= $sql;
				$reply_result = mysql_query($sql);
				while($reply_row = mysql_fetch_array($reply_result)){
					$height = (70 + ((int)(strlen($reply_row['content'])/72)*45));
					$totalHegiht += $height; 
					$writeTime = date('Y-m-d H:i', strtotime($reply_row['writeTime']));
					$profilePic = "../../" . substr($reply_row['profilePicture'],9,strlen($reply_row['profilePicture']));
					
									
					$divs .= '<div class="child'.$reply_row['depth2'].'" style="background-color:#A0EFAF; width:700px;height:'.$height.'px;border:1px solid #000000;" >';
		 			$divs .= '<div class="article_reply_picture"><img src="'.$profilePic.'" alt="img"></div>';
		 			$divs .= '<div class="article_reply_box"><div class="article_reply_id">'.$reply_row['email'].'<a onClick="doGuilty(this,'.$reply_row['community_id'].')"><img class="guilty_img" src="../bbs/images/guilty.png" alt="legal"></a>';
		 			$divs .= '<div class="guiltyTimes"></div>';
		 			$divs .= '<div class="reply_write_time">'.$writeTime.'</div></div>';
		 			$divs .= '<div class="article_reply_value">'.$reply_row['content'].'</div></div>';
		 			$divs .= '</div>'; 
				}	
				
				$divs .= '</div>';
				$divs .= '<div class="article_reply_textarea">';
				$divs .= '<div class="reply_picture"><img src = "../bbs/images/pic.png" width="100px" height="70px"></div>';
				$divs .= '<div class="reply_send" onClick="sendReply(this,';
				$divs .= $_SESSION['community'];
				$divs .= ', \'';
				$divs .= $current_user;
				$divs .= '\', ';
				$divs .= '\''.$profilePic.'\');">작성</div>';
				$divs .= '<textarea  onKeyUp="detectEnter(event.keyCode, this);" name="reply_text" class="reply_value" cols="60" rows="1"></textarea>';
				$divs .= '</div>';
				$divs .= '</div>';
				
				echo $divs;
				
				$script = '<script type="text/javascript">';
				$script .= '$("#tmp_height").height("'.(320+$totalHegiht).'px");';
				$script .= '$("#tmp_height").removeAttr("id");';
				$script .= '</script>';
				
				echo $script;
				
				
				}
				
				
			
			?>
			
			
			
	<!--	
			<div class="articles">
				<div class="fir">
					<div class="article_fabicon"></div>
					<div class="article_id"></div>
					<div class="article_message"></div>
					<div class="article_exit"></div>
				</div>
				<div class="sec">
					<div class="article_calendar"></div>
					<div class="article_contents"></div>
				</div>
				<div class="thir">
					<div class="article_date"></div>
					<div class="article_recommand"></div>
				</div>
			</div>
	-->
		</div>
		
		
		<div id="page">
		
			<?php
				if($isPre == TRUE){
					$page = '<a href="./community.php?start='.($startNo-4).'">';
					$page .= '<div class="pagination">이전</div>';
					$page .= '</a>';
					echo $page;
				}
				
				if($isNext == TRUE){
					$page = '<a href="./community.php?start='.($startNo+4).'">';
					$page .= '<div class="pagination">다음</div>';
					$page .= '</a>';
					echo $page;
				}
				
			?>
			
		
		
		</div>
		
		
		
		
	
		<script type="text/javascript">
		
		
				
		var isImg = false;
		var insert_img_width, insert_img_height;
		
		
		$('#previewExit').click(function(){
			// alert('close');
			$('#imgPreview').find('#previewImage').attr('src','');
			$('#imgPreview').css('display','none');
		
		});
		
		
		
 
   	$("#write").click(function(){
				
				
				
				// insert into UserWriteToCommunity (community_id, email, depth1, depth2, content, recommand, guilty, photoPath) 
				// values($_SESSION['community'], $curent_user, depth1, 0,document.cont.text.value ,0,0,'');//
				
				
				
				
				if(document.cont.text.value != ''){
				var divs;
				if(isImg == true){
					divs = '<div class="img_articles">';
				}else{
					divs = 	'<div class="articles ';
					divs += lastConNumber;
					divs += '_arti">';
				}
				
				
				divs +=		'<div class="fir">';
				// var chk_name = $("input[name='pic_info']:checked").attr('value');
// 				
				// if(chk_name == 'one'){
					// divs +=	 	'<div class="article_fabicon"><img alt="fir_img" src="../bbs/images/1.png"/></div>';
				// }else if(chk_name == 'two'){
					// divs +=	 	'<div class="article_fabicon"><img alt="sec_img" src="../bbs/images/2.png"/></div>';
				// }else if(chk_name == 'three'){
					// divs +=	 	'<div class="article_fabicon"><img alt="thir_img" src="../bbs/images/3.png"/></div>';
				// }else if(chk_name == 'four'){
					// divs +=	 	'<div class="article_fabicon"><img alt="four_img" src="../bbs/images/4.png"/></div>';
				// }
				divs +=		'<div class="article_fabicon"><img alt="user_img" src="'+'<?php echo $userPic;?>'+'"/></div>';
				divs +=	 	'<div class="article_id">'+'<?php echo $current_user;?>'+'</div>';
				divs +=	 	'<div class="article_message"></div>';
				divs +=	 	'<span><a onClick="removeElements(this);"><div class="article_exit">delete</div></a></span>';
				divs +=	 	'</div>';
				divs +=	 	'<div class="sec">';
				divs +=	 	'<div class="article_calendar">';
				divs += 	'<div class="cal_month">'+month+'</div>';
				divs += 	'<div class="cal_day">'+day+'</div>';
				divs += 	'<div class="cal_year">'+year+'</div>';
				divs += 	'</div>'
				divs +=	 	'<div class="article_contents">'+document.cont.text.value+'</div>';
				divs +=	 	'</div>';
				divs +=	 	'<div class="thir">';
				divs +=	 	'<div class="article_date"><div id="date">'+hours+':'+minutes+' ' + aOrP + '</div></div>';
				divs +=	 	'<span><a onClick="test(this);"><div class="article_recommand">0</div></a></span>';
				divs +=	 	'</div>';
				if(isImg == true){
					//alert(insert_img_width + ", " + insert_img_height);
					//alert('<div style="width:700px;"><img src= "'+ $('#imgbox').children(0).children(0).attr('src') + '" width = "' + insert_img_width + 'px" height = "' + insert_img_height +'px" alt="image"></div>');
					divs +=	 	'<div style="width:700px; height:100px; background-color:#000000;" ><img  onClick="imgClick(this)" src= "'+ $('#imgbox').children(0).children(0).attr('src') + '" width = "' + insert_img_width + 'px" height = "' + insert_img_height +'px" alt="image"></div>';
					initialImgBox();
					
					
				// width = "' + insert_img_width + 'px" height = "' + insert_img_height +'px" 
				}
				isImg = false;	
				
				var com_id = <?php echo $_SESSION['community']; ?>;
				var mail = '\'<?php echo $current_user; ?>\'';				
				var pic = '\'<?php echo $profilePic; ?>\'';
				
				divs += '<div class="reply"></div>';
				divs += '<div class="article_reply_textarea">';
				divs += '<div class="reply_picture"><img src = "../bbs/images/pic.png" width="100px" height="70px"></div>';
				divs += '<div class="reply_send" onClick="sendReply(this);">작성</div>';
				// divs += '<div class="reply_send" onClick="sendReply(this,';
				// divs += com_id;
				// divs += ', ';
				// divs += mail;
				// divs += ', ' + pic + ');">send</div>';
				divs +=	'<textarea  onKeyUp="detectEnter(event.keyCode, this);" name="reply_text" class="reply_value" cols="60" rows="1"></textarea>';
				
				divs += '</div>';
				divs +=	 	'</div>';
					
					$('#article_content').prepend(divs);
					//$('#article_content').prepend('<div class="articles">'+currentTime + <br/> + '    ' + document.cont.text.value + ' </div> ' );


				
				
				var commu_id = <?php echo $_SESSION['community']; ?>;
				var email = '<?php echo $current_user; ?>';
				var depth1 = lastConNumber;
				var depth2 = 0;
				var content = document.cont.text.value;
				var recommand = 0;
				var guilty = 0;
				
				// $ajax({
					// url: '../bbs/writeContent.php'
					// type:'json'
					// data:
				// })
				
				var jsonStr = JSON.stringify({
					community_id : commu_id, 
					email : email, 
					depth1 : depth1, 
					depth2 : depth2, 
					content : content, 
					recommand : 0, 
					guilty : 0,
					photo : ''
					});
				// alert(jsonStr);
				lastConNumber= lastConNumber+1;
				$.post("../bbs/writeContent.php", { jsonstr:jsonStr });
			
				
				
				
					
					
				}else{
					alert('please enter Text');
				}
				
				
				initialContent();
				
				


			});
		
		
		function removeElements(ele){
	  		
	  	///alert($(ele).parent().parent().find('.aricle_id').attr('class'));
	  	//alert($(ele).parent().parent().parent().find('.aricle_id').attr('class'));
	  	var owner = $(ele).parent().parent().parent().find('.article_id').text();
	  	var modify_user = '<?php echo $current_user ?>';
	  	if(owner != modify_user){
	  		alert('글의 저자가 아닙니다');
	  		return;
	  	}
	  	//alert(owner + '  ' +modify_user);
	  	var isDelete = confirm("진심이십니까?");
	  		
		if(isDelete == true){
			$(ele).parent().parent().parent().remove();
			
			var commu_id = com_id;
		var depth1 = $(ele).parent().parent().attr('class').substring(9,$(ele).parent().parent().attr('class').length-5);
		
		var jsonstr = JSON.stringify({
					community_id : commu_id, 
					depth1 : depth1 
					});
		//alert(jsonstr);
		
		$.post("../bbs/removeArticle.php", { jsonstr:jsonstr });
		alert('글삭제가 완료되었습니다. ^^');
		}
		
		
	}
		
		
		function writing(ele){
				
				
			sendReply(ele);
				


			}
		
		
			
		function detectEnter(e, ele){
			
			if(e == 13 && $(ele).val() != ''){
				writing(ele);
			}
			
		}
	

		
			
			$('#exit').click(function(){
				
				initialContent();

			});
			
			// $(".article_recommand").click(function(){
			// //	alert('recommand');
			// });
			
			$(".articles").find(".article_message").click(function(){
				//alert('send msg');
			});
			
			$("input[name='pic_info']").change(function(){
		  	  chk_name = $("input[name='pic_info']:checked").attr('value');
		  	 // alert($("input[@name='pic_info']:checked").name());
		  	  //alert($("input[@name='pic_info']:checked").val());
		  	  //alert($("input[@name='pic_info']:checked").value());
		  	// alert('type : ' + $('input[name="pic_info"]:checked').attr('value'));
		  	  if(chk_name == 'one'){
		  	  	$('#picture').attr('src','../bbs/images/1.png');
		  	  }else if(chk_name == 'two'){
		  	  	$('#picture').attr('src','../bbs/images/2.png');
		  	  }else if(chk_name == 'three'){
		  	  	$('#picture').attr('src','../bbs/images/3.png');
		  	  }else if(chk_name == 'four'){
		  	  	$('#picture').attr('src','../bbs/images/4.png');
		  	  }
		  	 	
		  	});
		  	
		  	
		  		function imagesSelected(myFiles) {
				
				var f = myFiles[0];
				var imageReader = new FileReader();
				
				imageReader.onload = (function(aFile) {
					return function(e) {
						var span = document.createElement('div');
						
						var img = document.createElement('img');
						img.src = e.target.result;
						
						
						var left_margin;
						var img_width;
						 
						 
						if(img.height >100){
							img_width = img.width / img.height *100;
							left_margin = (350 - (img_width / 2)) + 'px';
							
							insert_img_width = img_width;	
							insert_img_height = 100;
													
						}else{
							left_margin = (350 - (img.width / 2)) + 'px';
							
							
							insert_img_width = img.width / img.height *100;	
							insert_img_height = img.height * (img.width/insert_img_width);
						}
						
						span.innerHTML = ['<img class="inputimg" style="margin-left:',left_margin,'; max-width:600px; max-height:100px" src="', e.target.result,'" title="', aFile.name, '"/>'].join('');
						
						document.getElementById('imgbox').insertBefore(span, null);

					};
				})(f);
				imageReader.readAsDataURL(f);
			}
			
		  	function initialImgBox(){
				$('#imgbox').empty();
				$('#imgbox').text('Drop Image');
				$('#imgbox').css('background-color','#6032be');
				$('#imgbox').css('height','50px');
			}  	
			function initialContent(){
					
					$('#content_value').val('');
					$('#remain').text('140 remaining');
					
			}
		  	
		  	function dropIt(e){
				$('#imgbox').empty();
				imagesSelected(e.dataTransfer.files);
				e.stopPropagation();
				e.preventDefault();
				
				$('#imgbox').css('width','700px');
				$('#imgbox').css('height','100px');
				$('#imgbox').css('background-color','#696969');
				// alert($('#imgbox').children(0).attr('class'));
				// alert($('#imgbox').children(0).children(0).attr('class'));
				// alert($('#imgbox').children(0).children(0).attr('src'));
				isImg = true;
			} 
			
			
			
			
		function sendReply(elements){
		//, com_id, mail, pic
			
			var reply_length = $(elements).parent().find('.reply_value').val().length;
			
			var ori_height = $(elements).parent().parent().css('height');
			
			// alert($(elements).parent().parent().attr('class').substring(9,$(elements).parent().parent().attr('class').length-5));
			var depth1 = $(elements).parent().parent().attr('class').substring(9,$(elements).parent().parent().attr('class').length-5);
			// alert($(elements).parent().parent().find('.reply').children().length);
			
			var commu_id = <?php echo $_SESSION["community"];?>;
			var email = '<?php echo $current_user;?>';
			var depth1 = $(elements).parent().parent().attr('class').substring(9,$(elements).parent().parent().attr('class').length-5);
			var depth2;
			var reply_num = $(elements).parent().parent().find('.reply').children(':last').attr('class');
			if($(elements).parent().parent().find('.reply').children().length > 0){
		 		depth2 = reply_num.substr(5, reply_num.length);
		 		depth2 = parseInt(depth2)+1;
		 	}else { depth2 = 1;}
		 
			var reply_content = $(elements).parent().find('.reply_value').val();
			var recommand = 0;
			var guilty = 0;
			
			var jsonstr = JSON.stringify({
						community_id : commu_id, 
						email : email, 
						depth1 : depth1, 
						depth2 : depth2, 
						content : reply_content, 
						recommand : 0, 
						guilty : 0,
						photo : ''
						});
				//alert(jsonstr);	
			 $.post("../bbs/writeContent.php", { jsonstr:jsonstr });
			
			//alert(stringByteSize($(elements).parent().find('.reply_value').val()));
			var reply_height = (70 + parseInt(parseInt(reply_length/72)*45));
		//	alert(reply_height + ' ' +reply_length + ' ' + parseInt(parseInt(reply_length/80)*35 ));
			var plus_height = (parseInt(ori_height) + reply_height) + 'px';
			
			//alert(ori_height);
			//alert(plus_height);
			//alert(reply_length);
			 //alert($(elements).parent().parent().attr('class'));
			 //alert($(elements).parent().find('.reply_value').val());
			 $(elements).parent().parent().css('height',plus_height);
			 
			 
			 var rnumber=Math.floor(Math.random()*8)+1;
			 
			 // var img_src = "../bbs/images/r"+rnumber+".png";
			 	
			var pic = '<?php echo $userPic;?>';
			 	
			 	
			 var time = year;
			 
			 if(currentTime.getMonth() < 10){
			 	time += '-0'+ currentTime.getMonth();
			 }else{
			 	time += '-'+ currentTime.getMonth();
			 }
			 
			 if( day < 10){
			 	time += '-0'+ day +' '+ hours +':'+ minutes ;
			 }else{
			 	time += '-'+ day +' '+ hours +':'+ minutes ;
			 }
			
			 var divs 	= 	'<div class="child'+depth2+'" style="background-color:#A0EFAF; width:700px;height:'+reply_height+'px;border:1px solid #000000;" >';
			 divs 		+= 	'<div class="article_reply_picture"><img src="'+pic+'" alt="img"></div>';
			 divs 		+=	'<div class="article_reply_box"><div class="article_reply_id">'+mail+'<a onClick="doGuilty(this, '+commu_id+')"><img class="guilty_img" src="../bbs/images/guilty.png" alt="legal"></a>';
			 divs 		+= 	'<div class="guiltyTimes"></div>';
			 divs 		+= 	'<div class="reply_write_time">'+time+'</div></div>'
			 divs		+= 	'<div class="article_reply_value">'+$(elements).parent().find('.reply_value').val() + '</div></div>';
			 divs 		+= 	'</div>'; 
			 
			 //alert($(elements).parent().find('.reply_value').attr('class'));
			 // $(elements).parent().find('.reply_value').append(divs);
			 //$(elements).parent().prepend(divs);
			 $(elements).parent().parent().find('.reply').append(divs);
			 $(elements).parent().children(0).val('');
			 
				// $(elements).parent().parent().find('.reply').css('height',
						// (parseInt($(elements).parent().parent().find('.reply').css('height'))+35)+'px');
						
			 //$(elements).parent().prepend(divs);
			// $(elements).parent().css('height',(parseInt($(elements).parent().css('height'))+35)+'px');
			//alert($(elements).parent().children(0).val());
		}
			
			
			
			
			
			
			
			
			
			
			
		</script>
		
		
	</body>
</html>

