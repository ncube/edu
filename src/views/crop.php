<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Crop Image</title>
    <link rel="stylesheet" href="/public/bower_components/cropperjs/dist/cropper.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
    <style>
        .container {
            max-width: 640px;
            margin: 20px auto;
            text-align: center;
        }
        
        img {
            max-width: 100%;
        }
    </style>
</head>

<body>

    <div class="container">
        <h3>Crop Image</h3>
        <br>
        <div>
            <img id="image" src="/<?=$path?>" alt="Picture">
        </div>
        <br>
        <button onclick="redirect()" class="btn btn-danger">Upload</button>
    </div>

    <script src="/public/bower_components/cropperjs/dist/cropper.min.js"></script>
    <script>
        var x = null;
        var y = null;
        var width = null;
        var height = null;
        window.addEventListener('DOMContentLoaded', function() {
            var image = document.querySelector('#image');
            var minAspectRatio = 1;
            var maxAspectRatio = 1;
            var cropper = new Cropper(image, {
                ready: function() {
                    var cropper = this.cropper;
                    var containerData = cropper.getContainerData();
                    var cropBoxData = cropper.getCropBoxData();
                    var aspectRatio = cropBoxData.width / cropBoxData.height;
                    var newCropBoxWidth;
                    if (aspectRatio < minAspectRatio || aspectRatio > maxAspectRatio) {
                        newCropBoxWidth = cropBoxData.height * ((minAspectRatio + maxAspectRatio) / 2);
                        cropper.setCropBoxData({
                            left: (containerData.width - newCropBoxWidth) / 2,
                            width: newCropBoxWidth
                        });
                    }
                },
                crop: function(e) {
                    x = e.detail.x;
                    y = e.detail.y;
                    width = e.detail.width;
                    height = e.detail.height;
                },
                cropmove: function() {
                    var cropper = this.cropper;
                    var cropBoxData = cropper.getCropBoxData();
                    var aspectRatio = cropBoxData.width / cropBoxData.height;
                    if (aspectRatio < minAspectRatio) {
                        cropper.setCropBoxData({
                            width: cropBoxData.height * minAspectRatio
                        });
                    } else if (aspectRatio > maxAspectRatio) {
                        cropper.setCropBoxData({
                            width: cropBoxData.height * maxAspectRatio
                        });
                    }
                }
            });
        });

        function redirect() {
            window.location = "/profile/changepic?crop=true&x=" + x + "&y=" + y + "&width=" + width + "&height=" + height;
        }
    </script>
</body>

</html>