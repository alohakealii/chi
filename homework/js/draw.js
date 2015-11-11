// Assignment for Jim Mildrew's CS 116A class, Fall 2014
// Partial code given by Jim Mildrew
// Edited and completed by Qui Trinh



// Listener management -------------------------------------------------- 

var activeListeners = [];

function addCanvasListener(event, functionObj) {
  canvas.addEventListener(event, functionObj);
  activeListeners.push({event: event, func: functionObj});
}

function removeCanvasListeners() {
  activeListeners.forEach(
    function(listener) {
      canvas.removeEventListener(listener.event, listener.func);
    }
  );
  activeListeners = [];
}



// Mode selection --------------------------------------------------

var modeSelect = document.getElementById('modeSelect');
var colorSelect = document.getElementById('colorSelect');

function changeMode(event) { window[modeSelect.value](); }
modeSelect.addEventListener("change", changeMode);
changeMode();

function changeColor(event) { window[colorSelect.value](); }
colorSelect.addEventListener("change", changeColor);
changeColor();



// Graph paper --------------------------------------------------

function drawGraphPaper(units, color) {

  units = units || 20;
  color = color || "cornflowerblue"

  context.save();
  context.strokeStyle = color;
  context.beginPath();

  for (var i = 0.5; i <= canvas.width; i += units) {
    context.moveTo(i, 0.5);
    context.lineTo(i, canvas.height);
  }
  
  for (i = 0.5; i <= canvas.height; i += units) {
    context.moveTo(0.5, i);
    context.lineTo(canvas.width, i);
  }
  
  context.stroke();
  context.restore();
}

// test: draw the graph paper
drawGraphPaper();



// UIBox --------------------------------------------------

function drawUIBox(x, y, width, height) {  
  context.save();
  context.fillStyle = "white";
  context.strokeStyle = "black";
  context.shadowColor = "black";
  context.shadowOffsetX = 5;
  context.shadowOffsetY = 5;
  context.shadowBlur = 15;
  context.strokeRect(x, y, width, height);
  context.fillRect(x, y, width, height);
  context.restore();
}

// test: drawUIBox
//drawUIBox(10, 470, 100, 20);



// Messages --------------------------------------------------

function showMessage(string) {

  var box = {x: 10, y: 470, width: 180, height: 20};
  
  context.save();
  
  // draw the box exterior
  if (!showMessage.boxDrawn) {
    drawUIBox(box.x, box.y, box.width, box.height);
    showMessage.boxDrawn = true; // prevent redraw of the box
  }
  
  // draw the box contents
  context.fillStyle = "white";
  context.fillRect(box.x, box.y, box.width, box.height);
  context.fillStyle = "black";
  context.font = "14px Arial";
  context.fillText(string, box.x + 7, box.y+ 15);
  context.restore();
}

// test: showMessage
//showMessage("Ready to draw?");

function showCoordinates(x, y) {
  var coordinateString = "mouse location: (" + x + ", " + y + ")";
  showMessage(coordinateString);
}

// test: showCoordinates
//showCoordinates(101, 99);

function mouseAt(event) {
  
  var x = event.clientX - canvas.offsetLeft,
      y = event.clientY - canvas.offsetTop;
  
  showCoordinates(x, y);
};

// text: mouse event handler
canvas.addEventListener("mousemove", mouseAt);



// Default color --------------------------------------------------

function setDefaultShapeColor(r, g, b, a) {
  r = r || 127;
  g = g || 127;
  b = b || 127;
  a = a || 0.2;  
  context.fillStyle =
    "rgba(" + r + ", " + g + ", " + b + ", " + a + ")";
  context.strokeStyle =
    "rgb(" + r + ", " + g + ", " + b + ")";
}

// test: draw a few shapes using a new default color
setDefaultShapeColor(255, 190, 30, 0.2);
//setDefaultShapeColor();
//context.fillRect(10, 10, 100, 100);
//context.fillRect(50, 50, 100, 100);



// Rect shapes --------------------------------------------------

function RectShape(x, y, width, height) {
  this.x = x;
  this.y = y;
  this.width = width;
  this.height = height;
  this.angle = 0;
}

RectShape.prototype.path = function() {
  context.beginPath();
  if (!this.angle) {
    context.rect(this.x, this.y, this.width, this.height);
  }
  else {
    context.save();
    context.translate(this.x + (this.width / 2), this.y + (this.height / 2));
    context.rotate(this.angle);
    context.rect(-this.width / 2, -this.height/2, this.width, this.height);
    context.restore();
  }
}

RectShape.prototype.draw = function() {
  context.save();
  this.path();
  context.stroke();
  context.fill();
  context.restore();
}



// Shapes list --------------------------------------------------

var shapes = [];

function drawAllShapes() {
  shapes.forEach(
    function(shape) { shape.draw(); }
  );
}

function clearAndRedraw() {
  context.clearRect(0, 0, canvas.width, canvas.height);
  drawGraphPaper();
  showMessage.boxDrawn = false;
  showMessage("Ready to draw?");
  drawAllShapes();
}

// test: drawAllShapes
//shapes.push(new RectShape(10, 10, 100, 100));
//shapes.push(new RectShape(50, 50, 100, 100));
//shapes.push(new RectShape(canvas.width / 4, canvas.height / 4, canvas.width / 2, canvas.height / 2));
drawAllShapes();
clearAndRedraw();



// Draw mode --------------------------------------------------

var mousePressed = false;
var rect = new RectShape(0, 0, 0, 0); // global variable to hold 
                                      // and pass rectangle variables
                                      // between methods
var firstPoint = undefined,
    secondPoint = undefined;
	
