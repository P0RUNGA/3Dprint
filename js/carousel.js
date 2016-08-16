window.onload=function(){
	/**
     * 获取。定义变量
    **/
    var container = document.getElementById('carousel');
	var list      = document.getElementById('list');
	var prev      = document.getElementById('prev');
    var next      = document.getElementById('next');
   	var animated  = false;   //是否执行动画的状态标志
    var len       = 900;     //图片宽度
    var count     = 5;       //图片数量
    var timer;   //定时器

    /**
     * 移动图片(animate)函数
    **/
    function animate(offset){
    	var newleft = parseInt(list.style.left) + offset;
    	var time = 1000;      //位移总时间
    	var interval = 10;    //每次位移的间隔时间
    	var speed = offset/(time/interval); //每个时间间隔内(每次)的位移量
    	animated = true;

    	function go(){
    		if((speed < 0 && parseInt(list.style.left) > newleft) || (speed > 0 && parseInt(list.style.left) < newleft)){
    			list.style.left = parseInt(list.style.left) + speed + "px";
    			setTimeout(go,interval);
    		}
    		else{
    			animated = false;
    			list.style.left = newleft + "px";
		    	if(newleft > -len){
		    		list.style.left = -(len * count) + "px";
		    	}
		    	else if(newleft < -(len * count)){
		    		list.style.left = -len + "px";
		    	}
    		}
    	}
    	go();
	}
    /**
     * 点击箭头时的响应函数
    **/
    next.onclick = function(){
    	if(animated == false)
    		animate(-len);
    }
    prev.onclick = function(){
    	if(animated == false)
    		animate(len);
    }
    /**
     * 设置和清除自动播放
    **/
    function play(){
    	timer = setInterval(function(){
    		next.onclick();
    	},3000);
    }
    function stop(){
    	clearInterval(timer);
    }

    container.onmouseover = stop;
    container.onmouseout = play;
    play();
}