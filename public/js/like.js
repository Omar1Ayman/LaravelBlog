    $('.like').on('click' , function(){
        "use strict";
        var like_s = $(this).attr('data-like');
        var post_id = $(this).attr('data-postid');
        post_id = post_id.slice(0,-2);


        $.ajax({

           type:'post', 
           url: url,
           data: {like_s:like_s , post_id:post_id , _token:token},
           success: function(data){
               if(data.is_like == 1){
                   $('*[data-postid="' + post_id + '_l"]').removeClass('btn-secondary').addClass('btn-success')
                   $('*[data-postid="'+post_id+'_d"]').removeClass('btn-danger').addClass('btn-secondary')

                   var cu_like = $('*[data-postid="'+post_id+'_l"]').find('.likeb').text();
                   var newlike = parseInt(cu_like) + 1;
                   $('*[data-postid="'+post_id+'_l"]').find('.likeb').text(newlike)

                   if(data.change_like == 1){
                    var cu_dislike = $('*[data-postid="'+post_id+'_d"]').find('.dislikeb').text();
                    var newdislike = parseInt(cu_dislike) - 1;
                    $('*[data-postid="'+post_id+'_d"]').find('.dislikeb').text(newdislike)
                   }
               }
               if(data.is_like == 0){
                $('*[data-postid="'+post_id+'_l"]').removeClass('btn-success').addClass('btn-secondary')
                var cu_like = $('*[data-postid="'+post_id+'_l"]').find('.likeb').text();
                   var newlike = parseInt(cu_like) - 1;
                   $('*[data-postid="'+post_id+'_l"]').find('.likeb').text(newlike)
            }
           }

        });
    });
    $('.dislike').on('click' , function(){
        "use strict";
        var like_s = $(this).attr('data-dislike');
        var post_id = $(this).attr('data-postid');
        post_id = post_id.slice(0,-2);


        $.ajax({

           type:'post', 
           url: urld,
           data: {like_s:like_s , post_id:post_id , _token:token},
           success: function(data){
               if(data.is_dislike == 1){
                   $('*[data-postid="' + post_id + '_d"]').removeClass('btn-secondary').addClass('btn-danger')
                   $('*[data-postid="'+post_id+'_l"]').removeClass('btn-success').addClass('btn-secondary')

                   var cu_dislike = $('*[data-postid="'+post_id+'_d"]').find('.dislikeb').text();
                   var newdislike = parseInt(cu_dislike) + 1;
                   $('*[data-postid="'+post_id+'_d"]').find('.dislikeb').text(newdislike)
                   if(data.change_dislike == 1){
                    var cu_like = $('*[data-postid="'+post_id+'_l"]').find('.likeb').text();
                    var newlike = parseInt(cu_like) - 1;
                    $('*[data-postid="'+post_id+'_l"]').find('.likeb').text(newlike)
                   }

               }
               if(data.is_dislike == 0){
                $('*[data-postid="'+post_id+'_d"]').removeClass('btn-danger').addClass('btn-secondary')
                var cu_dislike = $('*[data-postid="'+post_id+'_d"]').find('.dislikeb').text();
                   var newdislike = parseInt(cu_dislike) - 1;
                   $('*[data-postid="'+post_id+'_d"]').find('.dislikeb').text(newdislike)
            }
           }

        });
    });