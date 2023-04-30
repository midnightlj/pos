$(document).ready(function() {
  // initialize Select2
  $('#select-box').select2({
    placeholder: 'Select Access',
    minimumInputLength: 1,
    ajax: {
      url: 'get_access.php',
      dataType: 'json',
      delay: 250,
      data: function(params) {
        return {
          search: params.term
        };
      },
      processResults: function(data) {
        return {
          results: data.results
        };
      },
      cache: true
    }
  })
});