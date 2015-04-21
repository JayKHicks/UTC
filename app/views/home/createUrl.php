<div class="container box-container create-url collapsable">
	<div class="row">
		<div class="col-lg-12">
			<a data-toggle="collapse" href="#createForm"  class="collapsed" aria-expanded="false">
				<h1>Create URL</h1>
			</a>
			<form id="createForm" class="form-horizontal collapse">
				<!==  =CONCATENATE(E1,
				P1,if(isblank(U1),"REQUIRED FIELD",upper(U1)),
				H1,if(isblank(I1),"REQUIRED FIELD",lower(I1)),
				J1,if(isblank(K1),"REQUIRED FIELD",lower(K1)),
				F1,if(isblank(G1),"REQUIRED FIELD",lower(G1)),
				if(isblank(O1),"",N1&lower(O1)),
				if(isblank(M1),"",L1&lower(M1)))
				==>
				<div class="form-group">
					<label for="baseUrl" class="col-sm-2 control-label">Base URL (E)<span style="color:red;">*</span></label>
					<div class="col-sm-9">
						<input type="url" class="form-control" id="baseUrl" placeholder="Base Url" required="required">
					</div>
					<div class="col-sm-1">
						<a class="search" href="#">
							<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
						</a>
					</div>
				</div>
				<div class="form-group">
					<label for="inputI" class="col-sm-2 control-label">utm_medium (I)<span style="color:red;">*</span></label>
					<div class="col-sm-9">
					<select class="form-control" id="inputI" placeholder="utm_medium" required="required">
						<option value=""></option>
						<option value="AFF">affiliate</option>
						<option value="BA">display</option>
						<option value="DML">direct-mail</option>
						<option value="EML">email</option>
						<option value="FSI">fsi</option>
						<option value="MOB">mobile</option>
						<option value="OFF">offline-other</option>
						<option value="OOH">out-of-home</option>
						<option value="PPC">ppc</option>
						<option value="PRT">print-ad</option>
						<option value="RAD">radio</option>
						<option value="SOC">social</option>
						<option value="TVN">tv</option>
						<option value="five">overlay</option>
					</select>
						</div>
					<div class="col-sm-1">
					<a class="add" href="#">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					</a>
					</div>
				</div>

				<!-- existing modal -->
				<div id="existingModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Existing Values</h4>
							</div>
							<div class="modal-body">
								<p>Do you want to save changes you made to document before closing?</p>
								<p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Save changes</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Add Modal -->
				<div id="addModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Add </h4>
							</div>
							<div class="modal-body">
								<p>Do you want to save changes you made to document before closing?</p>
								<p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Save changes</button>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="inputK" class="col-sm-2 control-label">utm_source (K)<span style="color:red;">*</span></label>
					<div class="col-sm-9">
					<select class="form-control" id="inputK" placeholder="utm_source" required="required">
						<option value=""></option>
						<option value="one">exacttarget</option>
						<option value="two">Optln</option>
						<option value="three">NJTransit</option>
					</select>
					</div>
					<div class="col-sm-1">
						<a class="add" href="#">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</a>
					</div>
				</div>
				<div class="form-group">
					<label for="inputG" class="col-sm-2 control-label">utm_campaign (G)<span style="color:red;">*</span></label>
					<div class="col-sm-9">
					<select class="form-control" id="inputG" placeholder="utm_campaign" required="required">
						<option value=""></option>
						<option value="one">341</option>
						<option value="two">AL1065</option>
						<option value="three">AP1702</option>
						<option value="one">AP1711</option>
						<option value="two">AP_1638</option>
						<option value="three">AR1050</option>
					</select>
						</div>
					<div class="col-sm-1">
					<a class="add" href="#">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					</a>
						</div>
				</div>
				<div class="form-group">
					<label for="inputO" class="col-sm-2 control-label">utm_term (O)</label>
					<div class="col-sm-9">
					<input type="text" class="form-control" id="inputO" placeholder="utm_term">
						</div>
					<div class="col-sm-1">
					<a class="search" href="#">
						<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					</a>
						</div>
				</div>
				<div class="form-group">
					<label for="inputP" class="col-sm-2 control-label">utm_content (M)</label>
					<div class="col-sm-9">
					<input type="text" class="form-control" id="inputP" placeholder="utm_content">
						</div>
					<div class="col-sm-1">
					<a class="search" href="#">
						<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					</a>
						</div>
				</div>
				<div class="form-group">
					<label for="inputP" class="col-sm-2 control-label">(T)</label>
					<div class="col-sm-9">
					<input type="text" class="form-control" id="inputP" placeholder="T">
						</div>
					<div class="col-sm-1">
					<a class="search" href="#" id="inputP">
						<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					</a>
						</div>
				</div>
				<div class="form-group">
					<label for="inputU" class="col-sm-2 control-label">gps-source (U)</label>
					<div class="col-sm-9">
					<input type="text" class="form-control" id="inputU" placeholder="gps-source" required="required" readonly="readonly">
						</div>
					<!== Q.R.S.T ==>
					<!== Q=K ==>
					<!== R=I ==>
					<!== S=G ==>
					<!== K.I.G.T ==>
				</div>
				<div class="text-muted"><em><span style="color:red;">*</span> Indicates required field</em></div>
				<br />
				<button type="submit" class="btn btn-primary">Submit</button>

			</form>
		</div>
	</div>
</div>
