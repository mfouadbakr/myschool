// document ready
$(document).ready(function(){
    

    $("#btn-generate").click(function(){
        $.ajax({
            url: 'ajax.php',
            data: {function2call: 'ajaxGenerateApp' , dynamic: $("#app-dynamic").html()},
            type: 'post',
            dataType: "text",
            success: function (data) {
                // action to be done
                
                alert("Success: Application was generated successfully");
                location.reload();
                },
                error: function(){
                    alert("failed to get levels");
                }
                });
      });

    // change program filter in school levels
    $("#filterProgram").change(function(){
        
            $.ajax({
                url: 'ajax.php',
                data: {function2call: 'ajaxGetLevels' , schoolProgID: $("#filterProgram").val()},
                type: 'post',
                dataType: "text",
                success: function (data) {
                    // action to be done
                    $('#levels-results').empty();
                    $("#levels-results").append(data);
                    },
                    error: function(){
                        alert("failed to get levels");
                    }
                    });
        
        
      });

      $("#filterProgramUser").change(function(){
        
        $.ajax({
            url: 'ajax.php',
            data: {function2call: 'ajaxGetLevelsUser' , schoolProgID: $("#filterProgramUser").val()},
            type: 'post',
            dataType: "text",
            success: function (data) {
                // action to be done
                $('#levelsResult').empty();
                $("#levelsResult").append(data);
                },
                error: function(){
                    alert("failed to get user levels");
                }
                });
    
  });
//school advising page - requests
  $("#filter-program").change(function(){
        
    $.ajax({
        url: 'ajax.php',
        data: {function2call: 'ajaxPrintRequests' , schoolProgID: $("#filter-program").val()},
        type: 'post',
        dataType: "text",
        success: function (data) {
            // action to be done
            $('#table-requests').empty();
            $("#table-requests").append(data);
            },
            error: function(){
                alert("failed to get requests");
            }
            });


});

//school advising page - appointments
$("#filter-appointment").change(function(){
        
    $.ajax({
        url: 'ajax.php',
        data: {function2call: 'ajaxPrintAppointments' , isAttended: $("#filter-appointment").val()},
        type: 'post',
        dataType: "text",
        success: function (data) {
            // action to be done
            $('#table-appointments').empty();
            $("#table-appointments").append(data);
            },
            error: function(){
                alert("failed to get appointments");
            }
            });


});

//school advising page - accept
$("#filter-accept").change(function(){
        
    $.ajax({
        url: 'ajax.php',
        data: {function2call: 'ajaxPrintAccept' , result: $("#filter-accept").val()},
        type: 'post',
        dataType: "text",
        success: function (data) {
            // action to be done
            $('#table-accept').empty();
            $("#table-accept").append(data);
            },
            error: function(){
                alert("failed to get acceptance");
            }
            });


});

  // function to get get variable
  function $_GET(param){
    var vars = {};
	window.location.href.replace( location.hash, '' ).replace( 
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;	
	}
	return vars;
  }

  // get static info in vaiables
  var lvlID;
  var fname,mname1,mname2,lname,gender,dob,nationality,pob,religion,address1,address2,hphone,lschool,primschool,prepschool,mjob,fjob;
  $("#next1").click(function(){
      // validations can occur here

      // assigning
      lvlID = $_GET('id');
    fname = $("#val-first").val();
    mname1 = $("#val-middle1").val();
    mname2 = $("#val-middle2").val();
    lname = $("#val-last").val();
    gender = $("#val-gender").val();
    dob = $("#val-dob").val();
    nationality = $("#val-nationality").val();
    pob = $("#val-birthplace").val();
    religion = $("#val-religion").val();
    address1 = $("#val-address1").val();
    address2 = $("#val-address2").val();
    hphone = $("#val-home").val();
    lschool = $("#val-school1").val();
    primschool = $("#val-school2").val();
    prepschool = $("#val-school3").val();
    mjob = $("#val-job1").val();
    fjob = $("#val-job2").val();
    
    
});

// submit request to school
$("#finish").click(function(){
    $.ajax({
        url: 'ajax.php',
        data: {function2call: 'ajaxSubmitRequest' 
        , xfinal: $("#final").html()
        , xlvlid: lvlID
        , xfname: fname
        , xmname1: mname1
        , xmname2: mname2
        , xlname: lname
        , xgender: gender
        , xdob: dob
        , xnationality: nationality
        , xpob: pob
        , xreligion: religion
        , xaddress1: address1
        , xaddress2: address2
        , xhphone: hphone
        , xlschool: lschool
        , xprimschool: primschool
        , xprepschool: prepschool
        , xmjob: mjob
        , xfjob: fjob
    },
        type: 'post',
        dataType: "text",
        success: function (data) {
            // action to be done
            //alert(data);
            alert("Success: Your request was submitted successfully to the school");
            window.location.href = 'index.php';

            },
            error: function(){
                alert("failed to submit request");
            }
            });
});
      

});


$(document).on('click', "#btn-logout", function() {
        $.ajax({
            url: 'ajax.php',
            data: {function2call: 'ajaxLogout'},
            type: 'post',
            dataType: "text",
            success: function (data) {
                // action to be done
                // redirect to index.php here
                window.location.href = 'index.php';
                },
                error: function(){
                    alert("failed to logout");
                }
                });
});

