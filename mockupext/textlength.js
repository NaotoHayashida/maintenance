$(function(){
  var max =80;
	$('textarea.comment').bind('keydown keyup keypress change',function(){
		var commentValueLength = $(this).val().length;
    var countdown= (max)-(commentValueLength);
		   $('.countcomment').html(countdown);
   if(countdown<0){$('.comment').css({background:'#ffcccc'});
   $('.countcomment').html("入力文字数をオーバーしています！");
   $('.button').attr('disabled','disabled');
   $('.button-pre').attr('disabled','disabled');
   $('.title').attr('disabled','disabled');
   }
   else{$('.comment').css({background:'#ffffff'});
   $('.button').removeAttr('disabled');
   $('.button-pre').removeAttr('disabled');
   $('.title').removeAttr('disabled');
   }
});
   	$('textarea.title').bind('keydown keyup keypress change',function(){
		var titleValueLength = $(this).val().length;
    var countdowntitle= (max)-(titleValueLength);
		   $('.counttitle').html(countdowntitle);
   if(countdowntitle<0){$('.title').css({background:'#ffcccc'});
   $('.counttitle').html("入力文字数をオーバーしています！");
   $('.button').attr('disabled','disabled');
   $('.button-pre').attr('disabled','disabled');
   $('.comment').attr('disabled','disabled');
   }
   else{$('.title').css({background:'#ffffff'});
   $('.button').removeAttr('disabled');
   $('.button-pre').removeAttr('disabled');
   $('.comment').removeAttr('disabled');
   }

	});
});