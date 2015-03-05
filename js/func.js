//user-id の読み込み
jQuery(window).load(function () {
var uid = parseInt(jQuery("#uid").attr("user-id")); 
//console.log(uid); 
	//release-idの読み込み
	jQuery(".release").each(function(i){
		var release = jQuery(this);
		var rid = parseInt(release.attr("release-id"));
		if(rid != "" ){
			//console.log(rid);
			/*記事の読み込み*/
			$.ajax({
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
				    release.find(".body").html(data["body"]);
				    release.find(".previous_release").attr("href",location.pathname + "?rid=" + data["previous"]);
				    release.find(".next_release").attr("href",location.pathname + "?rid=" + data["next"]);
				    release.find(".img1").attr("src",data["img1"]);
				    release.find(".img2").attr("src",data["img2"]);
				    release.find(".img3").attr("src",data["img3"]);
				    release.find(".img4").attr("src",data["img4"]);
				    release.find(".img5").attr("src",data["img5"]);
				  }
				  else{
				    alert("Error!");
				  }
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
				}
			});
			/*コメントの読み込み*/
			$.ajax({
				url: '../ajax/get_comment_from_rid.php',
				type:'POST',
				dataType: 'json',
				//data : {'rid': rid},
				data : {'rid': 813524},
				timeout:1000,
				success: function(data) {
				    //console.log(data);
				  if(data !== ""){
				  	for (var i = 0; i < data.length; i++) {
				  		console.log(data[i]["comment"]);
				  		var single_comment =	"<div class=\"single-comment\">";
						single_comment +=		"<div class=\"comment-author\">";
						single_comment +=						"<img src=\"http://placehold.it/60x60\" class=\"avatar\" alt=\"\">";
						single_comment +=						"<cite><a href=\"#\">Mark Robben</a></cite>";
						single_comment +=						"<span class=\"says\">says:</span>";
						single_comment +=					"</div><!-- comment-author -->";
						single_comment +=					"<div class=\"comment-meta\">";
						single_comment +=						"<time datetime=\"2013-03-23 19:58\">March 23, 2013 at 7:58 pm</time> / <a href=\"#\" class=\"reply\">Reply</a>";
						single_comment +=					"</div><!-- comment-meta -->";
						single_comment +=					"<p>" + data[i]["comment"] + "</p>";
						single_comment +=				"</div><!-- single-comment -->";
				  		release.find(".comment-list").html(single_comment);

				  	};
				  }
				  else{
				    alert("Error!");
				  }
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
				}
			});
	  	}
	});
});



