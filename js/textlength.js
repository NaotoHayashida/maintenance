$(function(){
  var titlemax =80;
  var commentmax =256;
  var anchormax=30;
var value=$('.gyojikubun option:selected').val();

//行事区分
	$('.gyojikubun').bind('keydown keyup keypress change',function(){
	var value=$('.gyojikubun option:selected').val();
   if(value==''){$('.gyojikubun').css({background:'#ffcccc'});
   $('.gyojicomment').html("行事区分を選択してください！");
   $('.button').attr('disabled','disabled');
   $('.button-pre').attr('disabled','disabled');
   $('.title').attr('disabled','disabled');
   $('.anchor').attr('disabled','disabled');
   $('.comment').attr('disabled','disabled');
   }

   else{$('.gyojikubun').css({background:'#ffffff'});
   $('.gyojicomment').html(" ");
   $('.button').removeAttr('disabled');
   $('.button-pre').removeAttr('disabled');
   $('.title').removeAttr('disabled');
   $('.anchor').removeAttr('disabled');
   $('.comment').removeAttr('disabled');
   }
   
   if(value == 3){
   $('.anchor').removeAttr('disabled');
   }else{
   $('.anchor').attr('disabled','disabled');
   }

});

//タイトル
   	$('textarea.title').bind('keydown keyup keypress change',function(){
		var titleValueLength = $(this).val().length;
		var countdowntitle= (titlemax)-(titleValueLength);
		   $('.counttitle').html(countdowntitle);
   if(countdowntitle<0){$('.title').css({background:'#ffcccc'});
   $('.counttitle').html("入力文字数をオーバーしています！");
   $('.button').attr('disabled','disabled');
   $('.button-pre').attr('disabled','disabled');
   $('.comment').attr('disabled','disabled');
   $('.anchor').attr('disabled','disabled');
   $('.gyojikubun').attr('disabled','disabled');
   }
   else{$('.title').css({background:'#ffffff'});
   $('.button').removeAttr('disabled');
   $('.button-pre').removeAttr('disabled');
   $('.comment').removeAttr('disabled');
   $('.anchor').removeAttr('disabled');
   $('.gyojikubun').removeAttr('disabled');

var value=$('.gyojikubun option:selected').val();
   if(value == 3){
   $('.anchor').removeAttr('disabled');
   }else{
   $('.anchor').attr('disabled','disabled');
   }

   }
});

//ｺﾒﾝﾄ
	$('textarea.comment').bind('keydown keyup keypress change',function(){
		var commentValueLength = $(this).val().length;
    var countdown= (commentmax)-(commentValueLength);
		   $('.countcomment').html(countdown);
   if(countdown<0){$('.comment').css({background:'#ffcccc'});
   $('.countcomment').html("入力文字数をオーバーしています！");
   $('.button').attr('disabled','disabled');
   $('.button-pre').attr('disabled','disabled');
   $('.title').attr('disabled','disabled');
   $('.anchor').attr('disabled','disabled');
   $('.gyojikubun').attr('disabled','disabled');
   }
   else{$('.comment').css({background:'#ffffff'});
   $('.button').removeAttr('disabled');
   $('.button-pre').removeAttr('disabled');
   $('.title').removeAttr('disabled');
   $('.anchor').removeAttr('disabled');
   $('.gyojikubun').removeAttr('disabled');

var value=$('.gyojikubun option:selected').val();
   if(value == 3){
   $('.anchor').removeAttr('disabled');
   }else{
   $('.anchor').attr('disabled','disabled');
   }

   }
});

//段落
	$('input.anchor').bind('keydown keyup keypress change',function(){
		var anchorValueLength = $(this).val().length;
    var countdownanchor= (anchormax)-(anchorValueLength);
		   $('.countanchor').html(countdownanchor);
   if(countdownanchor<0){$('.anchor').css({background:'#ffcccc'});
   $('.countanchor').html("入力文字数をオーバーしています！");
   $('.button').attr('disabled','disabled');
   $('.button-pre').attr('disabled','disabled');
   $('.comment').attr('disabled','disabled');
   $('.title').attr('disabled','disabled');
   $('.gyojikubun').attr('disabled','disabled');
   }
   else{$('.anchor').css({background:'#ffffff'});
   $('.button').removeAttr('disabled');
   $('.button-pre').removeAttr('disabled');
   $('.comment').removeAttr('disabled');
   $('.title').removeAttr('disabled');
   $('.gyojikubun').removeAttr('disabled');
   }
	});

//チェックボックス
	$("input[type='checkbox']").click(function(){
	var chk_new = $('.k_new').is(':checked');
	var chk_cal = $('.k_cal').is(':checked');
	if(chk_new == true){$("input[type='checkbox']").attr('checked','checked');
	}

	});


});