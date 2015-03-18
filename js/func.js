//user-id の読み込み
jQuery(window).load(function () {
	var uid = getCookie("uid");
	jQuery("#fb-root").attr("uid",uid) ;
	jQuery(".comment-box").css("display","none") ;


	// JavaScript SDKの読み込み
	var e = document.createElement('script'); e.async = true;
	e.src = document.location.protocol +　'//connect.facebook.net/ja_JP/all.js';
	document.getElementById('fb-root').appendChild(e);

	// JavaScript SDKの読み込みが終わったら実行される処理
	window.fbAsyncInit = function(){
		FB.init({
			//appId: '911848368876980',//www
			appId: '911875418874275',//local
			status: true,
			cookie: true,
      			version    : 'v2.2',
			xfbml: true
		});
	
		// Facebookにログイン中か判定
		FB.getLoginStatus(function(response){
			if(response.authResponse){
				jQuery('.before-login-element').hide();
				jQuery('.after-login-element').show();
				// ログイン中のアカウントの情報を取得する
				var request = 'me';
				FB.api(request, function(response) {
					var uid = response["id"];
					document.cookie = 'uid=' + encodeURIComponent(uid);
					jQuery("#fb-root").attr("uid",uid);
				});
			}else{
				jQuery('.after-login-element').hide();
				jQuery('.before-login-element').show();
				document.cookie = 'uid=' + encodeURIComponent(0);

			}
		});
	};

	// ログインボタンが押されたらログインウィドウを表示
	jQuery('.login-btn').click(function(){
		FB.login(function(response){
			if(response.authResponse){
				jQuery('.before-login-element').hide();
				jQuery('.after-login-element').show();
				document.cookie = 'uid=' + encodeURIComponent(uid);
			}
		});
	});

	// ログアウトボタンが押されたらログアウトする
	jQuery('.logout-btn').click(function(){
		FB.logout(function(response){
			jQuery('.after-login-element').hide();
			jQuery('.before-login-element').show();
			document.cookie = 'uid=' + encodeURIComponent(0);

		});
	});
	//要素の肉付け
	addReleaseBody();
});

//data-idの付いた要素にurlを持たせるファンクション
jQuery(document).on("click",'.link',function(){
	location.href = jQuery(this).attr("data-url") ;
	//location.href = jQuery(this).attr("data-url") + "?uid="+ jQuery("#fb-root").attr("uid");
});

//スクラップ
jQuery(document).on("click",'.scrap',function(){
	var scrap = jQuery(this);
	var rid = scrap.closest(".release").attr("release-id");
	var uid = jQuery("#fb-root").attr("uid");
	var type = "r_scrap";

	jQuery.ajax({
		url: '../ajax/scrap.php',
		type:'POST',
		dataType: 'json',
		data : {'rid': rid,'uid':uid,'type':type},
		timeout:1000,
		success: function(data) {
			
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
		}
	});
});

//クラップ
jQuery(document).on("click",'.clap',function(){
	var clap = jQuery(this);
	var rid = clap.closest(".release").attr("release-id");
	var uid = jQuery("#fb-root").attr("uid");
	var type = "r_clap";

	jQuery.ajax({
		url: '../ajax/scrap.php',
		type:'POST',
		dataType: 'json',
		data : {'rid': rid,'uid':uid,'type':type},
		timeout:1000,
		success: function(data) {
			
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
		}
	});
});

//コメント欄の表示・非表示
 jQuery(document).on("click",".mycomment",function(){
	var rid = jQuery(this).closest(".release").attr("release-id");
    	var id  = "#comment-box-" + rid;
	jQuery(id).toggle();
 });


function addReleaseBox(repeat){
	jQuery.ajax({
		url: '../ajax/get_release_box.php',
		type:'POST',
		dataType: 'json',
		data : {'repeat': repeat},
		timeout:1000,
		success: function(data) {
			console.log(data);
		  if(data !== ""){
		    var makeReleaseBox = jQuery.when(
		    	jQuery(".release-box").html(data)
		    	);
		    makeReleaseBox.done(function() {
		    	addReleaseBody();
		    });
		  }
		  else{
		    alert("Error!");
		  }
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
		}
	});
}
function addReleaseId4Scrap(){
	//release-idの付与
	jQuery(".scrap-rid-add").each(function(j){
		var target = jQuery(this);
		var page = 1;
		jQuery.ajax({
			url: '../ajax/get_release_id.php',
			type:'POST',
			dataType: 'json',
			data : {'page': page,'num': j},
			timeout:1000,
			success: function(data) {
			  if(data !== ""){
			  	console.log(data);
			    // var addReleaseId  = jQuery.when(
			    // 	target.attr("release-id",data[0]["rid"])
			    // 	);
			    // addReleaseId.done(function(){
			    // 	addReleaseBody();
			    //});

			  }
			  else{
			    alert("Error!");
			  }
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
			}
		});
	});
}
function addReleaseBody(){
	//release-idの読み込み
	jQuery(".release").each(function(i){
		var release = jQuery(this);
		var rid = parseInt(release.attr("release-id"));
		if(rid > 0 ){
			//console.log(rid);
			/*記事の読み込み*/
			jQuery.ajax({
				url: '../ajax/get_release.php',
				type:'POST',
				dataType: 'json',
				data : {'rid': rid},
				timeout:1000,
				success: function(data) {
				    //console.log(data);
				  if(data !== ""){
				    release.find(".title").html(data["title"]);
				    release.find(".cname").html(data["cname"]);
				    release.find(".time").html(data["time"]);
				    release.find(".body").html(data["body"]);
				    release.find(".previous_release").attr("href",location.pathname + "?rid=" + data["previous"]);
				    release.find(".next_release").attr("href",location.pathname + "?rid=" + data["next"]);
				    if(data !== ""){release.find(".img1").attr("src",data["img1"]);}
				    if(data !== ""){release.find(".img2").attr("src",data["img2"]);}
				    if(data !== ""){release.find(".img3").attr("src",data["img3"]);}
				    if(data !== ""){release.find(".img4").attr("src",data["img4"]);}
				    if(data !== ""){release.find(".img5").attr("src",data["img5"]);}
				　var uid = getCookie("uid");
				    if(uid > 0){release.find(".my-pic").attr("src","https://graph.facebook.com/" + uid + "/picture");}
				  }
				  else{
				    alert("Error!");
				  }
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
				}
			});
	  	}else{
	  		release.remove();
	  	}
	});
}
function getCookie(name)
{
    var result = null;
    var cookieName = name + '=';
    var allcookies = document.cookie;
    var position = allcookies.indexOf( cookieName );
    if( position != -1 )
    {
        var startIndex = position + cookieName.length;
        var endIndex = allcookies.indexOf( ';', startIndex );
        if( endIndex == -1 )
        {
            endIndex = allcookies.length;
        }
        result = decodeURIComponent(
            allcookies.substring( startIndex, endIndex ) );
    }
    return result;
}