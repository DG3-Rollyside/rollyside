<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <button onclick="save()">Opslaan</button>
    <div id="editorJs" style="border: 1px solid black;"></div>

    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/link"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@2.3.3/dist/bundle.min.js"></script>
    <script>

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
                    levels: [1,2],
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
            const http = new XMLHttpRequest();
            let url = './php/editor/saveArticle.php';
            if(insertId !== -1) {
                url += `?postId=${insertId}`;
            }
            console.log(url);

            http.open('POST', url, true);

            //Send the proper header information along with the request
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            http.onreadystatechange = function() {//Call a function when the state changes.
                if(http.readyState == 4 && http.status == 200) {
                    alert(http.responseText);
                    insertId = http.responseText;
                }
            }

            let sendData = {
                art: outputData,
                post: {
                    title: "moi man",
                    created_at: new Date(),
                    intro_img: "https://placehold.it/1920/1080",
                    post_img: "https://placehold.it/300/300"
                }
            }
            http.send(JSON.stringify(sendData));
        }).catch((error) => {
            console.log('Saving failed: ', error)
        });
    }
    </script>
</body>

</html>