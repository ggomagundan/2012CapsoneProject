<link type="text/css" rel="stylesheet" href="../bbs/style.css"/>
		<link type="text/css" rel="stylesheet" href="../bbs/articles.css"/>

<?php
							
		
			$depth1 = $_GET['depth'];
			$com_no = $_GET['no'];
		
			$sql = 'select community_id, UserWriteToCommunity.email, depth1, depth2, content, writeTime, recommand, guilty, photoPath, Member.profilePicture '; 
			$sql .= 'from UserWriteToCommunity left outer join Member on UserWriteToCommunity.email = Member.email ';
			$sql .= 'where community_id='.$com_no. ' and depth2=0 and depth1='.$depth1.' order by depth1';
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
				$sql .= 'where community_id='.$com_no.' and depth1='.$depth1.' and depth2<>0  order by depth2';
			
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
				
	



?>