function startRubberband(event)
{
  mousePressed = true;
  image = context.getImageData(0, 0, canvas.width, canvas.height);

  firstPoint = {x: event.clientX - canvas.offsetLeft,
                y: event.clientY - canvas.offsetTop};

}

function moveRubberband(event)
{
  if (mousePressed)
  {
   
    secondPoint = {x: event.clientX - canvas.offsetLeft,
                   y: event.clientY - canvas.offsetTop};
    
	context.clearRect(0, 0, canvas.width, canvas.height);
	context.putImageData(image, 0, 0);
	
	// set variables and draw temporary rectangle
	rect.x = firstPoint.x; 
	rect.y = firstPoint.y; 
	rect.width = secondPoint.x - firstPoint.x;
	rect.height = secondPoint.y - firstPoint.y;
	rect.draw();
  }
}

function endRubberband(event)
{
  // push a new rect based on temporary variables
  if (rect.width != 0 && rect.height != 0) {
    shapes.push(new RectShape(rect.x, 
                              rect.y, 
                              rect.width, 
                              rect.height));
  }
  mousePressed = false;
  firstPoint = secondPoint = undefined;
  rect.x = rect.y = rect.width = rect.height = 0;  
  clearAndRedraw();

}

function drawMode() {
  removeCanvasListeners();
  addCanvasListener("mousedown", startRubberband);
  addCanvasListener("mousemove", moveRubberband);
  addCanvasListener("mouseup", endRubberband);
  addCanvasListener("mousemove", mouseAt);
  canvas.style.cursor = 'crosshair';
}



// Hit mode --------------------------------------------------

function hitTest() {
  var index = -1;
  for (i = 0; i < shapes.length; i++)
  {
	shapes[i].path();
	if (context.isPointInPath(event.clientX - canvas.offsetLeft, 
	                          event.clientY - canvas.offsetTop))
	  index = i;
  }
  return index;
}

function doHitTests(event) {
  if (hitTest() >= 0)
    alert("hit!");
  else
    alert("miss");
}

function hitMode() {
  removeCanvasListeners();
  addCanvasListener("click", doHitTests);
  addCanvasListener("mousemove", mouseAt);
  canvas.style.cursor = 'default';
}



// Delete mode --------------------------------------------------

function doDeleteHit(event) {
  var deleteIndex = hitTest();
  if (deleteIndex >= 0) {
    shapes.splice(deleteIndex, 1);
    clearAndRedraw();
  }
}

function deleteMode() {
  removeCanvasListeners();
  addCanvasListener("click", doDeleteHit);
  addCanvasListener("mousemove", mouseAt);
  canvas.style.cursor = 'default';
}



// Move mode --------------------------------------------------

var moveOffsetX = 0,
    moveOffsetY = 0;
	
function doMoveHit(event) {
  mousePressed = true;
  firstPoint = {x: event.clientX - canvas.offsetLeft,
                y: event.clientY - canvas.offsetTop};
  var moveIndex = hitTest();
  rect = shapes[moveIndex];
  moveOffsetX = firstPoint.x - rect.x;
  moveOffsetY = firstPoint.y - rect.y;
}

function doMoveDrag(event) {
  if (mousePressed) {
    secondPoint = {x: event.clientX - canvas.offsetLeft,
                   y: event.clientY - canvas.offsetTop};
	rect.x = secondPoint.x - moveOffsetX;
	rect.y = secondPoint.y - moveOffsetY;
	clearAndRedraw();
  }
}

function doMoveDone(event) {
  rect = new RectShape(0, 0, 0, 0);
  mousePressed = false;
  moveOffsetX = moveOffsetY = 0;
  firstPoint = secondPoint = undefined;
}

function moveMode() {
  removeCanvasListeners();
  addCanvasListener("mousedown", doMoveHit);
  addCanvasListener("mousemove", doMoveDrag);
  addCanvasListener("mouseup", doMoveDone);
  addCanvasListener("mousemove", mouseAt);
  canvas.style.cursor = 'move';
}



// Rotate mode --------------------------------------------------

function doRotateHit(event) {
  mousePressed = true;
  context.save();
  firstPoint = {x: event.clientX - canvas.offsetLeft,
                y: event.clientY - canvas.offsetTop};
  var rotateIndex = hitTest();
  rect = shapes[rotateIndex];
}

function doRotateDrag(event) {
  if (mousePressed) {
    secondPoint = {x: event.clientX - canvas.offsetLeft,
                   y: event.clientY - canvas.offsetTop};    
    rect.angle = (Math.atan2(secondPoint.y - firstPoint.y, 
                                        secondPoint.x - firstPoint.x));
    clearAndRedraw();
  }
}

function doRotateDone(event) {
  mousePressed = false;
  firstPoint = secondPoint = undefined;
  context.restore();
}

function rotateMode() {
  removeCanvasListeners();
  addCanvasListener("mousedown", doRotateHit);
  addCanvasListener("mousemove", doRotateDrag);
  addCanvasListener("mouseup", doRotateDone);
  addCanvasListener("mousemove", mouseAt);
  canvas.style.cursor = 'alias';
}



// Color mode --------------------------------------------------

function defaultColor() {
  
  setDefaultShapeColor(255, 190, 30, 0.2);
  if (shapes != undefined) // will crash without if line possibly
                           // because shapes has an undefined value
						   // somewhere during initialization 
    clearAndRedraw();
}

function redColor() {
  setDefaultShapeColor(255, 0, 0, 0.2);
  clearAndRedraw();
}

function greenColor() {
  setDefaultShapeColor(102, 204, 0, 0.2);
  clearAndRedraw();
}

function blueColor() {
  setDefaultShapeColor(0, 0, 255, 0.2);
  clearAndRedraw();
}



// Initialize app --------------------------------------------------

function initApp() {
  clearAndRedraw();
}

// and away we go...
initApp();


