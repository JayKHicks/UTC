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
							{{each(key,val) urlBuilderConfig['editFields']}}
							<h1 class="line"><span>${key}</span></h1>
								{{each(group,item) val}}
								<div class="form-group">
									{{each item}}
									<div class="col-sm-${size}">
										<label class="control-label ${classname}">${label}</label>
											{{if type === 'select'}}
											<select class="form-control">
												<option val="">--</option>
											</select>
											{{else}}
											<input type="text" class="form-control" ${attr}>
											{{/if}}
									</div>
									{{/each}}
								</div>
								{{/each}}
							{{/each}}
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
