let flash = document.getElementById('flash');
  flash.classList.add('fadeout');
  setTimeout(function(){
    flash.style.display = "none";
  }, 1000);
