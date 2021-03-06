<html>
<head>
    <title>upload your website Online Coding</title>
    <base href="{{URL::to('/')}}">

    <meta property="og:url" content="upload-website.com/Online"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title"
          content="upload website - Front End Developer Playground &amp; Code Editor in the Browser"/>
    <meta property="og:description" content="front end web development playground , share your code online"/>
    <meta property="og:image" content="http://upload-website.com/images/Online.PNG"/>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}css/Online/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.19.0/codemirror.min.css">
    <link rel="stylesheet" href="https://codemirror.net/theme/ambiance.css">
    <link rel="stylesheet" href="/css/Online/simplescrollbars.css">
    <link type="text/css" rel="stylesheet" href="//golden-layout.com/assets/css/goldenlayout-base.css"/>
    <link type="text/css" rel="stylesheet" href="//golden-layout.com/assets/css/goldenlayout-dark-theme.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/Online/upload.css">

 

    <meta name="description" content="html ,css ,javascipt editor online ,coding playgrounds ,Test your JavaScript, CSS, HTML   online with Upload website code editor.
 "/>
 
</head>

<body id="MyController" ng-app="App" ng-controller="Live">
<div class="fake-line-1"></div>
<nav class="navbar  navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">

                <img style="width: 175px; margin-left: 20px;" src="{{URL::to('/')}}/images/footer-logo.png"
                     alt="{{URL::to('/')}}"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">

            <ul class="nav navbar-nav navbar-right">

                <li style="cursor: pointer;border-left: 2px solid rgba(34, 34, 34, 0.53);"><a href="../Online/"><span
                                class="glyphicon glyphicon-plus"></span> New </a>
                </li>
                @if($show)
                    <li style="cursor: pointer;border-left: 2px solid rgba(34, 34, 34, 0.53);"><a href="../Live/{{$id}}"
                                                                                                  target="_blank"><span
                                    class="glyphicon glyphicon-resize-full"></span> Full Screen</a>
                    </li>
                @endif
                <li id="save-window" style="cursor: pointer;border-left: 2px solid rgba(34, 34, 34, 0.53);">
                    <a><span class="glyphicon glyphicon-eject"></span>
                        Save</a></li>
                <li ng-click="Run()" style="cursor: pointer;border-left: 2px solid rgba(34, 34, 34, 0.53);"><a><span
                                class="glyphicon glyphicon-play" ng-click="Run()"></span> Run</a>
                </li>


            </ul>
        </div>
    </div>
</nav>


<div id="loading">
    <div>
        <img src="images/loading.gif"><br>
        Loading Editor Content...
    </div>
</div>

<div id="save-project" class="pop-window">
    <div>
        <div class="title">Save Current Project / Save as new</div>
        <br>

        <input id="projectSaveName" ng-model="TitleName" type="text" placeholder="Project Name" value="D3 Animations"
               required><br><br>
        <button ng-click="Save()" ng-disabled="false" id="save">SAVE</button>
        <button id="cancel" class="close-pop">CANCLE</button>
    </div>
</div>

<div id="ext-source" class="pop-window">
    <div>
        <div class="title">Enter CSS & JS external sources</div>
        <br>
        <p>Sources will be added in the project in the exact order you list them below</p>
        <p>Javascript External Scripts <br><span
                    class="weak"> &lt;script src='...' type='text/javascript'>&lt;/script></span></p>
        <textarea id="js-src"
                  placeholder="">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         </textarea>
        <p>CSS External Scripts <br><span class="weak"> &lt;link rel="stylesheet" href="...">
            </span></p>
        <textarea
                id="css-src">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         </textarea><br><br>
        <button id="save-ext-sources">SAVE</button>
        <button id="cancel" class="close-pop">CANCLE</button>
    </div>
</div>


</body>



<script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
<script type="text/javascript" src="//golden-layout.com/assets/js/goldenlayout.min.js"></script>
<script src="{{URL::to('/')}}/js/App.js"></script>



<script >
    var k = false
    @if($show)
     $(window).ready(function(){
         k = true
        });
       @endif
    var iframe ="<iframe  @if($show) src='Live/{{$id}}'  @endif id='abc_frame'  style='background: whitesmoke; border: 0;  width: 100%;  height: 100%; top: 0;  left: 0;  z-index: 1;display:none' ></iframe>";
    var editorHtml = null;
    var editorCss = null;
    var editorJs = null;
</script>
<script src="css/Online/upload.js"></script>
<script src="css/Online/codemirror.js"></script>
<script src="css/Online/simplescrollbars.js"></script>
<script src="css/Online/xml.js"></script>
<script src="css/Online/javascript.js"></script>
<script src="css/Online/css.js"></script>


</html>

