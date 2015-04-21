<!-- Usage:
$(template).tmpl(dataModel).appendTo(element)
example: $("#urlTableTemplate").tmpl(data).appendTo("#urlTable")
-->

<script id="urlTableTemplate" type="text/x-jquery-tmpl">
	${( $data.columnCount = columns.length ),''}
	${( $data.rowCount = 0 ),''}
	<table class="table">
		<thead>
			<tr>
				{{each columns}}
				<th>${$value}</th>
				{{/each}}
			</tr>
		</thead>
		<tbody>
			{{each data}}
			${( $data.editable = urlBuilderConfig['markets'].indexOf(siteCode) > -1 ? true : false ),''}
			${( $data.editClass = editable === true ? " collapsed accordion-toggle" : "" ),''}
			{{each urls}}
			${( $data.colorClass = rowCount%2 === 0 ? " odd" : "" ),''}
			<tr class="item${editClass}${colorClass}" siteCode="${siteCode}" searchId="${id}" data-toggle="collapse" data-target="#item${id},#divItem${id}">
				<td>${url}</td>
				<td><i class="fa fa-pencil-square-o"></i></td>
			</tr>
			${ ($data.rowCount += 1/4), ''}
			{{if editable === true}}
			<tr class="accordion-body collapse edit-form" searchId="${id}" id="item${id}">
				<td colspan="${columnCount}">
					<div class="accordion-body collapse" id="divItem${id}">
						<form class="edit-url form-horizontal">
							<h1>URLs</h1>
							<div class="form-group">
							<div class="col-sm-11 tracking">
								<label class="control-label">Tracking URL</label>
								<input type="text" class="form-control">
							</div>
							</div>
							<div class="form-group">
								<div class="col-sm-11 vanity">
									<label class="control-label">Vanity URL</label>
									<input type="text" class="form-control">
								</div>
							</div>
							<h1>Tracking Codes</h1>
							<div class="form-group">
								<div class="col-sm-2 utml_compaign">
									<label class="control-label">Utml_campaign</label>
									<select class="form-control">
										<option val="">--</option>
										<option>val1</option>
										<option>val2</option>
									</select>
								</div>
								<div class="col-sm-2 utml_medium">
									<label class="control-label">Utml_medium</label>
									<select class="form-control">
										<option val="">--</option>
										<option>val1</option>
										<option>val2</option>
									</select>
								</div>
								<div class="col-sm-2 utml_source">
									<label class="control-label">Utml_source</label>
									<select class="form-control">
										<option val="">--</option>
										<option>val1</option>
										<option>val2</option>
									</select>
								</div>
								<div class="col-sm-2 utml_content">
									<label class="control-label">Utml_content</label>
									<select class="form-control">
										<option val="">--</option>
										<option>val1</option>
										<option>val2</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-2 utml_term">
									<label class="control-label">Utml_term</label>
									<select class="form-control">
										<option val="">--</option>
										<option>val1</option>
										<option>val2</option>
									</select>
								</div>
								<div class="col-sm-2 gps_source">
									<label class="control-label">GPS Source</label>
									<select class="form-control">
										<option val="">--</option>
										<option>val1</option>
										<option>val2</option>
									</select>
								</div>
							</div>
							<div class="form-group table-buttons">
								<button type="submit" class="btn btn-primary delete">Delete</button>
								<button type="submit" class="btn btn-primary submit">Submit</button>
							</div>
						</form>
					</div>
				</td>
			</tr>
			{{/if}}
			{{/each}}
			{{/each}}
		</tbody>
	</table>
</script>