// var prcid = 1;
// //ぺーじを読み込んだら起動
//   //いいねボタンの色変化
//   jQuery(window).load(function () {
//     jQuery(".agood-btn").each(function(i){
//       var aid = jQuery(this).data("id");
//       var uid = jQuery("#uid").data("id");
//       //console.log(aid);
//       jQuery.ajax({
//         url: '/agood_status.php',
//         type:'POST',
//         dataType: 'json',
//         data : {aid: aid, uid : uid},
//         timeout:10000,
//         success: function(data) {
//           if(data['status'] == 'success'){
//             var id = "#agood-" + aid;
//             jQuery(id).parent().css("color", "#0091FF");
//           }
//           else{
//             //alert(data["status"]);
//           }
//         },
//         error: function(XMLHttpRequest, textStatus, errorThrown) {
//             //alert(data["status"]);
//         }
//       });
//   //お気に入りボタンの色変化
//       jQuery.ajax({
//         url: '/afavorite_status.php',
//         type:'POST',
//         dataType: 'json',
//         data : {aid: aid, uid : uid},
//         timeout:10000,
//         success: function(data) {
//           if(data['status'] == 'success'){
//             var id = "#afavorite-" + aid;
//             jQuery(id).parent().css("color", "#FF9100");
//           }
//           else{
//             //alert(data["status"]);
//           }
//         },
//         error: function(XMLHttpRequest, textStatus, errorThrown) {
//             //alert(data["status"]);
//         }
//       });
//     });
//   // //FB画像読み込み
//   //   jQuery(".article_img_box").each(function(i){
//   //     var url = jQuery(this).data("url");
//   //     if(url != ""){
//   //       jQuery(this).append('<img src=' + url + ' class='img-rounded' alt=''>');
//   //     }
//   //   });
//   //記事の画像読み込み
//     jQuery(".article_img_box").each(function(i){
//       var url = jQuery(this).data("url");
//       if(url != ""){
//         jQuery(this).append('<a href="' + url + '" target="_blank"><img src="' + url + '" alt="" style="width:90px; height:90px;"></a>');
//       }
//     });
//   });
// /*記事お気に入り*/
//   jQuery(document).on("click",'.afavorite-btn',function() {
//     var aid = jQuery(this).data("id");
//     var uid = jQuery("#uid").data("id");
//     var prcid = 1;
//     jQuery.ajax({
//       url: '/favorite_article.php',
//       type:'POST',
//       dataType: 'json',
//       data : {aid: aid, uid : uid},
//       timeout:10000,
//       success: function(data) {
//         if(data['status'] == 'success'){
//           aritcle_favorite_add(aid,prcid,uid);
//         }
//         else if(data['status'] == 'delete'){
//           aritcle_favorite_remove(aid);
//         }
//         else{
//           //alert(data["status"]);
//         }
//       },
//       error: function(XMLHttpRequest, textStatus, errorThrown) {
//           //alert(data["status"]);
//       }
//     });
//   });
// //記事お気に入り数追加
//   function aritcle_favorite_add(aid,prcid,uid) {
//     var id = "#afavorite-" + aid;
//     //var favoriteNum = Number(jQuery(id).text()) + 1;
//     //jQuery(id).text(favoriteNum);
//     jQuery(id).parent().css("color", "#FF9100");
//   }
// //記事お気に入り数除去
//   function aritcle_favorite_remove(aid) {
//     var id = "#afavorite-" + aid;
//     //var favoriteNum = Number(jQuery(id).text()) - 1;
//     //jQuery(id).text(favoriteNum);
//     jQuery(id).parent().css("color", "");
//   }
// /*検索*/
//   jQuery(document).on("click",'.search-btn',function(){
//     var words = jQuery("#search-input").val()
//     location.href="/index.php?words=" + words;
//   })
//   jQuery(document).on('keypress','.search-form-control',function (e) {
//     if(e.keyCode == 13) {
//       var words = jQuery("#search-input").val();
//       location.href="/index.php?words=" + words;
//     }
//   });
// /*記事良いね*/
//   jQuery(document).on("click",'.agood-btn',function() {
//     var aid = jQuery(this).data("id");
//     var uid = jQuery("#uid").data("id");
//     var prcid = 1;
//       jQuery.ajax({
//           url: 'good_article.php',
//           type:'POST',
//           dataType: 'json',
//           data : {aid: aid, uid : uid},
//           timeout:10000,
//           success: function(data) {
//             if(data['status'] == 'success'){
//               aritcle_good_add(aid,prcid);
//             }
//             else if(data['status'] == 'delete'){
//               aritcle_good_remove(aid);
//             }
//             else{
//               //alert(data["status"]);
//             }
//           },
//           error: function(XMLHttpRequest, textStatus, errorThrown) {
//           }
//       });
//   });
// //記事イイネ数追加
//   function aritcle_good_add(aid,prcid) {
//     var id = "#agood-" + aid;
//     var goodNum = Number(jQuery(id).text()) + 1;
//     jQuery(id).text(goodNum);
//     jQuery(id).parent().css("color", "#0091FF");
//   }
// //記事イイネ数除去
//   function aritcle_good_remove(aid) {
//     var id = "#agood-" + aid;
//     var goodNum = Number(jQuery(id).text()) - 1;
//     jQuery(id).text(goodNum);
//     jQuery(id).parent().css("color", "");
//   }
// /*コメント投稿*/
//   jQuery(document).on("click",'.comment-submit',function() {
//       var aid = this.id;
//       var commentInput = ':text[name="' + aid + '"]';
//       var comment = jQuery(commentInput).val();
//     if(comment.length > 140){
//       alert("投稿できる文字数は１４０文字までです");
//     }else{
//       var uid = jQuery("#uid").data("id");
//       postComment(aid,comment,uid);
//     }
//   });
//   jQuery(document).on('keypress','.comment-form-control',function (e) {
//     if(e.keyCode == 13) {
//       var aid = this.name;
//       var commentInput = ':text[name="' + aid + '"]';
//       var comment = jQuery(commentInput).val();
//       if(comment.length > 140){
//         alert("投稿できる文字数は１４０文字までです");
//       }else{
//         var uid = jQuery("#uid").data("id");
//         postComment(aid,comment,uid);
//         e.preventDefault();
//       }
//     }
//   });
//   function postComment(aid,comment,uid){
//     jQuery.ajax({
//       url: 'post_comment.php',
//       type:'POST',
//       dataType: 'json',
//       data : {aid : aid, uid : uid, comment : comment },
//       timeout:10000,
//       success: function(data) {
//         if(data['status'] == 'success'){
//           var commentAreaId = "comment_aid_" + aid;
//           var element = document.createElement('div');
//           element.id = "comment_cid_" + data.cid;
//           var att = document.createAttribute("class");
//           att.value = "comment_box";
//           element.setAttributeNode(att);
//           var deleteBtn = "<div class='comment_delete'><span id='" + data.cid + "' class='delete glyphicon glyphicon-remove-circle' aria-hidden='true'></span></div>";
//           var content = "<div class='comment_img' data-url='./index.php?mypageid=" + uid + "'><img src='https://graph.facebook.com/" + uid + "/picture' class='img-rounded' alt=''></div>";
//           var postCommentBody = "<div class='comment_body'><span id='comment_body_cid_" + data.cid + "'>" + comment + "</span></div>";
//           var postCommentTime = "<div class='comment_time'><span><span class='glyphicon glyphicon-time' aria-hidden='true'></span>now!</span></div>";
//           var postComment = "<div class='comment_text'>" + postCommentBody + postCommentTime + "</div>";
//           element.innerHTML = content + postComment + deleteBtn;
//           var objTextarea = document.getElementById(commentAreaId);
//           objTextarea.insertBefore(element,objTextarea.firstChild);
//           jQuery('input').val('');
//           jQuery('.comment-input-group').hide(500);
//           jQuery('.comment-btn').css('color','');
//           //プッシュ通知用
//             // var uid = jQuery("#uid").data("id");
//             var status = 3;
//             var prcid = 1;
//             jQuery.ajax({
//               url: '/push.php',
//               type:'POST',
//               dataType: 'json',
//               data : {aid: aid, prcid: prcid, uid: uid, status: status},
//               timeout:10000
//             });
//         }else{
//           //alert(data['status']);
//         }
//       },
//       error: function(XMLHttpRequest, textStatus, errorThrown) {
//         //alert("エラー");
//       }
//     });
//   }
// /*コメント削除*/
//   jQuery(document).on("click",'.delete',function() {
//     var cid = this.id;
//     var uid = jQuery("#uid").data("id");
//     var aid = jQuery(this).parent().parent().parent().parent().data("id");
//     var status = 3;
//     var prcid = 1;

