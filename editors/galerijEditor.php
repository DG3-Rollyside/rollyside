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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/croppie.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/galerijEditor.css">
</head>

<body>
        <div class="container">
            <form onsubmit="sendAjax(event)">
            <!-- Featured img -->
                <input type="file" id="upload" value="Choose a file" accept="image/*" />
            <!-- bulk -->
                <input class="form-control" id="browse" type="file" name="bulkImg[]" multiple>
            <!-- title -->
                <input class="form-control" type="text" name="feartuerimg" placeholder="Titel" value="<?php echo $title; ?>" id="title">
            <!-- submit -->
                <input class="btn btn-primary btn-large " type="submit" value="Bijwerken" name="submit">
            </form>

        </div>
        
        <div class="col-md-2 "></div>

        <div class="col-md-10 croppie">
            <div id="croppie-preview"></div>
                <div class="form-control">
                <div class="d-flex justify-content-center">
                    <button class="vanilla-rotate" data-deg="-90">Rotate Left</button>
                    <button class="vanilla-rotate" data-deg="90">Rotate Right</button>
                </div>
            </div>
        </div>

        <script src="js/jquery.js"></script>
        <script src="./js/croppie.js"></script>
        <script>
        var $uploadCrop;

        let id = <?php echo $id; ?>;

        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(".croppie-preview").addClass("ready");
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

        $uploadCrop = $("#croppie-preview").croppie({
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

