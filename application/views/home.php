<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/style2.css" type="text/javascript">

<div class="refferal_form-box"> 
    <h2>Enter Refferal</h2>
    <form id="form" class="refferal_form" action="">
        <input id="name-input" name="ref" type="text" minlength="6" maxlength="6" placeholder="code refferal, ex: REF001" autocomplete="off" required="required" class="refferal_form_input" />
        <p class="err-input"></p>
        <div class="btn-submit"><button type="submit"> <span>Submit</span></button></div>
    </form>

    <div class="refferal_result"> 
        <div class="res-200">
            <p><span>Name : </span><span id="name"></span></p>
            <p><span>Sex : </span><span id="sex"></span></p>
            <p><span>Hobby : </span><span id="hobby"></span></p>
            <p><span>City : </span><span id="city"></span></p>
            <p><span>Country : </span><span id="country"></span></p>
        </div>
        <div class="res-403">
            <p><span id="403"></span></p>
        </div>
        
    </div>
</div>


<script src="<?php echo base_url() ?>assets/jquery.min.js" type="text/javascript"></script>
<script>



    $("#name-input").on('change keydown paste input', function(){
        var val = this.value;
        var alphanumeric = /[^a-z\d]/i;
        var min = /^.{6,}$/;

        var valid_alphanumeric = !(alphanumeric.test(val));
        var valid_min = (min.test(val));

        if (valid_alphanumeric && valid_min) {
            $(".err-input").hide()
            $(".btn-submit").show()
        }else{
           $(".err-input").show()
           $(".btn-submit").hide()
           $("div.refferal_result").hide()
           $(".err-input").html("input must be alphanumeric and six character")
        }

        // console.log(Valid);

    });

    //form enter action
    $('#form').keypress(function (e) {
      if (e.which == 13) {
        e.preventDefault();
        process();
      }
    });

    //form click submit
    $('form').on('submit', function (e) {
        e.preventDefault();

        process();
    });

    function process() {
        //show box result when submit
        $("div.refferal_result").show();

        $.ajax({
            url: "<?php echo base_url('Process') ?>",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function (data) {
                var status = data.status;

                //if response not found
                if (status==403) {
                    $("div.res-200").hide()
                    $("div.res-403").show()
                    $('#403').html(data.data)
                }

                //if response true
                if (status==200) {

                    $("div.res-403").hide()
                    $("div.res-200").show()

                    //set data to view
                    $('#name').html(data.data[0].owner_name)
                    $('#sex').html(data.data[0].owner_sex)
                    $('#hobby').html(data.data[0].owner_hobby)
                    $('#city').html(data.data[0].owner_city)
                    $('#country').html(data.data[0].owner_country)

                }

            },
        }); 
    }
	
</script>	