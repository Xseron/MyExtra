const languages = ["Russian", "English", "Kazakh"]
let current = 0


if( !localStorage.getItem("lang") ){
    $(`.popup`).css({"display":"block"})
}


function changeLanguage(cur, delta){
    if (cur+delta >= languages.length){
        cur = -1
        current = -1
    }
    else if (cur+delta < 0){
        cur = languages.length
        current = languages.length
    }
    $('.lang').text(languages[cur+delta])
    current += delta
}

function selectLanguage(cur){
    localStorage.setItem("lang", languages[cur])
    $(`.popup`).css({"display":"none"})
}

function openPopupWithLanguage(){
    $(`.popup`).css({"display":"block"})
}

$('.Previous').click(function(){ changeLanguage(current, -1)})
$('.Next').click(function(){ changeLanguage(current, 1)})
$('.Select').click(function(){ selectLanguage(current)})


