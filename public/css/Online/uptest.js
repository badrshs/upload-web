function init(){var a={height:10,settings:{hasHeaders:!1},dimensions:{borderWidth:17},content:[{type:"column",content:[{type:"row",content:[{type:"component",componentName:"HTML",title:"some title",activeItemIndex:1},{type:"component",componentName:"CSS"},{type:"component",componentName:"JAVASCRIPT"}]},{type:"component",componentName:"Result"}]}]},b=new GoldenLayout(a);b.registerComponent("HTML",function(a,b){a.getElement().html('<div class="contenet" style="position:relative"><textarea id="contentHtml" ></textarea><img class="lan" src="https://www.w3.org/html/logo/downloads/HTML5_Logo_512.png"></div>')}),b.registerComponent("CSS",function(a,b){a.getElement().html('<div   class="contenet"><textarea id="contentCss" ></textarea><img class="lan" src="http://w3widgets.com/responsive-slider/img/css3.png"></div>')}),b.registerComponent("JAVASCRIPT",function(a,b){a.getElement().html('<div  class="contenet"><textarea id="contentJs" ></textarea><img class="lan" src="http://www.b2bweb.fr/wp-content/uploads/js-logo-badge-512.png"></div>')}),b.registerComponent("Result",function(a,b){a.getElement().html(iframe)}),b.init(),editorHtml=CodeMirror.fromTextArea(document.getElementById("contentHtml"),{mode:"xml",htmlMode:!0,theme:"ambiance",lineNumbers:!0,scrollbarStyle:"simple"}),editorCss=CodeMirror.fromTextArea(contentCss,{mode:"css",theme:"ambiance",lineNumbers:!0,scrollbarStyle:"simple"}),editorJs=CodeMirror.fromTextArea(contentJs,{mode:"javascript",lineNumbers:!0,theme:"ambiance",scrollbarStyle:"simple"}),setTimeout(function(){$("#loading").css("display","none")},1e3)}$(window).load(function(){init()}),$("#save-window").click(function(){$("#save-project").css("display","block")}),$(".close-pop").click(function(){$(".pop-window").css("display","none")}),$("#new-project").click(function(){}),$("#ext-src").click(function(){$("#ext-source").css("display","block")});