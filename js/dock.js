class Dock{
    constructor(){
        const dock = document.createElement("div");
        dock.setAttribute("class", "dock shell-theme rounded");
        document.getElementById('dock-wrapper').appendChild(dock);
    }
}