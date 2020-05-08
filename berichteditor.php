<?php
    if (isset($_GET["id"])) {
        $data = Database::getNieuwsEditorData($_GET["id"]);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/minified/croppie.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/messageEditor.css">
    <title>Bericht bewerken</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><img src="./img/logo.svg" height="70" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Galerij maken</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Nieuwsbericht maken <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- The body of the navbar saving -->
    <div class="form-group">

    
            <!-- <file upload> -->
        <div class="col-3 text-center mx-auto">
            <input class="form-control" aria-label="Titel" type="text" name="title" id="title" placeholder="Titel">
            <div class="custom-file form-group ">
                <input type="file" class="custom-file-input col-3" id="upload" value="Choose a file"
                accept="image/*" aria-describedby="featuredImgs" />
                <label class="custom-file-label" for="featuredImgs">Bestand kiezen</label>
            </div>
        <!-- </file upload> -->
            <label for="datepick">Datum:</label>
            <input class="form-control" type="date" id="datepick" name="datum">
            <button onclick="save()" class=" btn btn-primary btn-small">Opslaan</button> 
        </div>
    </div>
    
    <div class="wrapper">
        <div id="upload-demo"></div>
    </div>



    <div id="editorJs" style="border: 1px solid black;"></div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="./js/croppie.min.js"></script>
    <!-- the scripts for the editor -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/link"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@2.3.3/dist/bundle.min.js"></script>
    <script>
        //cropper
        var $uploadCrop;

        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.upload-demo').addClass('ready');
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    }).then(function() {
                        console.log('jQuery bind complete');
                    });

                }

                reader.readAsDataURL(input.files[0]);
            } else {
                swal("Sorry - you're browser doesn't support the FileReader API");
            }
        }

        $uploadCrop = $('#upload-demo').croppie({
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

        $('#upload').on('change', function() {
            readFile(this);
        });
        $('.upload-result').on('click', function(ev) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(resp) {
                popupResult({
                    src: resp
                });
            });
        });




        // message editor
        let insertId = <?php echo isset($_GET["id"]) ? $_GET["id"] : "-1"; ?>;
        const editor = new EditorJS({
            holderId: 'editorJs',
            placeholder: "klik hier om te bewerken",

            <?php 
            if(isset($data)) {
                echo "data: " . json_encode($data) . ",";
            }
            ?>

            tools: {
                header: {
                    class: Header,
                    shortcut: "CMD+SHIFT+H",
                    inlineToolbar: true,
                    config: {
                        placeholder: "Titel",
                        levels: [1, 2],
                        defaultLevel: 1,
                    }
                },
                list: {
                    class: List,
                    shortcut: "CMD+SHIFT+L",
                    inlineToolbar: true
                },
                embed: {
                    class: Embed,
                    inlineToolbar: false,
                    config: {
                        services: {
                            youtube: true,
                            coub: false
                        }
                    }
                },
                quote: {
                    class: Quote,
                    inlineToolbar: true,
                    shortcut: "CMD+SHIFT+Q",
                    config: {
                        qoutePlaceholder: "Voer een quote in",
                        captionPlaceholder: "Qoutes\'s author"
                    }
                },
                image: {
                    shortcut: "CMD+SHIFT+I",
                    class: ImageTool,
                    config: {
                        endpoints: {
                            byFile: "php/editor/uploadImg.php?file=1",
                            byUrl: "phpeditor//uploadImg.php?link=1"
                        }
                    }
                }

            }
        });

        function save() {
            editor.save().then((outputData) => {

                // get the original image
                $uploadCrop.croppie('result', {
                    type: 'blob',
                    size: 'original'
                }).then(function(original) {

                    //get the cropped image
                    $uploadCrop.croppie('result', {
                        type: 'blob'
                    }).then(function(cropped) {

                        /* when we have the original and the cropped image 
                            we need to save the post into the database  */

                        //check if you saved it previusly
                        let url = './php/editor/saveArticle.php';
                        if (insertId !== -1) {
                            // if we have saved it previusly we add the id of the post to the end of the url
                            url += `?postId=${insertId}`;
                        }

                        const http = new XMLHttpRequest();
                        http.open('POST', url, true);

                        //Send the proper header information along with the request
                        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                        http.onreadystatechange =
                            function() { //Call a function when the state changes.
                                if (http.readyState == 4 && http.status == 200) {
                                    alert(http.responseText);
                                    insertId = http.responseText;
                                }
                            }
                        let title = document.getElementById("title").value;
                        let sendData = {
                            art: outputData,
                            post: {
                                title: title,
                                created_at: new Date(),
                                intro_img: "https://placehold.it/1920/1080",
                                post_img: "https://placehold.it/300/300"
                            }
                        }
                        http.send(JSON.stringify(sendData));
                    });
                });

            }).catch((error) => {
                console.log('Saving failed: ', error)
            });
        }
    </script>
</body>

</html>