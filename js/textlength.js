$(function(){
  var titlemax =80;
  var commentmax =256;
  var anchormax=30;

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
   }
   else{$('.comment').css({background:'#ffffff'});
   $('.button').removeAttr('disabled');
   $('.button-pre').removeAttr('disabled');
   $('.title').removeAttr('disabled');
   $('.anchor').removeAttr('disabled');
   }
});

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
   }
   else{$('.title').css({background:'#ffffff'});
   $('.button').removeAttr('disabled');
   $('.button-pre').removeAttr('disabled');
   $('.comment').removeAttr('disabled');
   $('.anchor').removeAttr('disabled');
   }
});

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
   }
   else{$('.anchor').css({background:'#ffffff'});
   $('.button').removeAttr('disabled');
   $('.button-pre').removeAttr('disabled');
   $('.comment').removeAttr('disabled');
   $('.title').removeAttr('disabled');
   }
	});
});