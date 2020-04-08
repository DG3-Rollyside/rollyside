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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/"><img src="../img/logo.svg" height="70" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Galerij Maken <span class="sr-only">(Huidige pagina)</span></a>
                </li>
            
                <li class="nav-item">
                    <a class="nav-link" href="#">Bericht Maken</a>
                </li>
            
            </ul>
        </div>
    </div>
    </nav>
    <div class="container">
    <div class="row">
        <div class="left col-2">
            <div>
                <form onsubmit="sendAjax(event)">
                <!-- Featured img -->
                    <input type="file" id="upload" value="Choose a file" accept="image/*" />
                <!-- bulk -->
                    <input id="browse" type="file" name="bulkImg[]" multiple> <!-- title -->
                    <input class="form-control" type="text" name="feartuerimg" placeholder="Titel" value="<?php echo $title; ?>" id="title">
                <!-- submit -->
                    <input class="btn btn-primary btn-large " type="submit" value="Bijwerken" name="submit">
                </form>

            </div>
            
            <div>
                <ul>
                    <!-- genereer van upload fotos -->
                </ul>
            </div>
        </div>

        <div class="col-10 croppie">
            <div id="croppie-preview"></div>
                <div class="form-control">
                <div class="d-flex justify-content-center">
                    <button class="vanilla-rotate" data-deg="-90">Rotate Left</button>
                    <button class="vanilla-rotate" data-deg="90">Rotate Right</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="file-input">
        <input type="file" name="file-input" id="file-input" class="file-input__input" />
        <label class="file-input__label" for="file-input">
           <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="far" data-icon="image" class="svg-inline--fa fa-image fa-w-16" role="img" viewBox="0 0 512 512"><path fill="currentColor" d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm-6 336H54a6 6 0 0 1-6-6V118a6 6 0 0 1 6-6h404a6 6 0 0 1 6 6v276a6 6 0 0 1-6 6zM128 152c-22.091 0-40 17.909-40 40s17.909 40 40 40 40-17.909 40-40-17.909-40-40-40zM96 352h320v-80l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L192 304l-39.515-39.515c-4.686-4.686-12.284-4.686-16.971 0L96 304v48z"/></svg>
            <span>Upload file</span></label>
    </div>

    <div class="file-input">
        <input type="file" name="file-input" id="file-input" class="file-input__input" />
        <label class="file-input__label" for="file-input">
          <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="images" class="svg-inline--fa fa-images fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M480 416v16c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V176c0-26.51 21.49-48 48-48h16v48H54a6 6 0 0 0-6 6v244a6 6 0 0 0 6 6h372a6 6 0 0 0 6-6v-10h48zm42-336H150a6 6 0 0 0-6 6v244a6 6 0 0 0 6 6h372a6 6 0 0 0 6-6V86a6 6 0 0 0-6-6zm6-48c26.51 0 48 21.49 48 48v256c0 26.51-21.49 48-48 48H144c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h384zM264 144c0 22.091-17.909 40-40 40s-40-17.909-40-40 17.909-40 40-40 40 17.909 40 40zm-72 96l39.515-39.515c4.686-4.686 12.284-4.686 16.971 0L288 240l103.515-103.515c4.686-4.686 12.284-4.686 16.971 0L480 208v80H192v-48z"></path></svg>
            <span>Upload file</span></label>
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
            width: 750,
            height: 750,
        },
        enableExif: true
    });

    $("#upload").on("change", function() {
        readFile(this);
        console.log();
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

