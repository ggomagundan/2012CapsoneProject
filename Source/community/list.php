<?php
	require_once '../config/session.php';
	require_once '../config/datacon.php';
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ruara Survey</title>
	<script type="text/javascript" src="../javascript/jquery.js"></script>
	<link rel="stylesheet" href="list.css" type="text/css" media="screen" />
</head>
<body>
<?php require_once '../header/header.php';?>
	<div id="wrap">
		<div id = "content">
		<?php
			$per_page = 10;
			if (isset($_GET["page"])) $page = (int) $_GET['page'];
			if (!$page && $page <= 0) $page = 1;
			
			$query = "select count(*) from Community";
			$result = mysql_query($query);
			if($result){
				$row = mysql_fetch_array($result);
				$num_polls = $row[0];
			}
			
			$last_page = ceil($num_polls/$per_page);
			
			$query = "select * from Community order by community_Name desc limit ".(($page-1)*$per_page).",".$per_page;
			$result = mysql_query($query);
	
			while($row = mysql_fetch_array($result)){
				$poll_id = $row['community_id'];
				$make_email = $row['create_id'];
				$desc = $row['community_Desc'];
				$path = $row['doorPicture'];
				$title = $row['community_Name'];
			
		?>		
				<div class="poll">
					<table><tbody>
						<tr>
							<td rowspan="2" class="pollPicture"><img class="pollPicture" src="<?php echo $path;?>" alt="Door Picture"/></td>
							<td rowspan="2" class="pollTitle"><a href="join.php?community=<?php echo $poll_id;?>"><b><?php echo $title;?></b><br/><?=$desc?></a></td>
							<td rowspan="2" class="pollMaker"><?php echo $make_email;?></td>
						</tr>
					</tbody></table>
				</div>
		<?php
			}
			if ($last_page > 1){
		?>	
			<div id="pagination">
				<a href="list.php?page=1" class="direction">&laquo; 처음</a>
				<?php
					if($page>1)
						echo ("<a href='list.php?page=".($page-1)."' class ='direction'>&lsaquo; 이전</a>\n");
					
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
						else echo ("<a href='list.php?page={$i}' class = 'direction'>{$i}</a>\n");
					}
					if ( $page < $last_page )
						echo ("<a href='list.php?page=".($page+1)."' class='direction'>다음 &rsaquo;</a>\n");  
				?>
				<a href = "list.php?page=<?php echo($last_page);?>" class ="direction">마지막 &raquo;</a>
			</div>
		<?php
			}
		?>
		</div>
	</div>
	<footer id="footer"><img src="../images/footer.png"/>
	</footer>
</body>
</title>