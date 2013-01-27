<link type="text/css" rel="stylesheet" href="../bbs/admin.css"/>

<?php
	require_once('../bbs/db/db_connect.php');
	$com_id = $_SESSION['community'];
	$sql = 'select create_id from Community where community_id = '.$com_id;
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$community_owner = $row[0];
	
	if($current_user <> $community_owner ){
		echo '<script type="text/javascript">alert("운영자가 아닙니다.");location.replace("./community.php");</script>';
	}
	
	if($com_id <> $_GET['admin']){
		echo '<script type="text/javascript">alert("잘못된 접근입니다.");location.replace("./community.php");</script>';
	}
?>


<div id="adminContent">
	<?
		$sql = 'select * from CommunityRules where community_id = '.$com_id;
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$associate = $row['associate_Member_Auth'];
		$member =  $row['member_Auth'];
		$special = $row['special_Member_Auth'];  
		$operator = $row['operator_Member_Auth'];
		
	?>
	<table id="adminTable">
		<tr>
			<td></td>			
			<td>회원관리</td>
			<td>글쓰기</td>
			<td>읽기</td>
		</tr>
		<tr>
			<td>준회원</td>			
			<td id="ass_mem">
				
			 </td>
			<td id="ass_write">
				
			</td>
			<td id="ass_read">
				
			</td>
		</tr>
		<tr>
			<td>정회원</td>			
			<td id="mem_mem">
				
			 </td>
			<td id="mem_write">
				
			</td>
			<td id="mem_read">
				
			</td>
		</tr>
		<tr>
			<td>특별회원</td>			
			<td id="spe_mem">
				
			 </td>
			<td id="spe_write">
			
			</td>
			<td id="spe_read">
			
			</td>
		</tr>
		<tr>
			<td>운영자</td>			
			<td id="ope_mem">
				
			 </td>
			<td id="ope_write">
				
			</td>
			<td id="ope_read">
				
			</td>
		</tr>
	</table>
	
	
</div>


<script type="text/javascript">
			
			$(document).ready(function () {
				
				var associate =  <?php echo $associate;?>;
				var member = <?php echo $member;?>;
				var special = <?php echo $special;?>;  
				var operator = <?php echo $operator;?>; 
				
				if(associate >= 4){ setOn('#ass_mem'); associate-=4;
				}else{ setOff('#ass_mem'); }
				
				if(associate >= 2){	setOn('#ass_write'); associate-=2;			
				}else{ setOff('#ass_write'); }
				
				if(associate >= 1){ setOn('#ass_read'); associate-=1;				
				}else{ setOff('#ass_read'); }
				
				if(member >= 4){ setOn('#mem_mem'); member-=4;
				}else{ setOff('#mem_mem'); }
				
				if(member >= 2){	setOn('#mem_write'); member-=2;			
				}else{ setOff('#mem_write'); }
				
				if(member >= 1){ setOn('#mem_read'); member-=1;				
				}else{ setOff('#mem_read'); }
				
				if(special >= 4){ setOn('#spe_mem'); special-=4;
				}else{ setOff('#spe_mem'); }
				
				if(special >= 2){	setOn('#spe_write'); special-=2;			
				}else{ setOff('#spe_write'); }
				
				if(special >= 1){ setOn('#spe_read'); special-=1;				
				}else{ setOff('#spe_read'); }
				
				if(operator >= 4){ setOn('#ope_mem'); operator-=4;
				}else{ setOff('#oper_mem'); }
				
				if(operator >= 2){	setOn('#ope_write'); operator-=2;			
				}else{ setOff('#oper_write'); }
				
				if(operator >= 1){ setOn('#ope_read'); operator-=1;				
				}else{ setOff('#oper_read'); }
 		
    		});
    		
    		function setOn(ele){
    				$(ele).css('background-attachment', 'scroll');
    				$(ele).css('background-clip', 'border-box');
				    $(ele).css('background-color', 'transparent');
				    $(ele).css('background-image', 'url("../bbs/images/toggle.png")');
				    $(ele).css('background-origin', 'padding-box');
				    $(ele).css('background-position', '20px -10px');
    		}
    		
    		function setOff(ele){
    				$(ele).css('background-attachment', 'scroll');
    				$(ele).css('background-clip', 'border-box');
				    $(ele).css('background-color', 'transparent');
				    $(ele).css('background-image', 'url("../bbs/images/toggle.png")');
				    $(ele).css('background-origin', 'padding-box');
				    $(ele).css('background-position', '20px -70px');
    		}
    		
    		
    		
    		$('td').click(function(){
    			
    			var element = $(this).attr('id');
    			var position = $(this).css('background-position');
    			var posi = $(this).css('background-position').substr(5,8);
    			var seper = element.substr(0,3);
    			var auth = element.substr(4,6);
    			
    			
    			var onoff;
    			if(posi == "-10px"){
    				onoff = 'on';
    			}else{
    				onoff = 'off';
    			}
    			
    			var grade;
    			if(seper=='ass'){
    				grade = 'associate_Member_Auth';
    			}else if(seper=='mem'){
    				grade = 'member_Auth';
    			}else if(seper=='spe'){
    				grade = 'special_Member_Auth';
    			}else if(seper=='ope'){
    				grade = 'operator_Member_Auth';
    			}
    				
    			var pl_ma;
    			if(auth=='mem'){
    				pl_ma = 4;
    			}else if(auth=='write'){
    				pl_ma = 2;
    			}else if(auth=='read'){
    				pl_ma = 1;
    			}
    			
    			var sql;
				if(onoff=='on'){
					sql = 'update CommunityRules set '+ grade + ' = ' + grade + '-' +pl_ma +' where community_id =<?php echo $_SESSION['community'];?>';
					$(this).css('background-position' ,'20px -70px');
				}else{
					sql = 'update CommunityRules set '+ grade + ' = ' + grade + '+' +pl_ma +' where community_id =<?php echo $_SESSION['community'];?>';
					$(this).css('background-position' ,'20px -10px');
				}
    			
    			var jsonstr = JSON.stringify({
					sql : sql 
					});
				//alert(jsonstr);	
		 		$.post("../bbs/changeAuth.php", { jsonstr:jsonstr });
    			
    			//   4        2     1
    			// asso_mem write read
			    // mem_mem
			    // spe_mem
			    // oper_mem	
    			
    			
    		});
		</script>


