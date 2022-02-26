//  tagfy.js 用の追加JS
let input = document.getElementById('input-custom-dropdown'),
    // init Tagify script on the above inputs
    tagify = new Tagify(input, {
      whitelist: ["#地震","#台風"],
      maxTags: 10,
      dropdown: {
        maxItems: 20,           // <- mixumum allowed rendered suggestions
        classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
        enabled: 0,             // <- show suggestions on focus
        closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
      }
    })

// flash message 用のJS
if (document.getElementById('flash')) {
    let flash = document.getElementById('flash');
    flash.classList.add('fadeout');
    setTimeout(function(){
      flash.style.display = "none";
    }, 3000);
}

