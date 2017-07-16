<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token()  }}">
    <title>New Blog</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.11.0/styles/tomorrow-night.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <link rel="stylesheet" href="https://joshuajohnson.co.uk/Choices/assets/styles/css/choices.min.css">

    <link rel="stylesheet" href="{{ asset('css/write/style.css')  }}">
</head>
<body>

<div class="modal" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                Setting
            </div>
            <div class="modal-body">
                This is setting body

                <form action="javascript:void(0)">
                    <div class="form-group">
                        <label for="description">Post Description:</label>
                        <input type="text" name="description" id="description" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <select type="text" id="tags" multiple></select>

                        <button class="btn btn-primary" data-dismiss="modal">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">

                            <li>
                                <a href="/user/{{ Auth::user()->id}}">Profile</a>
                            </li>
                            <li>
                                <a href="{{ @route('newBlog') }}">New Blog Post</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="container">

    <button onclick="showPicker()">Show Picker</button>

    <div class="box" style="border: 1px solid #eee; padding: 2%;">

        <div class="tools">
            <button class="btn btn-danger" data-toggle="modal" data-target="#modal">Setting</button>
            <button class="btn btn-primary" >Save</button>
            <button class="btn btn-warning" onclick="publish()">Publish</button>
        </div>

        <div class="form">
            <div class="form-group">

                <input type="text" placeholder="Title : How to ..." id="title" class="title" />
            </div>

                <textarea id="myEditor"></textarea>

        </div>


    </div>



</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.11.0/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>

<script src="https://joshuajohnson.co.uk/Choices/assets/scripts/dist/choices.min.js"></script>


<script type="text/javascript" src="https://static.filestackapi.com/v3/filestack.js"></script>
<script>

    var imageUrl = "";

    var client = filestack.init('A6zLIqWR8S34i7vIrTAjcz');
    function showPicker() {
        client.pick({
            accept: 'image/*',
            maxFiles: 1,
            transformations: { crop: { aspectRatio: 16/9, circle: false } },
            onFileUploadFinished: function(file){
                imageUrl = file.url;
            }
        }).then(function(result) {
            console.log(JSON.stringify(result.filesUploaded))
        });
    }

    $(document).ready(function(){

    $(window).scroll(function(){
        if($(window).scrollTop() >= 190.390625){
            $(".editor-toolbar").addClass('fixed');
            $(".CodeMirror").css("margin-top", "48px");
        }else{
            $(".editor-toolbar").removeClass('fixed');
            $(".CodeMirror").css("margin-top", "0px");
        }
        }
    );

    });

    var choices = new Choices($("#tags")[0], {
        choices : [@foreach($tags as $tag)
        {
            label : "{{ $tag->name  }}",
            value: "{{ $tag->name  }}",
            customProperties : {
                real_id: "{{ $tag->id }}",
            }

        },@endforeach],
        paste: true,
        searchEnabled: true,
        searchChoices: true,
        addItems: true,
        removeItems: true,
        removeItemButton: false,

    });


    var simplemde = new SimpleMDE({autofocus: true,
        autoDownloadFontAwesome: true,
        autosave: {
        enabled: true,
            uniqueId: "MyUniqueID",
            delay: 1000,
    },
    blockStyles: {
        bold: "__",
            italic: "_"
    },
    element: document.getElementById("myEditor"),
        forceSync: true,
//        hideIcons: ["guide", "heading"],
        indentWithTabs: false,
        initialValue: "",
        insertTexts: {
        horizontalRule: ["", "\n\n-----\n\n"],
            image: ["![](http://", ")"],
            link: ["[", "](http://)"],
            table: ["", "\n\n| Column 1 | Column 2 | Column 3 |\n| -------- | -------- | -------- |\n| Text     | Text      | Text     |\n\n"],
    },
    lineWrapping: true,
        parsingConfig: {
        allowAtxHeaderWithoutSpace: true,
            strikethrough: false,
            underscoresBreakWords: true,
    },
    placeholder: "Type your ideas here!",
//        previewRender: function(plainText) {
//        return customMarkdownParser(plainText); // Returns HTML from a custom parser
//    },
//    previewRender: function(plainText, preview) { // Async method
//        setTimeout(function(){
//            $("editor-preview-side")[0].innerHTML = customMarkdownParser(plainText);
//        }, 250);
//
//        return "Loading...";
//    },
    promptURLs: true,
        renderingConfig: {
        singleLineBreaks: false,
            codeSyntaxHighlighting: true,
    },
    shortcuts: {
        drawTable: "Cmd-Alt-T"
    },
    showIcons: ["code", "table"],
        spellChecker: false,
        status: true,
        status: ["autosave", "lines", "words", "cursor"], // Optional usage
        status: ["autosave", "lines", "words", "cursor", {
        className: "keystrokes",
        defaultValue: function(el) {
            this.keystrokes = 0;
            el.innerHTML = "0 Keystrokes";
        },
        onUpdate: function(el) {
            el.innerHTML = ++this.keystrokes + " Keystrokes";
        }
    }], // Another optional usage, with a custom status bar item that counts keystrokes
        styleSelectedText: true,
        tabSize: 2,});


    function publish(){
        var title = $("#title").val();
        var content = simplemde.value();

        var tags = choices.getValue();
        var description = $("#description").val();

        if(title !== "" && content !== ""){
            $.ajax({
                type: "POST",
                data: {
                    title : title,
                    cont: content,
                    tags: tags,
                    description: description,
                    banner : imageUrl,
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route("newBlogPost") }}",

                success: function(data){
                    console.log(data);
                    $("#title").val("");
                    simplemde.value("");
                }
            });
        }
    }


</script>

</body>
</html>