//     if(window.confirm('削除しますか？')){
//       jQuery.ajax({
//           url: 'delete_comment.php',
//           type:'POST',
//           dataType: 'json',
//           data : {cid: cid, uid : uid},
//           timeout:10000,
//           success: function(data) {
//             var id = "comment_cid_" + cid;
//             document.getElementById(id).remove();
//             jQuery.ajax({
//               url: 'delete_notice.php',
//               type:'POST',
//               dataType: 'json',
//               data : {aid: aid, prcid: prcid, uid: uid, status: status},
//               timeout:10000,
//               success: function(data) {
//                 //alert(data);
//               }
//             });  
//           },
//           error: function(XMLHttpRequest, textStatus, errorThrown) {
//             //alert("エラー");
//           }
//       });
//     }
//   });
// /*詳細ポップアップ*/
//   jQuery(document).on("click",'.specific',function() {
//     var aid = this.id;
//     var id = "specific_" + aid;
//     jQuery.ajax({
//       url: "get_article.php",
//       type:'GET',
//       dataType: 'json',
//       data : {relID : aid},
//       async: false,
//       timeout:10000,
//       success: function(data) {
//         if(!document.getElementById("article_" + aid)){
//           var article = data;
//           var element = document.createElement('div');
//           element.id = "article_" + aid;
//           var link = "<a href='http://release.nikkei.co.jp/detail.cfm?relID=" + aid + "'><br>...続きはこちら</a>";
//           element.innerHTML = article + link;
//           element.style.margin = "20px";
//           element.style.height = "550px";
//           var objTextarea = document.getElementById(id);
//           objTextarea.appendChild(element);
//         }
//       },
//       error: function(XMLHttpRequest, textStatus, errorThrown) {
//         //alert("エラー");
//       }
//     });
//   });
// //記事欄色変化
//   jQuery(function(){
//     jQuery(".article")
//       .mouseover(function(){
//         jQuery(this).css('background', '#E1E8ED');
//       })
//       .mouseout(function(){
//         jQuery(this).css('background', 'white');
//       })
//   });
// //ページトップボタン
//   jQuery(function() {
//       var topBtn = jQuery('#page-top');
//       topBtn.hide();
//       //スクロールが100に達したらボタン表示
//       jQuery(window).scroll(function () {
//           if (jQuery(this).scrollTop() > 100) {
//               topBtn.fadeIn();
//           } else {
//               topBtn.fadeOut();
//           }
//       });
//       //スクロールしてトップ
//       jQuery(document).on("click","#page-top",function () {
//           jQuery('body,html').animate({
//               scrollTop: 0
//           }, 500);
//           return false;
//       });
//   });
// //マイページへリンク
//   jQuery(document).on("click",'.comment_img',function(){
//     location.href = jQuery(this).attr("data-url");
//   });
// //コメント欄表示
//   jQuery(function() {
//     var input = jQuery('.comment-input-group');
//     input.hide();
//     jQuery(document).on("click",".comment-btn",function () {
//       jQuery('.comment-input-group').hide(500);
//       jQuery('.comment-btn').css('color','');
//       var pencil = jQuery(this);
//       var aid = jQuery(this).data("id");
//       var inputForm = "input-group-" + aid;
//       jQuery("#" + inputForm).show(1000);
//       jQuery(pencil).css("color","#91FF00");
//       // jQuery('.input-group').hide(500);
//       // jQuery('.comment-btn').css('color','');
//       // var pencil = jQuery(this);
//       // var aid = jQuery(this).data("id");
//       // var inputForm = "input-group-" + aid;
//       // if(pencilFlg == 0){
//       //   jQuery("#" + inputForm).show(1000);
//       //   jQuery(pencil).css("color","#91FF00");
//       //   pencilFlg = 1;
//       // }else if(pencilFlg == 1){
//       //   jQuery("#" + inputForm).show(500);
//       //   jQuery(pencil).css("color","");
//       //   pencilFlg = 0;
//       // }
//     });
//   });
// var row = 10;//表示されている記事数
// var num = 5;//読み込む記事数
// var uid = jQuery("#uid").data("id");
// //記事スクロール読み込み
// $(window).on("scroll", function() {
//   var scrollHeight = $(document).height();
//   var scrollPosition = $(window).height() + $(window).scrollTop();
//   if ((scrollHeight - scrollPosition) / scrollHeight == 0.00 && jQuery("#scroll").data("id") == true) {
//     //ajaxで記事の読み込み
//     //とりあえずpageを渡す
//     //appendchild で付け足し
    
