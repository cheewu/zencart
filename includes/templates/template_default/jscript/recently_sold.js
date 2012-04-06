<!--
      var layerHeight = 500;
      var iFrame = 1;
      var iFrequency = 50;
      var speed = 10;
      var timer;
      var n1 = $("recently_sold_items");
      var n2 = $("recently_sold_items_a");
      var n3 = $("recently_sold_items_b");
      var goup = $("goup");
      var godown = $("godown");
      var h1 = 474-layerHeight;
        if(474 >= layerHeight){
          n1.style.height = layerHeight+'px';
        }else{
          n1.style.height = 474+'px';
		}
          n3.innerHTML = n2.innerHTML;
        function move(){
            if(n1.scrollTop >= 474)
              n1.scrollTop -= (474 - iFrame);
            else
              n1.scrollTop += iFrame;
              if(n1.scrollTop<=0) n1.scrollTop=h1-n1.scrollTop;

        }
        goup.onmousedown = function (){iFrame = +speed;return false;};
        goup.onmouseup = function(){iFrame=1};
        godown.onmousedown = function (){iFrame = -speed;return false;};
        godown.onmouseup = function(){iFrame=1};

        timer = setInterval("move()",iFrequency);
        n1.onmouseover=function() {clearInterval(timer);}
        n1.onmouseout=function() {timer=setInterval("move()",iFrequency);iFrame=1;}
//-->