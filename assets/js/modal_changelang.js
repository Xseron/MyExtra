const languages = ["Russian", "English", "Kazakh"]
let current = 0

if( !getCookie("language") ){
    $(`.popup`).css({"display":"block"})
}


function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

// function changeLanguage(cur, delta){
//     if (cur+delta >= languages.length){
//         cur = -1
//         current = -1
//     }
//     else if (cur+delta < 0){
//         cur = languages.length
//         current = languages.length
//     }
//     $('.lang').text(languages[cur+delta])
//     current += delta
// }

// function selectLanguage(cur){
//     localStorage.setItem("lang", languages[cur])
//     $(`.popup`).css({"display":"none"})
// }

function openPopupWithLanguage(){
    $(`.popup`).css({"display":"block"})
}

function pickLanguage(lang){
    document.cookie = encodeURIComponent("language") + '=' + encodeURIComponent(lang);
    $(`.popup`).css({"display":"none"})
}


$('.Kazakh').click(function(){ pickLanguage("Kazakh")})
$('.Russian').click(function(){ pickLanguage("Russian")})
$('.English').click(function(){ pickLanguage("English")})
$('.Select').click(function(){ pickLanguage("Russian")})


