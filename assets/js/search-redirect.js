function submitSearchForm(event) {
   event.preventDefault();
   const searchInput = document.getElementById("searchInput");
   const searchValue = searchInput.value.trim();
   if (searchValue !== "") {
      window.location.href = `./search.php?name=${encodeURIComponent(
         searchValue
      )}`;
   }
}
