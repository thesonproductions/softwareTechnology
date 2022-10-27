
$(document).ready(function () {

     $('.post-bar').click(function () {
          $('#postFile').css('display','block');
          $('.post-bar').css('display','none');
     })
     $('#close').click(function () {
          $('#content').val('');
          $('.dz-image-preview').empty();
          $('#postFile').css('display','none');
          $('.post-bar').css('display','block');
     })


     jQuery(".post-comt-box textarea").on("keydown", function(event) {
	      if (event.keyCode === 13) {
	           var detailUser = $('#userDetail').val();
	           var arr = detailUser.split('/');
	           var id = this.id
               var split_id = id.split('_');
		       var comment = jQuery(this).val();
               var data = {comment: comment, userId: split_id[1],postId: split_id[2]};
               var lastId;
		       $.ajax({
                    url: "Home/comment",
                    type: "POST",
                    data: data,
                    dataType: "JSON",
                    success: function (response) {
                         if (response.status === 0){
                              alert('An error occurred during the process, please try again');
                         } else {
                              lastId = response.id;
                              var parent = jQuery("#pre"+split_id[2]);
                              var comment_HTML = '	<li id="last'+response.id+'"><div class="comet-avatar"><div class="border-avatar"><img src="public/images/avatar/'+arr[0]+'" alt=""></div></div><div class="we-comment"><div class="coment-head"><h5><a href="profile/index.php?id='+arr[1]+'" title="">'+arr[3]+'</a></h5><span>'+arr[2]+'</span><a class="we-reply reply-button" style="cursor: pointer;" title="Reply" onclick="deletecomment('+lastId+')"><i class="ti-trash delete" id="delete_'+ lastId +'"></i></a></div><p>'+comment+'</p></div></li>';
                              $(comment_HTML).insertBefore(parent);

                         }
                    }
               });
               var dat = {id_post: split_id[2], type: 2};
               notifications(dat);
               jQuery(this).val('');
	      }
     });

     $('.more').click(function () {
          var id = this.id;
          var arr = id.split('_');
          var row = Number($('#rowMore').val());
          row = row + 5;
          var data = {row: row, postId: arr[1]};
          $('#rowMore').val(row);

          $.ajax({
               url: 'Home/readMore',
               type: "POST",
               data: data,
               beforeSend: function () {
                    $('#'+id).html("Loading...");
               },
               success: function (response) {
                    setTimeout(function () {
                         var parent = jQuery(".showmore").parent("li");
                         $("#last"+row).after(response);
                         $("#"+id).text("more comments");
                    },800);
               }
          })
     });

     $('.delete').click(function () {
          var id = this.id;
          idCmt = id.split('_');

          if(confirm("Are you sure you want to delete this comment?")) {
               $.ajax({
                    url: 'Home/deleteComment',
                    data: {idCmt: idCmt[1]},
                    type: 'POST',
                    dataType: "JSON",
                    success: function (response) {
                         $('#last'+idCmt[1]).remove();
                    }
               })
          }

     })

     $('.post').click(function () {
          var id = this.id;
          id = id.split('_')[1];
          if(confirm("Are you sure you want to delete this post ?")) {

               $.ajax({
                    url: 'Home/deletePost',
                    data: {id: id},
                    type: 'POST',
                    success: function (response) {
                        window.location= "Home";
                    }
               })
          }
     })

     $('.editPost').click(function () {
          var id = this.id;
          var arr = id.split('#$');
          $('#contentEdit').val(arr[2]);
          $('#idPostEdit').val(arr[1]);
          $('.previewFile embed').attr('src',arr[3]);
          $('.previewFile embed').attr('type',arr[4]);
     })

     $('#btnUpdateSubmit').on('click',function () {
         $('#edit').submit();
     })

     $('.addFollow').click(function (e) {
          e.preventDefault();
          var id = this.id;
          var id_follower = this.id.split('_')[1];
          var id_user = this.id.split('_')[2];
          var status = $('#suggest_'+id_follower).val();
          var route = (status == 0) ? "Profile/follower" : "Profile/unFollower";
          $.ajax({
               url: route,
               type: "POST",
               dataType: "JSON",
               data: {id_user: id_user,id_follower: id_follower},
               success: function (response) {
                    if (response.status === 1){
                         if (status == 0){
                              $('#c_'+id_follower).html(response.countFl + " followers");
                              $('#'+id).text('UnFollow');
                              $('#suggest_'+id_follower).val('1');
                         } else {
                              $('#c_'+id_follower).html(response.countFl + " followers");
                              $('#'+id).text('Follow');
                              $('#suggest_'+id_follower).val('0');
                         }
                    }
               }
          })
     })
     $.uploadPreview({
          input_field: "#image-upload",
          preview_box: "#image-preview",
          label_field: "#image-label"
     });

     $('#changePass').on('submit',function (e) {
          e.preventDefault();
          var id = $('#storeIdUser').val();
          var pass = $('#password').val();
          var newPass = $('#newPass').val();
          var cfp = $('#confirmPass').val();
          if (newPass !== cfp){
               $('.preview-change').html("Password does not match, please try again");
          } else if (!validPassword(pass) || !validPassword(newPass)){
               $('.preview-change').html("invalid Password! please try again");
          } else {
               $.ajax({
                    url: "profile/changeUpdate",
                    type: "POST",
                    data: {id: id,pass: pass,newPass: newPass},
                    dataType: "JSON",
                    success: function (response) {
                         if (response.status === 0){
                              $('.preview-change').html(response.message);
                         } else {
                              window.location = "profile/index.php?id="+id+"";
                         }
                    }
               })
          }
     })
     function validPassword(password) {
          const isStrongPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$/;
          return isStrongPassword.test(password)
     }
     $('#search-bar').keyup(function () {

          var search = $(this).val();
          if(search !== '')
          {
               load_data(search);
          }
          else
          {
               load_data();
          }
     })

     function load_data(query)
     {
          $.ajax({
               url:"home/search",
               method:"POST",
               data:{query:query},
               success:function(data)
               {
                    $('#search-here').html(data);
               }
          });
     }

     $('.choseChat').click(function () {
          var id_friend = this.id.split('_')[1];
          var route;
          if (this.id.split('_')[0] === 'chatUser'){
               route = "Messages/appearChatContent";
          } else {
               route = "Messages/appearChatContentMini";
          }
          $.ajax({
               url: route,
               type: "POST",
               data: {id_receive: id_friend},
               success: function (response) {
                    $('.peoples-mesg-box').html(response);

                    $('#send-area').keyup(function (e) {
                         if (e.keyCode === 13){
                              $('#send').click();
                         }
                    })

                    $('#chat-bar').on('submit',function (e) {
                         e.preventDefault();

                         var content = $('#send-area').val();
                         var id_send = $('#idSend').val();
                         var id_receive = $('#idReceive').val();
                         $.ajax({
                              url: "Messages/sendChat",
                              type: "POST",
                              data: {content: content,id_send: id_send,id_receive: id_receive},
                              success: function (response) {

                              }
                         })
                         $(".chatting-area").scrollTop($(".chatting-area")[0].scrollHeight);
                         $('#send-area').val("")
                    })
               }
          })

     })

     setInterval(function(){
          var id_friend = $('#idReceive').val();
          $.ajax({
               url: "Messages/showChat",
               type: "POST",
               data: {id_receive: id_friend},
               success: function(response){
                    $('.chatting-area').html(response);
               }
          });
     }, 400);

     $('#togeChat').click(function () {
          var myId = $('#storeIdUser').val();
          $.ajax({
               url: "Messages/seenChat",
               type: "POST",
               data: {myId: myId},
               success: function (response) {
                    $('#totalNotiChat').html(response);
               }
          })
     })
})
function deletecomment(id) {

     if(confirm("Are you sure you want to delete this comment ?")) {

          $.ajax({
               url: 'Home/deleteComment',
               data: {idCmt: id},
               type: 'POST',
               dataType: "JSON",
               success: function (response) {
                    $('#last'+id).remove();
               }
          })
     }

}
function notifications(data) {
     $.ajax({
          url: 'Notification/notifications',
          data: data,
          type: 'POST',
     })
}
function resetFormAvatar() {
     $('#image-upload').val('');
     $('#image-preview').attr('style','');
}
function updateAvatar() {
     $('#titleAvatar').html('Update Avatar');
     $('#isAvatar').val('avatar');
}
function updateCoverAvatar() {
     $('#titleAvatar').html('Update Cover Avatar');
     $('#isAvatar').val('cover')
}