//     jQuery.ajax({
//       url: '/append_article.php',
//       type:'POST',
//       dataType: 'json',
//       data : {row: row, num: num},
//       timeout:1000,
//       success: function(data) {
//         //console.log(data.articles.aid);
//         for (var k = 0; k < num; k++){
//           console.log(data.articles[k].aid);
//           if(data.articles[k].aid >= 1){
//             jQuery.ajax({
//               url: '/append_article_body.php',
//               type:'POST',
//               dataType: 'json',
//               data : {
//                         uid: uid,
//                         title: data.articles[k].title, 
//                         aid: data.articles[k].aid,
//                         url: data.articles[k].url,
//                         cname: data.articles[k].cname,
//                         sid: data.articles[k].sid,
//                         img1: data.articles[k].img1,
//                         img2: data.articles[k].img2,
//                         img3: data.articles[k].img3,
//                         img4: data.articles[k].img4,
//                         img5: data.articles[k].img5,
//                         good: data.articles[k].good
//                       },
//               timeout:1000,
//               success: function(data) {
//                 row = num + row;
//                 var appendArticle = document.createElement('div'); 
//                 appendArticle.className = 'article';
//                 appendArticle.setAttribute('data-id',data['aid']);
//                 appendArticle.innerHTML = data['body'];
//                 document.getElementById("article_body").appendChild(appendArticle);
//                 jQuery(function(){
//                   jQuery(".article")
//                     .mouseover(function(){
//                       jQuery(this).css('background', '#E1E8ED');
//                     })
//                     .mouseout(function(){
//                       jQuery(this).css('background', 'white');
//                     })
//                 });
//                 // jQuery(".article_img_boxes" + data['aid']).each(function(i){
//                 //   var url = jQuery(".article_img_box" + String(data['aid']) + 1).data("url");
//                 //   alert(url);
//                 //   if(url != ""){
//                 //     jQuery(".article_img_box" + String(data['aid']) + 1).append('<a href="' + url + '" target="_blank"><img src="' + url + '" alt="" style="width:90px; height:90px;"></a>');
//                 //   }
//                 // });
//                 // var url = jQuery(".article_img_box" + data['aid'] + "1").data("url");
//                 // if(url != ""){
//                 //   jQuery(".article_img_box" + data['aid'] + "1").append('<a href="' + url + '" target="_blank"><img src="' + url + '" alt="" style="width:90px; height:90px;"></a>');
//                 // }
//                 //コメント欄非表示
//                 jQuery(function() {
//                   var input = jQuery('.comment-input-group');
//                   input.hide();
//                 });
//               },
//               error: function(XMLHttpRequest, textStatus, errorThrown) {
//                   //alert("error");
//               }
//             });
//           }
//         }
//       },
//       error: function(XMLHttpRequest, textStatus, errorThrown) {
//           //alert("error");
//       }
//     });
//   }  
// });

