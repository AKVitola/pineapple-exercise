// ============Ajax for subscribers id

function deleteSubscriber(id) {

  console.log(id);
  console.log("deleted");

  let data = {
    'subscriberId' : id
  };

  console.log(data);

  $.ajax({
    type     : 'POST',
    url      :'../subscribers/delete.php',
    data     : data,
    dataType : 'json',
    encode   : true
  })
  .done(function() {
      location.reload();
  });
}

// ========= Url for search

function searchEmail(event, column, sort_order, selectedProvider, searchVal) {

  event.preventDefault();

  let searchInput = document.getElementById("search").value;
  let url = window.location.origin + "/assets/subscribers/subscribers.php" + "?column=" + column + "&order=" +  sort_order;

  if (searchVal !== searchInput) {
    searchVal = searchInput;
  }
  if(selectedProvider) {
    url += "&provider=" + selectedProvider;
  }
  if (searchVal) {
    url += "&searchVal=" + searchVal;
  }

  window.location.assign(url);
}
