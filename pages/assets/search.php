<form id="search-form" class="mainscreen__form form-mainscreen">
    <div class="form-mainscreen__actions">
        <input onkeyup="myFunction()" id="search-input" autocomplete="off" type="text" name="search" data-error="Введите значение" placeholder="С чем помочь сегодня?" class="form-mainscreen__input">
        <button class="form-mainscreen__btn _icon-key" type="button"></button>
        <button class="form-mainscreen__btn _icon-search" type="submit"></button>
    </div>
    <div id="search" class="form-mainscreen__result result-search">

    </div>
</form>
<script>
    $("#search-form").submit(function (e) { 
        e.preventDefault();
        var a = $('#search-input').val();
        window.location.href = "/catalog?text="+a;
    });
    function myFunction() {
        // Declare variables
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById('search-input');
        filter = input.value.toUpperCase();
        ul = document.getElementById("search");
        li = ul.getElementsByTagName('a');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            txtValue = li[i].textContent || li[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>