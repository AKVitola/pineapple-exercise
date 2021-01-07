// ============Ajax for subscribers id

function deleteSubscriber(id) {
  let data = {
    'subscriberId' : id
  };

  $.ajax({
    type     : 'POST',
    url      :'subscribers/delete.php',
    data     : data,
    dataType : 'json',
    encode   : true
  })
  .done(function() {
      location.reload();
  });
}

// ========= Url for search

function searchEmail(event, column, sort_order, selectedProvider, email) {

  event.preventDefault();

  let searchInput = document.getElementById("search").value;
  let url = window.location.origin + "/subscribers/subscribers.php" + "?column=" + column + "&order=" +  sort_order;

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
