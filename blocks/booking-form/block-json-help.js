// json files don't support comments so we use this file to describe each field.
help = {
    "name": "acf/simple-example", // name of your block, same as folder container  ex: "acf/name-of-block"
    "title": "Recipe Tip",// Title, nice name for our block
    "description": "",
    "render": "file:./render.php", // *** IMPORTANT  Use only from wp 6.1 *** the core of our block, replaces acf/renderTemplate 
    "style": "file:./style.css", // style loaded in editor and front end
    "editorStyle": "file:./editor-style.css", // style loaded only in editor
    "script": "simple-example", // *** IMPORTANT  Use only before wp 6.1 *** use same name as folder container / after wp 6.1 use "file:./script.js"
    "category": "blank", // use category defined at acf-blocks.php
    "icon": "carrot", // use icons from https://developer.wordpress.org/resource/dashicons
    "apiVersion": 2,
    "keywords": [], // max 3 keywords for find our block
    "acf": {
        "mode": "preview", // preview / auto / edit
        "renderTemplate": "render.php" // Use only before wp 6.1, the core of our block.
    },
    "styles": [ // Optional, we can use styles if we need them.
        {
            "name": "red",
            "label": "Red"
        },
        {
            "name": "blue",
            "label": "Blue"
        },
        {
            "name": "green",
            "label": "Green"
        }
    ],
    "supports": {
        "align": [
            "wide",
            "full"
        ], // Supports block alignment can be true (all) or false (none), or  array ["wide", "full","left", "right", "center"]. default = false;
        "anchor": true, // Availability to add an id / anchor field. default = false;
        "alignContent": true, // NOT RECOMENDED - Availability to align content width flex . default = false;
        "color": {
            "text": true,
            "background": true,
            "link": true
        }, // Availability to add a text, background o link colors by default.
        "alignText": true, // Availability to align all aour text elements by default, innerblocks with text align availability can override this option.
        "spacing": {
            "margin": [ // Margin,  can be bolean or array
                "top",
                "bottom"
            ],
            "padding": true, // Padding,  can be bolean or array
            "blockGap": false // Availability to specify a gap between elements
        },
        "dimensions": {
            "minHeight": true // adds MinHeight 
        },
        "__experimentalBorder": {
            "radius": true,
            "color": true,
            "style": true,
            "width": true
        },
        "typography": {
            "lineHeight": true,
            "fontSize": true
        },
        "fullHeight": true,
        "__experimentalLayout": false //
    },
    "attributes": { // Add default attributes in our block editor UI and generates classes or inline styles needed. 
        "backgroundColor": {
            "type": "string",
            "default": "theme-red"
        }
    },
    "example": { // TO DO
        "attributes": {
            "data": {
                "text": "This is an example text field",
                "text_area": "This is an example text area field"
            }
        }
    }
}