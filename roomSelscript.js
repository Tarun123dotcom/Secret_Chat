document.addEventListener('DOMContentLoaded', function() {
    const buttonone = document.getElementById('crRoom');
    const buttontwo = document.getElementById('jrRoom');
    buttonone.addEventListener('click', function() {
      window.location.href = 'createdRoom.php';
    });
    buttontwo.addEventListener('click', function() {
      window.location.href = 'joinRoom.php';
    });
  });
  