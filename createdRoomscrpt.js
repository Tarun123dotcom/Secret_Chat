document.addEventListener('DOMContentLoaded',function(){
    const min = 10000;
    const max = 99999;
    const randomInteger = Math.floor(Math.random() * (max - min + 1)) + min;
    const myspan = document.getElementById('mySpan');
    const text = randomInteger.toString();
    myspan.textContent=text;
    window.roomId = randomInteger;
})