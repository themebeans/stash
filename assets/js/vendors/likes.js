jQuery(document).ready(function(a) {

     a(".like").stop().click(function(){

          var rel = a(this).attr("rel");

          var data = {
               data: rel,
               action: 'stash_likes_callback'
          }

          a.ajax({
               action: "stash_likes_callback",
               type: "GET",
               dataType: "json",
               url: ajaxurl,

               data: data,
               success: function(data){

                    if(data.status == true){
                    	a(".like[rel="+rel+"]").addClass("liked");
                        a(".like[rel="+rel+"] span").html(data.likes);
                    }else{
                    	a(".like[rel="+rel+"]").removeClass("liked");
                        a(".like[rel="+rel+"] span").html(data.likes);
                    }

               }
          });
     });
});