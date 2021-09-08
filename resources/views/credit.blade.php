<head>
<!-- jQuery -->
<script src="/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">

<link rel="stylesheet" href="{{ asset('plugins/cropper/cropper.css') }}">

<script src="{{ asset('plugins/cropper/cropper.js') }}"></script>
    <script src="{{ asset('plugins/image/upload-image.js') }}"></script>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            var input = document.querySelectorAll('.input');
            var image = document.getElementById('image');
            var $alert = $('.alert');
            var $modal = $('#modal');
            var cropper;

            $('[data-toggle="tooltip"]').tooltip();

            input.forEach((item) => {
                item.addEventListener('change', function (e) {
                    sessionStorage.setItem('china-avatar', e.currentTarget.parentNode.querySelector('.avatar').getAttribute('data-session-id'));
                    sessionStorage.setItem('china-images', e.currentTarget.parentNode.querySelector('.uploadFile').getAttribute('data-session-id'));
                    var files = e.target.files;
                    var done = function (url) {
                        e.currentTarget.value = '';
                        image.src = url;
                        $alert.hide();
                        $modal.modal('show');
                    };
                    var reader;
                    var file;
                    // var url;

                    if (files && files.length > 0) {
                        file = files[0];

                        if (URL) {
                            done(URL.createObjectURL(file));
                        } else if (FileReader) {
                            reader = new FileReader();
                            reader.onload = function (e) {
                                done(reader.result);
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                });
            })

            $modal.on('shown.bs.modal', function () {
                cropper = new Cropper(image, {
                    aspectRatio: 4/3,
                    // zoomable: true,
                    // scrolable: true,
                    autoCropArea: 0,
                    viewMode: 2,
                    responsive: 0,
                });
            }).on('hidden.bs.modal', function () {
                cropper.destroy();
                cropper = null;
            });

            document.getElementById('crop').addEventListener('click', function () {
                // var initialAvatarURL;
                var canvas;

                $modal.modal('hide');

                if (cropper) {
                    canvas = cropper.getCroppedCanvas({
                        width: 800,
                        height: 450,

                    });

                    const avatar = document.querySelector(`img[data-session-id="${sessionStorage.getItem('china-avatar')}"]`);
                    const images = document.querySelector(`input[data-session-id="${sessionStorage.getItem('china-images')}"]`);
                    // initialAvatarURL = avatar.src;
                    avatar.src = canvas.toDataURL();
                    images.value=canvas.toDataURL();
                    console.log(images);
                }
            });

            $(".imgAddNew").click(function () {
                console.log(123123123);
                const elem = $(this).closest(".row").find('.imgAddNew').before('' +
                    '<div class="col-2 imgUp">' +
                    '<label class="label w-100" data-toggle="tooltip" title="Добавить изображение">' +
                    `<img class="rounded w-100 avatar" data-session-id="`
                    +"avatar-"+`${document.querySelectorAll('.imgUp').length}`+
                    `" src="{{ asset('no_image.png') }}" >` +
                    '<input type="file" class="sr-only input" data-session-id="'+
                    '" name="image" accept="image/*">' +
                    '<input type="hidden" class="uploadFile" data-session-id="'+
                    +"uploadFile-"+`${document.querySelectorAll('.imgUp').length}`+
                    '" name="images[]" value="">' +
                    '</label>' +
                    '<i class="fa fa-times del"></i>' +
                    '</div>'
                );

                elem.prev('.imgUp').find('.input').change(function (e) {
                    sessionStorage.setItem('china-avatar', e.currentTarget.parentNode.querySelector('.avatar').getAttribute('data-session-id'));
                    sessionStorage.setItem('china-images', e.currentTarget.parentNode.querySelector('.uploadFile').getAttribute('data-session-id'));
                    var files = e.target.files;
                    var done = function (url) {
                        e.currentTarget.value = '';
                        image.src = url;
                        $alert.hide();
                        $modal.modal('show');
                    };
                    var reader;
                    var file;
                    // var url;

                    if (files && files.length > 0) {
                        file = files[0];

                        if (URL) {
                            done(URL.createObjectURL(file));
                        } else if (FileReader) {
                            reader = new FileReader();
                            reader.onload = function (e) {
                                done(reader.result);
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                });
            });
            $(document).on("click", "i.del", function () {
                $(this).parent().remove();
            });
        });
    </script>

</head>
<body>
    <div class="container">
<div class="row">
    <form action="@isset($item){{ route('albums.update',['id'=>$item->id]) }}@else{{ route('albums.store') }}@endisset" class="was-validated" method="POST" enctype="multipart/form-data">
        @isset($item) @method('PATCH') @endisset
        @csrf
<div class="card-body">
    <div class="row mb-3">
        @include('_credit_images',['N_Photo'=>1,'addPhoto'=>true])
    </div>
</div>
        <button type="submit" class="btn btn-primary ml-4">Сохранить</button>
    </form>

</div>
    </div>
</body>