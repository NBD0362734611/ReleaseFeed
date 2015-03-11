//user-id の読み込み
jQuery(window).load(function () {
	var uid = parseInt(jQuery("#uid").attr("user-id")); 
	//addReleaseBody();
	addReleaseBody();
	//addReleaseBox(4);

});
jQuery(document).on("click",'.link',function(){
    location.href = jQuery(this).attr("data-url");
});
function addReleaseBox(repeat){
	$.ajax({
		url: '../ajax/get_release_box.php',
		type:'POST',
		dataType: 'json',
		data : {'repeat': repeat},
		timeout:1000,
		success: function(data) {
			console.log(data);
		  if(data !== ""){
		    var makeReleaseBox = $.when(
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
function addReleaseId(){
	//release-idの付与
	jQuery(".rid-add").each(function(j){
		var target = jQuery(this);
		var page = 1;
		$.ajax({
			url: '../ajax/get_release_id.php',
			type:'POST',
			dataType: 'json',
			data : {'page': page,'num': j},
			timeout:1000,
			success: function(data) {
			  if(data !== ""){
			  	console.log(data);
			    var addReleaseId  = $.when(
			    	target.attr("release-id",data[0]["rid"])
			    	);
			    addReleaseId.done(function(){
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
	});
}
function addReleaseBody(){
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
				    release.find(".time").html(data["time"]);
				    release.find(".body").html(data["body"]);
				    release.find(".previous_release").attr("href",location.pathname + "?rid=" + data["previous"]);
				    release.find(".next_release").attr("href",location.pathname + "?rid=" + data["next"]);
				    if(data !== ""){release.find(".img1").attr("src",data["img1"]);}
				    if(data !== ""){release.find(".img2").attr("src",data["img2"]);}
				    if(data !== ""){release.find(".img3").attr("src",data["img3"]);}
				    if(data !== ""){release.find(".img4").attr("src",data["img4"]);}
				    if(data !== ""){release.find(".img5").attr("src",data["img5"]);}

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
}
