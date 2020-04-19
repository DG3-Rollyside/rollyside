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
            <div class="left col-3">
                <div>
               
                    <form onsubmit="sendAjax(event)">
                        <div class="custom-file form-group">
                            <!-- Featured img -->
                            <input type="file" class="custom-file-input" id="upload" value="Choose a file"
                                accept="image/*" aria-describedby="featuredImgs" />
                            <label class="custom-file-label" for="featuredImgs">Bestand kiezen</label>
                        </div>
                        <div class="custom-file form-group">
                            <!-- bulk -->
                            <input id="browse" class="custom-file-input" type="file" name="bulkImg[]" multiple
                                aria-describedby="BulkImages">
                            <label class="custom-file-label" for="BulkImages">Bestanden kiezen</label>
                        </div>
                        <div class="form-group">
                            <!-- title -->
                            <input class="form-control" type="text" name="feartuerimg" placeholder="Galerij titel" value="<?php echo $title; ?>" id="title">
                            <!-- submit -->
                            <input class="btn btn-primary btn-large " type="submit" value="Bijwerken" name="submit">
                        </div>
                    </form>
                


                </div>
                <ol id="fileList">
                    <!-- genereer van upload fotos -->
                </ol>
            </div>  
            <div class="col-1"></div>

            <div class="col-8 croppie">
                <div id="croppie-preview"></div>
                <div class="d-flex justify-content-center">
                    <button class="vanilla-rotate" data-deg="-90"><img src="../img/icons/rotate.svg" height="45"
                            width="45" style="transform: scale(-1,1) rotate(-35deg);"></button>
                    <button class="vanilla-rotate" data-deg="90"><img src="../img/icons/rotate.svg" height="45"
                            width="45" style="transform: rotate(-35deg); "></button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="./js/croppie.js"></script>
    <script>
    var $uploadCrop;

    let id = <?php echo $id; ?> ;

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
            width: 600,
            height: 600,
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

    function addImgToList (file) {
        let tag = document.createElement('li');
        tag.innerHTML = file.name;
        
        const elem = document.getElementById('fileList');
        elem.appendChild(tag)

    }

    EL_browse.addEventListener('change', ev => {
        bulkimgs = [];
        const files = ev.target.files;
        if (!files || !files[0]) return alert('File upload not supported');
        [...files].forEach(readImage);

        var e = document.getElementById('fileList'); 
        
        var child = e.lastElementChild;  
        while (child) { 
            e.removeChild(child); 
            child = e.lastElementChild; 
        } 

        for (let i=0; i < files.length; i++) {
            addImgToList(files[i]);
        }        
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