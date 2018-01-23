jQuery(document).ready(function($) {

  // Perform AJAX login on form submit
  $('form#equityx_form').on('submit', function(e){
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: ajax_form_object.ajaxurl,
      data: $this.serialize(),
      success: function(data){
          document.location.href = ajax_from_object.this;
      }
    });
    e.preventDefault();
  });

});