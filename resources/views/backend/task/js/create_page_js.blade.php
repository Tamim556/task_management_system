<script>
    $(document).ready(function() {
        // Define a custom button for image insertion
        var insertImageButton = function(context) {
            var ui = $.summernote.ui;

            // Create button
            var button = ui.button({
                contents: '<i class="note-icon-picture"></i>',
                tooltip: 'Insert Image',
                click: function() {
                    var offcanvasElement = document.getElementById('offcanvasBottom');
                    var bsOffcanvas = new bootstrap.Offcanvas(offcanvasElement);
                    bsOffcanvas.show();


                    document.getElementById('offcanvasBottom').setAttribute('data-image-type',
                        'summernote');


                    $('#insertImageBtn').off('click').on('click', function() {
                        var fileInput = document.getElementById('imageFileInput');
                        var file = fileInput.files;
                        if (file) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                context.invoke('editor.insertImage', e.target
                                    .result);
                                bsOffcanvas.hide();
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                }
            });

            return button.render(); // Return button as jquery object
        }

        $('#task_body').summernote({
            height: 250,
            toolbar: [
                // Customize your toolbar
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
                ['mybutton', ['insertImage']]
            ],
            buttons: {
                insertImage: insertImageButton
            },
            callbacks: {
                onChange: function(contents, $editable) {
                    putValueCache(contents);
                }
            }
        });
    });

    function putValueCache(contents) {
        // Your caching logic here
        console.log(contents);
    }




    $(function() {

        $("#taskStoreFrom").on('submit', function(e) {
            e.preventDefault();
            // parent register

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                datatype: JSON,
                contentType: false,
                beforeSend: function() {

                    $(document).find('span.error-text').text('');
                },

                success: function(data) {

                    if (data.status == false) {

                        console.log('hi');
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        })
                    } else {


                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });

                        $('#taskStoreFrom')[0].reset();

                        $('#task_body').html('');      


                        window.location.href = '../task/index';

                        $('#imageDiv').load(location.href + ' #imageDiv');

                    }
                }
            });


        });

    });



    function mainImageOffcanvas(type) {
        var offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasBottom'));
        offcanvas.show();
        document.getElementById('offcanvasBottom').setAttribute('data-image-type', type);
    }

    function selectImage(imageSrc, name) {
    var imageType = document.getElementById('offcanvasBottom').getAttribute('data-image-type');

    if (imageType === 'main') {
        document.getElementById('main_image').value = name;
        $('#selected-image').attr('src', imageSrc);
        document.getElementById('image_div').style.display = 'block';

        // Remove 'show-tick' and 'clicked' classes and hide tick marks from all divs
        const divs = document.querySelectorAll('.custom-div');
        divs.forEach(div => {
            div.classList.remove('show-tick', 'clicked');
            const tickMark = div.querySelector('.tick-mark');
            if (tickMark) tickMark.style.display = 'none';
        });

        // Apply classes to the selected image's container and show the tick mark
        const selectedDiv = document.querySelector(`.custom-div[data-image-name="${name}"]`);
        if (selectedDiv) {
            selectedDiv.classList.add('show-tick', 'clicked');
            const tickMark = selectedDiv.querySelector('.tick-mark');
            if (tickMark) tickMark.style.display = 'block';
        }
    }

    if (imageType === 'summernote') {
        console.log(imageSrc);
        $('#task_body').summernote('editor.insertImage', imageSrc);
    }
}





    $(function() {

        $("#taskUpdateFrom").on('submit', function(e) {
            e.preventDefault();
            // parent register

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                datatype: JSON,
                contentType: false,
                beforeSend: function() {

                    $(document).find('span.error-text').text('');
                },

                success: function(data) {

                    if (data.status == false) {

                        console.log('hi');
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        })
                    } else {


                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "task uploaded successfully",
                            showConfirmButton: false,
                            timer: 2500,
                        });

                        $('#taskUpdateFrom')[0].reset();

                        window.location.href = '../index';
                        // $('#imageDiv').load(location.href + ' #imageDiv');

                    }
                }
            });


        });

    });




    $(function() {

        $("#imageStoreFrom").on('submit', function(e) {
            e.preventDefault();
            // parent register

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                datatype: JSON,
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },

                success: function(data) {

                    if (data.status == false) {

                        console.log('hi');
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        })
                    } else {

                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "image added successfully",
                            showConfirmButton: false,
                            timer: 2500,
                        });

                        $('#imageDiv').load(location.href + ' #imageDiv');


                    }
                }
            });


        });

    });
</script>
