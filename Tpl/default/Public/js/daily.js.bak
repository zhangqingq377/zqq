$(function() {
	$(".meeting_theme").click(function(){
		var meeting_id=$(this).parent().attr('name');
		//alert(meeting_id);
		$.ajax({
			type:"post",
			url:"getDetail",
			dataType:"json",
			data:"meeting_id="+meeting_id,
			complete:function(){
			},success:function(data){
				var result=eval(data);
				if(result['data']==null){
					alert("系统发生错误！");
				}else{
					//alert("here");
					$('#title').text(result['data']['meeting_theme']);
					$('#settime').text(result['data']['meeting_posttime']);
					$('#meet-post').text(result['data']['user_name']);
					$('#meet-theme').text(result['data']['meeting_theme']);
					$('#meet-host').text(result['data']['user_name']);
					$('#meet-content').text(result['data']['meeting_content']);
					$('#meet-room').text(result['data']['room_name']);
					$('#meet-start').text(result['data']['meeting_starttime']);
					$('#meet-stop').text(result['data']['meeting_stoptime']);
					$('.main-management').css("display","none");
					$('.meeting-detail').css("display","block");
				}
			}
		});
	});
	$(".getmeetlist").click(function(){
		$('.main-management').css("display","block");
		$('.meeting-detail').css("display","none");
	});
	$(".usecar").click(function(){
		if($(this).parent().prev().text()=='空闲'){
			var number = $(this).parent().prev().prev().prev().text();
			$.ajax({
				type:"post",
				url:"useCar",
				dataType:"json",
				data:"number="+number,
				complete:function(){
					window.location.href="";
				},success:function(data){
				}
			});
		}else{
			alert("该车辆非空闲状态，请稍后再试！");
		}
	});
});

function upload(){
	$('#upload-view').dialog('open');
}