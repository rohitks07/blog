@if(request()->ajax())

<div class="row align-items-center options" style="margin-bottom: 10px;">
	<div class="col-sm-12">
		<h5 class="pt-2 pb-2 bg-primary text-center" style="color:#fff;">Extras</h5>
	</div>

	<div class="col-sm-4">
		<label class="form-control-label">Option: </label>
		<input type="text" name="extras[option][]" class="form-control" value="" placeholder="size">
	</div>
	<div class="col-sm-8">
		<label class="form-control-label">Values:</label>
		<input type="text" name="extras[values][]" class="form-control" placeholder="options1 | option2 | option3" />
		<label class="form-control-label" style="margin-top: 3px;" >Additional Prices:</label>
		<input type="text" name="extras[prices][]" class="form-control" placeholder="price1 | price2 | price3" />
	</div>
</div>

@else
<p class="alert alert-danger">You Can not Access Directly!!!!</p>
@endif



<!-- <div class="row align-items-center options">
    <div class="col-sm-4">
        <label class="form-control-label">Option <span class="count">1</span></label>
        <input type="text" class="form-control" name="extra[option][]" placeholder="size">
    </div>
    <div class="col-sm-8">
        <label class="form-control-label">Values </label>
        <input type="text" class="form-control" name="extra[values][]" placeholder="option1 | option2 | option3">
        <label class="form-control-label">Additional Prices</label>
        <input type="text" class="form-control" name="extra[prices][]" placeholder="price1 | price2 | price3">
    </div>
</div> -->
