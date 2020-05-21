
function nFormatter(num){
  if(num >= 1000000000){
    return (num/1000000000).toFixed(1).replace(/\.0$/,"") + "G";
  }
  if(num >= 1000000){
    return (num/1000000).toFixed(1).replace(/\.0$/,"") + "M";
  }
  if(num >= 1000){
    return (num/1000).toFixed(1).replace(/\.0$/,"") + "K";
  }
  return num;
}

function replaceStr(str, find, replace) {
  for (var i = 0; i < find.length; i++) {
      str = str.replace(new RegExp(find[i], 'gi'), replace[i]);
  }
  return str;
}

function hashtag(text){
 
  // var repl = text.replace(/#(\w+)/g, '<a href="<?php echo BASE_URL ?>hashtag?tag=$1">#$1</a>');
  // return repl;
  var find = [/#(\w+)/g,/@(\w+)/g]
  var replaceWith = ['<a href="hashtag?tag=$1">#$1</a>','<a href="profile?username=$1">@$1</a>']
  var repl = replaceStr(text, find, replaceWith);
  return repl;
}

        
        
        
   $(document).ready(function(){
   $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() == $(document).height()) {
          $("#loader").show();
  
        id = document.getElementById("userid").value
        after = document.getElementById("after").value
        profilepic = document.getElementById("profilepic").value
        username = document.getElementById("username").value
       
        if(after){
        hash_query = 'e769aa130647d2354c40ea6a439bfc08';
        var url = 'https://www.instagram.com/graphql/query/?query_hash='+hash_query+'&id='+id+'&first=30&after='+after;
        $.ajax({
              url : "inc/loadMore.php",
              type: "POST",
              data :{'url' : url , 'pic' : profilepic},
              success:function(response){
                  
                  var obj = JSON.parse(response);
                  posts = obj.data.posts;
                  nextpage = obj.data.has_next_page;
                  if(nextpage){
                      after_url = obj.data.next_page_url;
                     document.getElementById("after").value = after_url;
                  }else{
                      document.getElementById("after").value ="";
                  }
                     posts_html = "";
                     for(var i=0;i<posts.length;i++){
                      url = posts[i].url;
                      likes = posts[i].likes;
                      comments = posts[i].comment;
                      mediaid = posts[i].shortcode;
                      caption= posts[i].caption;
                      date = posts[i].date;
                      isVideo = posts[i].is_video;
                      if(isVideo){
                        div = '<div class="videos-post"><a href="media/?id='+mediaid+'"></a><img class="img-fluid" src="'+url+'"><span class="videos"></span></div>';
                      }else{
                        div = '<a href="media/?id='+mediaid+'"><img class="img-fluid" src="'+url+'"></a>';
                      }
                      posts_html += '<article class="white-panel"><div class="media m-0"><div class="d-flex mr-3"><a href=""><img class="img-fluid rounded-circle" src="'+profilepic+'" alt="User"></a></div><div class="media-body"><p class="m-0 name username">'+username+'</p><small><span class="time"><i class="fa fa-clock-os" aria-hidden="true"></i>'+date+'</span></small></div></div><br>'+div+'<div class="cardbox-base"><ul class="float-right"><li><a>comments'+nFormatter(comments)+'</a></li><li><a><em class="mr-5"></em></a></li></ul><ul><li><a>Likes'+nFormatter(likes)+'</a></li><li><a><span></span></a></li></ul></div><p>'+hashtag(caption)+'</p></article>';
                     }

                     $('.posts').append(posts_html);
                     
                     
                 
               
              },
              error: function(response){
              alert("fail");
               }
  
        });
      }else{
        $("#loader").hide();

        }
        }
   });
   
  });
      

  // profile page code

  
