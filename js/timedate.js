// metoda pobierajaca aktualna date
function gettheDate()
{
    Todays = new Date();
    TheDate = "" + (Todays.getMonth() + 1) + " /" + (Todays.getYear() - 100);
    document.getElementById("data").innerHTML = TheDate;
}

var timerID = null;
var timerRunning = false;
// zatrzymuje zegar
function stopClock()
{
    if(timerRunning)
        clearTimeout(timerID);
    timerRunning = false;
}
// uruchamia zegar
function startClock()
{
    stopClock();
    gettheDate();
    showTime();
}

// pokazuje skonfigurowany czas 
function showTime()
{
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    var timeValue = "" + ((hours > 12) ? hours - 12 : hours)
    timeValue += ((minutes < 10) ? ":0" : ":") + minutes
    timeValue += ((seconds < 10) ? ":0" : ":") + seconds
    timeValue += (hours >= 12) ? " P.M." : " A.M."
    document.getElementById("zegarek").innerHTML = timeValue;
    timerID = setTimeout("showTime()", 1000);
    timerRunning = true;
}