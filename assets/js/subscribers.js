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