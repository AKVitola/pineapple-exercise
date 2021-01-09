function deleteSubscriber(id) {

  const data = {
    "subscriberId" : id,
    "submit" : "delete"
  };

  $.ajax({
    type     : "POST",
    url      : "../functionality.php",
    data     : data,
    dataType : "json",
    encode   : true
  })

  .done(function() {
      location.reload();
  });
}

// ========= Url for search
function searchEmail(event, column, sortOrder, selectedProvider, email) {

  event.preventDefault();

  let searchInput = document.getElementById("search").value;
  let url = window.location.origin + "/subscribers.php" + "?column=" + column + "&order=" +  sortOrder;

  if (email !== searchInput) {
    email = searchInput;
  }

  if(selectedProvider) {
    url += "&provider=" + selectedProvider;
  }

  if (email) {
    url += "&email=" + email;
  }

  window.location.assign(url);
}
