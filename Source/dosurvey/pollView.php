<?php
	require_once '../config/session.php';
	require_once '../config/datacon.php';
	
	if ( isset($_GET['id']) ){
		$poll_id = escape_str($_GET['id']);
		$_SESSION['poll_id'] = $poll_id;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ruara Survey</title>
	<script type="text/javascript" src="../javascript/jquery.js"></script>
	<link rel="stylesheet" href="pollView.css" type="text/css" media="screen" />
</head>
<body>
<?php require_once '../header/header.php';?>
	<div id="wrap">
		<div id = "content">
			<?php
				$query = "select * from Polls where poll_id='".$poll_id."'";
				$result = mysql_query($query);
			
				while($row = mysql_fetch_array($result)){
					$make_email = $row['make_email'];
					$join_num = $row['join_num'];
					$max_num = $row['max_num'];
					$start_date = $row['start_date'];
					$end_date = $row['end_date'];
					$cate = $row['category'];
					$desc = nl2br(htmlspecialchars(($row['description'])));;
					$path = $row['img_path'];
					$path = substr($path, 8);
					$path = '../' . $path;
					$title = $row['title'];
				}
				
				$query = "select count(*) c from Question where poll_id='".$poll_id."'";
				$result = mysql_query($query);
				
				while($row = mysql_fetch_array($result)){
					$q_count = $row['c'];
				}
				
			?>
			<table class="pollTable"><tbody>
				<tr>
					<td rowspan="3" id="tdPollImg"><img src="<?php echo $path;?>" id="pollImg"></td>
					<td class="label">▶ 생성자</td>
					<td class="article"><?php echo $make_email;?></td>
				</tr>
				<tr>
					<td colspan="2" class="label">▶ Title</td>
				</tr>
				<tr>
					<td colspan="2" id="title"><?php echo $title;?></td>
				</tr>
			</tbody></table>
			<table class="pollTable" id="pollDes"><tbody>
				<tr>
					<td colspan="2" class="label">▶ Description</td>
				</tr>
				<tr>
					<td colspan="2" id="desc"><?php echo $desc;?></td>
				</tr>
				<tr>
					<td class="label slabel">▶ 시작일</td>
					<td class="article"><?php echo $start_date;?></td>
				</tr>
				<tr>
					<td class="label slabel">▶ 종료일</td>
					<td class="article"><?php
						if ( $end_date == '0000-00-00') $end_date = '무제한';
						echo $end_date;
					?></td>
				</tr>
				<tr>
					<td class="label slabel">▶ 문항수</td>
					<td class="article"><?php echo $q_count;?></td>
				</tr>
				<tr>
					<td class="label slabel">▶ 완료인원</td>
					<td class="article"><?php echo $join_num;?></td>
				</tr>
				<tr>
					<td class="label slabel">▶ 최대인원</td>
					<td class="article"><?php echo $max_num;?></td>
				</tr>
			</tbody></table>
			<a href="doPoll.php"><button class="doSurvey">설문하기</button></a>
			<a href="resultPoll.php"><button class="doSurvey">결과보기</button></a>
		</div>
		<aside id = "side_nav">
			<ul>
				<li><a href = "pollList.php?cate=culture">문화분야...</a></li>
				<li><a href = "pollList.php?cate=life">생활분야...</a></li>
				<li><a href = "pollList.php?cate=society">사회분야...</a></li>
				<li><a href = "pollList.php?cate=study">학술분야...</a></li>
				<li><a href = "pollList.php?cate=sports">스포츠분야...</a></li>
				<li><a href = "pollList.php?cate=hotissue">Hot Issue...</a></li>
			</ul>
		</aside>
	</div>
		
	<footer id="footer">
		<img src="../images/footer.png"/>
	</footer>
</body>
</title>