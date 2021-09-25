@if(isset($item) and is_array($item->images_two) and count(array_filter($item->images_two)) > 0)
    @foreach($item->images_two as $image)
        @if($image != null)
            <div class="col-2 imgUpTwo">
                <label class="label w-100" data-toggle="tooltip" title="Изменить изображение">
                    <img class="rounded w-100 avatarTwo" data-session-id2=""  src="@isset($item){{ $item->getImages($loop->index,'images_two','/no_image.png') }}@else {{ asset('no_image.png') }} @endisset" >
                    <input type="file" class="sr-only input_two" name="image_two" accept="image/*">
                    <input type="hidden" class="uploadFileTwo" data-session-id2="" name="image_two[]" value="{{ $item->images_two[$loop->index] ?? '/no_image.png' }}">
                </label>
                @if($loop->iteration > $N_Photo)
                    <i class="fa fa-times del"></i>
                @endif
            </div>
        @endif
    @endforeach
@else
    <div class="col-2 imgUpTwo">
        <label class="label w-100" data-toggle="tooltip" title="Добавить изображение">
            <img class="rounded w-100 avatarTwo" data-session-id2="" src="{{ asset('no_image.png') }}" >
            <input type="file" class="sr-only input_two" name="image_two" accept="image/*">
            <input type="hidden" class="uploadFileTwo" data-session-id2="" name="image_two[]" value="">
        </label>
    </div>
@endif


@if(isset($addPhoto) and $addPhoto === true)
    <div class="text-primary imgTwoAddNewTwo" data-tooltip="tooltip" data-html="true" title="Добавить фото">
        <i class="fas fa-plus-circle"></i>
    </div>
@endif

<div class="modal fade" id="modalTwo" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Добавление изображения</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="img-container img-fluid w-100">
                    <img id="image_two" src="@isset($item){{ $item->getImages(0,'images_two','/no_image.png') }}@else {{ asset('no_image.png') }} @endisset" class="w-100" width="100%">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="crop2">Обрезать</button>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/cropper/cropper.css') }}">
@endpush

<!-- jQuery -->
{{--    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>--}}
<script src="{{ asset('plugins/cropper/cropper.js') }}"></script>
<script src="{{ asset('plugins/image/upload-image.js') }}"></script>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        var input = document.querySelectorAll('.input_two');
        var image = document.getElementById('image_two');
        var $alert = $('.alert');
        var $modal = $('#modalTwo');
        var cropper;

        $('[data-toggle="tooltip"]').tooltip();

        input.forEach((item) => {
            item.addEventListener('change', function (e) {
                sessionStorage.setItem('china-avatar', e.currentTarget.parentNode.querySelector('.avatarTwo').getAttribute('data-session-id2'));
                sessionStorage.setItem('china-images', e.currentTarget.parentNode.querySelector('.uploadFileTwo').getAttribute('data-session-id2'));
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
            console.log(image)
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

        document.getElementById('crop2').addEventListener('click', function () {
            // var initialAvatarURL;
            var canvas;

            $modal.modal('hide');

            if (cropper) {
                canvas = cropper.getCroppedCanvas({
                    width: 800,
                    height: 450,

                });

                const avatar = document.querySelector(`img[data-session-id2="${sessionStorage.getItem('china-avatar')}"]`);
                const images = document.querySelector(`input[data-session-id2="${sessionStorage.getItem('china-images')}"]`);
                // initialAvatarURL = avatar.src;
                avatar.src = canvas.toDataURL();
                images.value=canvas.toDataURL();
                console.log(images);
            }
        });

        $(".imgTwoAddNewTwo").click(function () {
            console.log(12312123);
            const elem = $(this).closest(".row2").find('.imgTwoAddNewTwo').before('' +
                '<div class="col-2 imgUpTwo">' +
                '<label class="label w-100" data-toggle="tooltip" title="Добавить изображение">' +
                `<img class="rounded w-100 avatarTwo" data-session-id2="`
                +"avatar-"+`${document.querySelectorAll('.imgUpTwo').length}`+
                `" src="{{ asset('/no_image.png') }}" >` +
                '<input type="file" class="sr-only input_two" data-session-id2="'+
                '" name="image_two" accept="image/*">' +
                '<input type="hidden" class="uploadFileTwo" data-session-id2="'+
                +"uploadFile-"+`${document.querySelectorAll('.imgUpTwo').length}`+
                '" name="image_two[]" value="">' +
                '</label>' +
                '<i class="fa fa-times del"></i>' +
                '</div>'
            );

            elem.prev('.imgUpTwo').find('.input_two').change(function (e) {
                sessionStorage.setItem('china-avatar', e.currentTarget.parentNode.querySelector('.avatarTwo').getAttribute('data-session-id2'));
                sessionStorage.setItem('china-images', e.currentTarget.parentNode.querySelector('.uploadFileTwo').getAttribute('data-session-id2'));
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