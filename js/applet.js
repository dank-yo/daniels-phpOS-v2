class Applet {
    constructor(id, name='application', type, path='none', width, height) {
      this.id = id;
      this.name = name;
      this.type = type;
      this.path = path;
      this.icon = `${this.path}icon.svg`;
      this.width = width;
      this.height = height;
  
      if (this.type === 'application') {
        this.element = document.createElement('li');
        this.element.setAttribute('class', 'd-flex align-items-center');
        this.element.innerHTML = `<div id='indicator-${this.name}'></div><img class='dock-icon' src='${this.icon}' onclick="createObject('${this.id}', '${this.name}', '${this.path}', ${this.width}, ${this.height})"></img>`;
      } else if (this.type === 'folder') {
        this.element = document.createElement('li');
        this.element.setAttribute('class', 'd-flex align-items-center');
        this.element.innerHTML = `<div id='indicator-${this.name}'></div><img class='dock-icon' src='${this.icon}' onclick=""></img>`;
      }
    }
  }
  