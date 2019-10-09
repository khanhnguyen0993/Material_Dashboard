$(() => {

  //Get date form db
  // let dateFromDB = new Date ($(".datepicker").val());
  // Format date
  // console.log($(".datepicker").val());
  //$(".datepicker").val(('0' + dateFromDB.getDate()).slice(-2) + '/' + ('0' + (dateFromDB.getMonth()+1)).slice(-2) + '/' + dateFromDB.getFullYear());

  $(".datepicker").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: "dd/mm/yy"
  });

  $('#searchListener').select2({
    placeholder: "Select a listener",
    allowClear: true,
    language: {
      noResults: function (){
        return "No Results Found - <a href='#' class='text-info' data-toggle='modal' data-target='#listenerModal'>Quickly create a new listener</a>";
      }
    },
    escapeMarkup: function (markup) {
        return markup;
    }  
  });

  $('#selectedPrize').select2();
  $('#pickupStatus').select2();

  $('.dataTable').DataTable();

  $(document).on('change', '#searchListener', function(){
    console.log(this.options[this.selectedIndex].value);
    $('#listener_id').val(this.options[this.selectedIndex].value);
    if ($(this).val()) {
      axios.get('/searchListener', {
        params: { query: this.options[this.selectedIndex].value}
      })
      .then(
        resp => {
          $('#name').html('<a class="text-info" href="/listeners/'+resp.data.id+'">'+resp.data.firstName+'</a>'),
          $('#phone').text(resp.data.phone),
          $('#participation').text(resp.data.participations),
          $('#suburb').text(resp.data.suburb),
          $('#moreInfo').html('<a href="/listeners/'+resp.data.id+'"><i class="fa fa-info-circle fa-lg text-info"></i></a>')
        })
      .catch(error => console.log(error));
    }
    $('.btn-add').prop('disabled', false);
  });

  // User-Show: Script for getting admin details displayed in Modal
  $(document).on('click', '.adminInfo', function(){
    console.log($(this).data('id'));
    axios.get('/users/'+$(this).data('id'))
    .then(
      resp => {
        $('#userName').val(resp.data.name),
        $('#userEmail').val(resp.data.email),
        $('#userType').val(resp.data.type),
        $('.updateUser').attr("data-id", $(this).data('id')),
        $('.deleteUser').attr("data-id", $(this).data('id')),
        resp.data.editRight?$('#userName, #userEmail, #userType').removeAttr("disabled"):$('#userName, #userEmail, #userType').attr("disabled",""),
        resp.data.editRight?$('#update-delete').show():$('#update-delete').hide()
      })
    .catch(error => console.log(error));
  });

  // User-Update: Script for updating admin details
  $(document).on('click', '.updateUser', function(){
    //console.log('ID: ' + $(this).attr("data-id"));

    //prepare data to update
    var data = {
      "id" : $(this).attr("data-id"),
      "name" : $('#userName').val(),
      "email": $('#userEmail').val(),
      "type" : $('#userType').val()
    };
    // console.log(data);
    axios.put('/users/'+$(this).attr("data-id"), {data:data})
    .then(
      ()=>{
        $('#loader').addClass("loader");
        $("#userTable").load(location.href + " #userTable");
        $('#loader').removeClass("loader");
      })
    .catch(error => {location.reload();console.log(error); });
  });

  // User-Delete
  $(document).on('click', '.deleteUser', function(){
    axios.delete('/users/'+$(this).attr("data-id")).then(()=>$("#userTable").load(location.href + " #userTable")).catch(error => console.log(error));
  });


  // Delete confirmation
  $(document).on('click', '[data-toggle="modal"]', function(e){
    // convert target (the button) to jQuery obj
    var $target = $(e.target);
    // Modal targeted by the button
    var modalSelector = $target.data('target');
    // get the value data-id from the button
    var dataValue = $target.data('id');
    // update(NOT SET) the data-id of the modal
    // $(modalSelector).attr('id', dataValue); --> attr -> Set only not update
    $(modalSelector).data('id', dataValue);
    if ($target.data('prize-id')) {
      $(modalSelector).data('prize-id', $target.data('prize-id'));
    }
    if ($target.data('participant-id')) {
      $(modalSelector).data('participant-id', $target.data('participant-id'));
    }
    // console.log($(modalSelector).data('id'));
    // console.log($target.data('prize-id'));
  })

  $(document).on('click', '#deleteConfirmation #delete-btn', function(){
    var obj = $('#deleteConfirmation').data('id');
    if (obj === 'prize') {
      $('#prizeDeleteForm-'+$('#deleteConfirmation').data('prize-id')).submit();
    } else if (obj === 'competition') {
      $('#competitionDeleteForm').submit();
    } else if (obj === 'participant') {
      $('#participantDeleteForm-'+$('#deleteConfirmation').data('participant-id')).submit();
    } else if (obj === 'listener') {
      console.log(`abcabca`);
      $('#listenerDeleteForm').submit();
    }
  });

  $(document).on('click', '.table-row', function() {
    window.document.location = $(this).data("href");
  });

  // Main search using Typeahead 
  // Set the options for "bloodhound" suggestion engine

  var engine = new Bloodhound({
    remote: {
      url: '/find?q=%QUERY%',
      wildcard: '%QUERY%'
    },
    datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
    queryTokenizer: Bloodhound.tokenizers.whitespace
  });

  $("#mainSearch").typeahead({
    hint:true, 
    highlight: true,
    minLength: 1,
    limit: 10
  },{
    source: engine.ttAdapter(),
    // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
    name: 'listenersList',
    // The key from the array we want to display (listener, competition)
    templates:{
      empty: ['<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'],
      header: ['<div class="list-group search-results-dropdown">'],
      suggestion: function(data){
        return `<a href=${data.url} class="list-group-item text-info">${data.name} - ${data.extension}</a>`
      }
    }
  });

  $('.checkAvailablePrizes').each((index, ele)=>{ele.style.color = ele.innerHTML < 11 ? "red" : "";})


  $(document).on('change', '#cashPrize', function() {
    numberValidation($(this));
  });
  $(document).on('change', '#prizeAmount', function(){
    numberValidation($(this));
  })

  function numberValidation(input){
    if(isNaN(input.val())){
      input.removeClass('is-valid');
      input.addClass('is-invalid');
    }else{
      input.removeClass('is-invalid');
      input.addClass('is-valid');
    }
  }



});
