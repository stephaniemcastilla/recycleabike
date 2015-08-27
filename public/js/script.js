jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   Demo.init(); // init demo(theme settings page)
   ComponentsPickers.init();
   Index.init(); // init index page
   Tasks.initDashboardWidget(); // init task dashboard widget
  
   alert('test');
   var a=document.getElementsByTagName("a");
   for(var i=0;i<a.length;i++)
   {
       a[i].onclick=function()
       {
           window.location=this.getAttribute("href");
           return false
       }
   }
});

function autofill(event) {
      var min_length = 0; // min caracters to display the autocomplete
      var keyword = $('#autofill').val();
      
      // send an ajax-request to this URL: current-server.com/songs/ajaxGetStats
      // "url" is defined in views/_templates/footer.php
      if (keyword.length >= min_length) {
        $.ajax(
          {
             url: "/people/getPeopleByLast",
             type: 'POST',
             data: {keyword:keyword, event:event},
             success:function(data){
                  if ($('#autofill').val() != ""){
                      $('#autofill-results').show();
                      $('#autofill-results tbody').html(data);
                  }else{
                      $('#autofill-results').hide();
                  }
             }
            })
      };
};

  function signInVolunteer(person_id) {
    $('#mode').val('points');
    $('#person_id').val(person_id);
  }
  
  function signInCustomer(person_id) {
    $('#mode').val('revenue');
    $('#person_id').val(person_id);
  }