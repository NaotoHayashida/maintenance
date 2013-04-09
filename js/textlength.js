$(function(){
  var titlemax =80;
  var commentmax =256;
  var anchormax=30;

$(document).ready(function(){
   var value=$('.gyojikubun option:selected').val();
   if(value!="" && value != 2){
   $('.anchor').removeAttr('disabled');
   }else{
   $('.anchor').attr('disabled','disabled');
   }
});
//行事区分
	$('.gyojikubun').bind('keydown keyup keypress change',function(){
	var value=$('.gyojikubun option:selected').val();
   if(value==''){$('.gyojikubun').css({background:'#ff6666'});
   $('.gyojicomment').html("行事区分を選択してください！");
   $('.button').attr('disabled','disabled');
	$('.button').css({background:'#eeeeee'});
   $('.button-pre').attr('disabled','disabled');
	$('.button-pre').css({background:'#eeeeee'});
   $('.title').attr('disabled','disabled');
	$('.title').css({background:'eeeeee'});
   $('.anchor').attr('disabled','disabled');
	$('.anchor').css({background:'#eeeeee'});
   $('.comment').attr('disabled','disabled');
	$('.comment').css({background:'#eeeeee'});
   }

   else{$('.gyojikubun').css({background:'#ffffff'});
   $('.gyojicomment').html(" ");
   $('.button').removeAttr('disabled');
	$('.button').css({background:'#ffffff'});
   $('.button-pre').removeAttr('disabled');
	$('.button-pre').css({background:'#ffffff'});
   $('.title').removeAttr('disabled');
	$('.title').css({background:'#ffffff'});
   $('.anchor').removeAttr('disabled');
	$('.anchor').css({background:'#ffffff'});
   $('.comment').removeAttr('disabled');
	$('.comment').css({background:'#ffffff'});
   }
   
   if(value!="" && value != 2){
   $('.anchor').removeAttr('disabled');
	$('.anchor').css({background:'#ffffff'});
   }else{
   $('.anchor').attr('disabled','disabled');
	$('.anchor').css({background:'#eeeeee'});
   }

});

//タイトル
   	$('textarea.title').bind('keydown keyup keypress change',function(){
		var titleValueLength = $(this).val().length;
		var countdowntitle= (titlemax)-(titleValueLength);
		   $('.counttitle').html(countdowntitle);
   if(countdowntitle<0){$('.title').css({background:'#ff6666'});
   $('.titletext').html("入力文字数をオーバーしています！");
   $('.button').attr('disabled','disabled');
	$('.button').css({background:'#eeeeee'});
   $('.button-pre').attr('disabled','disabled');
	$('.button-pre').css({background:'#eeeeee'});
   $('.gyojikubun').attr('disabled','disabled');
	$('.gyojikubun').css({background:'#eeeeee'});
   $('.anchor').attr('disabled','disabled');
	$('.anchor').css({background:'#eeeeee'});
   $('.comment').attr('disabled','disabled');
	$('.comment').css({background:'#eeeeee'});
   }
   else{$('.title').css({background:'#ffffff'});
   $('.titletext').html(" ");
   $('.button').removeAttr('disabled');
	$('.button').css({background:'#ffffff'});
   $('.button-pre').removeAttr('disabled');
	$('.button-pre').css({background:'#ffffff'});
   $('.gyojikubun').removeAttr('disabled');
	$('.gyojikubun').css({background:'#ffffff'});
   $('.anchor').removeAttr('disabled');
	$('.anchor').css({background:'#ffffff'});
   $('.comment').removeAttr('disabled');
	$('.comment').css({background:'#ffffff'});

var value=$('.gyojikubun option:selected').val();
   if(value!="" && value != 2){
   $('.anchor').removeAttr('disabled');
	$('.anchor').css({background:'#ffffff'});
   }else{
   $('.anchor').attr('disabled','disabled');
	$('.anchor').css({background:'#eeeeee'});
   }


   }
});

//ｺﾒﾝﾄ
	$('textarea.comment').bind('keydown keyup keypress change',function(){
		var commentValueLength = $(this).val().length;
    var countdown= (commentmax)-(commentValueLength);
		   $('.countcomment').html(countdown);
   if(countdown<0){$('.comment').css({background:'#ff6666'});
   $('.commenttext').html("入力文字数をオーバーしています！");
   $('.button').attr('disabled','disabled');
	$('.button').css({background:'#eeeeee'});
   $('.button-pre').attr('disabled','disabled');
	$('.button-pre').css({background:'#eeeeee'});
   $('.gyojikubun').attr('disabled','disabled');
	$('.gyojikubun').css({background:'#eeeeee'});
   $('.anchor').attr('disabled','disabled');
	$('.anchor').css({background:'#eeeeee'});
   $('.title').attr('disabled','disabled');
	$('.title').css({background:'#eeeeee'});
   }
   else{$('.comment').css({background:'#ffffff'});
   $('.commenttext').html(" ");
   $('.button').removeAttr('disabled');
	$('.button').css({background:'#ffffff'});
   $('.button-pre').removeAttr('disabled');
	$('.button-pre').css({background:'#ffffff'});
   $('.gyojikubun').removeAttr('disabled');
	$('.gyojikubun').css({background:'#ffffff'});
   $('.anchor').removeAttr('disabled');
	$('.anchor').css({background:'#ffffff'});
   $('.title').removeAttr('disabled');
	$('.title').css({background:'#ffffff'});

var value=$('.gyojikubun option:selected').val();
   if(value!="" && value != 2){
   $('.anchor').removeAttr('disabled');
	$('.anchor').css({background:'#ffffff'});
   }else{
   $('.anchor').attr('disabled','disabled');
	$('.anchor').css({background:'#eeeeee'});
   }


   }
});

//段落
	$('input.anchor').bind('keydown keyup keypress change',function(){
		var anchorValueLength = $(this).val().length;
    var countdownanchor= (anchormax)-(anchorValueLength);
		   $('.countanchor').html(countdownanchor);
   if(countdownanchor<0){$('.anchor').css({background:'#ff6666'});
   $('.anchortext').html("入力文字数をオーバーしています！");
   $('.button').attr('disabled','disabled');
	$('.button').css({background:'#eeeeee'});
   $('.button-pre').attr('disabled','disabled');
	$('.button-pre').css({background:'#eeeeee'});
   $('.gyojikubun').attr('disabled','disabled');
	$('.gyojikubun').css({background:'#eeeeee'});
   $('.comment').attr('disabled','disabled');
	$('.comment').css({background:'#eeeeee'});
   $('.title').attr('disabled','disabled');
	$('.title').css({background:'#eeeeee'});
   }
   else{$('.anchor').css({background:'#ffffff'});
   $('.anchortext').html(" ");
   $('.button').removeAttr('disabled');
	$('.button').css({background:'#ffffff'});
   $('.button-pre').removeAttr('disabled');
	$('.button-pre').css({background:'#ffffff'});
   $('.gyojikubun').removeAttr('disabled');
	$('.gyojikubun').css({background:'#ffffff'});
   $('.title').removeAttr('disabled');
	$('.title').css({background:'#ffffff'});
   $('.comment').removeAttr('disabled');
	$('.comment').css({background:'#ffffff'});
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