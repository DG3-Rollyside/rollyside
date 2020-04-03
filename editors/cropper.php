<?php 
  if (isset($_GET["id"])) {
    $id = $_GET["id"];
  } else {
    $id = -1;
  }
  if (isset($_GET["title"])) {
    $title = $_GET["title"];
  } else {
    $title = "";
  }
?>
<html>

<head>
    <link rel="stylesheet" href="./css/croppie.css" />
</head>

<body>
    <div class="demo-wrap upload-demo">
        <div class="container">
            <div class="grid">
                <div class="col-1-2">
                    <div class="actions">
                        <a class="btn file-btn">
                            <span>Upload</span>
                            <input type="file" id="upload" value="Choose a file" accept="image/*" />

                        </a>
                        <button class="upload-result">Result</button>
                    </div>
                </div>
                <div class="col-1-2">
                    <div class="upload-msg">
                        Upload a file to start cropping
                    </div>
                    <div class="upload-demo-wrap">
                        <div id="upload-demo"></div>
                        <!-- rotate featured image -->
                        <button class="vanilla-rotate" data-deg="-90">Rotate Left</button>
                        <button class="vanilla-rotate" data-deg="90">Rotate Right</button>
                    </div>
                </div>
            </div>
            <form onsubmit="sendAjax(event)">
              <input id="browse" type="file" name="bulkImg[]" multiple>
              <input type="text" name="feartuerimg" placeholder="Titel" value="<?php echo $title; ?>" id="title">
              <input type="submit" value="Submit" name="submit">
            </form>

        </div>
        <img id="homo">
        <textarea id="lul"></textarea>

        <div id="preview"></div>
        <script src="js/jquery.js"></script>
        <script src="./js/croppie.js"></script>
        <script>
        var $uploadCrop;

        let id = <?php echo $id; ?> ;

        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(".upload-demo").addClass("ready");
                    $uploadCrop
                        .croppie("bind", {
                            url: e.target.result
                        })
                        .then(function() {
                            console.log("jQuery bind complete");
                        });
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                alert("Sorry - your browser is gay");
            }
        }

        $uploadCrop = $("#upload-demo").croppie({
            enableOrientation: true,
            viewport: {
                width: 300,
                height: 300,
            },
            boundary: {
                width: 400,
                height: 400,
            },
            enableExif: true
        });

        $("#upload").on("change", function() {
            readFile(this);
        });

        let bulkimgs = [];

        const EL_browse = document.getElementById('browse');

        const readImage = file => {
            const reader = new FileReader();
            reader.addEventListener('load', () => {
                bulkimgs.push(reader.result);
            });
            reader.readAsDataURL(file);
        };

        EL_browse.addEventListener('change', ev => {
            bulkimgs = [];
            const files = ev.target.files;
            if (!files || !files[0]) return alert('File upload not supported');
            [...files].forEach(readImage);
        });

        async function sendAjax(e) {
            e.preventDefault();
            sendAsync()
            return false;
        }

        async function sendAsync() {

            $uploadCrop.croppie('result', 'base64').then((base) => {
              let title = document.getElementById('title').value;
                let obj = {
                    featured: base,
                    post: bulkimgs,
                    title: title
                }
                console.log(base);

                let json = JSON.stringify(obj);
                const Http = new XMLHttpRequest();
                let url = "./uploadGalerij.php";

                if (id >= -1) {
                    url += `?id=${id}`
                }
                Http.onreadystatechange = () => {
                    if (Http.readyState == XMLHttpRequest.DONE) {
                        id = Http.responseText;
                        alert(id);
                    }
                }

                Http.open("POST", url, true);
                Http.setRequestHeader('Content-type', 'application/json')
                Http.send(json);

            })

        }

        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
        $(function() {
            $('.vanilla-rotate').on('click', function(ev) {
                $uploadCrop.croppie('rotate', parseInt($(this).data('deg')));
            });
        });
        </script>
</body>

</html>