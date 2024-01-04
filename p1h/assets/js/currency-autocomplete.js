$(function(){
  var currencies = [
    { value: 'Handyman Deals', data: 'HD' },
    { value: 'Bathroom Remodeling', data: 'ALL' },
    { value: 'Remodeling Products', data: 'DZD' },
    { value: 'Plumbing', data: 'EUR' },
    { value: 'Electrical', data: 'AOA' },
    { value: 'Kitchen Remodeling', data: 'XCD' },
    { value: 'Carpentry', data: 'ARS' },
    { value: 'Maintenance', data: 'AMD' },
    { value: 'Assembly', data: 'ZWD' },
  ];
  
  // setup autocomplete function pulling from currencies[] array
  $('#autocomplete').autocomplete({
    lookup: currencies,
    onSelect: function (suggestion) {
      var thehtml = '<strong>Currency Name:</strong> ' + suggestion.value + ' <br> <strong>Symbol:</strong> ' + suggestion.data;
      $('#outputcontent').html(thehtml);
    }
  });
  

});