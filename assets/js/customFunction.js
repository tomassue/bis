function editUser(that){
    status = $(that).attr('data-status');
    id     = $(that).attr('data-id');

    $('#status').val(status);
    $('#user_id').val(id);
}

function editPos(that){
    pos = $(that).attr('data-pos');
    order = $(that).attr('data-order');
    id = $(that).attr('data-id');

    $('#position').val(pos);
    $('#order').val(order);
    $('#pos_id').val(id);
}

function editChair(that){
    title = $(that).attr('data-title');
    id = $(that).attr('data-id');

    $('#chair').val(title);
    $('#chair_id').val(id);
}

function editHouseholdNumber(that){
    household_number = $(that).attr('data-household');
    house_no = $(that).attr('data-house_no');
    household_purok = $(that).attr('data-household_purok');
    household_street_name = $(that).attr('data-household_street_name');
    household_address = $(that).attr('data-household_address');
    household_type = $(that).attr('data-household_type');

    id_household = $(that).attr('data-id');

    $('#household_number').val(household_number);
    $('#house_no').val(house_no);
    $('#household_purok').val(household_purok);
    $('#household_street_name').val(household_street_name);
    $('#household_address').val(household_address);
    $('#household_type').val(household_type);

    $('#id_household').val(id_household);
}

function editPurok(that){
    purok = $(that).attr('data-name');
    details = $(that).attr('data-details');
    purok_id = $(that).attr('data-id');

    $('#purok').val(purok);
    $('#details').val(details);
    $('#purok_id').val(purok_id);
}

function editMedOrService(that){
    med_or_services_name = $(that).attr('data-name');
    ms_id = $(that).attr('data-id');

    $('#med_or_services_name').val(med_or_services_name);
    $('#ms_id').val(ms_id);
}

function editOrg(that){
    org = $(that).attr('data-name');
    details = $(that).attr('data-details');
    org_id = $(that).attr('data-id');

    $('#org').val(org);
    $('#details').val(details);
    $('#org_id').val(org_id);
}

function editPrecinct(that){
    precinct = $(that).attr('data-precinct');
    details = $(that).attr('data-details');
    id = $(that).attr('data-id');

    $('#precinct').val(precinct);
    $('#details').val(details);
    $('#precinct_id').val(id);
}

function editOfficial(that){
    id = $(that).attr('data-id');
    honorifics = $(that).attr('data-honorifics');
    na = $(that).attr('data-name');
    // chair = $(that).attr('data-chair');
    pos = $(that).attr('data-pos');
    start = $(that).attr('data-start');
    end = $(that).attr('data-end');
    status = $(that).attr('data-status');
    
    $('#off_id').val(id);
    $('#honorifics').val(honorifics);
    $('#name').val(na);
    // $('#chair').val(chair);
    $('#position').val(pos);
    $('#start').val(start);
    $('#end').val(end);
    $('#status').val(status);
}

function editBlotter1(that){
    id                      =   $(that).attr('data-id');
    blotter_date            =   $(that).attr('data-blotter_date');
    blotter_time            =   $(that).attr('data-blotter_time');
    blotter_status          =   $(that).attr('data-blotter_status');
    user_username           =   $(that).attr('data-user_username');

    $('#id').val(id);
    $('#blotterdate').val(blotter_date);
    $('#blottertime').val(blotter_time);
    $('#blotter_status').val(blotter_status);
    $('#user_username').val(user_username);
}

function editSupport(that){
    id_support = $(that).attr('data-id_support');
    status_support = $(that).attr('data-status_support');

    $('#id_support').val(id_support);
    $('#status_support').val(status_support);
}

function editNoc(that){
    noc_id       = $(that).attr('data-id');
    noc_name = $(that).attr('data-noc_name');
    noc_details = $(that).attr('data-noc_details');

    $('#noc_id').val(noc_id);
    $('#noc_name').val(noc_name);
    $('#noc_details').val(noc_details);
}

//DISABLE IDENTITY WHEN VSTATUS IS NO
$('.vstatus').change(function(){
    var val = $(this).val();
    if(val=='No'){
        $('.indetity').prop('disabled', true);
    }else{
        $('.indetity').prop('disabled', false);
    }
});

///////////////////////////////////////////////////////////////////////////////////

$('.noc').change(function(){
    var val = $(this).val();
    if(val=='Others'){
        $('.noc_others').prop('disabled', false);
    }else{
        $('.noc_others').prop('disabled', true);
    }
});

$('.isResident').change(function(){
    var val = $(this).val();
    if(val=='Yes'){
        $('.comp_name').prop('disabled', false);
    }else{
        $('.comp_name').prop('disabled', true);
    }
});

$('.isResident').change(function(){
    var val = $(this).val();
    if(val=='No'){
        $('.comp_nameNotResident').prop('disabled', false);
    }else{
        $('.comp_nameNotResident').prop('disabled', true);
    }
});

$('.isResident').change(function(){
    var val = $(this).val();
    if(val=='No'){
        $('.comp_addNotResident').prop('disabled', false);
    }else{
        $('.comp_addNotResident').prop('disabled', true);
    }
});

$('.isResident').change(function(){
    var val = $(this).val();
    if(val=='No'){
        $('.comp_cnumNotResident').prop('disabled', false);
    }else{
        $('.comp_cnumNotResident').prop('disabled', true);
    }
});


///////////////////////////////////////////////////////////////////////////////////

$(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
});


Webcam.set({
    height: 250,
    image_format: 'jpeg',
    jpeg_quality: 90
});

$('#open_cam').click(function(){
    Webcam.attach( '#my_camera' );
});

function save_photo() {
    // actually snap photo (from preview freeze) and display it
    Webcam.snap( function(data_uri) {
        // display results in page
        document.getElementById('my_camera').innerHTML = 
        '<img src="'+data_uri+'"/>';
        document.getElementById('profileImage').innerHTML = 
        '<input type="hidden" name="profileimg" id="profileImage" value="'+data_uri+'"/>';
    } );
}

$('#open_cam1').click(function(){
    Webcam.attach( '#my_camera1' );
});

function save_photo1() {
    // actually snap photo (from preview freeze) and display it
    Webcam.snap( function(data_uri) {
        // display results in page
        document.getElementById('my_camera1').innerHTML = 
        '<img src="'+data_uri+'"/>';
        document.getElementById('profileImage1').innerHTML = 
        '<input type="hidden" name="profileimg" id="profileImage1" value="'+data_uri+'"/>';
    } );
}

function goBack() {
  window.history.go(-1);
}