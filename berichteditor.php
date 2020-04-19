<?php

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
        <div class="title_input">
            <label for="title"> Titel </label>
            <input type="text" name="title" id="title" placeholder="Titel" class="form-control">
        </div>
        <!-- <file upload> -->
        <div class="file-input">
            <input type="file" name="file-input" id="file-input" class="file-input__input" />
            <label class="file-input__label" for="file-input">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="far" data-icon="image" class="svg-inline--fa fa-image fa-w-16" role="img" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm-6 336H54a6 6 0 0 1-6-6V118a6 6 0 0 1 6-6h404a6 6 0 0 1 6 6v276a6 6 0 0 1-6 6zM128 152c-22.091 0-40 17.909-40 40s17.909 40 40 40 40-17.909 40-40-17.909-40-40-40zM96 352h320v-80l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L192 304l-39.515-39.515c-4.686-4.686-12.284-4.686-16.971 0L96 304v48z" /></svg>
                <span>Upload file</span></label>
        </div>
        <!-- </file upload> -->
        <button onclick="save()" class="btn btn-primary btn-small">Opslaan</button>
    </div>

    <div id="upload-demo"></div>



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

        $('#file-input').on('change', function() {
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
        let insertId = -1;
        const editor = new EditorJS({
            holderId: 'editorJs',

            tools: {
                linkTool: {
                    class: LinkTool,
                    config: {
                        endpoint: "./php/editor/fetchLinkData.php",
                    }
                },
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