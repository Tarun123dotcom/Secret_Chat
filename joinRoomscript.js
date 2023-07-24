import { roomId } from "./createdRoomscrpt";
document.addEventListener('DOMContentLoaded',function(){
    const myForm = document.getElementById('myForm');
    const textBoxInput = document.getElementById('textbox');
    myForm.addEventListener('submit',function(event){
            event.preventDefault();
            const roomNumber = textBoxInput.value;
    });
    if (roomNumber == roomId){
        window.location.href='chat.html';
    }else{
        window.location.href='error.html';
    }
})