$(document).ready(function () {
    $('.checkStatuss').click(function () {
        var id = this.id.split('_')[1];
        $.ajax({
            url: 'Notification/statusnotification',
            type: 'POST',
            data: {id_user: id},
            dataType: 'JSON',
            success: function (response) {
                if (response.countN !== 0){
                    $('#tbcount').text(response.countN);
                } else {
                    $('#tbcount').text(" ");
                }

            }
        })
    })

})