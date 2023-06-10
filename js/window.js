class Window{
    constructor(id, name, path, width, height){
        this.id = id;
        this.name = name;
        this.width = width;
        this.height = height;
        this.path = path;

        let wrapper_height = parseInt(this.height) + 26;

        this.element = document.createElement("div");
        this.element.setAttribute("class","window-wrapper");
        this.element.setAttribute("id",`window-${id}`);
        this.element.setAttribute("onclick",`bringToFront(${id})`);
        this.element.style=`width: ${this.width}px; height:${wrapper_height}px; position: absolute;`;
        this.element.innerHTML=`<div id='${id}', class='window-titlebar-wrapper d-flex justify-content-between'>\
                                    <ul class='titlebar-buttons'>\
                                        <a class='titlebar-button button-close' type='button' onclick='closeWindow("window-${this.id}")'></a>\
                                        <a class='titlebar-button button-minimize' type='button'></a>\
                                        <a class='titlebar-button button-maximize' type='button'></a>\
                                    </ul>
                                    <div class='titlebar-text text-center shell-text'>${this.name}</div>
                                    <div id='' class='titlebar-text text-center shell-text'></div>
                                </div>
                                <iframe id='${id}' class='window-frame-wrapper' name='frame-${id}' src='${path}' onclick='bringToFront(${id})' style='width: ${width}px; height: ${height}px; position: absolute;'></iframe>\
                                `;
        
    }
}

function createObject(id, name, path, width, height){
    if(!window['w' + id]){
        window['w' + id] = new Window(id, name, path, width, height);
    }
    document.getElementById('desktop').appendChild(window['w' + id].element);
    dragWindow(window['w' + id].element);
    console.log(`[DK-Console]: ${name} object created!`);
}


function closeWindow(id){
    const e = document.getElementById(id);
    panel = e.name;
    e.remove();
    return console.log(`[DK-Console]: ${id} closed.`);
}

function hideWindow(id){
    const e = document.getElementById(id);
    e.style.display('hidden');
    return console.log(`[DK-Console]: ${id} hidden.`);
}

function unhideWindow(id){
    const e = document.getElementById(id);
    e.style.remove("flex!important");
    return console.log(`[DK-Console]: ${id} re-opened.`);
}

function bringToFront(id) {
  const element = document.getElementById(`window-${id}`);
  if (element) {
    element.style.zIndex = getHighestZIndex() + 1;
  }
}

function getHighestZIndex() {
  let highestZIndex = 0;
  const elements = document.getElementsByClassName('window-wrapper');
  for (let i = 0; i < elements.length; i++) {
    const zIndex = parseInt(elements[i].style.zIndex);
    if (zIndex > highestZIndex) {
      highestZIndex = zIndex;
    }
  }
  return highestZIndex;
}


function dragWindow(elmnt) {
    var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    if (document.getElementById(`${elmnt.id}`)) {
      // if present, the header is where you move the DIV from:
      document.getElementById(`${elmnt.id}`).onmousedown = dragMouseDown;
    } else {
      // otherwise, move the DIV from anywhere inside the DIV:
      elmnt.onmousedown = dragMouseDown;
    }
  
    function dragMouseDown(e) {
      e = e || window.event;
      e.preventDefault();
      // get the mouse cursor position at startup:
      pos3 = e.clientX;
      pos4 = e.clientY;
      document.onmouseup = closeDragElement;
      // call a function whenever the cursor moves:
      document.onmousemove = elementDrag;
    }
  
    function elementDrag(e) {
      e = e || window.event;
      e.preventDefault();
      // calculate the new cursor position:
      pos1 = pos3 - e.clientX;
      pos2 = pos4 - e.clientY;
      pos3 = e.clientX;
      pos4 = e.clientY;
      // set the element's new position:
      elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
      elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    }
  
    function closeDragElement() {
      // stop moving when mouse button is released:
      document.onmouseup = null;
      document.onmousemove = null;
    }
}

function resizeElement(elmnt) {
    var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    if (document.getElementById(`titlebar-${elmnt.id}`)) {
      // if present, the header is where you move the DIV from:
      document.getElementById(`titlebar-${elmnt.id}`).onmousedown = dragMouseDown;
    } else {
      // otherwise, move the DIV from anywhere inside the DIV:
      elmnt.onmousedown = dragMouseDown;
    }
  
    function dragMouseDown(e) {
      e = e || window.event;
      e.preventDefault();
      // get the mouse cursor position at startup:
      pos3 = e.clientX;
      pos4 = e.clientY;
      document.onmouseup = closeDragElement;
      // call a function whenever the cursor moves:
      document.onmousemove = elementDrag;
    }
  
    function elementDrag(e) {
      e = e || window.event;
      e.preventDefault();
      // calculate the new cursor position:
      pos1 = pos3 - e.clientX;
      pos2 = pos4 - e.clientY;
      pos3 = e.clientX;
      pos4 = e.clientY;
      // set the element's new position:
      elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
      elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    }
  
    function closeDragElement() {
      // stop moving when mouse button is released:
      document.onmouseup = null;
      document.onmousemove = null;
    }
}