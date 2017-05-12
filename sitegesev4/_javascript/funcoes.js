var scrollY = 0;
var distance = 40;
function desceScroll(el) {
	var currentY = window.pageYOffset;
	var targetY = document.getElementById(el).offsetTop;
	var bodyHeight = document.body.offsetHeight;
	var yPos = currentY + window.innerHeight;
	var animator = setTimeout('desceScroll(\''+el+'\')',10);
	if(yPos > bodyHeight)
	{
		clearTimeout(animator);
	} 
	else 
	{
		if(currentY < targetY-distance)
		{
		    scrollY = currentY+distance;
		    window.scroll(0, scrollY);
	    } 
	    else 
	    {
		    clearTimeout(animator);
	    }
	}
}
function resetScroller(el){
	var currentY = window.pageYOffset;
    var targetY = document.getElementById(el).offsetTop;
	var animator = setTimeout('resetScroller(\''+el+'\')',10);
	if(currentY > targetY+distance)
	{
		scrollY = currentY-distance;
		window.scroll(0, scrollY-50);
	} 
	else 
	{
		clearTimeout(animator);
	}
}