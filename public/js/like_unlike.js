$(document).ready(function () {
    $('.like, .dislike').click(function () {

        var id = this.id;   // Getting Button id
        var split_id = id.split("_");

        var text = split_id[0];
        var postid = split_id[1];  // postid

        // Finding click type
        var type = -1;
        if(text === "like"){
            type = 1;
        }else{
            type = 0;
        }

        $.ajax({
            url: 'Home/likeUnLike',
            type: "POST",
            data: {postid: postid, type: type},
            dataType: "JSON",
            success: function (response) {
                var like = response.like.cou;
                var unlike = response.unlike.cou;
                $('#appear_'+postid).text(like);
                $('#uappear_'+postid).text(unlike);
                if (response.status === -1){
                    if (type === 1){
                        $('#iconlike_'+postid).attr('class','ti-heart');
                    } else {
                        $('#uiconlike_'+postid).attr('class','ti-heart-broken');
                    }
                } else {
                    if (type === 1){
                        $('#iconlike_'+postid).attr('class','fa fa-heart');
                        $('#uiconlike_'+postid).attr('class','ti-heart-broken');
                    } else {
                        $('#iconlike_'+postid).attr('class','ti-heart');
                        $('#uiconlike_'+postid).attr('class','fa fa-heartbeat');
                    }
                }
            }
        })
        var data = {id_post: postid,type: type};
        notifications(data)
    })
})
function notifications(data) {
    console.log(data)
    $.ajax({
        url: 'Notification/notifications',
        data: data,
        type: 'POST',
        success:function (response) {

        }
    })
}