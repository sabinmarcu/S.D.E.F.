InitDragDrop();

function InitDragDrop()
{
    document.onmousedown = OnMouseDown;
    document.onmouseup = OnMouseUp;
}
var _startX = 0;  
var _startY = 0;
var _offsetX = 0;           
var _offsetY = 0;
var _dragElement;              

function OnMouseDown(e)
{
    if (e == null) 
        e = window.event; 
    var target = e.target != null ? e.target : e.srcElement;
    if ((e.button == 1 && window.event != null || 
        e.button == 0) && 
        target.className == 'container drag')
    {
        _startX = e.clientX;
        _startY = e.clientY;
        _offsetX = ExtractNumber(target.style.left);
        _offsetY = ExtractNumber(target.style.top);
        _oldZIndex = target.style.zIndex;
        target.style.zIndex = 10000;
        _dragElement = target;
        document.onmousemove = OnMouseMove;
        document.body.focus();
        document.onselectstart = function () { return false; };
        target.ondragstart = function() { return false; };
        return false;
    }
}
function OnMouseMove(e)
{
    if (e == null) 
        var e = window.event; 
    _dragElement.style.left = (_offsetX + e.clientX - _startX) + 'px';
    _dragElement.style.top = (_offsetY + e.clientY - _startY) + 'px';
    windows[$(_dragElement).attr('id')].x = _dragElement.style.left;
    windows[$(_dragElement).attr('id')].y = _dragElement.style.top;
}
function OnMouseUp(e)
{
    if (_dragElement != null)
    {
        _dragElement.style.zIndex = _oldZIndex;
        document.onmousemove = null;
        document.onselectstart = null;
        _dragElement.ondragstart = null;    
        _dragElement = null;
    }
}
function ExtractNumber(value)
{
    var n = parseInt(value);
    return n == null || isNaN(n) ? 0 : n;
}