// //お知らせ表示
//   jQuery(window).load(function (){
//     var notice = jQuery('.push_msg_box');
//     //お気に入りpush通知
//     var uid = jQuery("#uid").data("id");
//     jQuery.ajax({
//       url: '/chk_push.php',
//       type:'POST',
//       dataType: 'json',
//       data : {uid: uid, status: 1},
//       timeout:10000,
//       success: function(data) {
//         if(data["num"] >= 1){
//           jQuery("#push_msg_favorite").append("<span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>新たに" + data["num"] + "人があなたをお気に入りにしました!");
//           notice.show(1000);
//         }
//       },
//       error: function(XMLHttpRequest, textStatus, errorThrown) {
//           //alert("error");
//       }
//     });
//     //イイネpush通知
//     var uid = jQuery("#uid").data("id");
//     jQuery.ajax({
//       url: '/chk_push.php',
//       type:'POST',
//       dataType: 'json',
//       data : {uid: uid, status: 2},
//       timeout:10000,
//       success: function(data) {
//         if(data["num"] >= 1){
//           jQuery("#push_msg_good").append("<span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>あなたのコメントに" + data["num"] + "件のイイネがあります!");
//           notice.show(1000); 
//         }
//       },
//       error: function(XMLHttpRequest, textStatus, errorThrown) {
//           //alert("error");
//       }
//     });
//     //コメントpush通知
//     var uid = jQuery("#uid").data("id");
//     jQuery.ajax({
//       url: '/chk_push.php',
//       type:'POST',
//       dataType: 'json',
//       data : {uid: uid, status: 3},
//       timeout:10000,
//       success: function(data) {
//         if(data["num"] >= 1){
//           jQuery("#push_msg_comment").append("<span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>あなたのコメントした記事に" + data["num"] + "件のコメントが付きました!");
//           notice.show(1000);
//         }
//       },
//       error: function(XMLHttpRequest, textStatus, errorThrown) {
//           //alert("error");
//       }
//     });
//   //notice.phpへリンク
//     jQuery(document).on("click",'.push_msg_box',function(){
//       location.href = jQuery(this).attr("data-url");
//     });
//   });