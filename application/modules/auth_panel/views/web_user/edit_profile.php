<?php
$option = array(
	'is_json' => false,
	'url' => site_url() . '/service_fetch_user_primary_record',
	'data' => json_encode(array('user_id' => $user_id))
);

$result = get_data_with_curl($option);
$user_data = $result['Result'];
/* loading side bar view for user */
$this->load->view('web_user/user_side_bar' ,array("user_data"=>$user_data) ); 

?>


<aside class="profile-info col-lg-9">
	<section class="panel">
		<div class="panel-body bio-graph-info">
			<h1> Profile Info</h1>
			<form class="form-horizontal" role="form">
				<div class="form-group">
					<label class="col-lg-2 control-label">About Me</label>
					<div class="col-lg-10">
						<textarea name="" id="" class="form-control" cols="30" rows="10"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">First Name</label>
					<div class="col-lg-6">
						<input class="form-control" id="f-name" placeholder=" " type="text">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Last Name</label>
					<div class="col-lg-6">
						<input class="form-control" id="l-name" placeholder=" " type="text">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Country</label>
					<div class="col-lg-6">
						<input class="form-control" id="c-name" placeholder=" " type="text">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Birthday</label>
					<div class="col-lg-6">
						<input class="form-control" id="b-day" placeholder=" " type="text">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Occupation</label>
					<div class="col-lg-6">
						<input class="form-control" id="occupation" placeholder=" " type="text">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Email</label>
					<div class="col-lg-6">
						<input class="form-control" id="email" placeholder=" " type="text">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Mobile</label>
					<div class="col-lg-6">
						<input class="form-control" id="mobile" placeholder=" " type="text">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Website URL</label>
					<div class="col-lg-6">
						<input class="form-control" id="url" placeholder="http://www.demowebsite.com " type="text">
					</div>
				</div>

				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<button type="submit" class="btn btn-success">Save</button>
						<button type="button" class="btn btn-default">Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</section>
	<section>
		<div class="panel panel-primary">
			<div class="panel-heading"> Sets New Password </div>
			<div class="panel-body">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label class="col-lg-2 control-label">New Password</label>
						<div class="col-lg-6">
							<input class="form-control" id="n-pwd" placeholder=" " type="password">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Re-type New Password</label>
						<div class="col-lg-6">
							<input class="form-control" id="rt-pwd" placeholder=" " type="password">
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button type="submit" class="btn btn-info">Save</button>
							<button type="button" class="btn btn-default">Cancel</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</aside>
