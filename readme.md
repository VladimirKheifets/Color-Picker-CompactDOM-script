# Color Picker

### Version: 1.0, 2022-04-08

Author: Vladimir Kheifets <kheifets.vladimir@online.de>

Copyright &copy; 2022 Vladimir Kheifets All Rights Reserved  
     
[CompactDOM on GitHub](https://github.com/VladimirKheifets/Java-Script-library-CompactDOM)

[Online-tutorial of the Java Script Library CompactDOM](https://www.alto-booking.com/developer/CompactDOM/)

[Color Picker Demo](https://www.alto-booking.com/developer/colorpicker/)


## index.html

```html
<html>
<head>
<script type="text/javascript" src="CompactDOM.min.js"></script>
<script type="text/javascript" src="js/index.min.js"></script>
</head>
<body></body>
</html>

```

## CompactDOM Script index.js

```js
/*
The 'ready' method with default selelector 'window' calls an anonymous function
after the page is fully loaded
*/
__.ready( () => {
    //Defining 'head' and 'body' elements
    body = _("body");
    head =  _("head");

    /*
    The 'create' method creates a child element 'title' in the parent element 'head'
    <title>Color picker</title>
    */
    head.create( "Color picker", {tag:"title"} );

    /*
    The 'link' method with default selelector 'head' creates  two child
    elements 'link' in the parent element 'head'
    <link href="css/index.css" rel="stylesheet" type="text/css">
    <link href="css/modal.css" rel="stylesheet" type="text/css">
    */
    __.link("css/index.css,css/modal.css");

    /*
    The 'create' method creates a child element 'meta' in the parent element 'head'
    <meta charset="utf-8">
    */
    head.create(1,{ tag:"meta", charset:"utf-8" });

    /*
    The 'create' method creates a child element 'meta' in the parent element 'head'
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,
     user-scalable=no, user-scalable=0">
    */
    head.create(1,
    {
        tag:"meta",
        name:"viewport",
        content:"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, user-scalable=0"
    });

    /*
    The 'create' method with default selelector 'body' creates a child element 'div'
    in the parent element 'body' and defining 'div' element
    <div align="center"></div>
    */
    div = __.create(1,{tag:"div", align:"center"});

    /*
    The 'create' method creates a child element 'div' in the parent element 'div'
    and defining 'divColorPicker' element
    <div id="color_picker"></div>
    */
    divColorPicker = div.create(1,{tag:"div", id:"color_picker"});

    /*
    The 'create' method creates five child elements 'span' in the parent element 'divColorPicker'
    <div id="color_picker"></div>
        <span class="bgc" title="Click me">
        <span class="bgc" title="Click me">
        <span class="bgc" title="Click me">
        <span class="bgc" title="Click me">
        <span class="bgc" title="Click me">
    </div>
    */
    divColorPicker.create( 5, { tag:"span", class:"bgc", title:"Click me" } );

    /*
    The 'create' method creates a child element 'div' in the parent element 'div'
    and defining 'colorCode' element
    <div></div>
    */
    colorCode = div.create( 1, {tag:"div"} );

    /*
    The 'hide' method makes the 'colorCode' element invisible.
    <div style="display:none"></div>
    */
    colorCode.hide();

    // Defining 'colors' array
    colors = [ "FFFFFF", "F7F7F7", "FFF8F7", "FFFDDE", "F9FEF6" ];

    /*
    The 'each' method calls an anonymous function for each 'span' elements
    with selector '.bgc' (NodeList)
    this function defining  each element - 'el'  and index of element - 'ind'
    */
    _(".bgc").each( ( el, ind ) => {

        /*
        The 'scc' method addes to each element the attribute style="background-color:"
        The value of color for each attribute is determined from the 'colors[ind]'
        <span class="bgc" title="Click me" style="background-color:#FFFFFF"></span>
        <span class="bgc" title="Click me" style="background-color:#F7F7F7"></span>
        ...
        <span class="bgc" title="Click me" style="background-color:#F9FEF6"></span>
        */
        el.css("background-color:#"+colors[ind]);

        /*
        The 'create' method creates a child element 'input' in the each parent element 'el'
        and defining 'inp' element
        <span class="bgc" title="Click me" style="background-color:#FFFFFF">
        <input type="color" value="#FFFFFF">
        </span>
        <span class="bgc" title="Click me" style="background-color:#F7F7F7">
        <input type="color" value="#F7F7F7">
        </span>
        ...
        <span class="bgc" title="Click me" style="background-color:#F9FEF6">
        <input type="color" value="#F9FEF6">
        </span>
        */
        inp = el.create(1,{tag:"input", type:"color", value:"#"+colors[ind]});

        //The 'on' method with the 'inp' selector handles the 'input' event and calls the anonymous function
        inp.on("input", (e) => {

            //The 'hide' method makes the 'colorCode' element unvisible.
            colorCode.hide();

            /*
            The 'val' method with the 'e.target' selector returns the color code
            and defines the 'color' variable.
            The 'toUpperCase' method of native js converts the value
            of the variable 'color' to uppercase
            */
            color = _(e.target).val();
            color = color.toUpperCase();

            //Defining 'selectors' array
            selectors = [el, body, _modal];

            /*
            The 'scc' method for each selector from the "selector" array is
            addes attribute the style="background-color:", or
            changes the previously defined value of this attribute.
            */
            for(i in selectors) selectors[i].css("background-color:" + color );


            //Defining 'modalContent' variable
            modalContent  = "<div>Selected color code: " + color + "</div>";
            modalContent += "<button>Copy code to clipboard</button>";
            modalContent += "<button>Send</button>";

            /*
            Method 'modal' with default selector '#modal'
            displays a modal window with the content from
            the variable 'modalContent'
            */
            __.modal(modalContent);

            /*
            The 'click' method for the 'button' selector
            (two buttons in a modal window) handles the 'click'
            event and calls an anonymous function.
            */

            _("button").click((eB) => {

                /*
                The 'content' method for the 'eB.target' selector
                returns the content of the element.
                */

                if(_(eB.target).content() === "Send")
                {
                    /*
                    The "send" button was clicked

                    Defining 'colorsCode' object
                    */
                    colorsCode={};

                    /*
                    The 'each' method calls an anonymous function for each 'input' elements
                    this function defining  each element - 'elmInput'  and index of element - 'ind'
                    */
                    _("input").each((elmInput, indInp) => {

                        /*
                        The "val" method returns the value of each "input" element.
                        Defining the properties of the 'colorsCode' object
                        */
                        color = elmInput.val()
                        color = color.toUpperCase();

                        //Defining the properties(key:value) of the 'colorsCode' object
                        colorsCode["color"+indInp] = color;
                    });

                    /*
                    The "send" method creates a 'formData' object from
                    the "colorsCode" object and send AJAX Post Request whith default
                    request type - 'FormData' to server(url:"selectedColors.php")
                    and returns AJAX Response with default response type - 'text'
                    to callback function.
                    In this function, the 'css' method changes the background color
                    to 'white' and then the 'modal' method displays
                    the AJAX Response in a modal window.
                    */
                    __.send(
                        {
                            url:"selectedColors.php",
                            method:"post",
                            data:colorsCode,
                            func:(rsp)=>{
                                _modal.css("background-color:white");
                                __.modal(rsp);
                            }
                        }
                    );
                }
                else
                {
                    /*
                    The "Copy color code to clipboard" button was clicked

                    The code of the selected color will be copied to the clipboard
                    */
                    navigator.clipboard.writeText(color);

                    //The content of the 'colorCode' element is created
                    colorCodeContent = "<br>Color code in clipbord: " + color;
                    colorCodeContent += "<button>Clear clipboard</button>";
                    colorCode.content(colorCodeContent);

                    /*
                    The 'click' method for the 'button' selector
                    (buttons in colorCodeContent) handles the 'click'
                    event and calls an anonymous function.
                    */
                    _("button").click(()=>{

                        // Сlear clipboard data
                        navigator.clipboard.writeText("");

                        //The 'hide' method makes the 'colorCode' element unvisible.
                        colorCode.hide();
                    });

                    // The 'show' method makes the colorCode element visible.
                    colorCode.show();
                }

                // The 'modal' method with a parameter of '0' immediately closes the modal window.
                __.modal(0);
            });
        });
    });

     /*
     The 'modal' method without parameters only creates the HTML code of the modal window,
     but does not display it.

     <div id="modal" class="modal" style="opacity: 0; transition-property: opacity;
     transition-duration: 600ms; transition-timing-function: cubic-bezier(0.02, 0.01, 0.47, 1);">
     <div class="modal_close">&times;</div>
     <div id="modal_content" class="modal_content"></div>
     </div>
     <div id="modal_gray_layer" class="modal_gray_layer"></div>
    */
    __.modal();

    //Outputs a current html-document to the web console
    console.log(document.documentElement);
});

```

## HTML document with generated tags

```html
<html>
<head>
<script type="text/javascript" src="CompactDOM.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<title>Color picker</title>
<link href="css/index.css" rel="stylesheet" type="text/css">
<link href="css/modal.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1,
    maximum-scale=1, user-scalable=no, user-scalable=0">
</head>
<body>
<div align="center">
    <div id="color_picker">
        <span class="bgc" title="Click me" style="background-color:#FFFFFF">
            <input type="color" value="#FFFFFF">
        </span>
        <span class="bgc" title="Click me" style="background-color:#F7F7F7">
            <input type="color" value="#F7F7F7">
        </span>
        <span class="bgc" title="Click me" style="background-color:#FFF8F7">
            <input type="color" value="#FFF8F7">
        </span>
        <span class="bgc" title="Click me" style="background-color:#FFFDDE">
            <input type="color" value="#FFFDDE">
        </span>
        <span class="bgc" title="Click me" style="background-color:#F9FEF6">
            <input type="color" value="#F9FEF6">
        </span>
    </div>
    <div style="display:none"></div>
</div>
<div id="modal" class="modal" style="opacity: 0; transition-property: opacity;
transition-duration: 600ms; transition-timing-function: cubic-bezier(0.02, 0.01, 0.47, 1);">
    <div class="modal_close">×</div>
    <div id="modal_content" class="modal_content">
</div>
</div>
<div id="modal_gray_layer" class="modal_gray_layer"></div>
</body>
</html>

```

## selectedColors.php (AJAX Post Request)

```php
<?
echo <<<HTML
<style>
.allColors{width:320px}
.title{font-size: 18px;line-height: 25px;margin-bottom: 20px;}
.post{
    border:1px solid #000000;
    margin:10 0 10 0;
    padding:10px;
    text-align:center}
</style>
<div style="allColors">
<div class='title'>PHP script selectedColors.php<br>
AJAX Post Request was<br>reseived from index.html</div>
HTML;
foreach($_POST as $key=>$value)
echo <<<HTML
<div  class = 'post' style="background-color:$value">
\$_POST['$key'] = $value
</div>
HTML;
?>
</div>

```

## index.css

```css
body, div{
    font-family:arial;
    font-size:14px;
}

button{margin:20 10 20 10}

.bgc{
    display: inline-block;
    border: 1px solid #aaa;
    border-radius:5px;
    width: 20px;
    height: 20px;
    margin: 0 10 0 10;
    cursor: pointer;
}

input[type="color"] {
    opacity: 0;
    display: block;
    width: 20px;
    height: 20px;
    border: none;
    cursor: pointer;
}

#color_picker, #color_picker + div{
    display: block;
    padding: 20 0 20 0;
    background-color: white;
    text-align: center;
    width: 230px;
    border: 1px solid #aaa;
    border-radius:5px;
    box-shadow:3px 3px 3px rgba(0, 0, 0, 0.5)
}

#color_picker + div{margin-top:20px;}
.modal_content{width: 250px}

```

## modal.css

```css
.modal{
    position:absolute;
    z-index:1;
    top:0;
    left:0;
    background-color: #ffffff;
    border: 1px solid #85A0C9;
    border-radius: 5px;
    box-shadow:3px 3px 3px rgba(0, 0, 0, 0.5);
}

.modal_content{
    display:table-cell;
    text-align:center;
    padding:40 20 20 20;
    font-size:14pt;
}

.modal_close{
    font-family: Courier;
    color:#aaa;
    cursor:pointer;
    font-size:50px;
    position:absolute;
    right:0;
    top:0;
    margin:-0.2em 0.3em 0 0;
    caret-color:transparent;
    width: 20px;
}

.modal_close:hover
{color:#FFCCD9;caret-color:transparent;}

.modal_gray_layer{
    width:100%;
    height:100%;
    position:absolute;
    top:0px;
    left:0px;
    background: rgba(0, 0, 0, 0.1);
    display:none;
}
```