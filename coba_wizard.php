<style>
	body{ 
		margin-top:40px; 
	}

	.stepwizard-step p {
		margin-top: 10px;
	}

	.stepwizard-row {
		display: table-row;
	}

	.stepwizard {
		display: table;
		width: 100%;
		position: relative;
	}

	.stepwizard-step button[disabled] {
		opacity: 1 !important;
		filter: alpha(opacity=100) !important;
	}

	.stepwizard-row:before {
		top: 14px;
		bottom: 0;
		position: absolute;
		content: " ";
		width: 100%;
		height: 1px;
		background-color: #ccc;
		z-order: 0;

	}

	.stepwizard-step {
		display: table-cell;
		text-align: center;
		position: relative;
	}

	.btn-circle {
	  width: 30px;
	  height: 30px;
	  text-align: center;
	  padding: 6px 0;
	  font-size: 12px;
	  line-height: 1.428571429;
	  border-radius: 15px;
	}
</style>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<link href="plugins/chosen/chosen.min.css" rel="stylesheet">
<script src="plugins/chosen/chosen.jquery.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
		$('.chosen').chosen({
			width:'100%'
		});
	</script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
	<div class="stepwizard">
		<div class="stepwizard-row setup-panel">
			<div class="stepwizard-step">
				<a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
				<p>Step 1</p>
			</div>
			<div class="stepwizard-step">
				<a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
				<p>Step 2</p>
			</div>
			<div class="stepwizard-step">
				<a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
				<p>Step 3</p>
			</div>
		</div>
	</div>
	<form role="form">
		<div class="row setup-content" id="step-1">
			<div class="col-xs-12">
				<div class="col-md-12">
					<h3> Step 1</h3>
					<div class="form-group">
						<label class="control-label">First Name</label>
						<input  maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name"  />
					</div>
					<div class="form-group">
						<label class="control-label">Last Name</label>
						<input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Last Name" />
					</div>
					<button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
				</div>
			</div>
		</div>
		<div class="row setup-content" id="step-2">
			<div class="col-xs-12">
				<div class="col-md-12">
					<h3> Step 2</h3>
					<div class="form-group">
						<label class="control-label">Company Name</label>
						<input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
					</div>
					<div class="form-group">
						<label class="control-label">Company Address</label>
																			<select name="month" class="chosen form-control" data-parsley-group="experience" data-parsley-required>
														<option value="">Month</option>
														<option value="1">January</option>
														<option value="2">February</option>
														<option value="3">March</option>
														<option value="4">April</option>
														<option value="5">May</option>
														<option value="6">June</option>
														<option value="7">July</option>
														<option value="8">August</option>
														<option value="9">September</option>
														<option value="10">October</option>
														<option value="11">November</option>
														<option value="12">December</option>
													</select>
					</div>
					<button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
				</div>
			</div>
		</div>
		<div class="row setup-content" id="step-3">
			<div class="col-xs-12">
				<div class="col-md-12">
					<h3> Step 3</h3>
					<button class="btn btn-success btn-lg pull-right" type="submit">Finish!</button>
				</div>
			</div>
		</div>
	</form>
</div>
<script>
$(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});
</script>