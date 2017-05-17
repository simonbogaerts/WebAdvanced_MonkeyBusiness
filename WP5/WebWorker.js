// var i = 0;
//
// function timedCount() {
//   i = i + 1;
//   postMessage(i);
//   setTimeout("timedCount()",500);
// }
//
// timedCount();
// var height = 200, width = 200;
//
// function timedCount() {
//   var square = createElement('div');
//   square.style.width = height + 10;
//   square.style.height = width + 10;
//   square.style.backgroundColor = "black";
//   height = height + 10;
//   width = width + 10;
//   postMessage(square);
//   setTimeout("timedCount()",500);
// }
//
// timedCount();

var out = "";

function timedCount() {
  out = out.concat(" | ");
  postMessage(out);
  setTimeout("timedCount()",500);
}

timedCount();
