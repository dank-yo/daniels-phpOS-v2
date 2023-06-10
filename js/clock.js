function startTime() {
    //Define new date
    let today = new Date();
    let hours = today.getHours();
    let minutes = today.getMinutes();
    let seconds = today.getSeconds();
    let time_period = hours >= 12 ? 'PM' : 'AM';

    //Update function
    m = checkTime(minutes);
    s = checkTime(seconds);

    //Format the hour slot to 12 hour time
    hours = hours % 12;
    hours = hours ? hours : 12;
    
    //Add the 0 to minuets and seconds
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;

    let time = hours + ':' + minutes + ":" + seconds + " " + time_period;

    document.getElementById('time').innerHTML = time;
    let t = setTimeout(startTime, 500);
}

function checkTime(i) { 
    // add zero in front of numbers < 10
    if (i < 10) {i = "0" + i};  
    return i;
}