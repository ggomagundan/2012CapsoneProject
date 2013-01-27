<link rel="stylesheet" href="../reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../header/header.css" type="text/css" media="screen" />
<script type="text/javascript" src="../javascript/header.js"></script>
<header>
<?php
	if(isset($_GET['message'])) $message = $_GET['message'];
	if($message == "ERROR"){
?>
	<script> alert('아이디와 비밀번호를 확인해주세요'); </script>
<?php
	}
?>
	<div id="headerBackground">
		<a href="../"><img src="./../images/logo1.png" alt="logo"/></a>
		<?php
		if(!$loggedin){
		?>
		<form action="./../log/login.php" method="post">
			<table>
				<tbody>
					<tr>
						<td class="formText"><label>아이디</label></td>
						<td class="formText"><label>비밀번호</label></td>
						<td></td>
					</tr>
					<tr>
						<td><input class="logInput" name="loginId" type="text"/></td>
						<td><input class="logInput" name="loginPwd" type="password"/></td>
						<td><input type="submit" value="로그인"/></td>
					</tr>
					<tr>
						<td>
							<input type="checkbox" name="persistent" value="1" checked="checked">
							<label><a id="perLogin">로그인 상태 유지</a></label>
						</td>
						<td colspan="2">
							<label id="joinBtn"><a onclick="openWin()"><b>회원가입</b></a></label>
							<label><a href="#">아이디</a>/<a href="#">비밀번호 찾기</a></label>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<?php
		}else{
		?>
		<form id="logForm">
			<table>
				<tbody>
					<tr>
						<td rowspan="2" id="userIcon">
							<?php
								$query = "select profilePicture from Member where email = '".$current_user."'";
								$result = mysql_query($query);
								while( $picture = mysql_fetch_array($result) ){
									$path = $picture['profilePicture'];
								}
								$path = substr($path, 8);
								$path = '../' . $path;
							?>
							<img id="userImg" src="<?php echo $path; ?>" alt="user icon" width="68" height="68"/>
						</td>
						<td><label id="userId"><?php echo $current_user; ?></label></td>
					</tr>
					<tr>
						<td>
							<label><a href="#">쪽지함</a> / <a href="../log/logout.php">로그아웃</a></label>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<?php
		}
		?>
	</div>
</header>
<nav id="tab">
	<ul>
		<li id="status">Status</li>
		<li id="community">Community</li>
		<li id="survey">Survey</li>
	</ul>
	<section class="tabContent" id="surveyTab">
		<div class="tabDiver">
			<div class="tabMenu"><a href="../dosurvey/pollList.php?cate=culture"><img src="../images/scroll.png" alt=""/><h2>설문 목록</h2></a></div>
			<div class="tabMenu"><a href="../survey/create.php"><img src="../images/scroll.png" alt=""/><h2>설문 제작</h2></a></div>
		</div>
		<div class="tabDiver">
			<h1>Hot Issue</h1>
			<a href="#">list 1</a>
			<a href="#">list 2</a>
			<a href="#" class="rightMenu">더보기</a><br>
			<h1>Interest Survey</h1>
			<a href="#">list 1</a>
			<a href="#">list 2</a>
			<a href="#" class="rightMenu">더보기</a>
		</div>
		<div class="tabDiver">
			<h1>Completed Survey</h1>
			<a href="#">list 1</a>
			<a href="#">list 2</a>
			<a href="#">list 3</a>
			<a href="#" class="rightMenu">더보기</a><br/>
			
		</div>
	</section>
	<section class="tabContent" id="communityTab">
		<div class="tabDiver">
			<form action="../community/community.php" method="post">
				<select name="community" id="selectCommunity">
				<?php 
					$query = "select community_Name, ctu.community_id 
								from CommunityToUser ctu, Community c where ctu.community_id = c.community_id and email='". $current_user."'";
					$result = mysql_query($query);
					while( $community = mysql_fetch_array($result) ){
						$community_name = $community['community_Name'];
						$community_number = $community['community_id'];
						?><option value="<?php echo $community_number;?>"><?php echo $community_name;?></option><?php
					}  
				?>
				</select>
				<button type="submit" id="submitCommunity">입장</button>
			</form>
			<div> 독려 or 커뮤니티 설문</div>
			<div class="rightMenu comm">
				<a href="../community/create.php" onclick=""><h2>커뮤니티 생성</h2></a><h2> / </h2><a href="../community/list.php"><h2>참여</h2></a>
			</div>
		</div>
		<div class="tabDiver" id="community2">
			<h1>Recent Article</h1>
			<a href="#">list 1</a>
			<a href="#">list 2</a>
			<a href="#" class="rightMenu">더보기</a><br>
			<h1>Interest Article</h1>
			<a href="#">list 1</a>
			<a href="#">list 2</a>
			<a href="#" class="rightMenu">더보기</a>
		</div>
		<div class="tabDiver" id="community3">
			<h1>Notice</h1>
			<a href="#">list 1</a>
			<a href="#">list 2</a>
			<a href="#">list 3</a>
			<a href="#" class="rightMenu">더보기</a>
		</div>
	</section>
	<section class="tabContent" id="statusTab">
		<div class="tabDiver">
			My picture
			<div id="openScrap">
				openScrap
			</div>
		</div>
		<div class="tabDiver">
			research 창<br />
			fillter dic 
		</div>
		<div class="tabDiver">
			status picture
		</div>
	</section>
	<div id="tabCloseBtn">
		X
	</div>
</nav>
