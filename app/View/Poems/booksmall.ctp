
<!DOCTYPE html>
<html>
<head>
    <title>
        谐调-     哲理诗   </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?php
        echo $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css');
        echo $this->Html->css('custom_bootstrap');
        echo $this->Html->css('style');
        echo $this->Html->script('//code.jquery.com/jquery-1.11.2.min.js');
        echo $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js');
        echo $this->Html->script('//www.turnjs.com/lib/turn.min.js');
    ?>
<style type='text/css'>
    html, body {
    margin: 0;
    height: 100%;
}

body {
    background-color: #333;
}

body.hide-overflow {
    overflow: hidden;
}

/* helpers */

.t {
    display: table;
    width: 100%;
    height: 100%;
}

.tc {
    display: table-cell;
    vertical-align: middle;
    text-align: center;
}

.rel {
    position: relative;
}

/* book */

.book {
    margin: 0 auto;
    width: 90%;
    height: 90%;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    overflow: visible !important;
}

.book .page {
    height: 100%;
    background-color: #fff;
}

.book .page img {
    max-width: 100%;
    height: 100%;
}
  </style>
  
</head>
<body>
  <div class="t">
    <div class="tc rel">
        <div class="book" id="book">
            <?php
            foreach($poems as $poem){
            ?>
                <div class="page">
                    <div class="book-content">
                        <center>
                            <div class="well" style="padding:20px 0;height:440px;">
                                <div style="font-size:18px;">
                                    <?php 
                                    if($poem){
                                        echo $poem['Poem']['number'].'·'.$poem['Poem']['title'];
                                    }?>
                                </div>
                            <?php 
                            if($poem){
                                if($poem['Poem']['like']){
                                    $like_number = $poem['Poem']['like'];
                                }else{
                                    $like_number = 0;
                                }
                                echo $poem['Poem']['content'];
                                echo '<button type="button" class="btn btn-custom btn-action" onclick = "this.disabled=true;like('.$poem['Poem']['id'].','.$poem['Poem']['like'].');return true;">
                                        <div id="like_number'.$poem['Poem']['id'].'" style="float:left;">'.$like_number.'</div>&nbsp;<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                                    </button>';
                            }?>
                            </div>
                        </center>   
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
  



<script type='text/javascript'>//<![CDATA[

function like(poem_id, poem_like) {
    poem_like = poem_like + 1;
    document.getElementById("like_number" + poem_id).innerHTML = poem_like;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "../like/" + poem_id + '?like_number=' + poem_like, true);
    xmlhttp.send();
}

/*
 * Turn.js responsive book
 */

/*globals window, document, $*/

(function () {
    'use strict';

    var module = {
        ratio: 0.69, //1.38,
        init: function (id) {
            var me = this;

            // if older browser then don't run javascript
            if (document.addEventListener) {
                this.el = document.getElementById(id);
                this.resize();
                this.plugins();

                // on window resize, update the plugin size
                window.addEventListener('resize', function (e) {
                    var size = me.resize();
                    $(me.el).turn('size', size.width, size.height);
                });
            }
        },
        resize: function () {
            // reset the width and height to the css defaults
            this.el.style.width = '';
            this.el.style.height = '';

            var width = this.el.clientWidth,
                height = Math.round(width / this.ratio),
                padded = Math.round(document.body.clientHeight * 0.95);

            // if the height is too big for the window, constrain it
            if (height > padded) {
                height = padded;
                width = Math.round(height * this.ratio);
            }

            // set the width and height matching the aspect ratio
            this.el.style.width = width + 'px';
            this.el.style.height = height + 'px';

            return {
                width: width,
                height: height
            };
        },
        plugins: function () {
            // run the plugin
            $(this.el).turn({
                display: "single",
                gradients: true,
                acceleration: true
            });
            // hide the body overflow
            document.body.className = 'hide-overflow';
        }
    };

    module.init('book');
}());
//]]> 

</script>

</body>

</html>

