Dropzone.autoDiscover = false;
$(document).ready(function () {

    function DoPrevent(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    var myDropZone = new Dropzone("#postFile",{
        url: "Home/uploadFile",
        method: 'POST',
        dictDefaultMessage: "Bạn có thể kéo ảnh hoặc click để chọn",
        maxFiles: 1,
        autoProcessQueue: false,
        init: function() {

            $('#upload').on('click',function(e) {

                if (myDropZone.getQueuedFiles().length > 0) {
                    e.preventDefault();
                    myDropZone.processQueue();
                    setTimeout(function () {
                        window.location = "Home";
                    },1000)
                } else {
                    $("#postFile").submit();
                }
            });

            this.on('addedfile', function(file) {
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });
            this.on('complete', function(file) {
                var f = file.xhr.response;
                console.log(file.xhr);
            });
            this.on("sendingmultiple", function() {
            });
            this.on("successmultiple", function(files, response) {
            });
            this.on("errormultiple", function(files, response) {
            });
        },

        addRemoveLinks: true,
    })
    //
})
