<?php
	require_once '../config/session.php';
	require_once '../config/datacon.php';
	
	if ( isset($_GET['cate']) ){
		$category = escape_str($_GET['cate']);
		$_SESSION['cate'] = $category;
	}else{
		$category = $_SESSION['cate'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ruara Survey</title>
	<script type="text/javascript" src="../javascript/jquery.js"></script>
	<link rel="stylesheet" href="pollList.css" type="text/css" media="screen" />
</head>
<body>
<?php require_once '../header/header.php';?>
	<div id="wrap">
		<div id = "content">
		<?php
			$per_page = 10;
			if (isset($_GET["page"])) $page = (int) $_GET['page'];
			if (!$page && $page <= 0) $page = 1;
			
			$query = "select count(*) from Polls where category = '".$category."'";
			$result = mysql_query($query);
			if($result){
				$row = mysql_fetch_array($result);
				$num_polls = $row[0];
			}
			
			$last_page = ceil($num_polls/$per_page);
			
			$query = "select * from Polls where category = '".$category."' order by start_date desc limit ".(($page-1)*$per_page).",".$per_page;
			$result = mysql_query($query);
			
			while($row = mysql_fetch_array($result)){
				$poll_id = $row['poll_id'];
				$make_email = $row['make_email'];
				$join_num = $row['join_num'];
				$max_num = $row['max_num'];
				$desc = $row['description'];
				$path = $row['img_path'];
				$path = substr($path, 8);
				$path = '../' . $path;
				$title = $row['title'];
			
		?>		
				<div class="poll">
					<table><tbody>
						<tr>
							<td rowspan="2" class="pollPicture"><img class="pollPicture" src="<?php echo $path;?>" alt="Poll Icon"/></td>
							<td rowspan="2" class="pollTitle"><a href="pollView.php?id=<?php echo $poll_id;?>"><?php echo $title;?></a></td>
							<td class="pollMaker"><?php echo $make_email;?></td>
						</tr>
						<tr>
							<td class="progress"><?php echo $join_num.' / '.$max_num; ?></td>
						</tr>
					</tbody></table>
				</div>
		<?php
			}
			if ($last_page > 1){
		?>	
			<div id="pagination">
				<a href="pollList.php?page=1" class="direction">&laquo; 처음</a>
				<?php
					if($page>1)
						echo ("<a href='pollList.php?page=".($page-1)."' class ='direction'>&lsaquo; 이전</a>\n");
					
					if ( $page <= 3 ){
						$first = 1;
						$last = $first + 6;
					}else if($last_page - $page < 3){
						$first = $last_page -6;
						$last = $last_page;
					}else{
						$first = $page - 3;
						$last = $first + 6;
					}
					
					if ( $first < 1 ) $first = 1;
					if ( $last > $last_page ) $last = $last_page;
					
					for ( $i = $first ; $i <= $last ; $i++ ){
						if ( $page == $i ) echo ("<strong>{$i}</strong>\n");
						else echo ("<a href='pollList.php?page={$i}' class = 'direction'>{$i}</a>\n");
					}
					if ( $page < $last_page )
						echo ("<a href='pollList.php?page=".($page+1)."' class='direction'>다음 &rsaquo;</a>\n");  
				?>
				<a href = "pollList.php?page=<?php echo($last_page);?>" class ="direction">마지막 &raquo;</a>
			</div>
		<?php
			}
		?>
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